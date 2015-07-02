<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */

?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <?php echo Html::csrfMetaTags(); ?>
            <title><?php echo Html::encode($this->title); ?></title>
            <?php $this->head(); ?>
        </head>
        <?php $this->beginBody(); ?>
        <body style="background:#F7F7F7;">
            <div>
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper"><?php echo $content; ?></div>
            </div>
        </body>
        <?php $this->endBody(); ?>
    </html>
<?php $this->endPage(); ?>