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
 
 ?>

</body>
</html>
