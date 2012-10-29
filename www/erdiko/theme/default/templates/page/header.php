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
?>
<header id="header">
  <div class="header">
    <hgroup>
      Website Name
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