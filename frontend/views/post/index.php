<?php
use yii\helpers\Url;
?>
<header class="section background-primary text-center tp_003">
    <h1 class="text-white margin-bottom-0 text-size-28 text-thin text-line-height-1">Tổng hợp các mẹo hay </h1>
</header>
<?php
 if($post){
     foreach($post as $item){
         ?>
         <section class="section tp_100">
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
