<?php
use common\models\Product;
use yii\helpers\Url;

?>
<article>
    <header class="section background-primary text-center tp_003">
        <h1 class="text-white margin-bottom-0 text-size-28 text-thin text-line-height-1">Danh sách các phương thuốc </h1>
    </header>
    <div class="section background-white">
        <div class="line">
            <div class="margin text-center">
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
                                        <p><?= $item->short_des?$item->short_des:'Đang cập nhật'?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</article>