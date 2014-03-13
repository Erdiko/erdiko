<?php $menu = $data['menu']['main']; ?>
<header id="header">
  <div class="header">
    <hgroup>
      <h1 class="logo"><a href="/"><?php echo $data['site']['name']; ?></a></h1>
    </hgroup>
    <nav>
      <ul id="main-nav" class="clearfix unstyled">
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
    </nav>
  </div>
</header>