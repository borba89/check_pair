<?php
class Email extends CApplicationComponent
{
    public $pathLayout = 'application.views.layouts.email';

    public $method = 'mail';

    public $smtpHost = 'localhost';

    public $smtpPort = 25;

    public $smtpSecure = '';//Options: '', 'ssl' or 'tls'

    public $smtpUsername = '';

    public $smtpPassword = '';

    public $SMTPOptions = array();

    public $mailer;

    public function init()
    {
        /**
         * Создать компонент из свежего EMailer 5
         */
        $this->mailer = Yii::createComponent('application.extensions.mailer5.EMailer');

        /**
         * Метод отправки письма mail|smtp
         */
        $this->mailer->Mailer = $this->method;

        if($this->method == 'smtp'){
            $this->mailer->isSMTP();
            $this->mailer->SMTPDebug = 2;
            $this->mailer->Host = $this->smtpHost;
            $this->mailer->Port = $this->smtpPort;
            $this->mailer->SMTPSecure = $this->smtpSecure;
            $this->mailer->SMTPAuth = true;
            $this->mailer->SMTPOptions = $this->SMTPOptions;
            $this->mailer->Username = $this->smtpUsername;
            $this->mailer->Password = $this->smtpPassword;
        }

        /**
         * Установить макет для письма
         */
        $this->mailer->setPathLayouts($this->pathLayout);

        $this->mailer->CharSet = 'UTF-8';

        $this->mailer->IsHTML(true);  // set email format to HTML
    }

    /**
     * Отправить письмо
     * @param $subject
     * @param $body
     * @param $to
     * @param null $senderEmail
     * @param null $senderName
     * @return bool
     * @throws CException
     */
    protected function sendEmail($subject, $body, $to, $senderEmail = null, $senderName = null)
    {
        if (!is_array($to)){
            $to = explode(',', $to);
        }

        $senderEmail = $senderEmail ? : Yii::app()->params['no-replyEmail'];

        /**
         * Отправитель
         */
        $this->mailer->From = $senderEmail;
        $this->mailer->FromName = $senderName;
        $this->mailer->AddReplyTo(Yii::app()->params['no-replyEmail']);

        /**
         * Добавить получателей
         */
        foreach($to as $toEmail){
            $this->mailer->AddAddress($toEmail);
        }

        $this->mailer->FromName = Yii::app()->name;

        $this->mailer->Subject = $subject;
        $this->mailer->IsHTML(true);  // set email format to HTML
        $this->mailer->Body = $body;

        if($this->mailer->Send()){
            return true;
        } else{
            die("Mailer Error: " . $this->mailer->ErrorInfo);
            //return false;
        }

    }

    /**
     * Отправка сообщения из контактной формы
     * @param $name
     * @param $email
     * @param $subject
     * @param $message
     * @return bool
     * @throws CException
     */
    public function contactMessage($name, $email, $subject_text, $text)
    {
        //название компании
        $company_name = Yii::app()->settings->get(Settings::COMPANY, 'company_name', Yii::app()->name);
        $company_email = Yii::app()->settings->get(Settings::COMPANY, 'company_email', Yii::app()->params['adminEmail']);

        //echo CVarDumper::dump($company_email,10,true);exit;
        $template = $this->findTemplate('contact');
        $subject = $template->subject;
        $message = $template->message;

        $subjectVars = array(
            '{company_name}' => $company_name,
            '{subject_text}' => CHtml::encode($subject_text),
        );

        $variables = array(
            '{subject_text}' => CHtml::encode($subject_text),
            '{email}'=>$email,
            '{username}' => CHtml::encode($name),
            '{text}' => CHtml::encode($text),
        );

        $subject = $this->fillVariableTemplate($subject, $subjectVars);

        $content = $this->fillVariableTemplate($message, $variables);

        $body = Yii::app()->controller->renderPartial($this->pathLayout, array('content'=>$content), true);

        return $this->sendEmail($subject, $body, $company_email, $email, $name);
    }

    /**
     * Отправка резюме на вакансию
     * @param $name
     * @param $model
     * @param $phone
     * @param $email
     * @param $file - attachment
     * @return bool
     * @throws CException
     * @throws CHttpException
     */
    public function resumeMessage($name, $model, $phone, $email, $file = null)
    {
        //название компании
        $company_name = Yii::app()->settings->get(Settings::COMPANY, 'company_name', Yii::app()->name);
        $company_email_resume = Yii::app()->settings->get(Settings::COMPANY, 'company_email_resume', Yii::app()->params['adminEmail']);

        $template = $this->findTemplate('resume');
        $subject = $template->subject;
        $message = $template->message;

        $subjectVars = array(
            '{company_name}' => $company_name,
            '{title}' => $model->title,
        );

        $variables = array(
            '{company_name}' => $company_name,
            '{phone}' => ($phone) ? $phone : Yii::t('MainModule.main', 'Не указан'),
            '{email}'=>$email,
            '{title}' => $model->title,
        );

        $subject = $this->fillVariableTemplate($subject, $subjectVars);

        $content = $this->fillVariableTemplate($message, $variables);

        $body = Yii::app()->controller->renderPartial($this->pathLayout, array('content'=>$content), true);

        if($file){
            $tmpDir = Yii::getPathOfAlias('application.runtime.tmp');
            $savedFile = $tmpDir.DIRECTORY_SEPARATOR.$file->name;
            if($file->saveAs($savedFile)){
                $this->mailer->addAttachment($savedFile);
            }
        }

        return $this->sendEmail($subject, $body, $company_email_resume, Yii::app()->params['no-replyEmail'], $name);
    }

    /**
     * Отправка сообщения об обратном звонке
     * @param $name
     * @param $phone
     * @param $comment
     * @param $brokers
     * @return bool
     * @throws CException
     * @throws CHttpException
     */
    public function requestCallback($name, $phone, $comment, $brokers)
    {
        $company_name = Yii::app()->settings->get(Settings::COMPANY, 'company_name', Yii::app()->name);
        $company_email = Yii::app()->settings->get(Settings::COMPANY, 'company_email', Yii::app()->params['adminEmail']);

        $template = $this->findTemplate('callback');
        $subject = $template->subject;
        $message = $template->message;

        $subjectVars = array(
            '{company_name}' => $company_name,
        );

        $variables = array(
            '{phone}' => ($phone) ? $phone : Yii::t('MainModule.main', 'Не указан'),
            '{username}'=>$name,
            '{comment}' => $comment,
        );

        $subject = $this->fillVariableTemplate($subject, $subjectVars);

        $content = $this->fillVariableTemplate($message, $variables);

        $body = Yii::app()->controller->renderPartial($this->pathLayout, array('content'=>$content), true);

        $to = array($company_email);

        foreach ($brokers as $broker) {
            array_push($to, $broker->email);
        }

        return $this->sendEmail($subject, $body, $to, Yii::app()->params['no-replyEmail'], $name);
    }

    /**
     * Отправка сообщения о заказе осмотра
     * @param $name
     * @param $phone
     * @param $text
     * @param $offer
     * @param $url
     * @param $broker_email
     * @return bool
     * @throws CException
     * @throws CHttpException
     */
    public function requestVisit($name, $phone, $text, $offer, $url, $broker_email)
    {
        $company_name = Yii::app()->settings->get(Settings::COMPANY, 'company_name', Yii::app()->name);
        $company_email = Yii::app()->settings->get(Settings::COMPANY, 'company_email', Yii::app()->params['adminEmail']);

        $template = $this->findTemplate('visit');
        $subject = $template->subject;
        $message = $template->message;

        $subjectVars = array(
            '{company_name}' => $company_name,
            '{offer}' => $offer,
        );

        $variables = array(
            '{offer}'=>$offer,
            '{url}'=>$url,
            '{phone}' => ($phone) ? $phone : Yii::t('MainModule.main', 'Не указан'),
            '{username}'=>$name,
            '{text}' => $text,
        );

        $subject = $this->fillVariableTemplate($subject, $subjectVars);

        $content = $this->fillVariableTemplate($message, $variables);

        $body = Yii::app()->controller->renderPartial($this->pathLayout, array('content'=>$content), true);

        $to = ($broker_email) ? $broker_email : $company_email;

        return $this->sendEmail($subject, $body, $to, Yii::app()->params['no-replyEmail'], $name);
    }

    /**
     * Отправить письмо о новой ставке в аукционе,
     * брокеру или на почту компании
     * @param $name
     * @param $phone
     * @param $bid
     * @param $currency
     * @param $url
     * @param $offer
     * @return bool
     * @throws CException
     * @throws CHttpException
     */
    public function setBid($name, $phone, $bid, $currency, $url, $offer)
    {
        $company_name = Yii::app()->settings->get(Settings::COMPANY, 'company_name', Yii::app()->name);
        $company_email = Yii::app()->settings->get(Settings::COMPANY, 'company_email', Yii::app()->params['adminEmail']);

        $template = $this->findTemplate('auction');
        $subject = $template->subject;
        $message = $template->message;

        $subjectVars = array(
            '{company_name}' => $company_name,
            '{offer}' => $offer->title,
        );

        $variables = array(
            '{offer}' => $offer->title,
            '{url}' => $url,
            '{bid}' => $bid,
            '{currency}' => $currency,
            '{phone}' => ($phone) ? $phone : Yii::t('MainModule.main', 'Не указан'),
            '{username}'=>$name,
        );

        $subject = $this->fillVariableTemplate($subject, $subjectVars);

        $content = $this->fillVariableTemplate($message, $variables);

        $body = Yii::app()->controller->renderPartial($this->pathLayout, array('content'=>$content), true);

        $to = ($offer->realty->broker_id) ? $offer->realty->broker->email : $company_email;

        return $this->sendEmail($subject, $body, $to, Yii::app()->params['no-replyEmail'], $name);
    }

    public function testMessage()
    {
        $template = $this->findTemplate('test');
        $subject = $template->subject;
        $message = $template->message;

        $subjectVars = array(
            '{user}' => 'Test User',
        );

        $variables = array(
            '{test}'=>'Bla-Bla-Bla',
            '{first}'=>'first var',
            '{second}'=>'second var',
        );

        $subject = $this->fillVariableTemplate($subject, $subjectVars);

        $content = $this->fillVariableTemplate($message, $variables);

        $body = Yii::app()->controller->renderPartial($this->pathLayout, array('content'=>$content), true);

        $to = array(
            'moskvinvitaliy@gmail.com',
            'moskvinvitaliy@rambler.ru',
            'foreach@mail.ru'
        );
        return $this->sendEmail($subject, $body, $to, Yii::app()->params['adminEmail'], 'tester');

    }

    /**
     * Получить из бд шаблон по имени
     * @param $name
     * @return array|mixed|null
     * @throws CHttpException
     */
    protected function findTemplate($name)
    {
        $model = EmailTemplate::model()->findByAttributes(array(
            'name'=>$name,
        ));

        if($model===null)
            throw new CHttpException(404,'Шаблон не найден.');
        return $model;
    }

    /**
     * Заполнить тело письмп переменными
     * @param $message
     * @param $variables
     * @return mixed
     */
    protected function fillVariableTemplate($message, $variables)
    {
        $searchArray = array_keys($variables);
        $replaceArray = array_values($variables);
        return str_replace($searchArray, $replaceArray, $message);
    }
}