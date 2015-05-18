<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\settings\controllers;

use matacms\controllers\module\Controller;
use matacms\settings\models\Setting;
use matacms\settings\models\SettingSearch;

class SettingsController extends Controller {

	public function getModel() {
		return new Setting();
	}

	public function getSearchModel() {
		return new SettingSearch();
	}

}
