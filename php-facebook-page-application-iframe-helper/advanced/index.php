<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Our sample application</title>
</head>
<body>
<?php 
$APP_SECRET = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
include_once("facebook_page_app.php");
$fpa = new Facebook_page_app($APP_SECRET); 
$page_url = "http://www.facebook.com/pages/Your-Page/YourPageId?sk=app_YourAppId"; // Replace this with the url of your page on facebook with your app selected
$app_data = $fpa->decodeAppData(); // This method looks for the presence of a submitted querystring
?>
<p>Hi and welcome to my page! This is a custom application</p>

<?php
//Lets check if the user likes our page - to do this we just call the isUserFan() method of our Facebook_page_app object
if($fpa->isUserFan()){
 echo "<p>Thanks very much for liking us on Facebook. As such let us present you with this exclusive voucher code for use on our website:<br />
 code:   VOUCHER123
 </p>
 <p>Once again many thanks -<br />Our Website Team</p> ";	

 }else{ // Doesn't look like they are a fan. Lets get them to sign up
	 echo "<p>It looks like you aren't a fan of ours! Click the &quot;Like&quot; link at the top of the page to get exclusive offers!</p>";
	 
 }
 
 // This next method create a link with a custom querystring for us to use. We can use querystring syntax or an array
 // QueryString
 echo "<p><a href=\"$page_url&app_data=". $fpa->encodeAppData("val=9&foo=bar")."\" target=\"_top\">test</a></p>";
 // ARRAY
 $params['val'] = 1;
$params['foo'] = 'bar';
 echo "<p><a href=\"$page_url&app_data=". $fpa->encodeAppData($params)."\" target=\"_top\">test</a></p>";
 
 if($app_data['foo'] === "bar"){
	 echo "<p>I only want to display this content if 'foo' is set to 'bar'</p>"; 
 }
 // Print out entire QS
 print_r($app_data); // Display the querystring
 
 include("facebook.php");
 $APP_ID = "xxxxxxxxxxxxxxxxxxxxxxxx";
 $facebook = new Facebook(array(
  'appId'  => $APP_ID, 
  'secret' => $APP_SECRET,
  'cookie' => true,
   'uploadSupport' =>true
)); 
 $session = $facebook->getSession();
$access_token = $facebook->getAccessToken();
$me = null;
// Session based API call.
if ($session) {
try { $uid = $facebook->getUser();
$me = $facebook->api('/me');
} catch (FacebookApiException $e) {
error_log($e);
}
} 
if($me){ // This line checks if we know who they are!
echo "<p>Hi, ".$me['name'].", I know who you are!</p>"	;
}else{ //If they haven't we can redirect them to a page to authorize our application. We have to use a redirect_uri to send them to the url of our site.
echo "<p>Looks like you haven't authorized my app. <a href=\"https://www.facebook.com/dialog/oauth?client_id=".$APP_ID."&redirect_uri=http://your-site.com/\" target=\"_top\">Authorize it here!</a></p>";	
}
 ?>

</body>
</html>
