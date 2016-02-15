<?php
App::uses('AppModel', 'Model');
/**
 * Vip Model
 *
 * @property Counter $Counter
 */
class Vip extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '必须填写'
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => '已经存在!',
                'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '必须填写',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
    );
}