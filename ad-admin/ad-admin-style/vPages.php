<?php include 'vCpHeader.php'; 
$Pages_Query = new AD_Query;
?>
<div class="admin_body">
    <?php admin_tabs("pages") ?>
    <div class="content">
        <div class="tab-content">
            <ul class="nav nav-pills pull-right" style="font-size: 12px;">
                <li class="active"><a href="<?php echo SITE_URL ?>/ad-admin/pages.php">قائمة الصفحات</a></li>
                <li><a href="<?php echo SITE_URL ?>/ad-admin/pages.php?add-new">أضف صفحة جديدة!</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="tab-content">
            <!-- /// EDIT BODY /// -->
            <div class="tab-pan active">
                <div class="editContent">
                    <div class="editForms">
                        <?php
                        if(($page_get > $page_count) || ($page_get <= 0)){
                        ?>
                        <div class="alert alert-warning">لا يوجد صفحات.</div>
                        <?php
                        }else{
                            ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <td>#</td>
                                    <td>عنوان الصفحة</td>
                                    <td>محتوى الصفحة </td>
                                    <td colspan="2">خيارات</td>
                                </tr>
                        <?php
                            while($page = $Pages_Query->DB_FetAs($pagesQEditShow)){
                                $cut = substr($page['page_content'],0,280)." .....";
                                $pageContentCut = strip_tags($cut);
                            ?>
                                    <tr id="page-<?php echo $page['page_id'] ?>-tr">
                                        <td><?php echo $page['page_id'] ?></td>
                                        <td><a href="<?php echo SITE_URL ?>/page/<?php echo $page['page_url'] ?>"><?php echo $page['page_title'] ?></a></td>
                                        <td style="font-size: 14px;"><?php echo $pageContentCut ?></td>
                                        <td><a class="btn btn-default" href="<?php echo SITE_URL ?>/ad-admin/pages.php?edit=<?php echo $page['page_id'] ?>">تعديل</a></td>
                                        <td>
                                            <button type="submit" rel="<?php echo $page['page_id'] ?>" name="delete_page" value="<?php echo $page['page_id'] ?>" class="del btn btn-danger">حذف</button>
                                            <img src="<?php _e(SITE_URL) ?>/ad-admin/cdn/css/img/ajax.GIF"  alt="جاري الحذف .." style="display: none;"/>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <?php
                        $next = $page_get + 1;
                        $prev = $page_get - 1;
                        ?>
                        <ul class="pagination">
                            <?php if($next <= $page_count){ ?>
                            <li><a href="pages.php?page=<?php echo $next ?>">&raquo;</a></li>
                            <?php } ?>
                            <?php if(($prev > 0) && ($prev < $page_count)){ ?>
                            <li><a href="pages.php?page=<?php echo $prev ?>">&laquo;</a></li>
                            <?php } ?>
                            <?php if($prev > $page_count){ ?>
                            <li><a href="pages.php?page=<?php echo $page_count ?>">&laquo;</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>