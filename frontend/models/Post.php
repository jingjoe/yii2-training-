<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title หัวข้อ
 * @property string $content รายละเอียด
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'หัวข้อ',
            'content' => 'รายละเอียด',
        ];
    }
}
