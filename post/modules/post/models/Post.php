<?php

namespace post\modules\post\models;

use Yii;
use yii\behaviors\TimestampBehavior;


class Post extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%post}}';
    }

   public function behaviors()  
    {  
        return [  
            [
//                TimestampBehavior
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],  
            ],  
        ];  
    }  





}
