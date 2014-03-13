<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

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
</head>
<body>

<div id="pagewrap">
  <div class="content-main">
    <?php echo $this->getLayout(); ?>
  </div>
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