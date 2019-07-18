<?php
class MainimageAction extends DCrudAction
{
    public function run()
    {
        if (isset($_POST['id']))
        {
            $id = (int)$_POST["id"];
            $offer_id = (int)$_POST["offer_id"];
            $contentType = $this->createModel();
            $model = MultipleImages::model()->findByPk($id);
            if(!$model)
                throw new CHttpException(400,Yii::t("base","No such record"));

            if ($contentType instanceof RealtyOffer) {
                /**
                 * Если вызов экшина происходит в контексе модели RealtyOffer
                 * Установить для всех записей с хешем в item_id типа nmAp6zLnbfGULmGpGm8baEtQ4NPYHOaw
                 * Параметр is_main = id объявления
                 * @todo проверить, что возвращается то что надо 1 || 0
                 */
                /*$result = MultipleImages::model()->updateAll(
                    array('is_main' => 1),
                    'id = :item_id AND content_type = "realtyoffer"',
                    array(':item_id' => $id)
                );

                echo $result;*/
                $model->is_main = 1;
                if($model->save()){
                    echo 1;
                }else{
                    echo 0;
                }
            } else {
                $multipleImages = MultipleImages::model()->findAll('content_type = :contentType AND item_id = :item_id', array(':contentType' => $contentType->getClass(), ':item_id' => $model->item_id));

                foreach($multipleImages as $image) {
                    $image->is_main = 0;
                    $image->update();
                }

                $model->is_main = 1;
                if ($model->update()) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
        else
            throw new CHttpException(400,Yii::t("base","POST is empty"));
    }
}