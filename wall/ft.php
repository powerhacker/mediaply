<?
$path = '..';

require($path.'/_common.php');

if (!$_GET['page']) {
	alert('정상적인 경로로 접근해주세요.');
	location_replace($ft['path']);
}

if ($_GET['username']) {
	$profile = mysql_fetch_assoc(mysql_query('SELECT * FROM `users` WHERE `username`="'.$_GET['username'].'";'));
} else {
	$profile = mysql_fetch_assoc(mysql_query('SELECT * FROM `users` WHERE `username`="'.$user['username'].'";'));
}

if (!$profile['profile_pic']) $profile['profile_pic'] = 'default.jpg';

if ($user['username'] == $profile['username']) {
	$is_mypage = 1;
} else {
	$is_mypage = 0;
}

require('includes/tolink.php');
require('includes/textlink.php');
require('includes/htmlcode.php');
require('includes/Expand_URL.php');
require('includes/time_stamp.php');

$profile_uid = $profile['uid'];

$rowsPerPage = 10;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>MEDIAPLY</title>
<link rel="stylesheet" type="text/css" href="<?=$ft['path']?>/css/common.css" />
<link rel="stylesheet" type="text/css" href="<?=$ft['path']?>/css/wall.css" />
<? if ($_GET['page']!='timeline') { ?>
<link rel="stylesheet" type="text/css" href="<?=$ft['wall_path']?>/css/facebox.css" />
<link rel="stylesheet" type="text/css" href="<?=$ft['wall_path']?>/css/tipsy.css" />
<link rel="stylesheet" type="text/css" href="<?=$ft['wall_path']?>/css/wall.css" />
<? } else { ?>
<link rel="stylesheet" type="text/css" href="<?=$ft['wall_path']?>/css/timeline.css" />
<? } ?>
<link rel="stylesheet" type="text/css" href="<?=$ft['wall_path']?>/css/uploadifive.css" />
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$ft['path']?>/js/ajaxfileupload.js"></script>
<!--<script type="text/javascript" src="<?=$ft['path']?>/js/ajaxFileUploadProgress.js"></script>-->
<script type="text/javascript" src="<?=$ft['path']?>/js/jcarousellite_1.0.1.min.js"></script>
<script type="text/javascript" src="<?=$ft['path']?>/js/basic.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/jquery.livequery.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/jquery.timeago.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/facebox.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/wall.js"></script>
<script type="text/javascript" src="<?=$ft['wall_path']?>/js/jquery.uploadifive.min.js"></script>
<script type="text/javascript">
var path = '<?=$ft['path']?>';

$(document).ready(function(){
	$("#searchinput").keyup(function(){
		var searchbox = $(this).val();
		var dataString = 'searchword=' + searchbox;

		if (searchbox.length > 0) {
			$.ajax({
				type: "POST",
				url: "<?=$ft['wall_path']?>/search_ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$("#display").html(html).show();
				}
			});
		}

		return false; 
	});

	$("#display").mouseup(function(){
		return false
	});

	$(document).mouseup(function(){
		$('#display').hide();
		$('#searchinput').val("");
	});
});
</script>
<style type="text/css">
.uploadifive-button {
	float: left;
	margin-right: 10px;
}
#queue {
	border: 1px solid #E5E5E5;
	height: 177px;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
	width: 300px;
}
</style>
</head>
<body <?=$profile['profile_bg']?'style="background:url(\''.$ft['path'].'/upload/profile_bg/'.$profile['profile_bg'].'\') '.($user['bg_repeat']=='Y'?'':'no-repeat').';"':''?>>
<? require($ft['wall_path'].'/topbar.php'); ?>

<? require($ft['wall_path'].'/ft/'.$_GET['page'].'.php'); ?>

<? require($ft['wall_path'].'/bottom.php'); ?>

<iframe id="hidden_iframe" src="" class="hide"></iframe>

</body>
</html>
