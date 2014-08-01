<header class="navbar navbar-static-top" id="top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand"><?php echo $data['site']['name']; ?></a>
    </div>
    
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <?php
          $menu = $data['menu']['main'];
          if($menu):
            foreach ($menu as $item): ?>
              <li>
                <a href="<?php echo  $item["href"]; ?>"><?php echo  $item["title"]; ?></a>
              </li>
            <?php
            endforeach;
          endif; ?>
      </ul>
    </nav>
  </div>
</header>