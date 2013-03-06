<?php
// @todo read menu from contexts/menu.json
// $topNav = Erdiko::getMenu('primary_nav'); // for example
$topNav = array(
  array("href" => "/markup", "title" => "Example Mark-Up"),
  array("href" => "/onecolumn", "title" => "1 Column Layout"),
  array("href" => "/twocolumn", "title" => "2 Column Layout"),
  array("href" => "/threecolumn", "title" => "3 Column Layout"),
);
?>
<header id="header">
  <div class="header">
    <hgroup>
      <h1 class="logo"><a href="/"><?php echo $data['site']['site_name']; ?></a></h1>
    </hgroup>
    <nav>
      <ul id="main-nav" class="clearfix unstyled">
      <?php $i = 0 ?>
        <?php
        if($topNav){
        foreach ($topNav as $node): ?>
        <li>
          <a href="<?php echo  $topNav[$i]["href"]; ?>"><?php echo  $topNav[$i]["title"]; ?></a>
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