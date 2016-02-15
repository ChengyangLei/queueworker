<?php
class DATABASE_CONFIG {
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => true,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'queueworker',
        'prefix' => '', 
        'encoding' => 'UTF8',
    );
}