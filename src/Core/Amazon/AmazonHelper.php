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

    function __construct()
    {
        Configure::load('amazon', 'default');
        $this->awsAccessKey = Configure::read('AwsAccessKey');
        $this->awsSecretKey = Configure::read('AwsSecretKey');
    }



    function search($search)
    {
        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => $this->awsAccessKey,
            "AssociateTag" => "developement-20",
            "SearchIndex" => "All",
            "Keywords" => $search,
            "ResponseGroup" => "Images,ItemAttributes,Offers"
        );

        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n" . $this->endpoint . "\n" . $this->uri . "\n" . $canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->awsSecretKey, true));

        // Generate the signed URL
        $request_url = 'http://' . $this->endpoint . $this->uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);

        return $request_url;
    }
}