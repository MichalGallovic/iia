<?php
require_once('redirect.php');
require_once('helpers.php');

$psc = $_POST["psc"];
$fuelType = $_POST["price_search_fuel"];
$url = 'http://psc.posta.sk/?city=&street=&zip='.$psc;
$result = \IIA\makeCurlRequest($url);

$dom = new DOMDocument();
$encoded_result = str_replace("&","",$result);
$dom->loadHTML($encoded_result);
$finder = new DOMXPath($dom);
$nodes = $finder->query('//span[@class="city"]');

//see if we got any town
$town = $nodes->item(0);

if(!isset($town)) {
    $message = ["message"=>"Nesprávne PSČ"];
    \IIA\JSONResponse($message);

} else {
    $error = false;

    $town = $nodes->item(0)->nodeValue;
    $town = str_replace(" ", "+", $town);
    $town = iconv('utf-8','windows-1250',$town);

    $url = "http://www.benzin.sk/index.php?price_search_town=".$town."&price_submit=Vyh%BEada%9D&price_search_region=-1&price_search_brand=-1&price_search_fuel=".$fuelType."&price_search_day=7&selected_id=118&article_id=-1";
    $result = \IIA\makeCurlRequest($url);

    // had to turn warning for parsing - because of benzin.sk html5 validity ( i think)
    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    $dom->strictErrorChecking = false;
    $encoded_result = str_replace("&","",$result);
    $dom->loadHTML($encoded_result);

    $json = \IIA\parseDOMtoJSON($dom);

    if($error) {
        \IIA\JSONResponse($message);
    } else {
        \IIA\JSONResponse($json);
    }
}




