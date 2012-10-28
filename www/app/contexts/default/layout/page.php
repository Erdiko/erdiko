<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<!-- disable iPhone inital scale -->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

<?php
	// Spit out meta tags
	foreach($data->getMeta() as $name => $content)
		echo '<meta name="'.$name.'" content="'.$content.'" >';
?>

<title><?php echo $data->getPageTitle(); ?> - <?php echo $data->getTitle(); ?></title>

<?php
  // Spit out CSS
  foreach($data->getCss() as $css)
    echo "<link rel='stylesheet' href='".$css['file']."' type='text/css' />\n";
?>
<?php
// Detect mobile device
function isMobile() {
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobile()): ?>
<link href="/app/contexts/default/css/media-queries.css" rel="stylesheet" type="text/css">
<?php endif ?>

<!--[if lt IE 9]>
  <script src="/erdiko/libraries/javascript/html5.js"></script>
  <script src="/erdiko/libraries/javascript/css3-mediaqueries.js"></script>
<![endif]-->

</head>
<body>

<div id="pagewrap">
  <?php echo $data->getHeader(); ?>
  <div class="content-main">
    <?php echo $this->getLayout(); ?>
  </div>
  <?php echo $data->getFooter(); ?>
</div>

<?php
	// Spit out JS below the footer
	foreach($data->getJs() as $js)
		echo "<script src='".$js['file']."'></script>\n";
?>
<script type="text/javascript">/* <![CDATA[ */
$(document).ready(function() {

});
/* ]]> */</script>

</body>
</html>