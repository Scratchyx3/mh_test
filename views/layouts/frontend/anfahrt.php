<?php $this->beginPage() ?>
<!--    adds header the the layout-->
<?php $this->beginContent('@app/views/layouts/frontend/basic/head.php'); ?>
<?php $this->endContent(); ?>
<body>
<?php $this->beginBody() ?>
<!--    adds nav bar to the layout-->
<?php $this->beginContent('@app/views/layouts/frontend/basic/navBar.php'); ?>
<?php $this->endContent(); ?>
<!--    adds view content to the layout-->
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>