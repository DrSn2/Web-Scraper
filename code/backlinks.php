<?php
// Get your access id and secret key here: https://moz.com/products/api/keys
$accessID = "mozscape-66f3230ac7";
$secretKey = "2d88fe7a99ffb7bb5f5b94b1805f0168";
// Set your expires times for several minutes into the future.
// An expires time excessively far in the future will not be honored by the Mozscape API.
$expires = time() + 300;
// Put each parameter on a new line.
$stringToSign = $accessID."\n".$expires;
// Get the "raw" or binary output of the hmac hash.
$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
// Base64-encode it and then url-encode that.
$urlSafeSignature = urlencode(base64_encode($binarySignature));
// Add up all the bit flags you want returned.
// Learn more here: https://moz.com/help/guides/moz-api/mozscape/api-reference/url-metrics
$cols = "128";
// Put it all together and you get your request URL.
$requestUrl = "http://lsapi.seomoz.com/linkscape/links/moz.com?Scope=pagetopage&Sort=page_authority&Filter=internal+301&Limit=1&SourceCols=536870916&TargetCols= 4&AccessID=".$accessID."&Expires=1225138899&Signature=".$secretKey;
// Put your URLS into an array and json_encode them.
//$batchedDomains = array('www.moz.com');
//$encodedDomains = json_encode($batchedDomains);
// Use Curl to send off your request.
// Send your encoded list of domains through Curl's POSTFIELDS.
$options = array(
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POSTFIELDS     => $encodedDomains
	);
$ch = curl_init($requestUrl);
curl_setopt_array($ch, $options);
$content = curl_exec($ch);
curl_close( $ch );
$contents = json_decode($content);
print_r($contents);
?>