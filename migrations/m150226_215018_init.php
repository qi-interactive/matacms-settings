<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use mata\user\migrations\Migration;

class m150226_215018_init extends Migration {
    
    public function safeUp() {
        $this->createTable('{{%matacms_setting}}', [
            'Key'          => 'VARCHAR(255) NOT NULL',
            'FormInputField'     => 'VARCHAR(255) NOT NULL'
        ]);

        $this->addPrimaryKey("PK_Key", "{{%matacms_setting}}", "Key");
    }

    public function safeDown() {
        $this->dropTable('{{%matacms_setting}}');
    }

}
