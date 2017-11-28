<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ControladoresMigration_102
 */
class ControladoresMigration_102 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('controladores', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'mtime',
                        [
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'ctime',
                        [
                            'type' => Column::TYPE_TIMESTAMP,
                            'size' => 1,
                            'after' => 'mtime'
                        ]
                    ),
                    new Column(
                        'controlador',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 32,
                            'after' => 'ctime'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id'], 'PRIMARY'),
                    new Index('controlador', ['controlador'], 'UNIQUE'),
                    new Index('ctime', ['ctime'], null)
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '8',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
