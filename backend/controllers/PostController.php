<?php

namespace backend\controllers;

use kartik\widgets\ActiveForm;
use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                if ($image->saveAs(Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_post') . "/" . $file_name)) {
                    $model->image = $file_name;
                }
            }
            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Tạo bài viết thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'Tạo bài viết không thành công');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
        $old_image = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $tmp = Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_post') . "/" ;
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                if ($image->saveAs($tmp . $file_name)) {
                    if(file_exists($tmp.$old_image)){
                        unlink($tmp . $old_image);
                    }
                    $model->image = $file_name;
                }
            }
            if($model->update()) {
                Yii::$app->getSession()->setFlash('success', 'Cập nhật bài viết thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'Cập nhật bài viết không thành công');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = Post::findOne($id);
        if($model->status == Post::STATUS_ACTIVE){
            Yii::$app->getSession()->setFlash('error', 'Không được xóa bài viết ở trạng thái hoạt động');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model = $this->findModel($id);
        $tmp = Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_post') . "/";
        if(file_exists($tmp.$model->image)){
            unlink($tmp . $model->image);
        }
        $model->delete();
        Yii::$app->getSession()->setFlash('success', 'Đã xóa bài viết thành công');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
