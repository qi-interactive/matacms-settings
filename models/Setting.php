<?php

namespace matacms\settings\models;

use Yii;

/**
 * This is the model class for table "matacms_setting".
 *
 * @property string $Key
 * @property string $FormType
 *
 * @property MataKeyvalue $key
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matacms_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Key', 'FormType'], 'required'],
            [['Key', 'FormType'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Key' => 'Key',
            'FormType' => 'Form Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKey()
    {
        return $this->hasOne(MataKeyvalue::className(), ['Key' => 'Key']);
    }
}