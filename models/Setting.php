<?php

namespace matacms\settings\models;

use Yii;

/**
 * This is the model class for table "matacms_setting".
 *
 * @property string $Key
 * @property string $FormInputField
 *
 * @property MataKeyvalue $key
 */
class Setting extends \yii\db\ActiveRecord {

    const DEFAULT_FORM_TYPE = "textInput";

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
            [['Key', 'FormInputField'], 'required'],
            [['Key', 'FormInputField'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Key' => 'Key',
            'FormInputField' => 'Form Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKey() {
        return $this->hasOne(MataKeyvalue::className(), ['Key' => 'Key']);
    }

    public static function findByKey($key) {
        return self::find()->where(["Key" => $key])->one();
    }
}