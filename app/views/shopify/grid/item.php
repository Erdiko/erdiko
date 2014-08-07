<?php $size = (isset($data['size'])) ? $data['size'] : 1; ?>

<div class="col-xs-6 col-sm-4 col-md-3 ">
	<figure>
    <div class="product-img-wrapper" data-index="0">
      <a href="<?php echo $data['details']['url']; ?>"><img class="product-img" width="180" height="180" src="<?php echo $data['details']['image']; ?>" alt="Grid Item"></a>
    </div>
    <figcaption>
      <h2 class="grid"><a href="<?php echo $data['details']['url']; ?>"><?php echo $data['details']['name']; ?></a></h2>
    </figcaption>
  </figure>
</div>
