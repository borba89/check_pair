<?php
class UploadAction extends DCrudAction
{
    public $_alreadyFirst;
    public $model;

    public function run()
    {
        if (!empty($_FILES)) {
            if (is_uploaded_file($_FILES["Filedata"]["tmp_name"])) {
                $fileTypes = array('jpg','JPG','jpeg','JPEG','gif','GIF','png', 'PNG'); // File extensions
                $fileParts = pathinfo($_FILES['Filedata']['name']);
                if (in_array($fileParts['extension'],$fileTypes)) {

                    //имя директории, куда сохраняются фото
                    $id = $_POST["id"];
                    $this->model = $this->createModel();

                    Yii::log($_FILES["Filedata"]["name"] . " file is receive", "error");
                    echo $_FILES["Filedata"]["name"] .  " file is receive <br>";

                    $hash = md5(rand(1, 99999) . $_FILES["Filedata"]["name"]) . "_" . $_FILES["Filedata"]["name"];
                    $dir = "images/site/".$this->model->getClass()."/" . $id . "/";

                    if (!is_dir($dir)) {
                        mkdir($dir, 0755, true);
                    }

                    move_uploaded_file($_FILES["Filedata"]["tmp_name"], "images/site/".$this->model->getClass()."/" . $id . "/" . $hash);

                    Yii::log($_FILES["Filedata"]["name"] . " is moved to images/site", "error");
                    echo $_FILES["Filedata"]["name"] . " is moved to images/site <br>";

                    $image = Yii::app()->iwi->load("images/site/".$this->model->getClass()."/" . $id . "/" . $hash);
                    $image->adaptive_new(1280, 853, false, false);
                    $image->save("images/site/".$this->model->getClass()."/" . $id . "/" . $hash);

                    Yii::log($hash . " is resized", "error");
                    echo $hash . " is resized <br>";

                    try {
                        $file = new MultipleImages();
                        $file->item_id = $id;
                        $file->content_type = $this->model->getClass();
                        $file->path = "images/site/".$this->model->getClass()."/" . $id . "/" . $hash;

                        if(!$this->checkFirst($id)) {
                            $file->is_main = 1;
                        } else {
                            $file->is_main = 0;
                        }

                        $file->save();

                        Yii::log($hash . " is saved to database", "error");
                        echo $hash . " is saved to database <br>";

                    } catch (Exception $e) {
                        echo '[Exeption] code: ' . $e->getCode() . ' Line: ' . $e->getLine() . ' ' . $e->getMessage();
                        Yii::log('[Exeption] code: ' . $e->getCode() . ' Line: ' . $e->getLine() . ' ' . $e->getMessage(), "error");
//                        CHtml::errorSummary('[Exeption] code: ' . $e->getCode() . ' Line: ' . $e->getLine() . ' ' . $e->getMessage(), "error");
                    }

                    echo $hash . ' is uploaded';
                } else {
                    echo $fileParts['extension'] . " Not in 'jpg','JPG','jpeg','JPEG','gif','GIF','png', 'PNG'";
                    Yii::log($fileParts['extension'] . " Not in 'jpg','JPG','jpeg','JPEG','gif','GIF','png', 'PNG'", "error");

//                    header("HTTP/1.1 405"); //any 4XX error will work
                    exit();
                }
            } else {
                echo 'file not upload';
                Yii::log("file not upload", "error");
            }
        }
    }

    private function checkFirst($item_id) {
//        if ($this->model instanceof RealtyOffer) {
//            return false;
//        }

        $multipleImages = MultipleImages::model()->count('content_type = :contentType && item_id = :item_id && is_main = 1', array(':contentType' => $this->model->getClass(), ':item_id' => $item_id));

        return $multipleImages > 0 ? true : false;
    }
}