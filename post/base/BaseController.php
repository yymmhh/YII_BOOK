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


class BaseController extends Controller
{
    public $enableCsrfValidation = false;

    public $no_need_login;
    
    public $check_work;

   

    public function dd($arr)
    {
        echo "<pre>";
        var_dump($arr);
        echo "<pre>";

    }


    public function init()
    {
        // parent::init();
//        echo "先";
       
    }

    // 前置
    public function beforeAction($action)
    {
        // parent::actions($action);
         
       
//        echo "BaseController";
        return true;
    }


    public function json_ok($data)
    {
        $arr=[];
        $arr["status"]="200";
        $arr["data"]=$data;
        $arr["error"]=0;
        return json_encode($arr);
    }

    public function json_error($data)
    {
        $arr=[];
        $arr["status"]="200";
        $arr["data"]=$data;
        $arr["error"]=1;
        return json_encode($arr);
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