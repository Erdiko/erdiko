<?php
$footerNav = array(
  array("href" => "/", "title" => "home"),
  array("href" => "/about", "title" => "About Us"),
);
?>

<footer id="footer">
  <div class="footer">
    <ul class="unstyled">
      <?php $i = 0 ?>
        <?php
        if($footerNav){
        foreach ($footerNav as $node): ?>
        <li>
          <a href="<?php echo  $footerNav[$i]["href"]; ?>"><?php echo  $footerNav[$i]["title"]; ?></a>
        </li>
        <?php $i++; ?>
      <?php
        endforeach;
        }
      ?>
    </ul>
    <p class="copyright clearfix">Copyright &copy; <?php echo date('Y', time());?> All rights reserved. <a href="/">Site Name</a></p>
  </div>
</footer>