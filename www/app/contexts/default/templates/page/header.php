<?php
// @todo read menu from contexts/menu.json
// $topNav = Erdiko::getMenu('primary_nav'); // for example
$topNav = array(
  array("link" => "/", "title" => "home"),
  array("link" => "/markup", "title" => "Example Mark-Up"),
  array("link" => "/onecolumn", "title" => "1 Column Layout"),
  array("link" => "/twocolumn", "title" => "2 Column Layout"),
  array("link" => "/threecolumn", "title" => "3 Column Layout"),
  array("link" => "/about", "title" => "About Us"),
);

$header = $this->getHeaderData();
?>
<header id="header">
  <div class="header">
    <hgroup>
      <h2 class="logo"><a href="/"><?php echo $header['site_name']; ?></a></h2>
    </hgroup>
    <nav>
      <ul id="main-nav" class="clearfix unstyled">
      <?php $i = 0 ?>
        <?php
        if($topNav){
        foreach ($topNav as $node): ?>
        <li>
          <a href="<?php echo  $topNav[$i]["link"]; ?>"><?php echo  $topNav[$i]["title"]; ?></a>
        </li>
        <?php $i++; ?>
      <?php
        endforeach;
        }
      ?>
      </ul>
    </nav>
  </div>
</header>