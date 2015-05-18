<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\settings;

use mata\base\Module as BaseModule;

class Module extends BaseModule {

	public function getNavigation() {

		// Change to checking if Admin when RBAC is implemented
		if (YII_DEBUG)
			return "/mata-cms/settings/settings";

		return false;
	}

}
