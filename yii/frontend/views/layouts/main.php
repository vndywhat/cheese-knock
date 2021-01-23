<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\components\MenusWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>

    <meta name="author" content="">

    <link rel="icon" href="/favicon.png" sizes="32x32">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title><?= Html::encode($this->title) ?> — <?=$this->params['addTitle']?></title>
    <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?161",t.onload=function(){VK.Retargeting.Init("VK-RTRG-378317-6Z19P"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script>
    <noscript><img src="https://vk.com/rtrg?p=VK-RTRG-378317-6Z19P" style="position:fixed; left:-999px;" alt=""/></noscript>
    <?php $this->head() ?>
</head>

<body <?php if(isset($this->params['class'])): ?>class="homepage"<?php endif; ?>>
<?php $this->beginBody() ?>
<header>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button id="responsive-menu-button" class="responsive-menu-button responsive-menu-boring responsive-menu-accessible navbar-toggler" type="button" data-target="#navbarNav" data-toggle="collapse">
                    <span class="responsive-menu-box">
                        <span class="responsive-menu-inner"></span>
                    </span>
                </button>
                <div id="responsive-menu-container" class="slide-left">
                    <div id="responsive-menu-wrapper"></div>
                </div>
                <a class="navbar-brand logo" href="/">
                    <?=Html::img('/images/logo.png', ['alt' => 'Cheese Knock'])?>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="" id="navbarNav">
                <div class="menu-mainmenu-container">
                    <?= MenusWidget::widget([
                        'items' => [
                            ['label' => 'Главная', 'url' => ['/site/index'], 'options' => [
                                'id' => 'menu-item-93',
                                'class' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-93 nav-item'
                            ]],
                            ['label' => 'Меню доставки', 'url' => ['/site/shop'],
                                'options' => [
                                    'id' => 'menu-item-95',
                                    'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-95 nav-item',
                                ],
                                'items' => [
                                    [
                                        'label' => 'Пицца', 'url' => ['/category/view', 'slug' => 'pizza'],
                                        'options' => [
                                            'id' => 'menu-item-97',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-97 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Пасты', 'url' => ['/category/view', 'slug' => 'pasta'],
                                        'options' => [
                                            'id' => 'menu-item-1840',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1840 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Салаты', 'url' => ['/category/view', 'slug' => 'salad'],
                                        'options' => [
                                            'id' => 'menu-item-1841',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1841 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Комбо', 'url' => ['/category/view', 'slug' => 'combo'],
                                        'options' => [
                                            'id' => 'menu-item-2614',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2614 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Напитки', 'url' => ['/category/view', 'slug' => 'drink'],
                                        'options' => [
                                            'id' => 'menu-item-98',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-98 nav-item',
                                        ],
                                    ],
                                ]],
                            ['label' => 'Условия доставки', 'url' => ['/site/payment'], 'options' => [
                                'id' => 'menu-item-96',
                                'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-96 nav-item'
                            ]],
                            ['label' => 'Контакты', 'url' => ['/site/contacts'], 'options' => [
                                'id' => 'menu-item-94',
                                'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-94 nav-item'
                            ]],
                        ],
                        'options' => [
                            'class' => 'nav navbar-nav',
                            'id' => 'menu-mainmenu',
                        ]
                    ]);?>
                </div>
                <div class="cartTop">
                    <a id="cartClear" href="#" class="btn btn-default pull-right" style="
                        margin: 32px 0 15px 3px;
                        padding: 2px 5px;
                    "><img width="10" height="10" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEBUTExIVFhUXFRUXFRcXFQ8VFRUaFRUWFhUYFxUYHSggGBolHRYVITEhJSkrLjAuFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAcAAADAAMBAQEAAAAAAAAAAAAAAQgFBgcCBAP/xABREAABAgMEBAgHCgwGAgMAAAABAAIDBDEFESFxBxJBYQYIE1FUkpOxc4GRobLS8RcjJCVCUlOzwcIUFiIyNENicoKiw9EVMzVjg6Nk4USE8P/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwDt6L+ZB5ktw9iBk7AgnZtSpgEUzQMm7NBNyVM0UxNf/wBRA77qov2lLefYjeUDB2lc64d6XJWQeYMJv4RHF4c1rg2HDIwufEx/K/ZANLiQnpp4ZPkJNrIJujzBc1h2sY0e+RB+1i1o/ev2KZCfKg6VOab7Vcb28hDHM2ET5S9xX4HTRa/0sLsYa52hB0T3aLX+lhdjDR7tFr/SwuxhrnaEHRPdotf6WF2MNA00Wv8ASwuxhrnaEHRBpotf6WF2MNfpL6bbWaby6A8czoQA/lIPnXN0IKL4Faa5eZeIU4wS0Q4CJrXwHHCpOMO/feMKrqoO1Q+qB0B8MnTEN0hHdrPgMDoLicXQwdVzD+4S27c79lB18FAN+SVcu9Fcu9Awb8kX8yVcAjcPYgZOwIJ2BKmARTNAyfKnevNM0wLq1QNNJNB5J2BKmATJ5qpUzQFM0UzRTNFMTVAUxNUbz7Ebz7EbygN5RXJFckVy70E48YebLrVYz5LJaHqjZ+U97ie7yLly6VxgT8cf/Xhd71zVBV2jvgdKykjB1YLHRHw2PjRXNa57nPaHEAmjRfcBTxkraTIQaCFD6jMPMvw4Pn4JLgfQQvF721ffTAIPnMhBoIUPqM/sgyEEfqod/wC4z+y+imaKZoPn/wAPgj9VDv8A3Gf2R/h8EVhQ+oz+y+imJqjeUHz/AOHwamFD6jP7LGW/wSk52A6FGgQ7iDquDWtfDOxzXAXgj/0b1m95QMcUESzUHk4j2X3lrnNJ59UkfYtw0NzBZbcrcfznPY4c4dCfgfHcfEtWtk/CY3hYnplbFomHx1J+EPoPQVjXLvRXAIrgEbh7EBuHsRTAIpgEUzQFM0UzRTeUUxNUBTE1TA2lLeUwNpQNNK9NB5JuzUz6QeGtowbUm4UKdjMYyM4NaHkBowwA5lTBNyljSTYU2+1ptzJWO5roziHNgxnNNKEC4oMZ7oVq9PmOuUe6FavT5jrlY08G53ocz2Ef1V887ZMxBAMWBFhgm4F8OIwE1uBcBigzR0hWr0+Y65TOkK1enzHXK1hfdJ2NMxW68KXjRG3kazIUV7bxUXtF16DMnSFavT5jrlB0hWr0+Y65WNHBud6HM9hH9VIcG53ocz2Ef1UH4Wta0eaicrMRXRX3Bus83m4UF/NiV8Syg4NzvQ5nsI/qo/Fud6HM9hH9VBkIPD21GtDWz0cNaAAA83AAXABexpBtXp8x1ysZ+Lc70OZ7CP6qDwbnehzPYR/VQZMaQbV6fMdcpe6FavT5jrlY08G53ocz2Ef1UHg3O9Dmewj+qgyXug2r0+Y65QdIVq9PmOuVjjwbnehzPYR/VR+Lc70OZ7CP6qDJHSFavT5jrlB0hWr0+Y65WNHBud6HM9hH9VIcG53ocz2Ef1UGNiRC4lzje4kkk7ScSSv2kJ2JAiNiwnuZEab2uabnNN114PjK+wcG53ocz2Ef1UDg3O9Dmewj+qgyY0g2r0+Y65QNINq9PmOuVjPxbnehzPYR/VR+Lc70OZ7CP6qDJjSDavT5jrlIaQbV6fMdcrEzFhTbGlz5WOxoxLnQYrWgc5JFwWPQbN7oNq9PmOuUe6FavT5jrlYGTkYsYlsGE+IQLyGMe8gX3XkNBwxC+08G53ocz2Ef1UGbsvh9ajpiE109HIMRgI1ziC4AqsLlH9kcHZxsxBJlJgARYZJMCMAAHi/5KsCuXeg9XoQhB5OGKN5QecpbygY5yuY8YSUMSyWvH6uYhu33ObEh972+RdNrktP0uyvLWLNj5rGvH/HEY/uaUEoKh+LjMa1nx4d/5kyXVxufCh4bhew+dTwu1cWqY98nYd/5zID+qYjTd1wg7sTfgEE7B7Etw9iKYBAydgRTNKmaKZoHTeUUxKVMTVG8oHvKBzlLeUVxNEAMcdiK5d6K5d6K5d6ArkmTfgEq4BG4exAydg9iCdgSpgEUzQOmG1FN5SpmimJqg0PThMaliRxfjEdBZW79axxA8TT51LiobjHTF1ny8O/F8yHXbmQog73hTyg7VxapYcrOxfmsgsv/AH3RHH0Au7DHFcm4uMpdZ8eIflTJGYZDZ5r3ldYrl3oCuXenffklXLvTv5kHpCVyaDyRtKVckyEq5d6Arl3rGcKJXl5GZhD5cCM3MuhuAuWTrkhwvw2UP9kEQLp/F6mS21XMv/zJaIPG10Nw8wK5zaUpyMeLCP6uI9nUcW/Ytq0PTRh23KG/85z2HfrwntHnIQVZTAIpmimaKZoMBw14WwbLl2x47Ij2uiCGBDDC7WLXvF+s4XC5h8y0CJp8kx+bKTBP7Rgt7iVldP8ALa1jlxqyYhO8oez75U0oK40e8MW2rLPmBCMIMjOhapeHk3Mhv1rwBdfr3Xbls+8rkfFviD8BmW30mAetDaL/AOVdcriaICuJoud8I9MMjJzUWWiwZlzoTtVxY2AWk3A4ExAbseZdErl3qTtLJ+Opzwo9BqDscnpvs+LFZCbAmwXvawXsl7r3ENF90WmK6ceYKMeDY+Gy3h4P1jVZ5OwIFuHsWI4W8IIdnycSae1z2w9S9rdXWOu9rBdfhV1/iWXpgFz7TvEDbFij50WCM/yw77qDFwtPNnXYy82P4Jc/1Qtw4F8N5S0xFMtyl8LU1w9gaffNfVuuJB/McpFXfOLZBAlpuJtdFht6jCR6ZQdjpiao3lG8o3lBwrjKTRMSSh30bGeR+8WNB/lcuKrp/GFm9e1mt2Mlobbt7nRHnzOHkXMEFR6D5TUsSASLtd0V533xXAHyNC3yuXete0eyvJ2VJMuu+DQXHN7A8+dxWw1wCArgE79gS3D2J0wCB3JpJoPJF+SVckzjkluCA3BG4exG4exFMAgkXSVJ8la86z/yIj+1PKAfzr4OCUzydoSkS+4MmYDjzXNitJW2ad5Lk7aiO+khwYmf5HJ/01z5riDeNmIQW9TNFMTVfjIRw+EyJXXY1w/iaCLvKv23lBomm+FfYcyTUGARu9/hjuJUtqtNKsHXsacv+ivA/dc132KS0HcuLREwnmGgMu4eMRge4Lttcu9cG4tb/f5xnPDhO6rnD7y7zXLvQFcu9SdpZ/1qc8KPQaqxrgFJ2lkfHU54Ueg1BguDY+Gy3h4P1jVZ5OwKMODf6bLeHg/WNVnnClUCpmuWcYqJq2XCbfi6bh37wIUY99y6nTNch4yMS6SlW7XR3O6sMj7yCflRPFyhgWZHdzzTh4hCg/3KnZUzoCghtjNPPGjHzhv3UHRt5RXE0RXE0RXLvQSlphmuUtubI2PYzLk4TGHztK09jCSABeSbgM6LKcLZrlbQm4l9+vMx3DIxHEeZe+BkpytoykO6/WmYIOXKNLj5L0FgysHUhshijGtb1QBh5F+u4exMnYEtwQG4JjDDalTAVTGGaD0hJNB5PMluHsTJ2BKmAQFMAimaKZopmgn7jISWrOy0X58BzSfBxCf6gXIV3rjJyV8vJxtrYsWH2jWu/pedcFQV9o8meUsmTeTefweE0nexoYfO1bDvK0LQbMa9iQATfyb4zMvfXPHmeFvtcTRBgeH0IvsqdF3/AMWPcN4huI7lHytC34XKSkw350CK3O+G4KL0HV+LnFutKMz50q49WLD/ALqiDjgFNXF/iXWxd86Xit87HfdVK7h7EBuHsUm6WR8dTnhR6DVWVMApN0sj46nPCj0GoMHwb/TZbw8H6xqs+majDg5+my3h4P1jVZ9MUCpiariXGWim6RZzmYd5OSH2rtu8rgvGTikzEm3mhRTd+89o+6g40qm0JQS2w5a/aYzvLHiXFSyq10WQNWxpIGnIh3Wc532oNqrl3r8J+Y1IUR+xjHOP8LSfsX71y71rukWa5OyZ1wN3waK2+mL2lgu33uQSI9xJJOJJvPjW56GpQxLbleZpiPP8EJ5HnuWlLqPF3li61Yj7vzJaIb+YuiQ2jzF3kQUduCKYCqKYCqKZoCmaYF1apUxNUwNpQNNJNB5J2BKmaZN2aVM0BTNFMTVFMTVG8oOb6fpPlLHLzWHHhPyv1of9RTQq00qynK2NOAikLXA5uTcIl+f5KktBQvFwjgyExDv/ADJnWu/fhMH3CutVy71wri1zHvs5CJqyC+791z2n0gu61y70HiMzXa5uwgjyi5RHcrgv5lFltQOTmYzPmxojeq8j7EG26EYxbbksB8oRmnsIjvuhVLTAKTdE0XVtqTP+6W9Zjm/aqypmgKZqTdLI+Opzwo9BqrKmak3Sz/rU54Ueg1Bg+Dh+Gy3h4P1jVZ+8qMODh+Gy3h4P1jVZ920oFvKnXjGRybTgt2CVYR/FFi39wVFVxNFNGn+NrWwR82BCHl1nfeQc3Vg8AYd1lSI/8SXJ8cJp+1R8rRsKDqSsCGKNgwm9VjQg+6uAWg6dJkMsSM3574LP+1r7vIwrftw9i5NxjpnVs+XhX/nTGsd4ZDf9rwgnldu4tUsb52LdsgMb/wBjnfd8q4iqL4ustqWZFiXYxJl128MhwwPPrIOqUzRTE1RTE1RvKA3lMDaUt59iYxxQO9NK9NB5JuSpiapnDFLefYgN59iN5RvKK4miD4Lfk+XlJiEaRIMVnXY5v2qL1b9cu9RbbcoIEzGhD9XGiQx/A8t+xB0Hi9zGrazmX/5kvEbdzkOY/uaVSNcApR0QzHJ21KEm6972dpCewedwVXbh7ED3BRzw1hatpzrdgm5gDxRn3KxaYBSVpTg6tszo/wB4u64DvtQfFwEiFtqSTr7rpuX8hisB816sKmajHg7G1JyXfsbHgu8kRpVn0xQKmJqpN0s/61OeFHoNVZbypN0sn46nPCj0GoMHwcPw2W8PB+sarPuvqox4N/pst4eD9Y1WbXLvQFcu9Sxpqi61uTWN93IgbrpeFf571U9cu9SZpWjB1szh5our1Gtb9iDVAPKVbkNtwDRQADK5RjYMLXm4DT8qNCb5XtCtEnYEC3BcK4ykx77Jwr6MjPO/WcxoP8pXdaYCqm3jBzGva4bf/ly0Jp3EuiP7nhBzJVPoVluTsSWvGL+Vf1or7vMApYVicBpXkrMk2OFxbLQbxzEw2lw8pKDN7yjefYjefYiuJQFcSmMcu9KuXenffl3oPSEIQeTzlLeUyNpSriaICuJoiuXeiuXeiuXegK5KStKcoIVszjQKxi+7wjRE+8q1rgFM+nyVDLZc76SDCf5AYf3EGm8FZjkp+ViE3akzAd1YjSe5WVTAKIWuIN4NxGI8Stez5gPgw3j5bGO6zQftQfvTNSvppgltuTW/kneWBDv896qimamfT7CItlx+dBgu8xb91BzqE+5wI2EHyFW5DdeA47QD5VEKtSx4uvLwXn5UKG7ysBQfXvKk3Syfjqc8KPQaqyriaKTdLJ+Opzwo9BqDB8G/02W8PB+sarOOOXeox4Nj4bLeHg/WNVnHHAICuAUecOYutak67nmpjzRXAKxL9gUXW/F15uYf86PFPliOKD7eA0IvtSSA2zUDyCK0nzBWHSlVJeiqEXWzJj/ev6rXO+xVpTNAUzUoaXpjlLbnDffc9rOzhMYfO0qsBhWqjThZNcrPzUT58xGd4jEdd5rkGOl4Je9rG1c4NGbjcO9WxAhBrWigaAAOYAXKQeAcrytqSbOeZgk5NeHHzAqwa4lAVxKK5d6K5d6K5d6Arl3p38yVcBRO/YEHq5CVyaDyQlXLvTIvySrl3oCuXeiuARXAI3D2IDcPYuB8ZKTDZqUi7XQXsP8AxvDh9aV3ymAXH+MjJgykrF2tjvZft98h6x+qHkQcAVeaOJoRLIknVP4PDbz3mG3UPnaVIaqDQVMh1iQRthvjM8sV0S7+cIN/piaqc+MVBItSE750qzzRYqozeVwPjJQfhUo/50GI3qvB++g44rF4ERS+zJN52ysA/wDU1R0q30YP17HkjsEBo6t7fsQbRXLvUnaWT8dTnhR6DVWNcu9SdpZ/1qc8KPQagwXBsfDZbw8H6xqs8nYFGHBsfDZbw8H6xqs8nYEHiK65pu2AnLBRLFeXOLjtJJ8ZvVoW1F1JWM7mgxXeRhN6ixBvGhWGXW5K/s8s7yQIn91U9MTVTPoCha1sNPzIEZw8Ya37ypjeUH4WhMCFBiRXfIhvduAa0u+xRQTfmaqutJExydkTrjtlorB/yNMMekpEQb1oTlde25bDBgivduuhPA/mLVUtcu9Tvxc5PWtKNE2MlnD+J8SHd5mvVEVy70BXLvRXAURXAURuCA3BPcEtwTpggaaSaDyRfklXAJnmS3D2IDcPYimARTAIpmgKZrnmnmUDrFiO2siwX+V/J/fXQ6ZrWNJ0pyljzrT9A9/Z++fdQSOqE4uEyDITDL/zJjWyD4bBh42FT2u0cWuZAjTkMmrILx/C57Sbv4wg7vvK4dxl2YyLucTI8nIEd5Xca4mi1jhzwIgWs2E2M+IwQnOLTDLATrAA3lzThgEEjqp9CkQusOVvNOWB8UeLcPJcsTLaDLMFXzL95iQx6LAt64N2DBkZdstLhwhtLiNZxcb3HWOOZQZSuAUnaWR8dTnhR6DVWO4excz4TaG5adm4sy6ZjNdFdrFrWwy1uAG3HYgn3g3+my3h4P1jVZ5wpVcmktBkrCiw4gm4xcx7XgFsK4ljg4X4UwXWaZlBguHcTUsqdN+P4JMY7zCcB5yo8Vo25ZbJqWiy8QuDYrCxxaQHAOwOreCPMuaRdAshdhMzQzMB3cwINM4ujPjSKdjZSJ5TFgj+6ozefYtH0f6NoNlRokVkd8TlGBlz2tGqA7WqMgt4riUGgadJnVsWMKco+Cwdo15v8TCpfVCcY+aukJeH86Y1swyG4d7wp7Qdz4tUn+TOxTQmCwc/5IiOOP8AE3yLtlcBRcv4vMoW2U9/0kzEPiayGzvDl1DcEBuCNwRuCKYCqApgKpjDNKmaYwzQNNJNB5J2BKmATJ2BKmaApmimaKZopiaoCmJqvkteTEaXjQ3C8RIURhGy57C0jzr695QOcoIgXTOL7MhlrlpP+ZLxW5kOZE7mFaNwnleRnZmFddqR4rbrrsBEcBhlcspo0tWHKWtKxortVjXlr3GjREY6GSdw17zuQVxXLvRXLvSY8PALSC0i8EG8EGlx5l6PMECrgEbh7EzzBFMAgW4IpgKp0pVFN5QKmaKYmqdMdqANpQLeUbz7EwNpQBfiUCriUVy70Vy70HHLvQcI4yk2DGk4Y+TDjP67mNB/6yuLroWnK2YUzax5Jwe2DCZB1hcWlzXPe4AitxfdmCueoKr0OSph2JKtNXNiPJ3RIr3N/lLVum4LE8EpMwLPlYPymS8FrtmIhtDjdnestTAVQFMBVFM0UzRTNAUzTA2lKmJTA2lA00IQeSfKlTNeikBdjtQKmJqjeUwNpQBtKBbyiuJondfVF1+XegnnT5wTdBmvw+G0mFHuEQj5EVoux5g5oBG8O5wuSq2LRkYcxCfBisD4Txqva4Xhw+zPcuFcMNBsdj3RLPeIsPEiFEcGxG8zWvP5LxXElppWqDlUtbMzDaGsmIzGijWxYrWjxA3L9RwhnOlzHbRvWWXi6N7WabjIRidwa4eVpIXn3PLV6BH6iDFDhDOdLmO2jesgcIZzpcx20b1llfc8tboEfqIOjy1ugR+ogxX4wznS5jto3rI/GGc6XMdtG9ZZU6PLW6BH6iDo8tXoEfqIMV+MU50uY7aN6yDwinOlzHbRvWWV9zy1egR+oj3PLV6BH6iDFHhFOdLmO2jesg8Ipzpcx20b1llRo8tXoEfqIGjy1egR+ogxX4xTnS5jto3rLzFt2bc0tdNR3Ai4tMaKQRvBKy40eWr0CP1EN0dWsT+gR+qB5yUGrrcNFvBN1o2gxpb7zCLYkd2zVBvDM3EXXc2sdi2Dg1oSn47wZotlod+N7mxIpH7LWEtHjPiK71wZ4OS9ny4gSzNVoxJOLnuNXvdtP/oC4BBlaYCqKZp3XZoAuzQKmaKYlMDaUAbSgW8+xMY4lF1+JRXJA700IQJCaECQU0IAoQhAJBNCBBCaEAkmhAkJoQIoKaEAhCEAEgmhAkJoQJCaECTQhAimhCBIQhB//9k=" alt=""></a>
                    <span class="counterPrice"><?= $this->params['cart-test']->getTotalCost()?> Р</span>
                    <a href="/cart" class="cartIco">
                        <div id="count-cart-products"><?= $this->params['cart-test']->getTotalCount()?></div>
                    </a>
                </div>
                <div class="phoneTop">
                    <?=$this->params['config']['phone']?>
                    <a href="#" data-target="#getCall" data-toggle="modal" onclick="yaCounter47037111.reachGoal('openform'); return true;">заказать звонок</a>
                </div>
                <div class="timeTop">
                    Прием заказов
                    <?=$this->params['config']['orders']?><br>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>

<div id="wrapper">
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<footer>
    <div class="container">
        <div class="col-sm-2">
            <a href="/" class="logo">
                <?=Html::img('/images/logo.png', ['alt' => 'Cheese Knock'])?>
            </a>
        </div>
        <div class="col-sm-5 col-sm-offset-1">
            <ul class="footMenu">
                <li><a href="/">Главная</a></li>
                <li><a href="/#about">О нас</a></li>
                <li><a href="/category/pizza">Заказать онлайн</a></li>
            </ul>
            <ul class="footMenu">
                <li><a href="/payment">Оплата и доставка</a></li>
                <li><a href="/politic">Политика конфиденциальности</a></li>
                <li><a href="/contacts">Контакты</a></li>
            </ul>
        </div>
        <div class="col-sm-3">
            <div class="ftel"><?=$this->params['config']['phone']?></div>
            <div class="fadr"><?=$this->params['config']['main_office']?></div>
            <div class="ftime">
                <?=$this->params['config']['time_work']?><br>
            </div>
        </div>
        <div class="col-sm-1 ecards">
            <?=Html::img('/images/visa_ico.png', ['alt' => 'Visa'])?>
            <?=Html::img('/images/mastercard_ico.png', ['alt' => 'Mastercard'])?>
        </div>
    </div>
    <div class="modal fade" id="getCall" tabindex="-1" role="dialog" aria-labelledby="getCall" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Обратный звонок</h4>
                </div>
                <div class="modal-body">
                    <div role="form" class="wpcf7" id="wpcf7-f4-o1" lang="ru-RU" dir="ltr">
                        <?php $callForm = ActiveForm::begin([
                            'id' => 'callForm',
                            'action' => ['site/get-call'],
                            'enableClientValidation' => true,
                            'options' => ['class' => 'wpcf7-form'],
                            'fieldConfig' => [
                                'template' => '{input}{error}',
                                'labelOptions' => [],
                            ],
                        ]); ?>
                        <p>
                            Имя
                            <span class="wpcf7-form-control-wrap yname">
                                <?=$callForm->field($this->params['callForm'], 'name')->textInput(['placeholder' => 'Ваше имя'])?>
                            </span>
                            Номер телефона
                            <span class="wpcf7-form-control-wrap ytel">
                                <?=$callForm->field($this->params['callForm'], 'phone')->textInput(['placeholder' => '+7 (912) 345-6789'])?>
                            </span>
                            <?=Html::submitInput('Заказать звонок', ['class' => 'wpcf7-form-control wpcf7-submit'])?>
                        </p>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="timeModal" tabindex="-1" role="dialog" aria-labelledby="timeModal" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 100%;max-width: 400px;color: #000;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">В данное время доставка не работает.</h4>
                    <h4 class="modal-title" id="myModalLabel2">Прием заказов с 11:30 до 22:30</h4>
                    <h4 class="modal-title" id="myModalLabel2">но Вы можете сделать заказ заранее</h4>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter47037111 = new Ya.Metrika2({
                    id:47037111,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/47037111" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!--<button id="responsive-menu-button" class="responsive-menu-button responsive-menu-boring responsive-menu-accessible" type="button" aria-label="Menu">
    <span class="responsive-menu-box">
        <span class="responsive-menu-inner"></span>
    </span>
</button>-->
<div id="responsive-menu-container" class="slide-left">
    <div id="responsive-menu-wrapper">
        <ul id="responsive-menu" class="">
            <li id="responsive-menu-item-99" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home responsive-menu-item responsive-menu-current-item">
                <a href="/" class="responsive-menu-item-link">Главная</a>
            </li>
            <li id="responsive-menu-item-103" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/pizza" class="responsive-menu-item-link">Пицца</a>
            </li>
            <li id="responsive-menu-item-1865" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/pasta" class="responsive-menu-item-link">Пасты</a>
            </li>
            <li id="responsive-menu-item-1866" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/salad" class="responsive-menu-item-link">Салаты</a>
            </li>
            <li id="responsive-menu-item-2616" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/combo" class="responsive-menu-item-link">Комбо</a>
            </li>
            <li id="responsive-menu-item-104" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/drink" class="responsive-menu-item-link">Напитки</a>
            </li>
            <li id="responsive-menu-item-101" class="menu-item menu-item-type-post_type menu-item-object-page responsive-menu-item">
                <a href="/cart" class="responsive-menu-item-link">Корзина</a>
            </li>
            <li id="responsive-menu-item-102" class=" menu-item menu-item-type-post_type menu-item-object-page responsive-menu-item">
                <a href="/payment" class="responsive-menu-item-link">Условия бесплатной доставки</a>
            </li>
            <li id="responsive-menu-item-100" class="menu-item menu-item-type-post_type menu-item-object-page responsive-menu-item">
                <a href="/contacts" class="responsive-menu-item-link">Контакты</a>
            </li>
        </ul>
        <div id="responsive-menu-additional-content">
            <div class="phoneTop">
                +7 (3812) 28-14-12
                <a href="" data-target="#getCall" data-toggle="modal">заказать звонок</a>
            </div>
            <div class="timeTop">
                Прием заказов<br>
                Пн-вс: 11.30-22.30
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
