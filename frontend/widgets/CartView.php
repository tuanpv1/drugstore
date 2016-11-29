<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/19/2016
 * Time: 9:09 PM
 */
namespace frontend\widgets;

use yii\base\Widget;
use Yii;

class CartView extends Widget{

    public $message;

    public  function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public  function run()
    {
        $session = Yii::$app->session;
        $cartInfo = $session['cart'];
        return $this->render('cart-view',[
            'cartInfo'=>$cartInfo
        ]);
    }
}