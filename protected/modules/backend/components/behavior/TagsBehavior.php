<?php
class TagsBehavior extends CActiveRecordBehavior
{
    public function afterSave($event)
    {
        if (isset($_POST['MultipleImages']['tags'])) {
            $param = $_POST['MultipleImages']['tags'];

            ContypeTags::model()->deleteAll('content_type = :contentType AND item_id = :item_id' , array(':contentType' => "albumImage", ':item_id' => $this->owner->id));

            foreach ($param as $value) {
                $tag = Tags::model()->find('id = :value OR tag = :value', array(':value' => $value));

                if(!$tag) {
                    $tag = new Tags();
                    $tag->tag = $value;
                    if($tag->validate()) {
                        $tag->save();
                    }
                }

                $contype_tags = new ContypeTags();
                $contype_tags->content_type = $this->owner->getClass();
                $contype_tags->item_id = $this->owner->id;
                $contype_tags->tag_id = $tag->id;
                $contype_tags->save();
            }
        }
    }

    public function getAllTags()
    {
        $tags = $this->owner->tags;
        return CHtml::listData($tags,'id','tag');

        return array();
    }

    public function tags()
    {
        $allTags = $this->owner->tags;
        $returnLink = '';

        if($allTags) {
            foreach($allTags as $value) {
                $returnLink[] = '#'.$value->tag;
            }
            $returnLink = implode(' ', $returnLink);
        }

        return $returnLink;
    }
}