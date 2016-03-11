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
use App\Core\Amazon\AmazonItem;
use App\Core\Amazon\SearchResult;

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
        $url = $this->_generateURL($search, $page);
        return $this->_readResult($url);
    }

    function nextItemsSearch($url)
    {
        return $this->_readResult($url);
    }

    private function _readResult($url)
    {
        $content = file_get_contents($url);
        $jsonObj = $this->_parseXmlToJsonObj($content);
        $items = $jsonObj->Items;

        $searchResult = new SearchResult();
        $searchResult->moreSearchURL = $items->MoreSearchResultsUrl;

        foreach($items->Item as $item)
        {
            $itemAttribute = $item->ItemAttributes;

            $amazonItem = new AmazonItem();
            $amazonItem->title = $itemAttribute->Title;
            $amazonItem->amazonLink = $item->DetailPageURL;
            if(property_exists(get_class($itemAttribute), 'ListPrice')) {
                $amazonItem->fullPrice = $itemAttribute->ListPrice->Amount;
            }

            if(isset($item->OfferSummary) && isset($item->OfferSummary->LowestNewPrice)) {
                $amazonItem->currentPrice = $item->OfferSummary->LowestNewPrice->Amount;
                $amazonItem->currentFormattedPrice = $item->OfferSummary->LowestNewPrice->FormattedPrice;
            }
            //$amazonItem->description = $item->EditorialReviews->EditorialReview->Content;

            $searchResult->addItem($amazonItem);
        }

        return $searchResult;
    }

    private function _generateURL($search, $page)
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
        echo "<script>console.log($json);</script>";

        $jsonObj = json_decode($json);

        return $jsonObj;
    }
}