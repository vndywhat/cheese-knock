<?php


namespace frontend\components;

use common\models\Slider;
use yii\base\Widget;

class SlickWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {

        $slides = $this->findSlides();

        return $this->render('slick', [
            'slides' => $slides,
        ]);
    }

    public function findSlides()
    {
        return Slider::find()->where("image != ''")->orderBy(['id' => SORT_DESC])->all();
    }
}