<?php

namespace post\modules\user\controllers;

use Yii;

use yii\web\Controller;
use post\base\BaseController;
use post\modules\user\models\User;
class RegisterController extends BaseController {
	
	
	public function actionIndex() {
		
		$arr=['user_email','user_pwd'];
		$data_info= $this->data_validate($arr);
	
		
		
    	 $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
    
    
    	 $password=crypt($data_info['user_pwd'], $salt);

    	 $user=new User();

    	 $user->email=$data_info['user_email'];
    	 $user->password=$password;
    	 $user->salt=$salt;

    	 $user->save();


  
		
	}

	
	
}
