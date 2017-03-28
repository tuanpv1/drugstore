<?php
use common\models\Product;
use yii\helpers\Url;

?>
<article>
    <header class="section background-primary text-center tp_003">
        <h4 class="text-white margin-bottom-0 text-size-28 text-thin text-line-height-1">Xem chi tiết </h4>
    </header>
    <?php
    if(isset($product)) {
        ?>
            <div class="section background-white">
                <div class="margin">
                    <div class="line">
                        <div class="s-12 m-6 l-6 margin-bottom-30   ">
                            <img style="width: 450px" class="tp_001" src="<?= $product->getImageLink() ?>" alt="<?= $product->name ?>">
                        </div>
                        <div class="s-12 m-6 l-6">
                            <h4 class="text-thin"><?= $product->name ?></h4>
                            <p class="margin-bottom-30">Giá: <?= Product::formatNumber($product->price) ?> VND</p>
                            <a class="button border-radius background-primary text-size-12 text-white text-strong"
                               href="javascript:void(0)" onclick="addCart(<?= $product->id ?>)">Mua
                            </a>
                        </div>
                    </div>
                    <div class="tp_002">
                        <b><i>Mô tả</i></b>:<br>
                        <?= $product->des?$product->des:"Đang cập nhật thông tin"?>
                    </div>
                </div>
            </div>
        <?php
        }
    ?>
</article>