<?php
TMPL_getHeader();
?>
<div class="body">
    <div class="boxs">
        <div class="post_box">
            <h3 class="box_title"><a href="<?php TMPL_PageUrl() ?>"><?php TMPL_PageTitle(); ?></a></h3>
            <div class="post_content">
                <?php TMPL_PageContent(); ?>
            </div>
            <div class="post_info">
                <span class="text-danger fa fa-calendar post_info_icon"></span><span class="post_info_span"><?php TMPL_PageDate() ?></span>
            </div>
            <hr class="hr_small"/>
        </div>
    </div>
</div>
<?php TMPL_getFooter(); ?>