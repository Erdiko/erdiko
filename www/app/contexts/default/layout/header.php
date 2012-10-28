<?php
$topNav = array(
  array("href" => "/", "navTitle" => "home"),
  array("href" => "/about", "navTitle" => "about us")
);
?>
<header id="header">
  <div class="header">
    <hgroup>
      Company Name
    </hgroup>
    <nav>
      <ul id="main-nav" class="clearfix unstyled">
      <?php $i = 0 ?>
        <?php
        if($topNav){
        foreach ($topNav as $node): ?>
        <li>
          <a href="<?php echo  $topNav[$i]["href"]; ?>"><?php echo  $topNav[$i]["navTitle"]; ?></a>
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