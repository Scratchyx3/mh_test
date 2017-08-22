<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 23.06.2017
 * Time: 14:55
 */

?>

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
        <!--    adds footer the the layout-->
        <?php $this->beginContent('@app/views/layouts/frontend/basic/footer.php'); ?>
        <?php $this->endContent(); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
