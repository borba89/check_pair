<?php

class Webhook extends CAction
{
    /**
     * The name of the branch to pull from.
     *
     * @var string
     */
    private $_branch = '';

    /**
     * The name of the remote to pull from.
     *
     * @var string
     */
    private $_remote = '';

    /**
     * Executes the necessary commands to deploy the website.
     */
    public function run()
    {
        try {
            Yii::log('Attempting deployment... '.date('Y-m-d H:i:s'), CLogger::LEVEL_TRACE, 'webhook');

            // Make sure we're in the right directory
            chdir(Yii::getPathOfAlias('webroot'));
            Yii::log('Changing working directory to... '.Yii::getPathOfAlias('webroot'), CLogger::LEVEL_TRACE, 'webhook');

            // Discard any changes to tracked files since our last deploy
            exec('git reset --hard HEAD', $output);
            Yii::log('Reseting repository... '.implode(' ', $output), CLogger::LEVEL_TRACE, 'webhook');

            // Update the local repository
            if (!empty($this->_remote) && !empty($this->_branch))
                exec('git pull '.$this->_remote.' '.$this->_branch, $output);
            else
                exec('git pull', $output);

            Yii::log('Pulling in changes... '.implode(' ', $output), CLogger::LEVEL_TRACE, 'webhook');

            // Secure the .git directory
            exec('chmod -R og-rx .git');
            Yii::log('Securing .git directory... ', CLogger::LEVEL_TRACE, 'webhook');

            Yii::log('Deployment successful.', CLogger::LEVEL_TRACE, 'webhook');
        } catch (Exception $e) {
            Yii::log($e, CLogger::LEVEL_ERROR, 'webhook');
        }
    }
}
