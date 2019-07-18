<?php 
/**
 * @var Comment model
 */
?>

<div class="blog-details-left-form">
<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->urlManager->createUrl($this->postCommentAction),
        'id'=>'blog-details-form',//$this->id,
)); ?>
    <h4 class="blog-details-left-title"><?php echo Yii::t('MainModule.main', 'Оставить комментарий');?></h4>
    <?php echo $form->errorSummary($newComment); ?>
    <p id="ajax-errors"></p>
    <?php 
        echo $form->hiddenField($newComment, 'owner_name'); 
        echo $form->hiddenField($newComment, 'owner_id'); 
        echo $form->hiddenField($newComment, 'parent_id', array('class'=>'parent_id'));
    ?>

    <?php if(Yii::app()->user->isGuest == true):?>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->textField($newComment,'user_name', array('size'=>64, 'required'=>'required', 'placeholder'=>Yii::t('MainModule.main', 'Ваше имя'))); ?>
            </div>

            <div class="col-md-6">
                <?php echo $form->textField($newComment,'user_email', array('size'=>40, 'required'=>'required', 'placeholder'=>Yii::t('MainModule.main', 'Ваш email'))); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <?php echo $form->textArea($newComment, 'comment_text', array('cols' => 60, 'rows' => 10, 'required'=>'required', 'placeholder'=>Yii::t('MainModule.main', 'Текст комментария'))); ?>
        </div>
    </div>

    <?php if($this->useCaptcha === true && extension_loaded('gd')): ?>
        <div class="row captcha">
            <div class="col-md-12">
                <?php echo $form->labelEx($newComment,'verifyCode'); ?>
                <div class="clearfix"></div>
                <div class="clearfix">
                    <?php $this->widget('CCaptcha', array(
                        'captchaAction'=>Yii::app()->urlManager->createUrl(CommentsModule::CAPTCHA_ACTION_ROUTE),
                    )); ?>
                    <?php echo $form->textField($newComment,'verifyCode'); ?>

                </div>
                <div class="hint">
                    <?php echo Yii::t('MainModule.main', 'Пожалуйста, введите буквы, как показано на рисунке выше. Буквы не чувствительны к регистру');?>
                </div>
                <?php echo $form->error($newComment, 'verifyCode'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="submit-comment" onclick="sendComment(event);"><?php echo Yii::t('MainModule.main', 'Добавить комментарий')?></button>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
