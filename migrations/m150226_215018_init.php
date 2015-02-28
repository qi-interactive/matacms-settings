<?php

/*
 * This file is part of the mata project.
 *
 * (c) mata project <http://github.com/mata/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\db\Schema;
use mata\user\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m150226_215018_init extends Migration {
    public function up() {
        $this->createTable('{{%matacms_setting}}', [
            'Key'          => 'VARCHAR(255) NOT NULL',
            'FormInputField'     => 'VARCHAR(255) NOT NULL'
        ]);

        $this->addPrimaryKey("PK_Key", "{{%matacms_setting}}", "Key");
    }

    public function down() {
        $this->dropTable('{{%matacms_setting}}');
    }
}