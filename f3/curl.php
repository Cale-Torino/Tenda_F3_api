<?php
/**
 * curl.php
 *
 * Send POST & GET requests via cURL
 *
 * @category   cURL requests
 * @package    cURL
 * @author     C.A Torino
 * @version    V1.0.0
 * @since      2022 November 21
 **/
//http://127.0.0.1/f3/curl.php?data=POST&url=http://192.168.8.102/goform/sysReboot&postdata=data&cookie=data
//http://127.0.0.1/f3/curl.php?data=GET&url=http://192.168.8.102/goform/getHomePageInfo?random=0.7189040724881826&modules=loginAuth,wifiRelay&cookie=data

$data = filter_input(INPUT_GET, 'data', FILTER_SANITIZE_URL);
$data = urldecode($data);

$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
$url = urldecode($url);

$postdata = filter_input(INPUT_GET, 'postdata', FILTER_SANITIZE_URL);
//$postdata = urldecode($postdata);
//$postdata = urldecode($postdata);

$Cookie = filter_input(INPUT_GET, 'cookie');
//$Cookie = base64_decode($Cookie);

//$url = "http://192.168.8.1/api/user/state-login";

// $headers = array(
//     "Content-Type: application/json", application/x-www-form-urlencoded
//     "Authorization: Bearer e281ac2e7fb08803bcec63cac529507882dd1eeb"
// );

// $postdata = json_encode(array(
//     "username" => "admin",
//     "firstnonce" => "3aa02875ef55bebf3218d5cfee83b467854896b3fc8ea92ec3b6e174037cea78",
//     "mode"=>"1"
//   ));

$header1 = array();

function HandleHeaderLine($curl, $headerLine)
{
  global $header1;
  if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', $headerLine, $c) == 1)
  {
    $header1["Cookie"] = $c[1];
  }
  return strlen($headerLine);
}

if($data == "POST")
{
    cURLPOST($url,$postdata,$Cookie); 
}
else if($data == "GET")
{
    cURLGET($url,$Cookie);
}
else
{
    echo json_encode(array(
        "Error" => "1",
        "Message" => "No request provided"
      ));
}

function cURLGET($url,$Cookie){
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_COOKIE => $Cookie,
    CURLOPT_TIMEOUT => 0,
    //CURLOPT_HEADERFUNCTION => "HandleHeaderLine",
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  echo $response;
}

function cURLPOST($url,$postdata,$Cookie){
  global $header1;

$curl = curl_init();
//$postdata = json_encode($data);
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_COOKIE => $Cookie,
  CURLOPT_POSTFIELDS => $postdata,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_HEADERFUNCTION => "HandleHeaderLine",
  CURLOPT_FOLLOWLOCATION => false,//set to false to prevent long wait time while tenda index.html loads
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
  ),
));
$response = curl_exec($curl);

curl_close($curl);

if($header1)
{
  $j = json_encode($header1);
  header("Cookie: $j");
}
echo $response;
} 