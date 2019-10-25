<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Test-Form';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'fname'); ?>
<?= $form->field($model, 'lname'); ?>
<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-12">{image}</div><div class="col-lg-12">{input}</div></div>',
])
?>

<?= Html::submitButton('ส่งข้อมูล', ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>
