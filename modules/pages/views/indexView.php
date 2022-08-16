<?php
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php if (!empty($data['page'])) echo $data['page']['page_title']  ?></h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php if (!empty($data['post'])) {
                            foreach ($data['post'] as $item) { ?>
                                <li class="clearfix">
                                    <a href="<?php echo url_home($data['page']['friendly_url'].'/'.$item['friendly_url'].'.html') ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo url($item['img']) ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="" title="" class="title"><?php echo $item['post_title'] ?></a>
                                        <span class="create-date"><?php echo (new DateTime($item['created_at']))->format('d-m-Y') ;?></span>
                                        <p class="desc"><?php echo $item['post_desc'] ?></p>
                                    </div>
                                </li>
                        <?php }
                        } ?>


                    </ul>
                </div>
            </div>

        </div>
        <?php get_sidebar() ?>
    </div>
</div>
<?php
get_footer();
?>