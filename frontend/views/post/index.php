<?php
use common\models\Product;
use yii\helpers\Url;
?>
<header class="section background-primary text-center tp_003">
    <h1 class="text-white margin-bottom-0 text-size-28 text-thin text-line-height-1">Tổng hợp các mẹo hay </h1>
</header>
<div class="section background-white">
    <div class="line">
        <div class="s-12 m-12 l-9">
        <?php
         if($post){
             foreach($post as $item){
                 ?>
                 <section class="section">
                 <div class="line">
                     <div class="margin">
                         <!-- Collumn 1 -->
                         <h4 class="text-uppercase text-strong"><?= $item->name ?></h4>
                         <div class="s-12 m-12 l-3 margin-m-bottom-2x">
                             <div class="line">
                                 <div class="margin">
                                         <div class="s-12 m-12 l-12 margin-m-bottom">
                                             <a class="image-hover-zoom" href="<?= Url::to(['post/detail','id'=>$item->id])?>"><img class="tp_001" style="width: 210px" src="<?= $item->getImageLink() ?>" alt="<?= $item->name ?>"></a>
                                         </div>
                                 </div>
                             </div>
                         </div>

                         <!-- Collumn 2 -->
                         <div class="s-12 m-12 l-8 margin-m-bottom-2x">
                             <div class="line">
                                 <p><?= $item->short_des?></p>
                                 <a class="text-more-info text-primary-hover" href="<?= Url::to(['post/detail','id'=>$item->id])?>">Xem chi tiết</a>
                             </div>
                         </div>
                     </div>

                 </div>
                 </section>
                <?php
             }
         }
        ?>
        </div>
        <div class="s-12 m-12 l-3">
            <h4 class="text-uppercase text-strong">Có thể quan tâm</h4>
            <?php
            if($product){
                foreach($product as $item){ /** @var \common\models\Product $item */
                    ?>
                    <div class="line margin-top-30">
                        <div class="margin">
                            <div class="s-4 m-4 l-4 margin-m-bottom">
                                <a class="image-hover-zoom" href="<?= Url::to(['product/detail','id'=>$item->id])?>"><img style="height: 80px" src="<?= $item->getImageLink() ?>" alt=""></a>
                            </div>
                            <div class="s-8 m-8 l-8 margin-m-bottom">
                                <p style="color: black"><a style="color: #00aa00" href="<?= Url::to(['product/detail','id'=>$item->id])?>"><?= $item->name ?></a></p>
                                <p style="color: black">Giá: <?= Product::formatNumber($item->price) ?> VND</p>
                                <p style="color: black"><?= Product::substr($item->short_des?$item->short_des:'Đang cập nhật',55) ?></p>
                                <a class="text-more-info text-primary-hover" href="<?= Url::to(['product/detail','id'=>$item->id])?>">Xem chi tiết</a>
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