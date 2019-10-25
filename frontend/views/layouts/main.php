<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="glyphicon glyphicon-th-large text-danger"></span> Yii2-Training',
        //'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top'
        ],
    ]);

 
    
    if (Yii::$app->user->isGuest) {
        $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ', 'url' => ['/site/login']];
        $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span> สมาชิก', 'url' => ['/site/signup']];
        


    } else {
        $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-book"></span> โปรไฟล์', 'url' => ['/user/settings/profile']];
        $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-log-out"></span> ออกจากระบบ', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
    }
        $username = '';
        if (!Yii::$app->user->isGuest) {
            $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
        }
    $menuItems = [
        ['label' => '<span class="glyphicon glyphicon-home"></span> หน้าหลัก','url' => ['/site/index']],
        
        ['label' => '<span class="glyphicon glyphicon-edit"></span> แบบทดสอบ', 'url' => ['#'],
            'items' => [
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Variable URL', 'url'=> ['/site/test01']],
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Controller To View', 'url'=> ['/site/test02']],
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Routing Yii2', 'url'=> ['/routing/index']],
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Model และ Form', 'url'=> ['/test/form']],
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Migration ProjectPost', 'url'=> ['/post/index']],
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Module รายงาน', 'url'=> ['/report/default/rep1'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => '<span class="glyphicon glyphicon-chevron-right"></span> Customize View', 'url'=> ['/site/datajs']],
            ]
        ],
        ['label' => '<span class="glyphicon glyphicon-exclamation-sign"></span> เกี่ยวกับ', 'url' => ['/site/about']],
        ['label' => '<span class="glyphicon glyphicon-phone-alt"></span> ติดต่อ', 'url' => ['/site/contact']],
        ['label' => '<span class="glyphicon glyphicon-user"></span> ผู้ใช้งาน' . " " . $username,
        'items' => $submenuItems
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
