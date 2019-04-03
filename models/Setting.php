<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

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

    public static function tableName()
    {
        return 'matacms_setting';
    }

    public function rules()
    {
        return [
            [['Key', 'FormInputField'], 'required'],
            [['Key'], 'unique'],
            [['Key', 'FormInputField'], 'string', 'max' => 255],
            // [['value.Value'], 'safe']
        ];
    }
    
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

    public static function findValue($key)
    {
        $value = \Yii::$app->cache->get(__CLASS__ . "_" . md5($key));

        if ($value === false) {
            $value = KeyValue::findValue($key);
            \Yii::$app->cache->set(__CLASS__ . "_" . md5($key), $value, null, new \matacms\cache\caching\MataLastUpdatedTimestampDependency());
        }

        return self::castToType($value);
    }

    /**
     * All values are stored as strings -- try to cast to something more appropriate
     */ 
    private static function castToType($value) {
        if ($value == "true" || $value == "1")
            return true;

        if ($value == "false" || $value == "0")
            return false;

        return $value;

    }
    
}
