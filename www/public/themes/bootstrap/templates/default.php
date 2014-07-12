<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<?php
	// Spit out meta tags
	foreach($data->getMeta() as $name => $content)
		echo '<meta name="'.$name.'" content="'.$content.'" >';
?>

<?php
  // Determine page title
  $title = $data->getTitle();
  if( $data->getPageTitle() )
    $title = $data->getPageTitle()." - ".$title;
?>
<title><?php echo $title ?></title>

<?php
  // Spit out CSS
  foreach($data->getCss() as $css)
    echo "<link rel='stylesheet' href='".$css['file']."' type='text/css' />\n";
?>
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

</body>
</html>
