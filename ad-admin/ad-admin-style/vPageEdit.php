<?php include 'vCpHeader.php'; 
$Pages_Query = new AD_Query;
?>
<div class="admin_body">
    <?php admin_tabs("pages") ?>
    <div class="content">
        <div class="tab-content">
            <ul class="nav nav-pills pull-right" style="font-size: 12px;">
                <li><a href="<?php echo SITE_URL ?>/ad-admin/pages.php">قائمة الصفحات</a></li>
                <li class="active"><a href="<?php echo SITE_URL ?>/ad-admin/pages.php?add-new">أضف صفحة جديدة!</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="tab-content">
            <!-- /// EDIT BODY /// -->
            <div class="tab-pane active" id="add-new">
                <div class="editContent">
                    <div class="editContent">
                        <hr/>
                        <div class="cpForm">
                            <form id="edit_page">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $EditPage['page_title'] ?>" name="p_title" placeholder="عنوان الصفحة ." id="p_title"/>
                                </div>
                                <div class="form-group">
                                    <textarea class="textEditor form-control" name="p_content" placeholder="محتوى الصفحة" rows="10" id="p_content"><?php echo $EditPage['page_content'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $EditPage['page_Des'] ?>" name="p_des" placeholder="وصف الصفحة " id="p_des"/>
                                    <span class="note">من أجل محركات البحث  ، إن ترك فارغًا فسيتم اقتصاص جزء من محتوى الصفحة كوصف لها ، يفضل ألا يتجاوز 200 حرف .</span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="p_key" value="<?php echo $EditPage['page_keyword'] ?>" placeholder="الكلمات المفتاحية لـ الصفحة " id="p_key"/>
                                    <span class="note">من أجل محركات البحث ، افصل بين كل كلمة وأخرى بـ ( , ) .</span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" name="p_url" value="<?php echo $EditPage['page_url'] ?>" dir="ltr" placeholder="رابط الصفحة * اختياري" id="p_url"/>
                                        <span class="input-group-addon" dir="ltr"><?php echo SITE_URL ?>/page/</span>
                                    </div>
                                    <span class="note">افصل بين كل كلمة وأخرى بـ ( - ) ، مثال : site-url ، ويفضل لو يكون الرابط باللغة الانجليزية .</span>
                                </div>
                                <div class="form-group">
                                    <?php if($EditPage['allow_comments'] == 1){ ?>
                                    السماح بالتعليقات ؟ &nbsp;<input  type="checkbox" checked="checked" name="p_allowcom" id="p_allowcom"/><br/>
                                    <?php }else{ ?>
                                    السماح بالتعليقات ؟ &nbsp;<input  type="checkbox" name="p_allowcom" id="p_allowcom"/><br/>
                                    <?php } ?>
                                </div>
                                <button type="submit" class="btn btn-success" name="add" value="yes">أضف!</button><span class="ajax-loading" id="p_add_ajax-loading">جاري الحفظ ..</span>
                                <div class="ajax-result alert alert-success" id="result_add">خطأ</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>