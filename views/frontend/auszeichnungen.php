<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Url;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
}
// check if there is already a title image saved in session
if ($session->has('auszeichnungenTitleImage') && file_exists($session->get('auszeichnungenTitleImage'))) {
    $imagePath = $session->get('auszeichnungenTitleImage');
// get path to random title image
} else {
    $imageMdl = new Image();
    $imageMdl -> type = 'auszeichnungen';
    $imageMdl -> setPath();
    $imagePath = $imageMdl -> getRndImagePath();
    $session->set('auszeichnungenTitleImage', $imagePath);
}
$url = Url::to('@web/' . $imagePath);
$this->title = 'Auszeichnungen';

?>

<div class="container-fluid">
    <div class="row">
        <div class="standardTitleImageContainer" style='background-image: url(<?= $url ?>);'></div>
    </div>
</div>