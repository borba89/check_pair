<?php
    $blogArticle = $_FILES['BlogArticle'];
    if (!empty($blogArticle['tmp_name']['image'])) {
        $aExtraInfo = getimagesize($blogArticle['tmp_name']['image']);
        $sImage = "data:" . $aExtraInfo["mime"] . ";base64," . base64_encode(file_get_contents($blogArticle['tmp_name']['image']));
        echo '<img src="' . $sImage . '" alt="Your Image" />';
    } elseif (isset($image)) {
        echo '<img src="/' . $image . '" alt="Your Image" />';
    }
?>

<h1><?php echo $title; ?></h1>
<div class="card-content">
    <?php echo $subtitle; ?>
</div>
<div class="card-content">
    <?php echo $content; ?>
</div>