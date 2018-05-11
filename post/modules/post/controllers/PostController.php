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


    public function  actionUpdate()
    {

        $request=Yii::$app->request;
        $id=$request->get('id');
        $post=Post::find()->where(['id'=>$id])->one();
        if($post==null){
            return $this->json_error("NOT this Post!");
        }

        $user=$this->user_Info();
         $isok=$post->get_validate($user);

         if($isok=="false") {
         return $this->json_error("miss authority!");
         }


         $post_info=['title','content'];
        $post_data=$this->data_validate($post_info);
         if($post_data=="false"){
            return $this->json_error("修改参数不全");
         }

        $post->title=$post_data['title'];
        $post->content=$post_data['content'];

        $isok= $post->save();

        if($isok==false){
            return json_error("修改失败!");
        }else{
            return $this->json_ok("修改OK!");
        }

    }

    public function  actionDelete()
    {
        $request=Yii::$app->request;
        $id=$request->get('id');
        $post=Post::find()->where(['id'=>$id])->one();
        if($post==null){
            return $this->json_error("NOT this Post!");
        }

        $user=$this->user_Info();
        $isok=$post->get_validate($user);

        if($isok=="false") {
            return $this->json_error("miss authority!");
        }

        $isok=$post->delete();
        if($isok==false){
            return json_error("Delete--error!");
        }else{
            return $this->json_ok("Delete--OK!");
        }
    }

}
