<?php

namespace app\controllers;

use app\components\Controller;
use app\helpers\CookieHelper;
use app\models\User;
use app\models\UserGroups;
use app\models\users\CreateUser;
use app\models\users\LoginUser;
use yii\web\View;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    /**
     * Render login page
     */
    public function actionAuthenticate()
    {
        $this->render('/index/login');
    }

    /**
     * Render users list page
     */
    public function actionCatalog()
    {
        $this->render('/user/catalog', [
            'list' => (new User())->getAll()
        ]);
    }

    /**
     * Render new user create page
     */
    public function actionAdd()
    {
        $this->setTitle('Новый пользователь');
        $this->registerJqueryFiles([
            '@webPath/public/js/moment.min2.js',
            '@webPath/public/js/datepicker/daterangepicker.js',
        ]);
        $this->getView()->registerJs(
            "$('#birthday').daterangepicker({
                singleDatePicker: true,
                format: 'YYYY-MM-DD',
                calender_style: 'picker_4'
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });",
            View::POS_READY
        );
        $this->render('/user/add', [
            'accessLevels' => (new UserGroups())->getAll()->toSelect()
        ]);
    }

    /**
     * Create new user action
     */
    public function actionCreate()
    {
        $createUser = new CreateUser();
        if (\Yii::$app->getRequest()->getIsPost() && $createUser->load($_POST, '')) {
            if ($createUser->validate()) {
                if ($createUser->run()) {
                    \Yii::$app->session->setFlash('success', \Yii::t('app', 'Пользователь добавлен'));
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('app', 'Ошибка добавления пользователя'));
                }
            } else {
                \Yii::$app->session->setFlash('error', \Yii::t('app', 'Ошибка валидации пользователя'));
                \Yii::$app->session->setFlash('errors_list', $createUser->getErrors());
            }
        }
    }

    /**
     * User authorisation to admin area
     */
    public function actionLogin()
    {
        $login = new LoginUser();
        if (\Yii::$app->getRequest()->getIsPost() && $login->load($_POST, '')) {
            if ($login->validate()) {
                /** @var \app\populate\User $result */
                $result = $login->run();
                if ($result) {
                    $this->setAuthCookies($result->getId(), $result->getAuthKey());
                    $this->redirect('/');
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('app', 'Ошибка авторизации пользователя'));
                }
            } else {
                \Yii::$app->session->setFlash('error', \Yii::t('app', 'Перепроверьте формат введенных данных'));
                \Yii::$app->session->setFlash('errors_list', $login->getErrors());
            }
        } else {
            \Yii::$app->session->setFlash('error', \Yii::t('app', 'Введите обязательные данные'));
        }

        $this->redirect('/user/authenticate');
    }

    /**
     * Logout action
     */
    public function actionLogout()
    {
        CookieHelper::removeCookie('id');
        CookieHelper::removeCookie('hash');
        $this->redirect('/user/authenticate');
    }
}
