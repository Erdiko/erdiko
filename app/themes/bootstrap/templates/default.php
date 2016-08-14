<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
    /** Spit out meta tags **/
    foreach ($this->getMeta() as $name => $content)
        echo "<meta name=\"{$name}\" content=\"{$content}\">\n";
?>

<title><?php echo $this->getPageTitle() ?></title>

<?php
// Spit out CSS
foreach ($this->getCss() as $css) {
    if ($css['active']) {
        echo "<link rel='stylesheet' href='".$css['file']."' type='text/css' />\n";
    }
}
?>
</head>
<body>

    <?php echo $this->getTemplateHtml('header'); ?>
    <?php echo $this->getTemplateHtml('messages'); ?>
    <?php echo $this->getContent(); ?>
    <?php echo $this->getTemplateHtml('footer'); ?>

<?php
    // Spit out JS below the footer
foreach ($this->getJs() as $js) {
    if ($js['active']) {
        echo "<script src='".$js['file']."'></script>\n";
    }
}
?>
<script type="text/javascript">/* <![CDATA[ */
$(document).ready(function() {

});
/* ]]> */</script>

<?php echo $this->getTemplateHtml('analytics') ?>

</body>
</html>
