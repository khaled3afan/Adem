<?php get_header();?>
<div class="body">
            <?php if(have_posts()):
                $options = get_option('theme_options');
                if(isset($options['twitterurl'])){
                    $via = TRUE;
                    $account = $options['twitterurl'];
                }else{
                    $via = FALSE;
                }
                    the_post();
                    ?>
    <div class="boxs">
                <div class="post_box">
                    <h3 class="box_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                        <?php if ( has_post_thumbnail() ) { ?>
                    <div class="center-block" style="margin: 0px auto 20px auto;">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                               <?php the_post_thumbnail("thumbnail",array("class"=>"thumbnail center-block"));?>
                            </a>
                    </div>
                                <?php
                        }
                        ?>
                    <div class="post_content">
                        <?php the_content(); ?>
                    </div>
                    <div class="post_info">
                        <span class="text-danger fa fa-calendar post_info_icon"></span><span class="post_info_span"><?php the_time("d / M  / Y"); ?></span>
                        <span class="text-danger fa fa-pencil post_info_icon"></span><span class="post_info_span"><?php the_author_posts_link(); ?></span>
                        <span class="text-danger fa fa-tag post_info_icon" dir="ltr"></span><span class="post_info_span"><?php get_category_link(the_category(" , "),",") ?></span>
                    </div>
                    <hr class="hr_small"/>
                </div>
                <div class="post_share">
                    <div class="pull-right">
                        <p>شارك التدوينة :</p>
                    </div>
                    <div class="pull-left" dir="ltr">
                        <nav class="post_share_icon">
                            <a href="" 
                               onclick="javascript:void window.open('http://twitter.com/share?text=<?php the_title(); ?>&url=<?php echo wp_get_shortlink(); if($via == TRUE){ ?>&via=<?php echo $account; }?>','1400059754991','width=600,height=600,toolbar=0,menubar=1,location=1,status=1,scrollbars=1,resizable=1');return false;"
                               class="fa fa-twitter-square fa-2x"></a>
                            <a href="javascript::void(0)" onclick="javascript:void window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink(); ?>','1400059754991','width=600,height=600,toolbar=0,menubar=1,location=1,status=1,scrollbars=1,resizable=1');return false;" class="fa fa-facebook-square fa-2x"></a>
                            <a href="javascript::void(0)" onclick="javascript:void window.open('https://plus.google.com/share?url=<?php echo wp_get_shortlink(); ?>','1400059754991'.'width=600,height=600,toolbar=0,menubar=1,location=1,status=1,scrollbars=1,resizable=1');return false;" class="fa fa-google-plus-square fa-2x"></a>
                        </nav>
                    </div>
                </div>
                <div class="clearfix"></div>
    <?php
    if ( comments_open() || get_comments_number() ) {
        comments_template();                                          
    }else{
    ?>
    </div>
    <?php
    }
    //endwhile;
    ?>
    <?php
    else: ?>
    <div class="boxs" style="text-align: center;margin-bottom: 300px">
        <h4>هذه المدونة .. فارغة يا صديقي :(</h4>
    </div>
<?php endif; ?>
        </div>
<?php get_footer();