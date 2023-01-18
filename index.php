<?php 
  
if($_GET['page_url'] != ""){ 
    $APK_ORIGINAL_NAME = substr($_GET['page_url'] , 26);  
    DL($APK_ORIGINAL_NAME); 
} 
  
function DL($APK_ORIGINAL_NAME){ 

$REQ = curl_init(); 
$header = [
'accept: application/json', 
'content-type: application/json', 
'origin: https://cafebazaar.ir', 
'referer: https://cafebazaar.ir/', 
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 Edg/108.0.1462.76']; 
curl_setopt($REQ, CURLOPT_URL, 'https://api.cafebazaar.ir/rest-v1/process/AppDownloadInfoRequest');
curl_setopt($REQ, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($REQ, CURLOPT_POSTFIELDS, "{\"properties\":{\"language\":2,\"clientVersionCode\":1100301,\"androidClientInfo\":{\"sdkVersion\":22,\"cpu\":\"x86,armeabi-v7a,armeabi\"},\"clientVersion\":\"11.3.1\",\"isKidsEnabled\":false},\"singleRequest\":{\"appDownloadInfoRequest\":{\"downloadStatus\":1,\"packageName\":\"$APK_ORIGINAL_NAME\",\"referrers\":[]}}}"); curl_setopt($REQ, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($REQ, CURLOPT_HTTPHEADER, $header); 
$ResponeREQ = curl_exec($REQ); 
$ResponeJson = json_decode($ResponeREQ , true); 
  
$Download1 = $ResponeJson['singleReply']['appDownloadInfoReply']['fullPathUrls'][0]; 

$Download2 = $ResponeJson['singleReply']['appDownloadInfoReply']['fullPathUrls'][1]; 
  
   echo(json_encode([
    'CafeBazaar Downloader v1', 
    'DownloadLink1' => $Download1, 
    'DownloadLink2' => $Download2
    ])); 
} 
  
?>
