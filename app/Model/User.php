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
    );

    public function user_list(){
        return $this->find('list',array(
            'fields'=>array('User.id','User.name'),
            'conditions'=>array('active>0')
        ));
    }
}
 ?>