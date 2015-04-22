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
            // [['value.Value'], 'safe']
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

    public static function exists($key) {
        return self::findByKey($key) != null;
    }

    public function afterSave($insert, $changedAttributes) {
        
        if ($insert) {
            $keyValue = KeyValue::findByKey($this->Key);

            if ($keyValue == null) 
                $this->addNewKeyValue();
        }
    }

    private function addNewKeyValue() {

        $kv = new KeyValue();
        $kv->attributes = [
            "Key" => $this->Key,
            "Value" => ""
        ];

        if ($kv->save() == false)
            throw new \yii\web\ServerErrorHttpException($kv->getTopError());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue() {
        return $this->hasOne(KeyValue::className(), ['Key' => 'Key']);
    }

    public static function findByKey($key) {
        return  self::find()->where(["Key" => $key])->one();
    }

    public static function findValue($key) {
        $retVal = KeyValue::findValue($key);
        return self::castToType($retVal);
    }

    /**
     * All values are stored as strings -- try to cast to something more appropriate
     */ 
    private function castToType($value) {
        if ($value == "true" || $value == "1")
            return true;

        if ($value == "false" || $value == "0")
            return false;

        return $value;

    }
    
}