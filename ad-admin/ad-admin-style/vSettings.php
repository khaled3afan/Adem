<?php include 'vCpHeader.php';?>
<div class="admin_body">
    <?php admin_tabs("settings") ?>
    <div class="content">
        <div class="tab-content">
            <div class="forms">
                <div class="alert" style="display: none;" id="alertSettingsShow">أهلًا</div>
                <div class="cpForm">
                    <form role="form" id="siteForm">
                        <div class="form-group">
                            <label for="siteName">اسم الموقع :</label>
                            <input type="text" id="upSiteName" class="form-control" name="sName" placeholder="الاسم الذي سيظهر أعلى الصفحة "/>
                        </div>
                        <div class="form-group">
                            <label for="siteDescriptions">وصف الموقع :</label>
                            <input type="text" id="upSiteDescrip" class="form-control" name="sDescrip" placeholder="النص الذي سيظهر أسفل اسم الموقع "/>
                        </div>
                        <div class="form-group">
                            <label for="siteUrl">رابط الموقع :</label>
                            <div class="input-group">
                                <span class="input-group-addon" dir="ltr">/</span>
                                <input type="text" id="upSiteUrl" class="form-control" dir="ltr" name="sUrl" placeholder="www.example.com"/>
                                <span class="input-group-addon" dir="ltr">http://</span>
                            </div>
                        </div>
                        <button class="btn btn-info" name="sSave" value="yes">حفظ</button><span class="ajax-loading" id="site-loading">جاري الحفظ ..</span>
                        <div class="ajax-result alert" id="site-alert">خطأ</div>
                    </form>
                </div>
                <hr/>
                <div class="cpForm">
                    <form id="googleForm">
                        <div class="form-group">
                            <label for="googleAnyCode">شفرة إحصائيات قوقل :</label>
                            <textarea class="form-control" dir="ltr" name="googleCode" id="upGoogleCode" style="height: 120px;"></textarea>
                        </div>
                        <button class="btn btn-primary" name="gSave" value="yes">حفظ</button><span class="ajax-loading" id="google-loading">جاري الحفظ ..</span>
                        <div class="ajax-result alert" id="google-alert">خطأ</div>
                    </form>
                </div>
                <hr/>
                <div class="cpForm">
                    <form rol="form" id="emailForm">
                        <p class="alert alert-info">أرجو منك يا سيدي إدخال بريد الكتروني فعّال ؛ كي أذكّرك بكلمة المرور حينما تغيب عن بالِك ! فأنا خادمك المطيع D:</p>
                        <div class="form-group">
                            <label for="email">البريد الالكتروني :</label>
                            <input type="email" class="form-control" dir="ltr" name="email" id="upEmail" placeholder="example@example.com"/> 
                        </div>
                        <button class="btn btn-warning" name="eSave" value="yes">حفظ</button><span class="ajax-loading" id="email-loading">جاري الحفظ ..</span>
                        <div class="ajax-result alert" id="email-alert">خطأ</div>
                    </form>
                </div>
                <hr/>
                <div class="cpForm">
                    <form rol="form" id="passForm">
                        <p class="alert alert-info">أرجو منك يا سيدي إدخال كلمة مرور طويلة وقوية تحتوي على حروف ورموز وأرقام ؛ حتى لا يتجسس علينا اللصوص! ;)</p>
                        <div class="form-group">
                            <input type="password" class="form-control" name="newPass" id="upPass" placeholder="كلمة المرور الجديدة"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="newPassR" id="upPassRewrite" placeholder="أعد كتابة كلمة المرور الجديدة"/>
                        </div>
                        <button class="btn btn-danger" name="pSave" value="yes">حفظ</button><span class="ajax-loading" id="pass-loading">جاري الحفظ ..</span>
                        <div class="ajax-result alert" id="pass-alert">خطأ</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>