<?php
namespace frontend\controllers;

use common\models\Order;
use common\models\OrderDetail;
use common\models\Product;
use common\models\Subcriber;
use frontend\models\Cart;
use Yii;
use yii\web\Controller;
use yii\helpers\Json;

/**
 *  Product Controller
 */
class ProductController extends Controller
{
    public function actionIndex()
    {
        $product = Product::find()->andWhere(['status'=>Product::STATUS_ACTIVE])->all();
        return $this->render('index',[
            'product'=>$product
        ]);
    }

    public function actionDetail($id)
    {
        $product = Product::findOne(['id'=>$id]);
        return $this->render('view',[
            'product'=>$product
        ]);
    }

    public function actionAddCart($id){
        $productInfo = Product::findOne($id);
//        echo "<pre>";print_r($productInfo);die();

        $cart = new Cart();
        $cart->addCart($id,$productInfo);
        $session = Yii::$app->session;
        $cartInfo = $session['cart'];
        $totalAmount = $total=0;
        foreach($cartInfo as $key => $value){
            $totalAmount += $value['amount'];
//            if($value['sale'] == 0) {
//                $total += $value['price'] * $value['amount'];
//            }else {
//                $sal = ($value['price']*(100-$value['sale']))/100;
//                $total += $sal * $value['amount'];
//            }
        }
        return $this->renderAjax('cart',['cartInfo'=>$totalAmount]);
    }

    public function actionListMyCart(){
        $session = Yii::$app->session;
        $cart = $session['cart'];
//        echo "<pre>";print_r($cart);die();
        $totalAmount = $total_all=0;
        if(isset($cart)){
            foreach($cart as $key => $value){
                $totalAmount += $value['amount'];
                $total_all += $value['price'] * $value['amount'];
            }
        }
        return $this->render('list-my-cart',['cart'=>$cart,'total_all'=>$total_all,'totalAmount'=>$totalAmount]);
    }

    public function actionUpdateCart($id,$amount){
        $cart = new Cart();
        $cart->updateItem($id,$amount);
        $session = Yii::$app->session;
        $cartInfo = $session['cart'];
        $totalAmount = $total=0;
        foreach($cartInfo as $key => $value){
            $totalAmount += $value['amount'];
        }
        return $this->renderAjax('cart',['cartInfo'=>$totalAmount]);
    }

    public function actionDelCart($id){
        $cart = new Cart();
        $cart->deleteItem($id);
        $session = Yii::$app->session;
        $cartInfo = $session['cart'];
        $totalAmount = $total=0;
        foreach($cartInfo as $key => $value){
            $totalAmount += $value['amount'];
        }
        return $this->renderAjax('cart',['cartInfo'=>$totalAmount]);
    }

    public function actionSaveBuy()
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $state = $_POST['state'];

        // save table subcriber
        $sub = new Subcriber();
        $sub->phone = $phone;
        $sub->name = $name;
        $sub->state = $state;
        $sub->status = Subcriber::STATUS_ORDER;
        $sub->address = $address;

        if($sub->save()){
            // save table order
            $id_sub = $sub->id;

            $session = Yii::$app->session;
            $cart  = $session['cart'];
//        echo "<pre>";print_r($cart);die();
            $totalAmount = $total=0;
            foreach($cart as $key => $value){
                $totalAmount += $value['amount'];
                $total += $value['price'] * $value['amount'];
            }

            $order = new Order();
            $order->phone = $phone;
            $order->number = $totalAmount;
            $order->address = $address;
            $order->id_sub = $id_sub;
            $order->status = Order::STATUS_TP;
            $order->total = $total;
            if($order->save()){

                $order_id = $order->id;
                foreach ($cart as $key => $value) {
                    $total_one =  $value['amount']*$value['price'];
                    $order_detail = new OrderDetail();
                    $order_detail->order_id = $order_id;
                    $order_detail->product_id = $value['id'];
                    $order_detail->price = $value["price"];
                    $order_detail->number = $value["amount"];
                    $order_detail->total = $total_one;
                    $order_detail->price_sale = null;
                    if(!$order_detail->save()){
                        $message = 'Đặt hàng không thành công. không lưu thành công chi tiết đơn hàng!';
                        return Json::encode(['success' => false, 'message' => $message]);
                    }
                }
                $session->remove('cart');
                $message = 'Đặt hàng thành công, bộ phận chăm sóc khách hàng sẽ gọi lại để xác nhận đơn hàng.';
                return Json::encode(['success' => true, 'message' => $message]);
            }else{
                $message = 'Đặt hàng không thành công vui lòng thử lại.';
                return Json::encode(['success' => false, 'message' => $message]);
            }
        }else{
            $message = 'Đặt hàng không thành công vui lòng thử lại.';
            return Json::encode(['success' => false, 'message' => $message]);
        }
    }

    public function actionSaveSub(){
        $phone = $_POST['phone'];
        $name = '';
        $message = '';
        if(isset($_POST['name'])){
            $name = $_POST['name']?$_POST['name']:'';
            $message = $_POST['message']?$_POST['message']:'';
        }
        $sub = new Subcriber();
        $sub->phone = $phone;
        $sub->name = $name;
        $sub->state = $message;
        $sub->status = Subcriber::STATUS_NOTCALL;
        if($sub->save()){
            if($sub->name == ''){
                $message = 'Đã yêu cầu gọi lại thành công, bộ phận chăm sóc khách hàng sẽ gọi lại cho quý khách sau ít phút.';
            }else{
                $message = 'Đã gửi yêu cầu thành công, bộ phận chăm sóc khách hàng sẽ liên hệ lại cho quý khách sớm nhất.';
            }
            return Json::encode(['success' => true, 'message' => $message]);
        }else{
            $message = 'Yêu cầu chưa được thực hiện vui lòng thử lại.';
            return Json::encode(['success' => false, 'message' => $message]);
        }
    }
}
