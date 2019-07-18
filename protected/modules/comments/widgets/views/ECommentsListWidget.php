<div class="comment-widget" id="<?php echo $this->id?>">
<?php
    $this->render('ECommentsWidgetComments', array('comments' => $comments));
    if($this->showPopupForm === true) {
        if($this->registeredOnly === false || Yii::app()->user->isGuest === false)
        {
            echo "<div id=\"addCommentDialog-$this->id\">";
                $this->widget('comments.widgets.ECommentsFormWidget', array(
                    'model' => $this->model,
                ));
            echo "</div>";
        }
    }else{
        if($this->registeredOnly === false || Yii::app()->user->isGuest === false) {
            $this->widget('comments.widgets.ECommentsFormWidget', array(
                'model' => $this->model,
            ));
        }
    }

    /*if($this->registeredOnly === false || Yii::app()->user->isGuest === false) {
        echo CHtml::link(Yii::t('CommentsModule.msg', 'Add comment11111111'), '#', array('rel'=>0, 'class'=>'add-comment'));
    } else {
        echo '<strong>'.Yii::t('CommentsModule.msg', 'You cannot add a new comment').'</strong>';
    }*/
?>
</div>
