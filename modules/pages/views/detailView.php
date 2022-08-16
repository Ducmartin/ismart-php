<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <?php if (!empty($data)) { ?>
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $data['post_title'] ?></h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date"><?php echo (new DateTime($data['created_at']))->format('d-m-Y') ?></span>
                        <div class="detail">
                            <?php echo $data['post_content'] ?>
                        </div>
                    </div>
                </div>
            </div>
             <?php get_sidebar() ?>
        <?php } else { ?>
            <p style="color: red;text-align:center;font-size :40px;">TRANG KHÔNG TỒN TẠI</p>
        <?php } ?>
       
    </div>
</div>
<?php
get_footer();
?>