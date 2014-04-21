<?php include 'vCpHeader.php';
$DB_edit = new AD_Query();
?>
<div class="admin_body">
    <ul class="nav nav-tabs">
        <li><a href="<?php _e(SITE_URL)?>/ad-admin/">أهلًا!</a></li>
        <li class="active"><a href="<?php _e(SITE_URL)?>/ad-admin/edit">بيانات الواجهة</a></li>
        <li><a href="<?php _e(SITE_URL)?>/ad-admin/themes">القوالب</a></li> 
        <li><a href="<?php _e(SITE_URL)?>/ad-admin/settings">الإعدادات</a></li> 
    </ul>
    <div class="content">
        <div class="tab-content">
            <ul class="nav nav-pills pull-right" style="font-size: 12px;">
                <li class="active"><a href="#add-new" data-toggle="tab">أضف حقل جديد!</a></li>
                <li><a href="#edit-old" data-toggle="tab">تعديل حقل</a></li>
                <li><a href="#social" data-toggle="tab">مواقع التواصل الإجتماعي</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="tab-content">
            <!-- /// ADD NEW BODY /// -->
            <div class="tab-pane fade in active" id="add-new">
                <div class="editContent">
                    <div class="editContent">
                        <hr/>
                        <div class="cpForm">
                            <form id="addNew-Form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="newIName" placeholder="عنوان الحقل ." id="newIName"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="newITip" placeholder="وصف الحقل ( تولتيب ) ." id="newITip"/>
                                </div>
                                <div class="form-group">
                                    <textarea class="textEditor form-control" name="newIContent" placeholder="محتوى الحقل" rows="10" id="newIContent"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="newISID" placeholder="معرّف الحقل ( انجليزي فقط )( إلزامي )." id="newISID"/>
                                </div>
                                <button type="submit" class="btn btn-success" name="newISave" value="yes">أضف!</button><span class="ajax-loading" id="newI-ajax-loadin">جاري الحفظ ..</span>
                                <div class="ajax-result alert" id="newI-alertShow">خطأ</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /// EDIT BODY /// -->
            <div class="tab-pane fade in" id="edit-old">
                <div class="editContent">
                    <?php if($DB_edit->DB_Num($getINFOS) > 0){ ?><form id="selectEdit">
                        <div class="form-group">
                            <select class="form-control" name="chooseInfoID" id="selector">

                                <option value="0">اختر الحقل ..</option>
                                <?php while ($__CHOOSE__ = $DB_edit->DB_FetAs($getINFOS)){?>
                                <option value="<?php _e($__CHOOSE__['info_id'])?>"><?php _e($__CHOOSE__['info_name']);
                                ?></option>
                                <?php }
                                $infoID = $__CHOOSE__['info_id'];
                                ?>
                            </select>
                        </div>
                    </form>
                    <hr/>
                    <div class="editForms">
                        <div class="cpForm">
                            <img src="<?php _e(SITE_URL) ?>/cdn/css/img/ajax.GIF" style="display: none" id="info-loading"/>
                            <form id="updatesForm">
                                <div class="form-group">
                                    <label for="infoName">اسم الحقل :</label>
                                    <input type="text" class="form-control" name="upInfoName" id="up_infoName"/>
                                </div>
                                <div class="form-group">
                                    <label for="infoTooltip">وصف الحقل ( تولتيب ) :</label>
                                    <input type="text" class="form-control" name="upTooltip" id="up_infoTooltip"/>
                                </div>
                                <div class="form-group">
                                    <label for="infoStyleID">محتوى الحقل :</label>
                                    <textarea class="textEditor form-control" name="upContent" id="up_infoContent" rows="10"></textarea>
                                </div>
                                <hr/>
                                <p class="alert alert-info">إعدادات متقدمة ، متخصصة بالستايل .</p>
                                <div class="form-group">
                                    <label for="infoStyleID">معرف الحقل :</label>
                                    <input type="text" class="form-control" name="upStyleID" id="up_infoStyleID"/><br/>
                                </div>
                                <hr/>
                                <input type="hidden" name="upInfoID"  id="upID"/>
                                <button type="submit" name="saveUPINFO" value="yes" class="btn btn-default">حفظ</button>
                                <span class="ajax-loading" id="save-info-loading">جاري الحفظ ..</span>
                                <div class="ajax-result alert" id="info-save-alert">خطأ</div>
                            </form>
                            <form id="delete-form" class="pull-left">
                                <button type="submit" name="delete" class="btn btn-danger" id="delete_id">حذف الحقل</button>
                                <img src="<?php _e(SITE_URL) ?>/cdn/css/img/ajax.GIF" id="delete-loading" alt="جاري الحذف .." style="display: none;"/>
                                <div class="ajax-result alert" id="delete-alert">خطأ</div>
                                
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php }else{?>
                        <p class="alert alert-warning">لم تقم بإضافة أي حقول في الواجهة .</p>
                    <?php }?>
                    
                </div>
            </div>
            <!-- SOCIAL TABE BODY -->
            <div class="tab-pane fade in" id="social">
                <div class="editContent">
                    <div class="cpForm">
                        <form id="social_edit">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="facebook" id="facebook" value="<?php $DB_edit->getSocial("facebook") ?>"/>
                                    <span class="input-group-addon" dir="ltr">FaceBook</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="twitter" id="twitter" value="<?php $DB_edit->getSocial("twitter") ?>"/>
                                    <span class="input-group-addon" dir="ltr">Twitter</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="google_plus" id="google_plus" value="<?php $DB_edit->getSocial("google_plus"); ?>"/>
                                    <span class="input-group-addon" dir="ltr">Google +</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="instagram" id="instagram" value="<?php $DB_edit->getSocial("instagram"); ?>"/>
                                    <span class="input-group-addon" dir="ltr">instagram</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="tumblr" id="tumblr" value="<?php $DB_edit->getSocial("tubmlr"); ?>"/>
                                    <span class="input-group-addon" dir="ltr">Tumblr</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="skype" id="skype" value="<?php $DB_edit->getSocial("skype"); ?>"/>
                                    <span class="input-group-addon" dir="ltr">Skype</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="youtube" id="youtube" value="<?php $DB_edit->getSocial("youtube"); ?>"/>
                                    <span class="input-group-addon" dir="ltr">YouTube</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" dir="ltr" type="text" name="github" id="github" value="<?php $DB_edit->getSocial("github"); ?>"/>
                                    <span class="input-group-addon" dir="ltr">GitHub</span>
                                </div>
                            </div>
                            <input type="hidden" name="update_social" value="save"/>
                            <button type="submit" name="social" value="save" class="btn btn-success">حفظ</button><span class="ajax-loading" id="social-loading">جاري الحفظ ..</span>
                            <div class="ajax-result alert" id="social-result">خطأ</div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>