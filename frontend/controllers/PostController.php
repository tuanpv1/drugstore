<?php
namespace frontend\controllers;

use common\models\Post;
use Yii;
use yii\web\Controller;

/**
 *  Post Controller
 */
class PostController extends Controller
{
    public function actionIndex()
    {
        $post = Post::find()->andWhere(['status'=>Post::STATUS_ACTIVE])->all();
        return $this->render('index',[
            'post'=>$post
        ]);
    }

    public function actionDetail($id)
    {
        $post = Post::findOne(['id'=>$id]);
        $involve= Post::find()->andWhere("id != :id")->addParams([':id'=>$id])->all();
        return $this->render('detail',[
            'post'=>$post,
            'involve'=>$involve
        ]);
    }
}
