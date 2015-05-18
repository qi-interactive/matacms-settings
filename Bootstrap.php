<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\settings;

use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use mata\keyvalue\models\KeyValue;
use matacms\settings\models\Setting;

class Bootstrap implements BootstrapInterface {

	public function bootstrap($app) {
		if ($this->canRun($app) == false)
			return;

		Event::on(KeyValue::className(), KeyValue::EVENT_KEY_NOT_FOUND, function($event) {
			$this->addKeyToSettings($event->message);
		});
	}

	private function addKeyToSettings($key) {
		$setting = Setting::findByKey($key);

		if ($setting == null) 
			$this->addNewSetting($key);
	}

	private function addNewSetting($key) {		
		$setting = new Setting();
		$setting->attributes = [
			"Key" => $key,
			"FormInputField" => Setting::DEFAULT_FORM_TYPE
		];

		if ($setting->save() == false)
			throw new \yii\web\ServerErrorHttpException($setting->getTopError());
	}

	private function canRun($app) {
		return is_a($app, "yii\console\Application") == false;
	}

}
