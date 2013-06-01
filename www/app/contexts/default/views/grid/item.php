<?php $size = (isset($data['size'])) ? $data['size'] : 1; ?>
<li class="unit size1of<?php echo $size; ?>">
  <figure>
    <div class="product-img-wrapper" data-index="0">
      <a href="<?php echo $data['details']['url']; ?>"><img class="product-img" src="http://placehold.it/180x180" alt="Grid Item"></a>
    </div>
    <figcaption>
      <h2 class="grid"><a href="<?php echo $data['details']['url']; ?>"><?php echo $data['details']['name']; ?></a></h2>
    </figcaption>
  </figure>
</li>