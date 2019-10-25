<?php
$this->title = 'Controller To View';
?>

<h1>ทดสอบการส่งค่าตัวแปรจาก Controller ไปให้ View แสดงผล</h1>
<p>
<h3>
    <span class="bg-success">คำนำหน้า : </span><?= $pname ?> <br>
    <span class="bg-success">ชื่อ-นามสกุล : </span><?= $fullname ?> <br>
    <span class="bg-success">อายุ/ปี : </span><?= $age; ?> <br>
    <span class="bg-success">หน่วยงาน : </span><?= $office ?> <br> 
</h3>
</p>

