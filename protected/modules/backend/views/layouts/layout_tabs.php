<?php $this->beginContent(Yii::app()->getModule('backend')->getBackendLayoutAlias('main')); ?>
    <?php
        $this->icon = !empty($this->icon) ? $this->icon : 'fa-picture-o';
        $this->tabTitle = !empty($this->tabTitle) ? $this->tabTitle : Yii::t("BackendModule.backend", 'Pictures');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-indigo">
                <div class="panel-heading">
                    <h4><?php echo $this->title; ?></h4>
                    <div class="options">
                        <div class="options">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#domprogress"><i class="fa fa-file-text-o"></i> General </a></li>
                                <li class=""><a data-toggle="tab" href="#codeprogress"><i class="fa <?php echo $this->icon; ?>"></i> <?php echo $this->tabTitle; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="border-radius: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div id="domprogress" class="tab-pane active">
                                    <?php echo $content; ?>
                                </div>
                                <div id="codeprogress" class="tab-pane">
                                    <?php $this->showClip('left_column_content'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
		Yii::app()->clientScript->registerCssFile($this->module->assetsUrl.'/fancybox/jquery.fancybox.css');
		Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/fancybox/jquery.fancybox.pack.js', CClientScript::POS_END);
	?>

    <?php Yii::app()->clientScript->registerScript('fancyboxInit',"
        $('a.images-group').fancybox();
    ", CClientScript::POS_READY); ?>

<?php $this->endContent() ; ?>