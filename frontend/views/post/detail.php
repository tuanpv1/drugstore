<?php
use yii\helpers\Url;
?>
<article>
    <header class="section background-primary text-center tp_003">
        <h1 class="text-white margin-bottom-0 text-size-28 text-thin text-line-height-1">Xem chi tiết tin tức </h1>
    </header>
    <section class="section background-white">
    <?php
    if($post){
        ?>
        <div class="line">
            <div class="s-12 m-12 l-8">
                <div class="line">
                    <!-- Collumn 1 -->
                    <h4 class="text-uppercase text-strong"><?= $post->name ?></h4>
                    <div class="s-12 m-12 l-3 margin-m-bottom-2x">
                        <div class="line">
                            <div class="margin">
                                <div class="s-12 m-12 l-12 margin-m-bottom-30">
                                    <a class="image-hover-zoom" href="/"><img class="tp_001" style="width: 210px" src="<?= $post->getImageLink() ?>" alt="<?= $post->name ?>"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Collumn 2 -->
                    <div class="s-12 m-12 l-8 margin-m-bottom-30">
                        <div class="line">
                            <p ><?= $post->short_des?></p>
                        </div>
                    </div>
                    <div class="s-12 m-12 1-12 margin-top-30 margin-bottom-30">
                        <?= $post->des ?>
                    </div>
                </div>
            </div>
            <div class="s-12 m-12 l-4">
                <h4 class="text-uppercase text-strong">Bài viết bạn có thể quan tâm</h4>
                <?php
                if($involve){
                    foreach($involve as $item){
                        ?>
                            <div class="line margin-top-30">
                                <div class="margin">
                                    <div class="s-4 m-4 l-4 margin-m-bottom">
                                        <a class="image-hover-zoom" href="<?= Url::to(['post/detail','id'=>$item->id])?>"><img style="height: 80px" src="<?= $item->getImageLink() ?>" alt=""></a>
                                    </div>
                                    <div class="s-8 m-8 l-8 margin-m-bottom">
                                        <p style="color: black"><a href="<?= Url::to(['post/detail','id'=>$item->id])?>"><?= $item->name ?></a></p>
                                        <a class="text-more-info text-primary-hover" href="<?= Url::to(['post/detail','id'=>$item->id])?>">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    </section>
</article>
