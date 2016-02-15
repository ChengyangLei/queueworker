<?php

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
//App::uses('Sanitize', 'Utility');

class AppModel extends Model {
    /**
     * 是否开启缓存
     *
     * @var bool
     */
    var $cache = false;
    /**
     * 缓存key相关的字段
     *
     * @var array
     */
    var $cacheIndexFields = array();

    public function __construct($id = false, $table = null, $ds = null) {
        $this->useDbConfig = (!defined('APP_DEV') || APP_DEV) ? 'default' :  'master';
        parent::__construct($id, $table, $ds);
    }

    private function getSlave() {
        if (!defined('APP_DEV') || APP_DEV)
            return $this->useDbConfig;
        
        $sources_list = ConnectionManager::enumConnectionObjects();
        $slaves = array();
        foreach ($sources_list as $name => $values) {
            if (preg_match('/^slave[0-9]+$/i', $name) == 1) 
                $slaves[] = $name;
        }
        return $slaves[rand(0, count($slaves) - 1)];
    }

    function findFromSlave($type = 'first', $params = array()) {
        return parent::find($type, $params);
        //下面的程序有时有BUG,原因不明，这样就只用master,当前我们没有主从，也够用
        $oldDb = $this->useDbConfig;
        $this->setDataSource($this->getSlave());
        $data = parent::find($type, $params);
        $this->setDataSource($oldDb);
        return $data;
    }
   
    /**
     * 锁住表一行，防止脏数据，必须要用主建，以免全表锁。
     * 调用之前必须有 $db->begin();
     * @param type $primaryKeyValue
     * @return type
     */
    function rowLock($primaryKeyValue){
        if (!$primaryKeyValue || !$this->useTable || !$this->primaryKey) return ;
        $sql="select 1 from ".$this->useTable." where ".$this->primaryKey."='".$primaryKeyValue."' for update";
        return $this->query($sql);
    }
    
    function find($type = 'first', $params = array()) {
        if ($this->cache) {
            $typeString = is_array($type) ? md5(json($type)) : $type;
            $tag = $this->useTable ? : __CLASS__;
            $version = (int) Cache::read($tag);
            $paramsHash = md5(serialize($params));
            $fullTag = $this->cacheKey($params) . '_' . $typeString . '_' . $paramsHash;
            if ($result = Cache::read($fullTag)) {
                if ($result['version'] == $version)
                    return $result['data'];
            }
        }

        $data = $this->findFromSlave($type, $params);
        if ($this->cache) {
            $result = array('version' => $version, 'data' => $data);
            Cache::write($fullTag, $result);
            Cache::write($tag, $version);
        }
        return $data;
    }

    function updateCounter() {
        if ($this->cache) {
            $tag = $this->useTable ? : __CLASS__;
            Cache::write($tag, 1 + (int) Cache::read($tag));
        }
    }

    function getPrefixCacheKey($key, $config = 'default') {
        $settings = Cache::settings($config);
        if (empty($settings) || !self::isInitialized($config))
            return '';
        $key = MemcacheEngine::key($key);
        if (!$key) {
            return '';
        }
        return $settings['prefix'] . $key;
    }

    function clearCacheByFields($fields = array()) {
        if ($fields==null) {
            return ;
        }
        $prefix = array('app', $this->useTable);
        foreach ($fields as $key => $value) {
            $prefix[] = $key.'_'.$value;
        }
        $prefixKey = strtolower(join('_', $prefix));

        return CacheLogic::clearByPrefix($prefixKey);
    }

    function cacheKey($params) {
        if (isset($params['conditions'])) {
            $prefix = array();
            foreach ($this->cacheIndexFields as $one) {
                if (!isset($params['joins']) && isset($params['conditions'][$one])) {
                    $prefix[] = $one.'_'.$params['conditions'][$one];
                }
                else {
                    $key = $this->useTable.'.'.$one;
                    if (isset($params['conditions'][$key])) {
                        $prefix[] = $one.'_'.$params['conditions'][$key];
                    }
                }
            }

            $key = $this->useTable ? $this->useTable.'_'.join('|', $prefix) : __CLASS__.'_'.join('|', $prefix);

            return $key;
        }

        return $this->useTable ? : __CLASS__;
    }
    
    function updateAll($fields, $conditions = true) {
        $this->updateCounter();
        return parent::updateAll($fields, $conditions);
    }

    function afterDelete() {
        $this->updateCounter();
        parent::afterDelete();
    }

    function afterSave($created,$options = array()) {
        $this->updateCounter();
        parent::afterSave($created);
    }
    
    
    /**
     * 过滤数据
     *
     * @param string $options 
     * @return void
     * @author Lin Yang
     */
    public function beforeValidate($options = array()) {
        if (isset($this->data[$this->name]) && is_array($this->data[$this->name])) {
            foreach ($this->data[$this->name] as &$value) {
                if (is_string($value)) {
                    $value = trim($value);
                }
            }
        }
        return true;
    }
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->name]) && is_array($this->data[$this->name])) {
            foreach ($this->data[$this->name] as &$value) {
                if (is_string($value)) {
                    $value = trim($value);
                }
            }
        }
        return true;
    }

    /**
     * 检查是否为手机号
     *
     * @author LinYang
     * @param  int/string  $check
     * @return bool
     */
    public function validate_mobile($value)
    {
        $mobile = @$value['mobile'];
        return preg_match("/^(?:13\d|18\d|14\d|15\d)-?\d{5}(\d{3}|\*{3})$/", $mobile);
    }
}

