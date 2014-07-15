<footer>
<div id="footer">
  <div class="container">

    <ul class="nav nav-justified">
      <?php
        $menu = $data['menu']['footer'];
        if($menu):
          foreach ($menu as $item): ?>
            <li><a href="<?php echo  $item["href"]; ?>"><?php echo  $item["title"]; ?></a></li>
          <?php
          endforeach;
        endif; ?>
    </ul>

    <div class="copyright">
      <p>Copyright &copy; <?php echo date('Y', time());?> All rights reserved &nbsp;&nbsp;&nbsp; Powered by <a href="http://www.erdiko.org" target="_blank">Edriko</a> &nbsp;&nbsp;&nbsp; Code licensed under <a href="https://github.com/arroyo/Erdiko/blob/master/LICENSE" target="_blank">MIT</a></p>
    </div>
  </div>
</div>
</footer>