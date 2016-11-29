<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/27/2016
 * Time: 9:39 PM
 */
use common\models\Product;
use yii\helpers\Url;

?>
<header class="section background-primary text-center tp_003">
    <h4 class="text-white margin-bottom-0 text-size-28 text-thin text-line-height-1">Xem giỏ hàng </h4>
</header>
<div class="section background-white">
    <div class="line">
        <div class="s-12 m-12 1-8 margin text-center">
            <h2 class="text-uppercase text-strong margin-bottom-30">Sản phẩm trong giỏ hàng</h2>
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td width="20%" class="image">Sản phẩm</td>
                    <td width="30%" class="description"></td>
                    <td width="15%" class="price">Giá</td>
                    <td width="15%" class="quantity">Số Lượng</td>
                    <td width="15%" class="total">Tổng tiền</td>
                    <td width="5%"></td>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($cart) && $cart != null){
            //                        echo "<pre>"; print_r($cart);die();
                    foreach($cart as $key =>$value){
                        $total =  $value['amount']*$value['price'];
                        ?>
                        <tr>
                            <td class="cart_product">
                                <a href="<?= Url::to(['product/detail','id'=>$value['id']]) ?>"><img style="width: 150px" src="<?= Product::getImageLinkStatic($value['image']) ?>" alt="<?= $value['name'] ?>"></a>
                            </td>
                            <td class="cart_description">
                                <p><a href="<?= Url::to(['product/detail','id'=>$value['id']]) ?>"><?= $value['name'] ?></a></p>
                            </td>
                            <td class="cart_price">
                                <p><?= Product::formatNumber($value['price']).' VND'?></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" onclick="addition(<?= $key ?>)" href="javascript:void(0)"> + </a>
                                    <input class="cart_quantity_input" onkeyup="updateCart(<?= $key ?>)" type="text" name="amount_<?= $key ?>" id="amount_<?= $key ?>" value="<?= $value['amount'] ?>" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" onclick="subtraction(<?= $key ?>)" href="javascript:void(0)"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price"><?= Product::formatNumber($total).' VND' ?></p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" onclick="delCart(<?= $key ?>)" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Hiện giỏ hàng của bạn đang trống
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="section background-white">
    <div class="line">
        <div class="margin">

            <!-- Company Information -->
            <div class="s-12 m-12 l-6">
                <h2 class="text-uppercase text-strong margin-bottom-30">Tổng tiền giỏ hàng</h2>
                <div class="float-left">
                    <i class="icon-paperplane_ico background-primary icon-circle-small text-size-20"></i>
                </div>
                <div class="margin-left-80 margin-bottom">
                    <h4 class="text-strong margin-bottom-0">Tổng tiền <span><?=Product::formatNumber($total_all).' VND'?></span></h4>
                    <p>Số lượng sản phẩm <span> <?= $totalAmount ?> Sản phẩm</span><br>
                        Phí ship <span>Miễn phí</span><br>
                        Số tiền phải thanh toán <span><?=Product::formatNumber($total_all).' VND'?></span>
                    </p>
                    <?php
                    if($cart){
                        ?>
                        <a class="submit-form button background-primary border-radius text-white" onclick="inPutInfo()" href="javascript:void(0)">Tiến hành thanh toán</a>
                        <?php
                    }else{
                        ?>
                        <a class="submit-form button background-primary border-radius text-white" href="<?= Url::to(['site/index']) ?>">Tiếp tục mua hàng</a>
                        <?php
                    }
                    ?>
                </div>

            </div>

            <!-- Contact Form -->
            <div class="s-12 m-12 l-6" id="do_action_tp">
                <h2 class="text-uppercase text-strong margin-bottom-30">Thông tin người đặt hàng</h2>
                <form class="customform" method="post">
                    <div class="line">
                        <div class="margin">
                            <div class="s-12 m-12 l-6">
                                <input id="name" name="name" class="required email border-radius" placeholder="Họ Tên (*)" title="Họ Tên" type="text" />
                                <h6  id="c_name" class="text-size-28" style="color: red">Không được để trống họ và tên</h6>
                            </div>
                            <div class="s-12 m-12 l-6">
                                <input name="phone" id="phone" class="required name border-radius" placeholder="Số điện thoại (*)" title="Số điện thoại" type="text" />
                                <h6  id="c_phone" class="text-size-28" style="color: red">Không được để trống số điện thoại</h6>
                                <h6  id="cc_phone" class="text-size-28" style="color: red">Số điện thoại không đúng định dạng!</h6>
                            </div>
                        </div>
                    </div>
                    <div class="s-12">
                        <input name="address" id="address" class=" required subject border-radius" placeholder="Địa chỉ nhận hàng  (*)" title="Địa chỉ nhận hàng" type="text" />
                        <h6  id="c_address" class="text-size-28" style="color: red">Không được để trống địa chỉ nhận hàng</h6>
                    </div>
                    <div class="s-12">
                        <textarea id="state" name="state" class="message border-radius" placeholder="Tình trạng bệnh và yêu cầu nếu có" rows="3"></textarea>
                    </div>
                    <div class="s-12 m-12 l-4">
                        <h6  id="c_validate" class="text-size-28" style="color: red">Vui lòng nhập đủ các trường có dấu (*)</h6>
                        <a id="btn" class="submit-form button background-primary border-radius text-white">Đặt hàng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>