<?php $size = (isset($data['size'])) ? $data['size'] : 1; ?>
<li class="unit size1of<?php echo $size; ?>">
  <figure>
    <div class="product-img-wrapper" data-index="0">
      <a href="/artwork"><img class="product-img" src="http://cache.net-a-porter.com/images/products/312919/312919_in_mt2.jpg" alt="Run Techfit™ cropped leggings"></a>
    </div>
    <figcaption>
      <h2 class="grid"><a href="<?php echo $data['details']['url']; ?>"><?php echo $data['details']['name']; ?></a></h2>
    </figcaption>
  </figure>
</li>