<?php
// move this array to a json config and load dynamicly...
// $topNav = Erdiko::getMenu('primary_nav'); // for example
$topNav = array(
  array("href" => "/", "nav_title" => "home"),
  array("href" => "/markup", "nav_title" => "Example Mark-Up"),
  array("href" => "/onecolumn", "nav_title" => "1 Column Layout"),
  array("href" => "/twocolumn", "nav_title" => "2 Column Layout"),
  array("href" => "/threecolumn", "nav_title" => "3 Column Layout"),
  array("href" => "/about", "nav_title" => "About Us"),
);

error_log("this: ".print_r($this, true));

$header = $this->getHeaderData();

error_log("data header: ".print_r($header['site_name'], true));
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
          <a href="<?php echo  $topNav[$i]["href"]; ?>"><?php echo  $topNav[$i]["nav_title"]; ?></a>
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