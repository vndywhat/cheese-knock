<?php
/**
 * @var $slides \common\models\Slider
 * @var $slide \common\models\Slider
 */

use frontend\assets\SlickAsset;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

SlickAsset::register($this);

$slickJs = <<<JS
$('.introSlider').slick({
    infinite: true,
    speed: 600,
    arrows: true,
    dots: true,
    pauseOnFocus: false,
    pauseOnHover: false,
    autoplay: true,
    autoplaySpeed: 5000
});
JS;

$this->registerJs($slickJs);
?>
<?php if(count($slides) > 0): ?>
<section class="intro">
    <div class="introSlider text-center">
        <?php foreach ($slides as $slide): ?>
        <div class="introSliderSingle" style="background: url('<?=$slide->getImage()?>') 50% 50% / cover no-repeat;">
            <div class="introSliderSingle__inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 introSliderSingle__MainCol">
                            <div class="introSliderSingle__info">
                                <h2 class="introSliderSingle__title">
                                    <?= Html::decode($slide->title) ?>
                                    <?= Html::img('/images/intro/cheese.svg', [
                                        'class' => 'img-responsive introSliderSingle__titleIco',
                                        'alt' => 'Cheese',
                                    ])?>
                                </h2>
                                <?php if($slide->subtitle): ?>
                                <h3 class="introSliderSingle__subTitle">
                                    <?=$slide->subtitle?>
                                </h3>
                                <?php endif; ?>
                                <?php if($slide->price): ?>
                                <div class="introSliderSingle__Price">
                                    <div class="introSliderSingle__PriceInner">
                                        за <span class="introSliderSingle__PriceVal"><?=$slide->price?></span>
                                        <span class="introSliderSingle__PriceSymb">р</span>
                                        <?= Html::img('/images/intro/underscore.png', [
                                            'class' => 'img-responsive',
                                            'alt' => 'underscore',
                                        ]) ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($slide->excerpt): ?>
                                <div class="introSliderSingle__Excerpt">
                                    <?= Html::decode($slide->excerpt)?>
                                </div>
                                <?php else: ?>
                                <ul class="introSliderSingle__descMenu">
                                    <li class="introSliderSingle__descMenuItem">
                                        <span class="introSliderSingle__descMenuItemIco">*</span>
                                        Распространяется на
                                        доставку и самовывоз
                                    </li>
                                    <li class="introSliderSingle__descMenuItem">
                                        <span class="introSliderSingle__descMenuItemIco">**</span>
                                        Данное предложение
                                        не суммируется с другими скидками и акциями
                                    </li>
                                </ul>
                                <?php endif; ?>
                                <?php
                                $link = ($slide->link) ? $slide->link : ['/category/view', 'slug' => 'pizza'];
                                echo Html::a('Перейти в меню доставки', $link, [
                                    'class' => 'btnCust delivMenuBtn',
                                    'tabindex' => '-1',
                                ]) ?>
                            </div><!-- /introSliderSingle__info-->
                        </div><!-- /col-->
                    </div><!-- /row-->
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>