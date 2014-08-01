<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<?php
	// Spit out meta tags
	foreach($data->getMeta() as $meta)
  {
		  echo '<meta name="'.$meta['name'].'" content="'.$meta['content'].'" >';
  }
?>

<title><?php echo $data->getPageTitle() ?></title>

<?php
  // Spit out CSS
  foreach($data->getCss() as $css)
  {
    if($css['active'])
      echo "<link rel='stylesheet' href='".$css['file']."' type='text/css' />\n";
  }
?>
</head>
<body>

<div id="pagewrap">
  <?php echo $data->getTemplateHtml('header'); ?>
  <div class="container content-main">
    <?php echo $this->getContent(); ?>
  </div>
  <?php echo $data->getTemplateHtml('footer'); ?>
</div>

<?php
	// Spit out JS below the footer
	foreach($this->getJs() as $js)
  {
    if($js['active'])
      echo "<script src='".$js['file']."'></script>\n";
  }
?>
<script type="text/javascript">/* <![CDATA[ */
$(document).ready(function() {

});
/* ]]> */</script>

<?php echo $data->getTemplateHtml('analytics') ?>

</body>
</html>
