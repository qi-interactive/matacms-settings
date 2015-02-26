<?php

namespace matacms\settings\controllers;

use matacms\controllers\module\Controller;
use matacms\settings\models\Setting;
use matacms\settings\models\SettingSearch;

/**
 * ContentBlockController implements the CRUD actions for ContentBlock model.
 */
class SettingsController extends Controller {

	public function getModel() {
		return new Setting();
	}

	public function getSearchModel() {
		return new SettingSearch();
	}
}
