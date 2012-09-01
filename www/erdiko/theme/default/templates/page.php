<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $data->getTitle(); ?></title>

	<?php 
		// Spit out CSS
		foreach($data->getCss() as $css)
			echo "<link rel='stylesheet' href='".$css['file']."' type='text/css' />\n";
		
		// Spit out JS
		foreach($data->getJs() as $js)
			echo "<script src='".$js['file']."'></script>\n";
	?>

</head>
<body>

<div class="header-bg">
    <?php echo $data->getHeader(); ?>
</div>
<div class="container">
    <?php echo $this->getLayout(); ?>
</div>
<div class="footer-bg">
    <?php echo $data->getFooter(); ?>
</div>

</body>
</html>