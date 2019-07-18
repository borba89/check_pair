yii-seo
=======

Search engine optimization for the Yii PHP framework.

Based on crisu83's [yii-seo](https://github.com/crisu83/yii-seo).

## Usage

In layout

```
    <?php Yii::app()->controller->widget(
        'vendor.chemezov.yii-seo.widgets.SeoHead',
        array(
            'httpEquivs'         => array(
                'Content-Type'     => 'text/html; charset=utf-8',
                'X-UA-Compatible'  => 'IE=edge,chrome=1',
                'Content-Language' => 'en-EN'
            ),
            'defaultTitle'       => "My default title",
            'defaultDescription' => "My default description",
            'defaultKeywords'    => "My default keywords",
        )
    ); ?>
```

In Controller

```
    public function behaviors()
    {
        return array(
            'seo' => array('class' => 'vendor.chemezov.yii-seo.behaviors.SeoBehavior'),
        );
    }

    public function filters()
    {
        return array(
            array('vendor.chemezov.yii-seo.filters.SeoFilter + view'), // apply the filter to the view-action
        );
    }
```

In view file

```

$this->title = [$model->title, "My cool site!"];
$this->metaDescription = "My page description";
$this->metaKeywords = "My page keywords";

```