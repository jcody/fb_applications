<?php
include_once('Facebook_plugins_class.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<head> 
<title>Facebook Plugins Integration Demo</title> 

</head>
<body>


<h3>Facebook status update dialog</h3>
<div>
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->display_status_update(array('title'=>'Click here to update your Facebook status'));
	echo '1. Standard:<br>';
	echo '<b>'.$display.'</b>';
	
	echo '<br>';
	
	$display = $f1->display_status_update(array('title'=>'Click here to update your Facebook status', 'link'=>'http://yougapi.com'));
	echo '2. Update status + share an attached link:<br>';
	echo '<b>'.$display.'</b>';
	
	echo '<br><br>';
	
	$display = $f1->display_status_update(array('title'=>'Click here to update your Facebook status', 'link'=>'http://yougapi.com', 'description'=>'Have a look on the services offered by this company!', 'picture'=>'http://yougapi.com/include/images/yougapi_logo.png'));
	echo '3. Update status + share an attached link + description + custom picture attached:<br>';
	echo '<b>'.$display.'</b>';
	
	echo '<br><br>';
	echo '<b>Tip:</b><br>Our Facebook status function doesn\'t require your users to authorize your application before they can post to their wall. They can do it right away! Just try it yourself with one of the 3 examples above.';
	
	?>
</div>

<h3>Facebook Add Friend dialog</h3>
<div>
	<?php
	$f1 = new Facebook_plugins_class();
	echo '<div style="padding-bottom:8px;">Click on the link bellow to open the friends dialog</div>';
	$display = $f1->display_add_friend_dialog(array('title'=>'Add me on Facebook', 'id'=>'100002198068836'));
	echo '<b>'.$display.'</b>';
	?>
</div>
<h3>Facebook Like buttons</h3>
<div>
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_like_button(array('url'=>'http://codecanyon.net/item/facebook-wpress-viral-tool-for-wordpress/158212?ref=yougapi'));
	echo '<div style="padding-bottom:8px;">Available on codecanyon: <a href="http://codecanyon.net/item/facebook-wpress-viral-tool-for-wordpress/158212?ref=yougapi" target="_blank">Facebook WPress Viral tool for WordPress</a></div>';
	echo ''.$display.'<br><br>';
	?>
</div> 
<h3>Facebook Like box</h3> 
<div> 
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_like_box(array('url'=>'http://www.facebook.com/pages/Yougapi-Technology/162896513752848'));
	echo $display;
	?>
</div> 
<h3>Facebook comments</h3> 
<div> 
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_comments(array('num_posts'=>'20', 'width'=>'660'));
	echo $display;
	?>
</div> 
<h3>Facebook Facepile</h3> 
<div> 
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_facepile(array(''=>'', 'width'=>'660'));
	echo $display;
	?>
</div>
<h3>Facebook Live Stream</h3> 
<div> 
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_live_stream(array('width'=>'660', 'xid'=>'11'));
	echo $display.'<br><br>';
	?>
</div>
<h3>Facebook Recommendation box</h3> 
<div> 
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_recommendations(array('domain'=>'youtube.com', 'width'=>'460'));
	echo $display.'<br><br>';
	?>
</div>
<h3>Facebook Activity Feed</h3> 
<div> 
	<?php
	$f1 = new Facebook_plugins_class();
	$display = $f1->get_activity_feed(array('domain'=>'techcrunch.com', 'width'=>'460'));
	echo $display;
	?>
</div>

</body> 
</html> 