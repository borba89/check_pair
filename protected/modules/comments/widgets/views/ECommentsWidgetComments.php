<?php if(count($comments) > 0):?>
        <?php foreach($comments as $comment):?>
        <div class="blog-details-comment-single <?php echo isset($subclass)?$subclass:''?>" id="comment-<?php echo $comment->id; ?>">
            <?php if($subclass){?>
                <hr class="children-comment-V" noshade style="">
                <hr class="children-comment-H" noshade style="">
            <?php } ?>
            <!--<img src="<?php /*echo Yii::app()->getModule('main')->themeAssets;*/?>/img/blog-details-comment-img1.png" alt="">-->
            <div class="blog-comment-text">
                <?php if($this->adminMode === true):?>
                    <div class="admin-panel">
                        <?php if($comment->status === null || $comment->status == Comment::STATUS_NOT_APPROWED) echo CHtml::link(Yii::t('CommentsModule.msg', 'approve'), Yii::app()->urlManager->createUrl(
                            CommentsModule::APPROVE_ACTION_ROUTE, array('id'=>$comment->id)
                        ), array('class'=>'approve'));?>
                        <?php echo CHtml::link(Yii::t('CommentsModule.msg', 'delete'), Yii::app()->urlManager->createUrl(
                            CommentsModule::DELETE_ACTION_ROUTE, array('id'=>$comment->id)
                        ), array('class'=>'delete pull-right'));?>
                    </div>
                <?php endif; ?>
                <h5>
                    <?php echo $comment->userName;?>
                    <?php if($this->allowSubcommenting === true && ($this->registeredOnly === false || Yii::app()->user->isGuest === false)):?>
                    <a href="#" rel="<?php echo $comment->id;?>" class="add-comment" data-id="<?php echo $comment->id;?>">
                        <i class="zmdi zmdi-mail-reply-all"></i> <?= Yii::t('MainModule.main','Ответить') ?>
                    </a>
                    <?php endif;?>
                </h5>
                <span><?php echo Yii::app()->dateFormatter->formatDateTime($comment->create_time);?></span>
                <p style="word-break: break-all;"><?php echo CHtml::encode($comment->comment_text);?></p>
            </div>
        </div>
        <?php
        if(count($comment->childs) > 0 && $this->allowSubcommenting === true){
            $this->render('ECommentsWidgetComments', array('comments' => $comment->childs, 'subclass'=>'cta'));
        }
        ?>
        <?php endforeach;?>
<?php else:?>
    <p><?php echo Yii::t('MainModule.main', 'Напишите комментарий! Ваше мнение важно для нас.');?></p>
<?php endif; ?>

