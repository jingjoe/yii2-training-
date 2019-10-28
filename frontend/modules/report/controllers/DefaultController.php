<?php

namespace frontend\modules\report\controllers;
use Yii;
use yii\web\Controller;
use yii\db\Query;
use yii\data\ArrayDataProvider;

/**
 * Default controller for the `report` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    
    public function actionRep1($date1 = NULL, $date2 = NULL, $spp = NULL) {
        $sql_date = Yii::$app->db->createCommand('SELECT date FROM set_datetime')->queryOne();
        $date1 = $sql_date['date'];
        $date2 = date('Y-m-d');
        $spp = "1,2,3,4,5,6";
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $spp = $_POST['spp'];
        }
        $sql = "SELECT spclty,dep,COUNT(DISTINCT vn) AS cc
                FROM nodiagopd
                WHERE vstdate BETWEEN '$date1'and '$date2'
                AND pttype_spp_id IN ($spp)
                GROUP BY dep
                ORDER BY cc DESC";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'chart' => $data,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'spp' => $spp]);
    }

}
