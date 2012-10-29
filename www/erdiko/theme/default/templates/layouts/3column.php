<div class="content column-3">
  <div class="col-left">
    <?php echo $data->getSidebar('left'); ?>
  </div>
  <div class="content-main">
    <?php echo $data->getMainContent(); ?>
  </div>
  <div class="aside">
    <?php echo $data->getSidebar('right'); ?>
  </div>
</div>