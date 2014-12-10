<?php
require 'vendor/autoload.php';
$username = urlencode($_REQUEST['request']);
$client = new \Guzzle\Service\Client('https://api.github.com');


try {
    $try_guzzle = $client->get('users/'.$username.'?client_id=34914a31c721a58c49d3&client_secret=53087a8ee29a5260648be31d6580aee9c8e48341');
    $guzzle_response = $try_guzzle->send()->json();
    $git_repos = $client->get('users/'.$username."/repos")->send()->json();
    $repos = [];

    foreach($git_repos as $repo) {
        array_push($repos,["repo_name" => $repo['name'],
            "repo_url" => $repo['html_url'],
            "repo_description"  =>  $repo['description']]);
    }
    $fullname = "";
    if(isset($guzzle_response['name'])) {
        $fullname = $guzzle_response['name'];
    }
    $response = [
        "username"      =>  $guzzle_response['login'],
        "fullname"      =>  $fullname,
        "avatar_url"    =>  $guzzle_response['avatar_url'],
        "github_url"    =>  $guzzle_response['html_url'],
        "public_repos"  =>  $repos
    ];
} catch(\Guzzle\Http\Exception\RequestException $e) {
    $response = [
        "message"   =>  "User not found."
    ];
    http_response_code(404);
}


header("Content-Type: application/json");
echo json_encode($response);