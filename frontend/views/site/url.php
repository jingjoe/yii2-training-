<?php
$this->title = 'Variable URL';
?>
<div class="text-center">
    <h3>
        <p>URL สำหรับทดสอบ http://localhost/yii2-training/frontend/web/index.php?r=site%2Ftest01&data=xxx</p>
        <p>xxx ให้ระบุข้อความ</p>
    </h3>
    <h1><span class="label label-primary">ฉันชื่อ</span> : <span class="label label-warning"> <?= $data ;?> </span>  </h1>
    
</div>
