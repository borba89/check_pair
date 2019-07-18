<?php
/**
 * Created by PhpStorm.
 * User: foreach
 * Date: 29.01.19
 * Time: 20:07
 */

class YoutubeCode
{
    public static function getCode($url)
    {
        $out = array();
        $result = parse_url($url);
        //print_r($result); exit;
        if(isset($result['host'])){
            if($result['host'] == 'www.youtube.com'){
                //echo 'youtube';
                if(isset($result['query'])){
                    parse_str($result['query'], $out);
                    if(isset($out['v'])){
                        return 'https://www.youtube.com/embed/'.$out['v'];
                    }
                }else{
                    return null;
                }
            }elseif ($result['host'] == 'www.facebook.com'){
                //echo 'facebook';
                if(isset($result['query'])){
                    parse_str($result['query'], $out);
                    if(isset($out['href'])){
                        return 'https://www.facebook.com/plugins/video.php?href='.$out['href'];
                    }else{
                        //https://www.facebook.com/top.foto.video/videos/1181109842055495/
                        return 'https://www.facebook.com/plugins/video.php?href='.$url;
                    }
                }else{
                    return 'https://www.facebook.com/plugins/video.php?href='.$url;
                }
            }else{
                return null;
            }
        }else{
            return null;
        }

    }
}