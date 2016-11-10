<?php if (!empty($data['google']['tag_manager'])) : ?>
    <?php foreach ($data['google']['tag_manager'] as $tag) : ?>
        <?php if (!empty($tag['container_id'])) : ?>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?php echo $tag['container_id'];?>');
        </script>
        <?php endif;
    endforeach;
endif ?>
