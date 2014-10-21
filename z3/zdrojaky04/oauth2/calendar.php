<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../../googleAPI/src'); 
require_once 'Google/Client.php';
require_once 'Google/Service/Calendar.php';
//
 $application_name = 'MyCalendar';
 $client_id = '...';
 $client_secret = '...';
 $redirect_uri = '...';
 $developer_key = '...';
 
$client = new Google_Client();
//print_r($client);exit;
//$client->setUseObjects(true);
$client->setApplicationName($application_name);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setDeveloperKey($developer_key);

$client->setScopes(array(
    'https://www.googleapis.com/auth/calendar',
    'https://www.googleapis.com/auth/calendar.readonly',
));

if (isset($_GET['code'])) {

    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
        //print_r($_SESSION['token']);exit;
    //header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);


if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);

}
}
if ($client->getAccessToken()) {
    //echo 'innn';exit;
    $service = new Google_Service_Calendar($client);
      //echo '<pre>';      print_r($service);exit;
    //$calendar = $service->calendars->get('primary');
    //echo $calendar->getSummary();
 
 
 
        $events = $service->events->listEvents('primary');

            while(true) {
                foreach ($events->getItems() as $event) {
                    echo $event->getSummary();  echo "<br>";
                            }
                    $pageToken = $events->getNextPageToken();
                        if ($pageToken) {
                        $optParams = array('pageToken' => $pageToken);
                            $events = $service->events->listEvents('primary', $optParams);
                                        } else {
                                                    break;
                                                }
                        }

    $_SESSION['token'] = $client->getAccessToken();
} else {
    $authUrl = $client->createAuthUrl();
    print "<a class='login' href='$authUrl'>Connect Me!</a>";

}

?>