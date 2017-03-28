<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\CartView;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$title = "Bổ thận tráng dương"
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- HEADER -->
<header role="banner">
    <!-- Top Bar -->
    <div class="top-bar background-white">
        <div class="line">
            <div class="s-12 m-6 l-6">
                <div class="top-bar-contact">
                    <p class="text-size-12">Liên hệ: 0972.64.9696 | <a class="text-orange-hover" href="mailto:contact@sampledomain.com">onglangchuc@gmail.com</a></p>
                </div>
            </div>
            <div class="s-12 m-6 l-6">
                <div class="right">
                    <ul class="top-bar-social right">
                        <li><a href="/"><i class="icon-facebook_circle text-orange-hover"></i></a></li>
                        <li><a href="/"><i class="icon-twitter_circle text-orange-hover"></i></a> </li>
                        <li><a href="/"><i class="icon-google_plus_circle text-orange-hover"></i></a></li>
                        <li><a href="/"><i class="icon-instagram_circle text-orange-hover"></i></a></li>
                    </ul>
                    <?= CartView::widget() ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Navigation -->
    <nav class="background-white background-primary-hightlight">
        <div class="line">
            <div class="s-12 l-2 tp_007">
                <a href="<?= Url::to(['site/index']) ?>" class="logo tp_008"><img style="width: 96px" src="<?=  Yii::$app->request->baseUrl; ?>/img/logo_free.png" alt="Trang chủ"></a>
            </div>
            <div class="top-nav s-12 l-10">
                <p class="nav-text"></p>
                <ul class="right chevron">
                    <li><a href="<?=  Url::to(['site/index']) ?>">TRANG CHỦ</a></li>
                    <li><a href="<?=  Url::to(['product/index']) ?>">THUỐC</a></li>
                    <li><a href="<?=  Url::to(['post/index']) ?>">MẸO HAY NHÂN GIAN</a></li>
                    <li><a href="<?=  Url::to(['site/about']) ?>">GIỚI THIỆU</a></li>
                    <li><a href="<?=  Url::to(['site/contact']) ?>">LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="main">
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<footer>
    <!-- Social -->
    <div class="background-primary padding text-center">
        <a href="#"><i class="icon-facebook_circle icon2x text-white"></i></a>
        <a href="#"><i class="icon-twitter_circle icon2x text-white"></i></a>
        <a href="#"><i class="icon-google_plus_circle icon2x text-white"></i></a>
        <a href="#"><i class="icon-instagram_circle icon2x text-white"></i></a>
    </div>

    <!-- Main Footer -->
    <section class="section background-dark">
        <div class="line">
            <div class="margin">
                <!-- Collumn 1 -->
                <div class="s-12 m-12 l-4 margin-m-bottom-2x">
                    <h4 class="text-uppercase text-strong">Đông y Ông Lang Chức</h4>
                    <p class="text-size-20"><em>"Được thừa hưởng từ bí quyết của cha ông để lại nhà thuốc đông y đã giúp đỡ hàng nghìn bệnh nhân lấy lại được phong độ."</em><p>

                        <div class="line">
                            <h4 class="text-uppercase text-strong margin-top-30"></h4>
                            <div class="margin">
                                <div class="s-12 m-12 l-4 margin-m-bottom">
                                    <a class="image-hover-zoom" href="<?= Url::to(['site/about']) ?>"><img src="<?=  Yii::$app->request->baseUrl; ?>/img/blog-01.jpg" alt=""></a>
                                </div>
                                <div class="s-12 m-12 l-8 margin-m-bottom">
                                    <p>Kế nghiệp từ Ông Lang Chức nhà thuốc đông y đã dần khẳng định được vị trí của mình với sự phục hồi năng lực cho cánh mày râu</p>
                                    <a class="text-more-info text-primary-hover" href="<?= Url::to(['site/about']) ?>">Tìm hiểu thêm</a>
                        </div>
                </div>
            </div>
        </div>

        <!-- Collumn 2 -->
        <div class="s-12 m-12 l-4 margin-m-bottom-2x">
            <h4 class="text-uppercase text-strong">Liên hệ:</h4>
            <div class="line">
                <div class="s-1 m-1 l-1 text-center">
                    <i class="icon-placepin text-primary text-size-12"></i>
                </div>
                <div class="s-11 m-11 l-11 margin-bottom-10">
                    <p><b>Địa chỉ:</b> Xã Đông Lỗ, Hiệp Hòa, TP Bắc Giang  </p>
                </div>
            </div>
            <div class="line">
                <div class="s-1 m-1 l-1 text-center">
                    <i class="icon-mail text-primary text-size-12"></i>
                </div>
                <div class="s-11 m-11 l-11 margin-bottom-10">
                    <p><b>E-mail:</b> onglangchuc@gmail.com</p>
                </div>
            </div>
            <div class="line">
                <div class="s-1 m-1 l-1 text-center">
                    <i class="icon-smartphone text-primary text-size-12"></i>
                </div>
                <div class="s-11 m-11 l-11 margin-bottom-10">
                    <p><b>Hotline:</b> 0972.64.9696</p>
                </div>
            </div>
            <div class="line">
                <div class="s-1 m-1 l-1 text-center">
                    <i class="icon-facebook text-primary text-size-12"></i>
                </div>
                <div class="s-11 m-11 l-11">
                    <p><a target="_blank" href="https://www.facebook.com/dongychuayeusinhly/" class="text-primary-hover"><b>Facebook</b></a></p>
                </div>
            </div>
        </div>

        <!-- Collumn 3 -->
        <div class="s-12 m-12 l-4">
            <h4 class="text-uppercase text-strong">Đăng kí nhận tư vấn</h4>
            <form class="customform text-white">
                <div class="line">
                    <div class="margin">
                        <div class="s-12 m-12 l-6">
                            <input name="tel" id="phone_footer" class="required email border-radius" placeholder="Số điện thoại" title="Your e-mail" type="text" />
                            <h6  id="c_phone_call_footer" class="text-size-28" style="color: red">Số điện thoại không được bỏ trống</h6>
                            <h6  id="cc_phone_call_footer" class="text-size-28" style="color: red">Số điện thoại không đúng định dạng</h6>
                        </div>
                        <div class="s-12 m-12 l-6">
                            <input name="name" id="name_footer" class="name border-radius" placeholder="Họ và tên" title="Your name" type="text" />
                        </div>
                    </div>
                </div>
                <div class="s-12">
                    <textarea name="message" id="message_footer" class="message border-radius" placeholder="Tình trạng bênh và yêu cầu" rows="3"></textarea>
                </div>
                <div class="s-12">
                    <a id="bt_footer" class="submit-form button background-primary border-radius text-white">Gửi yêu cầu</a>
                </div>
            </form>
        </div>
        </div>
        </div>
    </section>
    <hr class="break margin-top-bottom-0" style="border-color: rgba(0, 38, 51, 0.80);">

    <!-- Bottom Footer -->
    <section class="padding background-dark">
        <div class="line">
            <div class="s-12 l-6">
                <p class="text-size-12">Copyright 2016 @ThuocDongY</p>
                <p class="text-size-12">Liên hệ thiết kế website SDT: 094.3434.093</p>
            </div>
            <div class="s-12 l-6">
                <a class="right text-size-12" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding<br> by TP</a>
            </div>
        </div>
    </section>
</footer>
    <div class="line bottombar">
        <div class="s-12 m-12 l-12">
            <form class="customform text-black">
                <div class="line">
                    <div class="margin">
                        <div class="s-12 m-12 l-4 tp_005">
                            <img style="height: 100px;" src="<?=  Yii::$app->request->baseUrl; ?>/img/tuvan.jpg" alt="">
                        </div>
                        <div class="s-12 m-12 l-6 tp_006">
                            <h4 class="text-uppercase text-strong text_request">Yêu cầu gọi lại miễn phí</h4>
                            <div class="line">
                                <div class="margin">
                                    <div class="s-8 m-8 1-8">
                                        <input name="phone_ddd" id="phone_ddd" class="required email border-radius" placeholder="Số điện thoại" title="Số điện thoại" type="tel" />
                                    </div>
                                    <div class="s-4 m-4 1-3">
                                        <a id="btn_tp" class="submit-form button background-primary border-radius text-white">Gửi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>