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
            <h5 class="text-thin headline text-center margin-bottom-50">Danh sách <span class="text-primary">Thuốc</span></h5>
            <?php
            if(isset($product)) {
                foreach($product as $item) {
                    ?>
                    <div class="s-12 m-12 l-4 margin-bottom">
                        <div class="padding-2x block-bordered border-radius">
                            <div class="s-12 m-12 l-6 text-center">
                                <a class="image-hover-zoom" href="<?= Url::to(['product/detail','id'=>$item->id]) ?>"><img style="height:135px" src="<?= $item->getImageLink() ?>" alt="<?= $item->name ?>"></a>
                            </div>
                            <a style="margin-top: 25px;color: #00aa00" href="<?= Url::to(['product/detail','id'=>$item->id]) ?>"><?= Product::substr($item->name,42) ?></a>
                            <p class="margin-bottom-30">Giá: <?= Product::formatNumber($item->price) ?> VND</p>
                            <div>
                                <a class="button border-radius background-success text-size-12 text-white text-strong"
                                   href="<?= Url::to(['product/detail','id'=>$item->id]) ?>">Xem </a>
                                <a class="button border-radius background-primary text-size-12 text-white text-strong"
                                   href="javascript:void(0)" onclick="addCart(<?= $item->id ?>)">Mua</a>
                            </div>
                            <div class="1-12 text-center"><br>
                                <p><?= $item->short_des?$item->short_des:'Đang cập nhật' ?></p>
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

<!-- Section 2 -->
<section class="section text-center">
    <img class="right" style="width: 100%" src="<?=  Yii::$app->request->baseUrl; ?>/img/banner_ng.png" alt="Tổng đài hỗ trợ">
</section>
<hr class="break margin-top-bottom-0">

<!-- Section 4 -->
<section class="section background-white">
    <div class="line">
        <h5 class="text-thin headline text-center margin-bottom-50">Bài viết mẹo hay <span class="text-primary">Chữa bệnh</span></h5>
        <div class="carousel-default owl-carousel carousel-wide-arrows">
            <div class="item">
                <div class="margin">
                <?php $index = 1; foreach ($post as $value) { ?>
                    <div class="s-12 m-12 l-6">
                        <div class="image-border-radius margin-m-bottom">
                            <div class="margin">
                                <div class="s-12 m-12 l-4 margin-m-bottom">
                                    <a class="image-hover-zoom"
                                       href="<?= Url::to(['post/detail', 'id' => $value->id]) ?>"><img
                                            src="<?= $value->getImageLink() ?>" alt="<?= $value->name ?>"></a>
                                </div>
                                <div class="s-12 m-12 l-8 margin-m-bottom">
                                    <h3><a class="text-dark text-primary-hover"
                                           href="<?= Url::to(['post/detail', 'id' => $value->id]) ?>"><?= $value->name ?></a>
                                    </h3>
                                    <p><?= $value->short_des ?></p>
                                    <a class="text-more-info text-primary-hover"
                                       href="<?= Url::to(['post/detail', 'id' => $value->id]) ?>">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                if ($index % 2 == 0 && $index <= count($post) && $index !=0 ) {?>
                </div>
            </div>
            <div class="item">
                <div class="margin">
            <?php
            }
            $index++;
            }
            ?>
        </div>
    </div>
</section>