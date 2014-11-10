<?php namespace IIA;

function makeCurlRequest($url) {
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url
	));
	// Send the request & save response to $resp
	$result = curl_exec($curl);

	// Close request to clear up some resources
	curl_close($curl);

	return $result;
}

function JSONResponse($text) {
    header('Content-Type: application/json');
    echo json_encode($text);
}

function parseDOMtoJSON($dom) {
    libxml_clear_errors();
    $error = false;
    $finder = new \DOMXPath($dom);
    // table rows are stripped - pump_list_row1, pump_list_row2
    $prices1 = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'pump_list_row1')]");
    $prices2 = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'pump_list_row2')]");

    $maxprices1 = $prices1->length;
    $maxprices2 = $prices2->length;

    $allprices = [];

    for($i = 0; $i < max($prices1->length, $prices2->length); $i++){
        if(($i+1) <= $maxprices1) {

            $petrolinfo = [];
            foreach($prices1->item($i)->childNodes as $item) {
                $data = $item->nodeValue;
                if($data) {
                    array_push($petrolinfo,$data);
                }
            }

            if(!isset($petrolinfo[1])) {
                $error = true;
                $message = ["message"=>"Pre dané kritéria, sme nenašli žiadne výsledky. "];
                break;
            }

            $petrolinfo = ['station'=>$petrolinfo[0],'price'=>$petrolinfo[1],'locality'=>$petrolinfo[2],'date'=>$petrolinfo[3]];
            array_push($allprices,$petrolinfo);
        }
        if(($i+1) <= $maxprices2) {

            $petrolinfo = [];
            foreach($prices2->item($i)->childNodes as $item) {
                $data = $item->nodeValue;
                if($data) {
                    array_push($petrolinfo,$data);
                }
            }
            if(!isset($petrolinfo[1])) {
                $error = true;
                $message = ["message"=>"Pre dané kritéria, sme nenašli žiadne výsledky. "];
                break;
            }
            $petrolinfo = ['station'=>$petrolinfo[0],'price'=>$petrolinfo[1],'locality'=>$petrolinfo[2],'date'=>$petrolinfo[3]];

            array_push($allprices,$petrolinfo);
        }
    }

    return ($error) ? $message : $allprices;
}