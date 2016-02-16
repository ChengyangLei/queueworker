<?php 
class User extends AppModel {

    public $useTable = 'users';

    public $validate = array(
        'email' => array(
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
        'name' => array(
            'required' => array(
                'rule' => '/^\w{6,20}$/u',
                'message' => '合法的姓名2-16位由字母、数字、下划线、汉字组成',
            )
        ),
        'qq' => array(
            'required' => array(
                'rule' => '/[0-9]{1,12}/',
                'message' => 'qq号码由数字组成',
            )
        ),
        'tel' => array(
            'required' => array(
                'rule' => '/^(13[0-9]|15[0|1|3|6|7|8|9]|18[8|9])\d{8}$/',
                'message' => '电话号码不正确',
            )
        ),
    );

    public function user_list(){
        return $this->find('list',array(
            'fields'=>array('User.id','User.name'),
            'conditions'=>array('active>0')
        ));
    }
}
 ?>