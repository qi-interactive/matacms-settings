<?php 

namespace matacms\settings;

use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use mata\keyvalue\models\KeyValue;

class Bootstrap implements BootstrapInterface {

	public function bootstrap($app) {

		if ($this->canRun($app) == false)
			return;

		Event::on(KeyValue::className(), KeyValue::EVENT_KEY_NOT_FOUND, function($event) {
			$this->addKeyToSettings($event->sender);
		});

	}

	private function addKeyToSettings($sender) {
		print_r($sender);
		exit;
	}

	private function canRun($app) {
		return is_a($app, "yii\console\Application") == false;
	}
}