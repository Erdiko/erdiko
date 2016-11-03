<?php if (!empty($data['google']['analytics']['tracking_id'])) : ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php echo $data['google']['analytics']['tracking_id'] ?>', 'auto');
        ga('send', 'pageview');

    </script>
    <?php
endif ?>

<?php if (!empty($data['google']['tag_manager'])) : ?>
    <?php foreach ($data['google']['tag_manager'] as $tag) : ?>
        <?php if (!empty($tag['container_id'])) : ?>
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $tag['container_id'] ?>"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <?php endif;
    endforeach;
endif ?>

