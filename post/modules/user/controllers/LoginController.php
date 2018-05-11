<?php

namespace post\modules\user\controllers;

use post\modules\user\models\User;
use Yii;

use yii\web\Controller;
use post\base\BaseController;

class LoginController extends BaseController
{


    public function actionIndex()
    {


        $request = Yii::$app->request;
        if ($request->isPost) {
            $request_arr = ['user_email', 'user_pwd'];
            $data = $this->data_validate($request_arr);
            if ($data == "false") {
                return $this->json_error("参数缺失");
            }
            $userModel=$this->actionFindUser($data['user_email']);
            $user=$userModel->toArray();

            if($userModel==null){
                return  $this->json_error("没有这个用户!");
            }

            $password=crypt($data['user_pwd'],$user['salt']);
            if($password==$user['password'])
            {
                $session=Yii::$app->session;
                $session->set("user",$userModel);
                return  $this->json_ok($user['name']."登陆成功!");
            }else{
                return  $this->json_error("登陆失败!");
            }


        }
    }

//查找用户
    public function actionFindUser($email=null)
    {
        $user=null;
        if($email!=null)
        {
            $user = User::find()->where(['email' => $email])->one();


        }else{
            $request_arr = ['user_email'];
            $data = $this->data_validate($request_arr);
            if ($data == "false") {
                return $this->json_error("参数缺失");
            }
            $user = User::find()->where(['email' => $data['user_email']])->one();

        }

        if ($user != null) {
            return $user;
        } else {
            return null;
        }


    }

    //测试是否登陆
    public function  actionIsLogin()
    {
        $session=Yii::$app->session;
        $user= $session->get("user");
        $this->dd($user);
        return  $this->json_ok($user->toArray());
    }

}
