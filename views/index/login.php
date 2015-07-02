<?php $this->title = Yii::t('app', 'Авторизация'); ?>
<div id="login" class="animate form">
    <section class="login_content">
        <form action="/user/login" method="post">
            <h1>Авторизация</h1>
            <?php if (\Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    <?php echo \Yii::$app->session->getFlash('success', null, true); ?>
                </div>
            <?php endif; ?>
            <?php if (\Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    <?php echo \Yii::$app->session->getFlash('error', null, true); ?>
                </div>
            <?php endif; ?>
            <div>
                <input type="text" class="form-control" placeholder="E-mail" name="email" required="" />
            </div>
            <div>
                <input type="password" class="form-control" placeholder="Пароль" name="password" required="" />
            </div>
            <div>
                <input type="submit" class="btn btn-default submit" value="Войти" />
                <a class="reset_pass" href="#">Забыли пароль?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                    <h1><i class="fa fa-paw" style="font-size: 26px;"></i> TiBa</h1>

                    <p>©2015 Все права защищены. Условия использования</p>
                </div>
            </div>
        </form>
    </section>
</div>