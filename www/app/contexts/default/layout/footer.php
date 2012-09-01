<footer id="footer">
  <p>
    Copyright &copy; 2012 All Rights Reserved.
    <br>
    <?php
      echo $data['content'];
      foreach($data['links'] as $link)
        echo '<a href="'.$link['url'].'">'.$link['name'].'</a>';
    ?>
  </p>
</footer>