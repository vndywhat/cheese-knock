<?php

/* @var $this yii\web\View
 * @var $hits \common\models\Product
 */

$this->title = 'Доставка итальянской пиццы Cheese Knock';

use frontend\components\InstagramWidget;
use frontend\components\SlickWidget;
use yii\helpers\Html;

?>

<?= SlickWidget::widget() ?>
<section class="about" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?= Html::img('/images/aboutLogo.png', ['class' => 'aboutLogo', 'alt' => 'Cheese Knock'])?>
                <?=$this->params['config']['about']?>
            </div>
        </div>
    </div>
</section>
<?php if(count($hits) > 0): ?>
<section class="hits">
    <div class="container">
        <div class="row">
            <h2>Хиты</h2>
            <?php
            $hitsHtml = '';
            foreach ($hits as $hit)
            {
                $hitsHtml .= '<div class="col-sm-3">';
                $hitsHtml .= '<a aria-label="'.$hit->title.'" href="'.\yii\helpers\Url::to(['/product/view', 'slug' => $hit->slug]).'" class="hitsImg">';
                $hitsHtml .= Html::img($hit->getThumb(), ['alt' => $hit->title, 'title' => $hit->title]);
                $hitsHtml .= '</a>';
                $hitsHtml .= '<a aria-label="'.$hit->title.'" href="'.\yii\helpers\Url::to(['/product/view', 'slug' => $hit->slug]).'" class="pizzaName">';
                $hitsHtml .= $hit->title . ' <span>'.$hit->getSizeWeight().'</span>';
                $hitsHtml .= '</a>';
                $hitsHtml .= '<div class="pizzaPrice">'.$hit->price.' Руб</div>';
                $hitsHtml .= Html::a('Заказать', ['/product/view', 'slug' => $hit->slug], ['class' => 'getOrder', 'aria-label' => 'Заказать']);
                $hitsHtml .= '</div>';
            }
            echo $hitsHtml;
            ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php 
/*InstagramWidget::widget([
    '_accessToken' => Yii::$app->params['instToken'],
])*/ ?>