<header class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><?php echo $data['site']['name']; ?></a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <?php
          $menu = $data['menu']['main'];
          if($menu):
            foreach ($menu as $item): ?>
              <li><a href="<?php echo  $item["href"]; ?>"><?php echo  $item["title"]; ?></a></li>
            <?php
            endforeach;
          endif; ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</header>