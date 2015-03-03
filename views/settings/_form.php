<?php

use mata\widgets\DynamicForm;

echo DynamicForm::widget([
	'model' => $model->getValue()->one(),
	'fieldAttributes' => [
		'Key' => false,
	    'Value' => [
	        'label' => $model->Key,
	        'fieldType' => $model->FormInputField
	    ]
	   ]
	]);

