<?php

namespace post\modules\user\controllers;

use post\modules\user\models\User;
use Yii;

use yii\web\Controller;
use post\base\BaseController;

class RegisterController extends BaseController {
	
	
	public function actionIndex() {

	    $request=Yii::$app->request;
	    if($request->isPost)
        {
            $arr=['user_name','user_email','user_pwd'];
            $data_info= $this->data_validate($arr);

            if($data_info=="false")
            {
                return $this->json_error("参数不全");
            }



            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);


            $password=crypt($data_info['user_pwd'], $salt);

            $user=new User();

            $user->name=$data_info['user_name'];
            $user->email=$data_info['user_email'];
            $user->password=$password;
            $user->salt=$salt;

            $info= $user->save();

            return  $this->json_ok($info);
        }


		
	}

	
	
}
