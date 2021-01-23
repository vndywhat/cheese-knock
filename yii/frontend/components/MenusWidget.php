<?php

namespace frontend\components;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

class MenusWidget extends Menu
{
    public $submenuTemplate = "\n<ul class=\"sub-menu\">\n{items}\n</ul>\n";

    public $linkActiveTemplate = '<a href="{url}" aria-current="page">{label}</a>';

    /**
     * @var string the CSS class to be appended to the active menu item.
     */
    public $activeCssClass = 'active';

    public function init()
    {
        parent::init();
    }

    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     */
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            if($this->isItemActive($item)) {
                $template = ArrayHelper::getValue($item, 'template', $this->linkActiveTemplate);
            } else {
                $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            }

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }
}