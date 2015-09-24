<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div>
        <?php

        date_default_timezone_set('Europe/Moscow');
        $format = 'd M Y H:i';
        $stamp = 1442229654;
        //$date = date(DATE_RSS, time());
        echo time();
        echo '<br>';
        echo date(DATE_RSS, time());
        echo '<br>';
        echo date($format, $stamp);
        echo '<br>';
        $t = time();
        echo $t - $stamp;
        echo '<br>';
        echo date('t');
        ?>
    </div>

    <?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $form = ActiveForm::begin(['id' => 'id']);
    echo Html::input('button', 'button', 'button', [
        'onclick' => 'msg'
    ]);

//    $model = new \app\models\Advert();
//
//    echo $form->field($model, 'a')->input('button', [
//        'value' => 'BUTTON',
//        'onclick' => '
//                        $.ajax({
//                            url: http://new.loc/advert/add-to-bookmarks?id=2,
//                            success: function() {
//                                .alert("OK");
//                            }
//                        });
//                        '
//    ]);
//
//    ActiveForm::end();
    ?>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
