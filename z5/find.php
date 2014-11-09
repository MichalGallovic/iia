<?php
require_once('redirect.php');
$psc = $_POST["psc"];
$fuelType = $_POST["price_search_fuel"];
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://psc.posta.sk/?city=&street=&zip='.$psc
));
// Send the request & save response to $resp
$result = curl_exec($curl);

// Close request to clear up some resources
curl_close($curl);
$dom = new DOMDocument();
$encoded_result = str_replace("&","",$result);
$dom->loadHTML($encoded_result);
$finder = new DOMXPath($dom);
$nodes = $finder->query('//span[@class="city"]');
$town = $nodes->item(0);
if(!isset($town)) {
    $message = ["message"=>"Nesprávne PSČ"];
    header('Content-Type: application/json');
    echo json_encode($message);
//    \IIA\movePage(200,)
} else {
    $town = $nodes->item(0)->nodeValue;
    $town = iconv('utf-8','windows-1250',$town);
    $query = "http://www.benzin.sk/index.php?price_search_town=".$town."&price_submit=Vyh%BEada%9D&price_search_region=-1&price_search_brand=-1&price_search_fuel=".$fuelType."&price_search_day=7&selected_id=118&article_id=-1";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $query
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->strictErrorChecking = false;
    $encoded_result = str_replace("&","",$result);
    $dom->loadHTML($encoded_result);
//$tables = $dom->getElementsByTagName("table");
    libxml_clear_errors();

    $finder = new DOMXPath($dom);
    $prices1 = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'pump_list_row1')]");
    $prices2 = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'pump_list_row2')]");

    $maxprices1 = $prices1->length;
    $maxprices2 = $prices2->length;
    $allprices = [];
    for($i = 0; $i < max($prices1->length, $prices2->length); $i++){
        if(($i+1) <= $maxprices1) {
//        echo $prices1->item($i)->textContent . "<br>";
            $petrolinfo = [];
            foreach($prices1->item($i)->childNodes as $item) {
                $data = $item->nodeValue;
                if($data) {
                    array_push($petrolinfo,$data);
                }
            }

            $petrolinfo = ['station'=>$petrolinfo[0],'price'=>$petrolinfo[1],'locality'=>$petrolinfo[2],'date'=>$petrolinfo[3]];
            array_push($allprices,$petrolinfo);
        }
        if(($i+1) <= $maxprices2) {
//        echo $prices2->item($i)->textContent . "<br>";
            $petrolinfo = [];
            foreach($prices2->item($i)->childNodes as $item) {
                $data = $item->nodeValue;
                if($data) {
                    array_push($petrolinfo,$data);
                }
            }
            $petrolinfo = ['station'=>$petrolinfo[0],'price'=>$petrolinfo[1],'locality'=>$petrolinfo[2],'date'=>$petrolinfo[3]];
            array_push($allprices,$petrolinfo);
        }
    }

    header("Content-Type: application/json");
    echo json_encode($allprices);
}




