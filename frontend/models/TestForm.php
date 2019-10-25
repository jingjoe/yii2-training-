<?php
namespace frontend\models;
use yii\base\Model;

class TestForm extends Model{
    public $fname;
    public $lname;
    public $verifyCode;

    
    public function rules() {
        return[
            [['fname','lname'],'required'],
            ['verifyCode', 'captcha'],
        ];
    }
    
    public function attributeLabels() {
        return[
            'fname'=>'ชื่อ',
            'lname'=>'นามสกุล',
            'verifyCode' => '',
        ];
    }
}
