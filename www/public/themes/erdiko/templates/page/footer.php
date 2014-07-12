<?php $menu = $data['menu']['footer']; ?>

<footer id="footer">
  <div class="footer">
    <ul class="unstyled">
      <?php $i = 0 ?>
        <?php
        if($menu){
        foreach ($menu as $item): ?>
        <li>
          <a href="<?php echo  $item["href"]; ?>"><?php echo  $item["title"]; ?></a>
        </li>
        <?php $i++; ?>
      <?php
        endforeach;
        }
      ?>
    </ul>
    <p class="copyright clearfix">Copyright &copy; <?php echo date('Y', time());?> All rights reserved. <a href="/"><?php echo $data['site']['full_name']; ?></a></p>
  </div>
</footer>