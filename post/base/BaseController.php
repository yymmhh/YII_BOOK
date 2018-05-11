<?php

/**
 * @date        : 2017年8月30日
 * @author      : Jason
 * @copyright   : http://www.hoge.cn/
 * @description : 后台控制器基类
 */
namespace post\base;

use yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use backend\modules\ucenter\models\User;
use backend\modules\admin\models\Site;
use backend\modules\ucenter\models\WeixinUser;

class BaseController extends Controller
{
    public $enableCsrfValidation = false;

    public $no_need_login;
    
    public $check_work;

   

    public function init()
    {
        // parent::init();
        echo "先";
       
    }

    // 前置
    public function beforeAction($action)
    {
        // parent::actions($action);
         
       
        echo "BaseController";
        return true;
    }


    public function data_validate($arr)
    {
        $request = \Yii::$app->request;
        $data=[];
        foreach ($arr as $item) {
            if ($item != null) {
                if ($request->post($item) == null) {

                    return "false";
                }else{

                    $data[$item]=$request->post($item);
                }
            }

        }

        return $data;
    }

}