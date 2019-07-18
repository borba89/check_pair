<?php $form = new ActiveForm();
$form->id = 'blog-article-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
);
$form->type = 'horizontal';
?>


<?php if ($realtyTypeTags && $realty): ?>
    <div class="col s12 center">
        <a href="<?= Yii::app()->createUrl('/backend/realtyTags/admin') ?>"><?php echo Yii::t("OfferModule.offer", 'Выберите особенности объекта'); ?></a>
    </div>

    <div class="input-field col s12 input-field-Tags">
        <?php
        $realty->realtyTags = $realty->getTagsChecked();
        //Если создается новое - все теги включены
            if ($realty->is_new){
                foreach ($realtyTypeTags as $tag){
                $realty->realtyTags[$tag->id]=0;
                }
            }

            foreach ($realtyTypeTags as $tag):
            ?>
            <div class="input-field col s6 m4 l4">
                <p>
                    <?php
                    echo $form->checkBox($realty, 'realtyTags['.$tag->id.']');
                    echo $form->label($realty, 'realtyTags['.$tag->id.']', array('class'=>'active label_checkbox_tag','label' => $tag->title,));
                    ?>
                </p>
            </div>
            <?php
//                                echo $form->checkboxGroup($realty, 'realtyTags['.$tag->id.']',
//                                    array('widgetOptions' =>
//                                        array(
//                                            'htmlOptions' => array(
//                                                'checked'=> in_array($tag->id, $tagsChecked) ? true : false
//                                            ),
//                                        ),
//                                        'labelOptions' => array(
//                                            'for' =>  CHtml::activeId($realty, 'realtyTags['.$tag->id.']'),
//                                        ),
//                                        'groupOptions'=>array(
//                                            'class'=>'input-field col s2'
//                                        ),
//                                        'label' => $tag->title,
//                                    )
//                                );
            ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>