<?php
class DefaultController extends Frontend
{
    public $apiClass;

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
            'webhook' => 'application.components.Webhook',
        );
    }

    /**
     * Смена языка
     */
    public function actionChange()
    {
        if (isset($_GET['lang'])) {
            Yii::app()->session['language'] = $_GET['lang'];
            Yii::app()->session['language_is_changed'] = $_GET['lang'];
        }

        if (isset(Yii::app()->session['language']))
        {
            $cookie = new CHttpCookie('language', $_GET['lang']);
            $cookie->expire = time() + (60*60*24*365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;

            Yii::app()->language = Yii::app()->session['language'];
            Yii::app()->user->setState('language', $_GET['lang']);
        }

        $this->redirect($this->urltrans(Yii::app()->request->urlReferrer));
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->apiClass = Yii::createComponent('offer.models.ApiOffer');
        $this->footer_phone = true;
        //Yii::app()->email->testMessage();
        $this->render('index');
    }

    /**
     * Contact page
     */
    public function actionContact()
    {
        $this->footer_phone = true;

        if(Yii::app()->request->isPostRequest){
//            CVarDumper::dump($_POST,10,true);exit;

            $name = CHtml::encode($_POST['name']);
            $email = CHtml::encode($_POST['email']);
            $subject = CHtml::encode($_POST['subject']);
            $message = CHtml::encode($_POST['message']);

            /*$mailer = Yii::createComponent('application.extensions.mailer5.EMailer');
            $mailer->From = $email;
            $mailer->FromName = $name;
            $mailer->AddAddress(Yii::app()->params['adminEmail']);
            $mailer->CharSet = 'UTF-8';
            $mailer->Subject = $subject;
            $mailer->Body = $message;*/
            if(Yii::app()->email->contactMessage($name, $email, $subject, $message)){
                $feedback = new Feedback();
                $feedback->name = $name;
                $feedback->email = $email;
                $feedback->subject = $subject;
                $feedback->message = $message;
                $feedback->save();
                Yii::app()->user->setFlash('success', Yii::t("MainModule.main", 'Спасибо! Мы свяжемся с вами в самое ближайшее время.'));
                $this->redirect('/main/default/contact');
            }else{
                Yii::app()->user->setFlash('error', Yii::t("MainModule.main", 'Произошла ошибка. Сообщение не отправлено.'));
                //echo CVarDumper::dump($mailer->ErrorInfo,10,true);exit;
            }

        }
        $this->render('contact');
    }

    /**
     * Страница о компании
     * @throws CException
     */
    public function actionAbout()
    {
        Yii::import('backend.models.AboutEmployees');
        $this->footer_phone = true;
        $models = AboutEmployees::model()->findAll();
        $this->render('about', array(
            'models'=>$models
        ));
    }

    /**
     * Страница список вакансий
     */
    public function actionVacancy()
    {
        $vacancies = Vacancy::model()->findAllByAttributes(array(
            'lang'=>Yii::app()->language
        ));
        $this->render('vacancy', array(
            'vacancies'=>$vacancies
        ));
    }

    /**
     * Страница детального просмотра вакансии
     * @param $id
     */
    public function actionVacant($id)
    {
        $vacancy = Vacancy::model()->findByPk($id);
        $this->render('vacancy_show', array(
            'model'=>$vacancy
        ));
    }

    /**
     * Отправка резюме со страницы вакансии
     * @throws CException
     */
    public function actionSendResume()
    {
        //echo CVarDumper::dump($_POST,10,true);exit;

        $id = (int)$_POST['id'];
        $name = CHtml::encode($_POST['name']);
        $email = CHtml::encode($_POST['email']);
        $phone = isset($_POST['phone']) ? CHtml::encode($_POST['phone']) : null;

        $model = Vacancy::model()->findByPk($id);

        $file = CUploadedFile::getInstanceByName('file');

        if(Yii::app()->email->resumeMessage($name, $model, $phone, $email, $file)){
            $this->redirect(Yii::app()->request->urlReferrer);
        }else{
            Yii::app()->user->setFlash('error', Yii::t('MainModule.main', 'Произошла ошибка при отправке резюме! Попробуйте повторить позже.'));
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->footer_phone = true;
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Подписка на сайт
     */
    public function actionSubscribe()
    {
        if(Yii::app()->request->isPostRequest){

            $email = CHtml::encode($_POST['email']);

            $exist = Subscribe::model()->findByAttributes(array(
                'email'=>$email
            ));

            if(!$exist){
                $subscribe = new Subscribe();
                $subscribe->email = $email;
                if($subscribe->save()){
                    echo json_encode(array(
                        'result'=>'success',
                        'message'=>Yii::t('MainModule.main', 'Подписка успешно оформлена!')
                    ));
                }else{
                    echo json_encode(array(
                        'result'=>'error',
                        'message'=>Yii::t('MainModule.main', 'Произошла ошибка при оформлении подписки!')
                    ));
                }

            }else{
                echo json_encode(array(
                    'result'=>'warning',
                    'message'=>Yii::t('MainModule.main', 'Вы уже подписывались ранее!')
                ));
            }

            Yii::app()->end();
        }
        $this->redirect('/main/default');
    }

    public function actionCallback()
    {
        if(Yii::app()->request->isPostRequest){
            //echo CVarDumper::dump($_POST,10,true);exit;

            $name = CHtml::encode($_POST['name']);
            $phone = CHtml::encode($_POST['phone']);
            $comment = CHtml::encode($_POST['comment']);
            $refferer = CHtml::encode($_POST['refferer']);
            $broker = CHtml::encode($_POST['broker_id']);
            $model = new RequestCallback();
            $model->setScenario('create');
            $model->attributes = $_POST['RequestCallback'];
            $model->name = $name;
            $model->phone = $phone;
            $model->comment = $comment;

            if($model->save()){
                echo json_encode(array(
                    'result'=>'success',
                    'message'=>Yii::t('MainModule.main', '<h2>Спасибо!</h2> <p>Мы свяжемся с Вами в ближайшее время!</p>')
                ));
            }else{
                echo json_encode(array(
                        'result'=>'error',
                        'message'=>Yii::t('MainModule.main', 'Произошла ошибка при заказе обратного звонка!'.CHtml::errorSummary($model))
                ));
            }

            Yii::app()->end();
            //$this->redirect('/main/default/contact');

        }
        if ($refferer){
            $this->redirect($refferer);
        } else {
            $this->redirect('/main/default');
        }

    }
}
