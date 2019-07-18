<!DOCTYPE html>
<html lang="ru">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76335968-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-76335968-2');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->getModule('main')->assetsUrl; ?>/img/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons" rel="stylesheet">
    <?php Yii::app()->seo->run(Yii::app()->language); ?>
</head>
<body>

<?php echo $this->renderPartial('main.partial.header'); ?>

<?php //echo $content; ?>
<?php $this->widget(
    'BottomMenu',
    array(
        'filter' => $this->footer_filter,
        'favorite' => $this->footer_favorite,
        'phone' => $this->footer_phone,
    )
); ?>
<footer>
    <div class="container box-shadow display-none-xs mt-3em-sm">
        <div class="bc-white text-center pt-1_5em pb-1_5em">
            <div class="size-0_8em">
                <?php echo Yii::t("MainModule.main", "© 2019 Lexeos Imobil. Все права защищены. Разработано в CYBTRONIX"); ?>
            </div>
            <?php $this->widget('MultiLang'); ?>
        </div>
    </div>
</footer>
<a class="anchor" id="toTop" href="#top-menu" style="display: none;"><em class="fa fa-angle-up size-2em lh-0_8em" aria-hidden="true"></em></a>
</body>
</html>