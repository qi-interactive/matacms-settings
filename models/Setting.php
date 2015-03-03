<?php

namespace matacms\settings\models;

use Yii;
use mata\keyvalue\models\KeyValue;
/**
 * This is the model class for table "matacms_setting".
 *
 * @property string $Key
 * @property string $FormInputField
 *
 * @property MataKeyvalue $key
 */
class Setting extends \matacms\db\ActiveRecord {

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
            [['Key'], 'unique'],
            [['Key', 'FormInputField'], 'string', 'max' => 255],
            [['value.Value'], 'safe']
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
    public function getValue() {
        return $this->hasOne(KeyValue::className(), ['Key' => 'Key']);
    }

    public static function findByKey($key) {
        return self::find()->where(["Key" => $key])->one();
    }
}