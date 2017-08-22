<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 21.06.2017
 * Time: 13:49
 */

use app\models\Image;
use yii\helpers\Html;

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

$this->title = 'Auszeichnungen';

?>

<div class="container-fluid">
    <div class="row standardTitleImageContainer">
        <?php echo Html::img('@web/' . $imagePath, ['alt'=>'weingarten', 'class'=>'standardTitleImage']); ?>
    </div>
</div>