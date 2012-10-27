<?php
$social = array(
  array("class" => "facebook", "href" => "http://www.facebook.com"),
  array("class" => "twitter", "href" => "http://www.twitter.com")
);

$topNav = array(
  array("href" => "/", "navTitle" => "home"),
  array("href" => "/about", "navTitle" => "about us")
);
?>
<header id="header">
  <div class="header">
    Company Name
    <?php echo $data['content']; ?>
  </div>

  <nav>
    <ul id="main-nav" class="clearfix">
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
</header>