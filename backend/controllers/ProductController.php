<?php

namespace backend\controllers;

use common\models\OrderDetail;
use common\models\Product;
use common\models\ProductSearch;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * FoodController implements the CRUD actions for Food model.
 */
class ProductController extends Controller
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
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Food model.
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
     * Creates a new Food model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                if ($image->saveAs(Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_product') . "/" . $file_name)) {
                    $model->image = $file_name;
                }
            }
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Tạo nhóm thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Tạo nhóm không thành công');
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
     * Updates an existing Food model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        /** @var Product $model */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $image_old = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $tmp = Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_product') . "/";
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                if ($image->saveAs($tmp . $file_name)) {
                    if(file_exists($tmp . $image_old) && !empty($image_old)){
                        unlink($tmp . $image_old);
                    }
                    $model->image = $file_name;
                } else {
                    $model->image = $image_old;
                }
            } else {
                $model->image = $image_old;
            }
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Cập nhật nhóm thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Food model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        /** @var  Product $model */
        if ($model->status == Product::STATUS_ACTIVE) {
            Yii::$app->getSession()->setFlash('error', 'Không được xóa sản phẩm ở trạng thái hoạt động');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $order_detail = OrderDetail::findOne(['id_product' => $id]);
        if ($order_detail) {
            Yii::$app->getSession()->setFlash('error', 'Không được xóa sản phẩm đang có trong đơn hàng, vui lòng chuyển sang chế độ ẩn sản phẩm.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model = $this->findModel($id);
        $tmp = Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_product') . "/";
        unlink($tmp . $model->image);
        $model->delete();
        Yii::$app->getSession()->setFlash('success', 'Đã xóa sản phẩm thành công');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Food model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Food the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
