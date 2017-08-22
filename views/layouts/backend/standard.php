<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 28.06.2017
 * Time: 12:08
 */
?>
<?php $this->beginPage() ?>
    <!--    adds header the the layout-->
<?php $this->beginContent('@app/views/layouts/backend/basic/head.php'); ?>
<?php $this->endContent(); ?>
    <body>
    <?php $this->beginBody() ?>
    <!--    adds menu-->
    <?php $this->beginContent('@app/views/layouts/backend/basic/menu.php'); ?>
    <?php $this->endContent(); ?>
        <!--    adds view content to the layout-->
        <?= $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>