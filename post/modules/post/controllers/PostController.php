<?php

namespace post\modules\post\controllers;


use post\modules\post\models\Post;
use Yii;

use yii\data\Pagination;
use yii\web\Controller;
use post\base\BaseController;
class PostController extends BaseController {
	
    public function beforeAction($action)
    {
        if($this->is_login()){
                return true;
        }else{
            return $this->json_error("登陆失败!");
        }
    }


    public function  actionAdd()
    {

        $data_info=['title','content'];
        $data=$this->data_validate($data_info);

        if($data=="false")
        {
            return $this->json_error("参数不全");
        }



        $post=new Post();
        $post->title=$data["title"];
        $post->content=$data["content"];
        $post->user_id=$this->user_Info()->toArray()['id'];
        $isok=$post->save();

        if($isok)
        {
            return $this->json_ok("发布成功--OK!");
        }else{

            return $this->json_error("发布失败--ERROR!");
        }

    }

}
