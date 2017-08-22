<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 13.07.2017
 * Time: 13:15
 */

?>

<?php $this->beginPage() ?>
    <!--    adds header the the layout-->
<?php $this->beginContent('@app/views/layouts/backend/basic/head.php'); ?>
<?php $this->endContent(); ?>
    <body>
    <?php $this->beginBody() ?>
    <!--    adds view content to the layout-->
    <?= $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>