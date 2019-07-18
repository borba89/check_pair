<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 30.01.19
 * Time: 15:04
 */
?>
<?php foreach ($existVideos as $video):?>
<div class="col s12 m6 l6 for-del-<?php echo $video->id;?>">
    <a href="/offer/realtyOffer/deleteVideo/id/<?php echo $video->id;?>" class="realty-offer-video-delete">Удалить</a>
    <div class="size-1_2em p-1em pt-2em pr-3em-lg">
        <object width="420" height="315"
                data="<?php echo $video->url;?>">
        </object>
    </div>
</div>
<?php endforeach;?>
