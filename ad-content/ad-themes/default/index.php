<?php
TMPL_getHeader();
?>
            <div class="body">
                <div class="panels">
                    <div class="panel-group" id="accordion">
                        <?php
                        while($_INFO = $AD_Query->DB_FetAs($info)){
                            ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <p class="panel-title">
                                    <a href="#<?php echo $_INFO['info_styleID'] ?>" data-toggle="collapse" data-parent="#accordion"
                                       data-toggle="tooltip" data-placement="right" title="<?php _e($_INFO['info_tooltip']) ?>" class="tooltip_show" data-animation="animation"><?php _e($_INFO['info_name']) ?> <span class="caret"></span></a>
                                </p>
                            </div>
                            <div id="<?php _e($_INFO['info_styleID']) ?>" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <?php echo stripslashes($_INFO['info_content']); ?>
                                </div>                                 
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php if($AD_Query->db_Num($social) > 0){ ?>
                <nav class="social" dir="ltr">
                    <?php
                    while($_SOCIAL = $AD_Query->DB_FetAs($social)){
                    ?>
                    <a href="<?php _e($_SOCIAL['sc_link']) ?>" target="_blanck" class="social_tooltip fa fa-<?php _e($_SOCIAL['sc_name']) ?> fa-2x"></a>
                    <?php
                    }
                    ?>
                </nav>
                <?php }  ?>
            </div>
<?php TMPL_getFooter() ?>