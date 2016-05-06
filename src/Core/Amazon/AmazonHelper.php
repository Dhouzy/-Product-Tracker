<?php
/**
 * AmazonHelper
 * Created by M-A
 * Since: 04 Mar 2016
 *
 * Amazon Helper to communicate with the product api.
 * This class should be temporary while the service gets completed
 */

namespace App\Core\Amazon;

use Cake\Core\Configure;

class AmazonHelper
{

    private $endpoint = "webservices.amazon.ca";
    private $uri = "/onca/xml";
    private $awsAccessKey;
    private $awsSecretKey;
    private $associateTag;

    function __construct()
    {
        Configure::load('amazon', 'default');
        $this->awsAccessKey = Configure::read('AwsAccessKey');
        $this->awsSecretKey = Configure::read('AwsSecretKey');
        $this->associateTag = Configure::read('AssociateTag');
    }

    function search($search, $page)
    {
        $url = $this->_generateItemSearchURL($search, $page);

        return $this->_readSearchResult($url);
    }

    function findProduct($productASIN)
    {
        $url = $this->_generateItemLookupURL($productASIN);
        $jsonObj = $this->_getJSONFromURL($url);
        $item = $jsonObj->Items->Item;

        $amazonItem = $this->_readOneResult($item);

        return $amazonItem;
    }

    function getReviewUrl($productASIN){
        $amazonItem = $this->findProduct($productASIN);
        return $amazonItem->reviewUrl;
    }

    private function _readSearchResult($url)
    {
        $jsonObj = $this->_getJSONFromURL($url);
        $items = $jsonObj->Items;

        $searchResult = new SearchResult();
        $searchResult->moreSearchURL = isset($items->MoreSearchResultsUrl) ? $items->MoreSearchResultsUrl : null;
        $searchResult->numMaxPages = isset($items->TotalPages) ? $items->TotalPages : null;

        if(isset($items->Item)) {
            foreach ($items->Item as $item) {
                $amazonItem = $this->_readOneResult($item);
                $searchResult->addItem($amazonItem);
            }
        }

        return $searchResult;
    }

    private function _readOneResult($item)
    {
        $itemAttributes = $item->ItemAttributes;

        $amazonItem = new AmazonItem($item->ASIN, $itemAttributes->Title, $item->DetailPageURL);

        if(property_exists(get_class($itemAttributes), 'ListPrice')) {
            $amazonItem->fullPrice = $itemAttributes->ListPrice->Amount;
        }

        if(isset($item->OfferSummary) && isset($item->OfferSummary->LowestNewPrice)) {
            if(isset($item->OfferSummary->LowestNewPrice->Amount))
                $amazonItem->currentPrice = $item->OfferSummary->LowestNewPrice->Amount;

            $amazonItem->currentFormattedPrice = $item->OfferSummary->LowestNewPrice->FormattedPrice;
            if(isset($item->SmallImage)) {
                $amazonItem->smallImageLink = $item->SmallImage->URL;
                $amazonItem->largeImageLink =  $item->SmallImage->URL;
            }
            else {
                $amazonItem->smallImageLink = "";
            }
            if(isset($item->LargeImage)) {
                $amazonItem->largeImageLink = $item->LargeImage->URL;
            }
        }

        if(isset($itemAttributes->Brand))
            $amazonItem->brand = $itemAttributes->Brand;

        if(isset($itemAttributes->Color))
            $amazonItem->color = $itemAttributes->Color;

        if(isset($itemAttributes->PackageDimensions)){
            $dimensions = $itemAttributes->PackageDimensions;
            if(isset($dimensions->Length))
                $amazonItem->length = round($dimensions->Length / 3.937); // hundrenths of inches to millimeters
            if(isset($dimensions->Width))
                $amazonItem->width = round($dimensions->Width / 3.937);
            if(isset($dimensions->Height))
                $amazonItem->height = round($dimensions->Height / 3.937);
        }

        if(isset($itemAttributes->PackageDimensions->Weight))
            $amazonItem->weight = round($itemAttributes->PackageDimensions->Weight / 45359.2); // hundrenths of pounds to milligrams

        if(isset($item->CustomerReviews->IFrameURL))
            $amazonItem->reviewUrl = $item->CustomerReviews->IFrameURL;

        return $amazonItem;
    }

    private function _getJSONFromURL($url)
    {
        $content = file_get_contents($url);
        return $this->_parseXmlToJsonObj($content);
    }

    private function _generateItemSearchURL($search, $page)
    {
        $params = array(
            "Service" => "AWSECommerceService",
            "ItemPage" => $page,
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => $this->awsAccessKey,
            "AssociateTag" => $this->associateTag,
            "SearchIndex" => "All",
            "Keywords" => $search,
            "ResponseGroup" => "Images,ItemAttributes,Offers,Reviews"
        );

        return $this->_generateSearchURL($params);
    }

    private function _generateItemLookupURL($productASIN)
    {
        $params = array(
            "Service" => "AWSECommerceService",
            "AWSAccessKeyId" => $this->awsAccessKey,
            "AssociateTag" => $this->associateTag,
            "Operation" => "ItemLookup",
            "ItemId" => $productASIN,
            "ResponseGroup" => "Images,ItemAttributes,Offers,Reviews"
        );

        return $this->_generateSearchURL($params);
    }

    private function _generateSearchURL($params)
    {
        if (!isset($params["Timestamp"]))
        {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value)
        {
            array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
        }

        $canonical_query_string = join("&", $pairs);
        $string_to_sign = "GET\n" . $this->endpoint . "\n" . $this->uri . "\n" . $canonical_query_string;
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->awsSecretKey, true));
        $request_url = 'http://' . $this->endpoint . $this->uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);

        return $request_url;
    }

    private function _parseXmlToJsonObj ($xml)
    {
        $xml = str_replace(array("\n", "\r", "\t"), '', $xml);
        $xml = trim(str_replace('"', "'", $xml));
        $simpleXml = simplexml_load_string($xml);
        $json = json_encode($simpleXml);
        $jsonObj = json_decode($json);

        return $jsonObj;
    }
}