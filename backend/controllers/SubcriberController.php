<?php

namespace backend\controllers;

use backend\models\FormSub;
use common\models\Order;
use common\models\Product;
use Yii;
use common\models\Subcriber;
use common\models\SubcriberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubcriberController implements the CRUD actions for Subcriber model.
 */
class SubcriberController extends Controller
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
     * Lists all Subcriber models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubcriberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subcriber model.
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
     * Creates a new Subcriber model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormSub();

        if ($model->load(Yii::$app->request->post())) {
            $sub = new Subcriber();
            $sub->phone = $model->phone;
            $sub->name = $model->name;
            $sub->status = $model->status;
            $sub->address = $model->address;
            $sub->note_admin = $model->note_admin;
            $sub->state = $model->state;
            $sub->save();
            if($sub->status == Subcriber::STATUS_ORDER){
                $order = new Order();
                $order->phone = $model->phone;
                $order->id_product = $model->id_product;
                $order->number = $model->number;
                $order->price = Product::findOne($model->id_product)->price;
                $order->address = $model->address;
                $order->status = $model->status;
                $order->total = Subcriber::getPriceTotal($model->number,$model->id_product);
                $order->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subcriber model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = FormSub::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $sub = Subcriber::findOne($id);
            $sub->phone = $model->phone;
            $sub->name = $model->name;
            $sub->status = $model->status;
            $sub->address = $model->address;
            $sub->note_admin = $model->note_admin;
            $sub->state = $model->state;
            if($sub->status == Subcriber::STATUS_ORDER){
                if($model->id_product){
                    if($model->number){
                        $order = new Order();
                        $order->phone = $model->phone;
                        $order->id_product = $model->id_product;
                        $order->number = $model->number;
                        $order->price = Product::findOne($model->id_product)->price;;
                        $order->address = $model->address;
                        $order->status = Order::STATUS_TP;
                        $order->id_sub = $id;
                        $order->id_user = Yii::$app->user->id;
                        $order->total = Subcriber::getPriceTotal($model->number,$model->id_product);
                        $order->save();
                        $sub->update();
                        \Yii::$app->session->setFlash('success', 'Cập nhật thông tin thành công!');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }else{
                        \Yii::$app->session->setFlash('error', 'Số lượng không được để trống!');
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }else{
                    \Yii::$app->session->setFlash('error', 'Sản phẩm không được để trống!');
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }else{
                $sub->update();
                \Yii::$app->session->setFlash('success', 'Cập nhật thông tin thành công!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subcriber model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Subcriber model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subcriber the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subcriber::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
