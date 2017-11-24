<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 16.11.2017
 * Time: 13:49
 */

?>
<?php $this->beginPage() ?>
<!--    adds header the the layout-->
<?php $this->beginContent('@app/views/layouts/frontend/basic/head.php'); ?>
<?php $this->endContent(); ?>
<body>
<?php $this->beginBody() ?>
<!--    adds nav bar to the layout-->
<?php $this->beginContent('@app/views/layouts/frontend/basic/navBarEnglish.php'); ?>
<?php $this->endContent(); ?>
<!--    adds view content to the layout-->
<?= $content ?>
<!--    adds footer the the layout-->
<?php $this->beginContent('@app/views/layouts/frontend/basic/footerEnglish.php'); ?>
<?php $this->endContent(); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

