<?php 
if(isset($data['title']))
    echo '<h1 class="page-header">'.$data['title']."</h1>\n";

// Determine classes (@todo move to a helper class)
$classPre = "content-body";
$classes = "";
foreach($data['identifier'] as $class)
  $classes .= "$classPre-$class ";
?>

<div id="content-body" class="<?php echo $classes; ?>"><?php echo $data['content']; ?></div>