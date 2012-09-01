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

<?php //echo $data['content']; ?>
<header id="header">
  <div class="social">
    <ul class="no-bullet left">
    <?php $i = 0 ?>
      <?php
      if($social){
      foreach ($social as $node): ?>
      <li class="<?php echo  $social[$i]["class"]; ?>">
        <a href="<?php echo  $social[$i]["href"]; ?>"></a>
      </li>
      <?php $i++; ?>
    <?php
      endforeach;
      }
    ?>
    </ul>
  </div>

  <hgroup>
    <div id="site-logo">
      <a href="<?php echo  $logo['href']; ?>"><img src="<?php echo  $logo['src']; ?>" alt="<?php echo  $logo['alt']; ?>"/></a>
    </div>
  </hgroup>

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