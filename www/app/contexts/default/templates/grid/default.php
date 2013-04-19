<?php 
	$title = $this->getPageTitle();
 	if(!empty($title))
    	echo "<h1>".$title."</h1>\n";

    $data = $this->getLayoutData(); // @todo rename 'templates' folder to 'layouts'
    // error_log("data: ".print_r($data, true));
?>

<div class="unit size1of1">
	<ul class="unstyled product-grid">

<?php
$artwork = array(
	'size' => $data['columns'],
	'details' => null
	);

for($i=0; $i<$data['items']; $i++)
{
	// $artwork['details'] = $data['artwork'][$i];
	echo Erdiko::getView($artwork, '/grid/artwork.php');
}
?>

	</ul>
</div>