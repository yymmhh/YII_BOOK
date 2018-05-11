<?php

namespace post\modules\post\controllers;


use post\modules\post\models\Post;
use Yii;

use yii\data\Pagination;
use yii\web\Controller;
use post\base\BaseController;
class PostShowController extends BaseController {
	


	public function actionIndex()
	{
        $request=\Yii::$app->request;
        $page=$request->get("page");
        if($page==null)
        {
            $page=1;
        }

        $sizeCount=0;   //一共分多少页
        //每页的数量*(浏览页-1)+1
        $pageSize=Yii::$app->params['pageSize'];   //每页的个数从配置文件读取
        $paindex=$pageSize *($page-1);

        $query= Post::find();
        $count = $query->count();
        if($count % $pageSize !=0){
            $sizeCount=$count / $pageSize +1;
        }else{
            $sizeCount=$count / $pageSize ;
        }

        $articles = Post::find()
            ->limit($pageSize)
            ->offset($paindex)
            ->asArray()
            ->all();


        $data[]=null;
        $data["data"]=$articles;
        $data["sizeCount"]=$sizeCount;
        $data["page"]=$page;

        return $this->json_ok($data);

	}



}
