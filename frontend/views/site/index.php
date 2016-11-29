<?php
use common\models\Product;
use yii\helpers\Url;

?>
<!-- Main Carousel -->
<section class="section background-dark">
    <div class="line">
        <div class="carousel-fade-transition owl-carousel carousel-main carousel-nav-white carousel-wide-arrows">
            <?php
            if(isset($banner)) {
                foreach($banner as $item) {
                    ?>
                    <div class="item">
                        <div class="s-12 center">
                            <img style="height:400px" src="<?= $item->getImageLink() ?>" alt="<?= $item->name ?>" height="150px">
                            <div class="carousel-content">
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Section 1 -->
<section class="section background-white">
    <div class="line">
        <div class="margin text-center">
            <?php
            if(isset($product)) {
                foreach($product as $item) {
                    ?>
                    <div class="s-12 m-12 l-4 margin-bottom">
                        <div class="padding-2x block-bordered border-radius">
                            <div class="s-12 m-12 l-6">
                                <a class="image-hover-zoom" href="/"><img style="height:135px" src="<?= $item->getImageLink() ?>" alt="<?= $item->name ?>"></a>
                            </div>
                            <br><br>
                            <h4 class="text-thin"><?= Product::substr($item->name,42) ?></h4>
                            <p class="margin-bottom-30">Giá: <?= Product::formatNumber($item->price) ?> VND</p>
                            <a class="button border-radius background-success text-size-12 text-white text-strong"
                               href="<?= Url::to(['product/detail','id'=>$item->id]) ?>">Xem chi tiết</a>
                            <a class="button border-radius background-primary text-size-12 text-white text-strong"
                               href="javascript:void(0)" onclick="addCart(<?= $item->id ?>)">Mua</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Section 2 -->
<section class="section background-primary text-center">
    <div class="line">
        <div class="s-12 m-10 l-11">
            <p class="s-12 m-10 l-8 text-size-20 right">
                Mọi thắc mắc bạn có thể liê hệ ngay tổng đài tư vấn hỗ trợ<br> hotline: 0943434093
            </p>
            <p class="s-12 m-10 l-4 right">
                <img class="right" style="width: 300px" src="<?=  Yii::$app->request->baseUrl; ?>/img/tuvan.jpg" alt="Tổng đài hỗ trợ">
            </p>
        </div>
    </div>
</section>
<hr class="break margin-top-bottom-0">

<!-- Section 4 -->
<section class="section background-white">
    <div class="line">
        <h4 class="text-thin headline text-center text-s-size-20 margin-bottom-50">Bài viết mẹo hay <span class="text-primary">Chữa bệnh</span></h4>
        <div class="carousel-default owl-carousel carousel-wide-arrows">
            <?php
            if($post) {
//                foreach ($post as $key => $value) {
                foreach ($post as $item) {
//                    echo "<pre>";print($key);die();
                    ?>
                    <div class="item">
                        <div class="margin">
                            <div class="s-12 m-12 l-6">
                                <div class="image-border-radius margin-m-bottom">
                                    <div class="margin">
                                        <div class="s-12 m-12 l-4 margin-m-bottom">
                                            <a class="image-hover-zoom"
                                               href="<?= Url::to(['post/view', 'id' => $item->id]) ?>"><img
                                                    src="<?= $item->getImageLink() ?>" alt="<?= $item->name ?>"></a>
                                        </div>
                                        <div class="s-12 m-12 l-8 margin-m-bottom">
                                            <h3><a class="text-dark text-primary-hover"
                                                   href="<?= Url::to(['post/view', 'id' => $item->id]) ?>"><?= $item->name ?></a>
                                            </h3>
                                            <p><?= $item->short_des ?></p>
                                            <a class="text-more-info text-primary-hover"
                                               href="<?= Url::to(['post/view', 'id' => $item->id]) ?>">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="s-12 m-12 l-6">
                                <div class="image-border-radius margin-m-bottom">
                                    <div class="margin">
                                        <div class="s-12 m-12 l-4 margin-m-bottom">
                                            <a class="image-hover-zoom"
                                               href="<?= Url::to(['post/view', 'id' => $item->id]) ?>"><img
                                                    src="<?= $item->getImageLink() ?>" alt="<?= $item->name ?>"></a>
                                        </div>
                                        <div class="s-12 m-12 l-8 margin-m-bottom">
                                            <h3><a class="text-dark text-primary-hover"
                                                   href="<?= Url::to(['post/view', 'id' => $item->id]) ?>"><?= $item->name ?></a>
                                            </h3>
                                            <p><?= $item->short_des ?></p>
                                            <a class="text-more-info text-primary-hover"
                                               href="<?= Url::to(['post/view', 'id' => $item->id]) ?>">Xem chi
                                                tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>