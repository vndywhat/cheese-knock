<?= \frontend\components\MenusWidget::widget([
    'items' => [
        ['label' => 'Главная', 'url' => ['/site/index'], 'options' => [
            'id' => 'menu-item-93',
            'class' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-93'
        ]],
        ['label' => 'Меню доставки', 'url' => ['/site/shop'],
            'options' => [
                'id' => 'menu-item-95',
                'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-95',
            ],
            'items' => [
                [
                    'label' => 'Пицца', 'url' => ['/catalog/pizza'],
                    'options' => [
                        'id' => 'menu-item-97',
                        'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-97',
                    ],
                ],
                [
                    'label' => 'Пасты', 'url' => ['/site/test'],
                    'options' => [
                        'id' => 'menu-item-1840',
                        'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1840',
                    ],
                ],
                [
                    'label' => 'Салаты', 'url' => ['/category/salad'],
                    'options' => [
                        'id' => 'menu-item-1841',
                        'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1841',
                    ],
                ],
                [
                    'label' => 'Комбо', 'url' => ['/category/combo'],
                    'options' => [
                        'id' => 'menu-item-2614',
                        'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2614',
                    ],
                ],
                [
                    'label' => 'Напитки', 'url' => ['/category/drink'],
                    'options' => [
                        'id' => 'menu-item-98',
                        'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-98',
                    ],
                ],
        ]],
        ['label' => 'Условия доставки', 'url' => ['/payment'], 'options' => [
            'id' => 'menu-item-96',
            'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-96'
        ]],
        ['label' => 'Контакты', 'url' => ['/contacts'], 'options' => [
            'id' => 'menu-item-94',
            'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-94'
        ]],
    ],
    'options' => [
        'class' => 'nav navbar-nav',
        'id' => 'menu-mainmenu',
    ]
]);?>