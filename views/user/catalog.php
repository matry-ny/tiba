<?php
$this->title = Yii::t('app', 'Список пользователей');
/* @var $list array */
?>
<div class="page-title">
    <div class="title_left">
        <h3>Список пользователей</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                        <?php foreach ($list as $value): ?>
                            <?php /** @var $value \app\populate\User */ ?>
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                    <div class="left col-xs-7">
                                        <h2><?php echo $value->getName(); ?></h2>
                                        <p><strong>Должность: </strong> <?php echo $value->getGroupName(); ?></p>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-envelope"></i> <?php echo $value->getEmail(); ?> </li>
                                            <?php if ($value->isActive()): ?>
                                                <li><i class="fa fa-unlock"></i> Пользователь активен</li>
                                            <?php else: ?>
                                                <li><i class="fa fa-lock"></i> Пользователь заблокирован</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                        <img
                                            src="<?php echo $value->getAvatar(); ?>"
                                            alt="<?php $value->getName(); ?> avatar"
                                            class="img-circle img-responsive"
                                            width="200px">
                                    </div>
                                </div>
                                <div class="col-xs-12 bottom text-right">
                                    <div class="col-xs-12 col-sm-6 emphasis" style="float: right;padding-right: 45px;">
                                        <a class="btn btn-success btn-xs" href="mailto:<?php echo $value->getEmail(); ?>">
                                            <i class="fa fa-user"></i> <i class="fa fa-comments-o"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"></i> Профайл
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>