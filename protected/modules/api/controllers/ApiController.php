<?php

class ApiController extends CController
{
    public $POST = null;
    public $author = null;

    public function filters() {
        return array(
            array(
                'api.filters.PerformanceFilter',
            ),
        );
    }

    public function actionIndex(){}

    public function actionGetGamesInfo() {
        $medicalTest = @$this->POST->medicalTest;
        $user = User::model()->findByPk($this->author);
        $out = array();
        $difficulty = $medicalTest == "true" ? 0 : $user->level;

        $levels = Level::model()->findAllByAttributes(array('difficulty' => $difficulty));

        if ($levels) {
            foreach ($levels as $index => $level) {
                $out[$index]['name'] = $level->gameType->title;
                $out[$index]['type'] = $level->gameType->rootNode->title;
                $out[$index]['description'] = $level->gameType->description;
                $out[$index]['white_noise'] = $this->createAbsoluteUrl('/Data/Media/Sounds/whitenoise.mp3');

                foreach($level->attributes as $key => $value)
                    $out[$index][$key] = $value;

                $criteria=new CDbCriteria;
                $criteria->with = array('set');

                $criteria->condition = 'set.level_id = :level_id';
                $criteria->params[':level_id'] = $level->id;
                $setsOptions = SetsOptions::model()->findAll($criteria);

                if ($setsOptions) {
                    foreach ($setsOptions as $setsOption){
                        $audio = empty($setsOption->option->audio->file) ? "" : Yii::app()->createAbsoluteUrl($setsOption->option->audio->file);
                        $image = empty($setsOption->option->image->file) ? "" : Yii::app()->createAbsoluteUrl($setsOption->option->image->file);

                        $out[$index]['sets'][$setsOption->set_id]['options'][] = array(
                            'option_id' => $setsOption->option->id,
                            'image' => $image,
                            'audio' => $audio,
                            'order' => $setsOption->option->order,
                        );

                        // Male and Female
                        if ($level->gameType->id == 4) {
                            $outF = array();
                            $crt = new CDbCriteria;
                            $crt->condition = 'set_id = :set_id AND option_m_id = :option_m_id';
                            $crt->params = array(':set_id' => $setsOption->set_id, ':option_m_id' => $setsOption->option->id);

                            $setsFOption = SetsFOptions::model()->find($crt);
                            if ($setsFOption) {
                                $audio = empty($setsFOption->option->audio->file) ? "" : Yii::app()->createAbsoluteUrl($setsFOption->option->audio->file);
                                $image = empty($setsFOption->option->image->file) ? "" : Yii::app()->createAbsoluteUrl($setsFOption->option->image->file);
                                $out[$index]['sets'][$setsOption->set_id]['options'][] = array(
                                    'option_id' => $setsFOption->option->id,
                                    'image' => "hello",
                                    'audio' => $audio,
                                    'order' => $setsFOption->option->order,
                                );
                            }
                        }
                    }

                    $out[$index]['sets'] = array_values($out[$index]['sets']);
                }
            }

            Yii::app()->ajax->success(array_values($out));
        }

        Yii::app()->ajax->failure('No such setting');
    }

    public function actionGetGameInfo()
    {
        $user = User::model()->findByPk($this->author);

        $out = array();
        $id = (int) $this->POST->game_type_id;
        $postLevel = @$this->POST->level;
        $medicalTest = $this->POST->medicalTest == false ? 0 : 1;

        $difficulty = isset($postLevel) && $medicalTest ? $postLevel : $user->level;
        $level = Level::model()->findByAttributes(array('game_type_id' => $id, 'difficulty' => $medicalTest ? 0 : $difficulty));

        if ($level) {
            $out['difficulty'] = $difficulty;

            $out['name'] = $level->gameType->title;
            $out['type'] = $level->gameType->rootNode->title;
            $out['description'] = $level->gameType->description;
            $out['white_noise'] = $this->createAbsoluteUrl('/Data/Media/Sounds/whitenoise.mp3');

            foreach($level->attributes as $key => $value) {
                if ($key == 'difficulty') continue;
                $out[$key] = $value;
            }

            $criteria=new CDbCriteria;
            $criteria->with = array('set');

            $criteria->condition = 'set.level_id = :level_id';
            $criteria->params[':level_id'] = $level->id;
            $setsOptions = SetsOptions::model()->findAll($criteria);

            if ($setsOptions) {
                $sameAudio = array();
                foreach ($setsOptions as $setsOption) {
                    $audio = empty($setsOption->option->audio->file) ? "" : Yii::app()->createAbsoluteUrl($setsOption->option->audio->file);
                    $image = empty($setsOption->option->image->file) ? "" : Yii::app()->createAbsoluteUrl($setsOption->option->image->file);

                    if ($level->gameType->id == 11) {
                        if (empty($sameAudio[$setsOption->set_id]))
                            $sameAudio[$setsOption->set_id] = $audio;

                        $out['sets'][$setsOption->set_id]['options'][] = array(
                            'option_id' => $setsOption->option->id,
                            'image' => $image,
                            'audio' => $sameAudio[$setsOption->set_id],
                            'order' => $setsOption->option->order,
                        );
                    } else {
                        $out['sets'][$setsOption->set_id]['options'][] = array(
                            'option_id' => $setsOption->option->id,
                            'image' => $image,
                            'audio' => $audio,
                            'order' => $setsOption->option->order,
                        );
                    }

                    // Male and Female
                    if ($level->gameType->id == 4) {
                        $crt = new CDbCriteria;
                        $crt->condition = 'set_id = :set_id AND option_m_id = :option_m_id';
                        $crt->params = array(':set_id' => $setsOption->set_id, ':option_m_id' => $setsOption->option->id);

                        $setsFOption = SetsFOptions::model()->find($crt);
                        if ($setsFOption) {
                            $audio = empty($setsFOption->option->audio->file) ? "" : Yii::app()->createAbsoluteUrl($setsFOption->option->audio->file);
                            $out['sets'][$setsOption->set_id]['options'][] = array(
                                'option_id' => $setsFOption->option->id,
                                'image' => "hello",
                                'audio' => $audio,
                                'order' => $setsFOption->option->order,
                            );
                        }
                    }
                }

                $out['sets'] = array_values($out['sets']);
            }

            Yii::app()->ajax->success($out);
        }

        Yii::app()->ajax->failure('No such setting');
    }

    public function actionSetGameAborted()
    {
        $gameResult = GameResult::model()->findByPk(@$this->POST->game_result_id);
        if (!$gameResult) Yii::app()->ajax->failure('No geme was found');

        $gameResult->status = GameResult::ABORTED;

        if ($gameResult->save())
            Yii::app()->ajax->success(array('game_type_id' => $gameResult->id));
        else
            Yii::app()->ajax->failure($this->stringErrors($gameResult->getErrors()));
    }

//{"token":"e96c02c9f519b0940d08a46e85fbf5e5", "medicalTest":false, "hearingAid":false}
    public function actionSetGameInfo()
    {
        $gameTestFlag = $this->POST->medicalTest == false ? 0 : 1;
        $hearingAid = $this->POST->hearingAid == false ? 0 : 1;
        /** @var User $user */
        $user = User::model()->findByPk($this->author);
        $postLevel = @$this->POST->level;
        $difficulty = isset($postLevel) && $gameTestFlag ? $postLevel : $user->level;
        $repeatLevelFlag = $postLevel && $postLevel < $user->getLevel() ? true : false;

        $difficiltyLevel = $gameTestFlag ? 0 : $difficulty;
        $level = Level::model()->findByAttributes(array('game_type_id' => @$this->POST->game_type_id, 'difficulty' => $difficiltyLevel));
        if (!$level) Yii::app()->ajax->failure('Level can\'t be found');

        $gameResult = new GameResult();
        $gameResult->user_id = $this->author;
        $gameResult->level_id = $level ? $level->id : NULL;
        $gameResult->status = GameResult::STARTED;

        $gameResult->medicalTest = $gameTestFlag;
        $gameResult->hearingAid = $hearingAid;

        if ($gameResult->medicalTest)
            $gameResult->test_difficulty = $difficulty;

        if ($gameResult->save()) {
            $nextLevel = new NextLevel();
            $nextLevel->setGameTestFlag($gameTestFlag);
            $nextLevel->setUser($user);
            if ($gameTestFlag) { // if medical test
                $nextLevel->setGameTestFlag(true);
                $nextLevel->setGameTypeId(@$this->POST->game_type_id);
                //$nextGame = $user->nextLevel(true, @$this->POST->game_type_id);
            } elseif ($repeatLevelFlag) { // plaing passed levels one more time
                $nextLevel->setRepeatLevelFlag(true);
                $nextLevel->setGameTypeId(@$this->POST->game_type_id);
                //$nextGame = $user->nextLevel(true, false, null, null, @$this->POST->game_type_id);
            } else { // standart regime of playing
                $nextLevel->setGameResult($gameResult);
                //$nextGame = $user->nextLevel(true, false, null, $gameResult);
            }
            $nextLevel->init();
            $nextGame = $nextLevel->getNextTypeId();

            Yii::app()->ajax->success(array('game_result_id' => $gameResult->id, 'next_game_type_id' => $nextGame));
        } else {
            Yii::app()->ajax->failure($this->stringErrors($gameResult->getErrors()));
        }
    }

    public function actionSetGameResult()
    {
        /** @var GameResult $gameResult */
        $gameResult = GameResult::model()->findByPk((int)$this->POST->game_result_id);
        if (!$gameResult) Yii::app()->ajax->failure('No game was found');
        $gameResult->points = $this->POST->points;
        $gameResult->status = GameResult::FINISHED;

        $datetime1 = new DateTime($gameResult->date);
        $datetime2 = new DateTime("now");

        $diffInSeconds = $datetime2->getTimestamp() - $datetime1->getTimestamp();
        $gameResult->played_time = $diffInSeconds;
        $gameResult->answer_options = $gameResult->level->display_options;
        $gameResult->questions_delay = $gameResult->level->delay;
        $gameResult->white_noise_level = $gameResult->level->white_noise_level;

        if ($gameResult->update()) {
            $gameResult->checkIfPassed();
            $gameResult->testComplete();
            $gameResult->deleteCanceledNodes();
            foreach ($this->POST->result_details as $detail) {
                $model = new ResultDetails();
                $model->game_result_id = $gameResult->id;
                $model->correct = $detail->correct;
                $model->quick = $detail->quick;
                if ($model->save()) {
                    foreach ($detail->option_id as $key => $option) {
                        $answerSequience = new AnswerSequience();
                        $answerSequience->result_details_id = $model->id;
                        $answerSequience->option_id = $option;
                        $answerSequience->answered_option_id = $detail->answered_option_id[$key];
                        $answerSequience->delay = $detail->delay;
                        if (!$answerSequience->save())
                            Yii::app()->ajax->failure($this->stringErrors($answerSequience->getErrors()));
                    }
                } else
                    Yii::app()->ajax->failure($this->stringErrors($model->getErrors()));
            }
            if (!$this->POST->next_game_type_id) $this->redirect(array('/backend/profile/patientDetail/'.$gameResult->user_id));
            else Yii::app()->ajax->success();
        }
        else
            Yii::app()->ajax->failure($this->stringErrors($gameResult->getErrors()));
    }

    private function stringErrors($errors) {
        $stringError = array();
        foreach ($errors as $error) {
            foreach ($error as $err) {
                $stringError[] = $err;
            }
        }
        return implode(',', $stringError);
    }
}
