<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
$this->title = 'รายงานไม่ลงผลวินิจฉัยผู้ป่วยนอกแยกรายแผนก DIAGNOSIS_OPD';
$this->params['breadcrumbs'][] = ['label' => 'รายงานออนไลน์', 'url' => ['/report/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            'themes/grid',
            //'modules/exporting',
            'modules/solid-gauge',
        ]
    ]);
    ?>
</div>
<div class='bg-success'>
    <?php $form = ActiveForm::begin(['layout' => 'inline']); ?>
    <div class="form-group">
        <label class="control-label"> เลือกวันที่ </label>
        <?php
        echo DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'changeMonth' => true,
                'changeYear' => true,
                'todayHighlight' => true
            ]
        ]);
        ?>

    </div>
    <div class="form-group">
        <label class="control-label"> ถึง </label>
        <?php
        echo DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'changeMonth' => true,
                'changeYear' => true,
                'todayHighlight' => true
            ]
        ]);
        ?>
    </div>
    <div class="form-group">
        <label class="control-label"> สิทธิ </label>

        <?php
        $list_spp = [
            '1,2,3,4,5,6' => 'ทั้งหมด',
            '1' => 'ข้าราชการ/รัฐวิสาหกิจ',
            '2' => 'บัตรประกันสังคม',
            '3' => 'UC (บัตรทอง ไม่มี ท.)',
            '4' => 'สปร.(บัตรทอง มี ท.)',
            '5' => 'คนต่างด้าวที่ขึ้นทะเบียน',
            '6' => 'อื่นๆ (ต่างด้าวไม่ขึ้นทะเบียน/ชำระเงินเอง)'];
        echo Html::dropDownList('spp', $spp, $list_spp, ['class' => 'form-control']);
        ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-warning btn-flat']) ?>
    </div><!-- /.input group -->
    <?php ActiveForm::end(); ?>
</div>
<br>

<div class="panel panel-default">
    <div class="panel-heading"> <h3 class="panel-title"><span class="glyphicon glyphicon glyphicon-signal"></span> <?= $this->title; ?>  ข้อมูลวันที่ <?=$date1 ?> ถึง <?=$date2 ?></h3> </div>
    <div class="panel-body">
        <div id="container-line"></div>
        <?php

        $categ = [];
        for ($i = 0; $i < count($chart); $i++) {
            $categ[] = $chart[$i]['dep'];
        }
        $js_categ = implode("','", $categ);

        $data_cc = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_cc[] = $chart[$i]['cc'];
        }
        $js_cc = implode(",", $data_cc);

        $this->registerJs(" $(function () {
                            $('#container-line').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'รายงานไม่ลงผลวินิจฉัยผู้ป่วยนอกแยกรายแผนก DIAGNOSIS_OPD',
                                    x: -20 //center
                                },
                                subtitle: {
                                    text: '',
                                    x: -20
                                },
                                xAxis: {
                                      categories: ['$js_categ'],
                                },
                                yAxis: {
                                    title: {
                                        text: 'จำนวน(ครั้ง)'
                                    },
                                    plotLines: [{
                                        value: 0,
                                        width: 1,
                                        color: '#808080'
                                    }]
                                },
                                tooltip: {
                                    valueSuffix: ''
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle',
                                    borderWidth: 0
                                },
                                credits: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'แผนก/งาน',
                                    data: [$js_cc]
                                }]
                            });
                        });
             ");
        ?>
<br>
        <?=GridView::widget([
            'dataProvider' => $dataProvider,
            'showPageSummary'=>true,
            'headerRowOptions' => ['style' => 'background-color:#cccccc'],
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'after' => 'วันที่ประมวลผล '.date('Y-m-d H:i:s').' น.',
                'footer'=>false
            ],
            'responsive' => true,
            'hover' => true,
            'exportConfig' => [
                   GridView::CSV => ['label' => 'Export as CSV', 'filename' => 'ReportCheck1_'.date('Y-d-m')],
                   GridView::PDF => ['label' => 'Export as PDF', 'filename' => 'ReportCheck1_'.date('Y-d-m')],
                   GridView::EXCEL=> ['label' => 'Export as EXCEL', 'filename' => 'ReportCheck1_'.date('Y-d-m')],
                   GridView::TEXT=> ['label' => 'Export as TEXT', 'filename' => 'ReportCheck1_'.date('Y-d-m')],
                ],
        // set your toolbar
            'toolbar' =>  [
                ['content' => 
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/report/default/rep1'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'รีเซ็ต')])
                ],
                '{toggleData}',
                '{export}',
            ],
        // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'pjax' => true,
            'pjaxSettings' => [
                'neverTimeout' => true,
                'beforeGrid' => '',
                'afterGrid' => '',
            ],
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn'
                ],
                [
                    'label' => 'แผนก/งาน',
                    'format' => 'raw',
                    'value' => function($model) use($date1,$date2,$spp){
                        return Html::a(Html::encode($model['dep']), ['/report/default/rep1detail', 'id' => $model['spclty'],'date1' => $date1,'date2' => $date2,'spp' => $spp ]);
                    },
                    'pageSummary'=>'รวมทั้งหมด' 
                ],
                [
                    'attribute'=>'cc',
                    'header' => 'จำนวน (ครั้ง)',
                    'hAlign'=>'left',
                    'format'=>['decimal', 0],
                    'pageSummary'=>true
                ],
            ]
        ]);
        ?>
     </div>
</div>

