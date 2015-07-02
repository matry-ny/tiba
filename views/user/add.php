<?php

use \yii\helpers\Html;

/* @var $accessLevels array */

?>
<div class="page-title">
    <div class="title_left">
        <h3>Новый пользователь</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <br />
                                <form id="demo-form2" method="post" action="/user/create" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Имя <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Уровень доступа</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="group" class="form-control col-md-7 col-xs-12">
                                                <?php echo Html::renderSelectOptions(0, $accessLevels) ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Пол</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="gender" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="gender" value="male"> Мужской
                                                </label>
                                                <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="gender" value="female" checked=""> Женский
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Дата рождения</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Аватар</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="avatar" class="file form-control col-md-7 col-xs-12" type="file" style="padding: 0">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group phones-block">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Телефоны</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 phones-list">
                                            <div class="phone-row">
                                                <input class="form-control col-md-7 col-xs-12" type="text" name="phones[]">
                                                <span class="fa fa-plus-circle add-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Пароль <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password" class="form-control col-md-7 col-xs-12" required="required" type="password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="re_password" class="control-label col-md-3 col-sm-3 col-xs-12">Повторите пароль <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="re_password" class="form-control col-md-7 col-xs-12" required="required" type="password" name="compare_password">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <a href="/user/catalog" class="btn btn-primary">Отмена</a>
                                            <button type="submit" class="btn btn-success">Готово</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>