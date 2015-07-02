<?php

namespace app\components;

use app\models\User;
use Yii;
use yii\web\NotFoundHttpException;
use app\helpers\CookieHelper;

/**
 * Class Controller
 * @package app\components
 */
class Controller extends \yii\web\Controller
{
    /**
     * @var string
     */
    private $returnUrlParam = '__returnUrlParam';

    /**
     * @var array
     */
    private $loginPages = [
        '/user/authenticate',
        '/user/login'
    ];

    /**
     * @var string
     */
    public $layout = '/layouts/login';

    public function init()
    {
        if ((new User())->checkHash(CookieHelper::getCookie('id'), CookieHelper::getCookie('hash'))) {
            $this->layout = '/layouts/main';
            $this->setAuthCookies(CookieHelper::getCookie('id'), CookieHelper::getCookie('hash'));
        } elseif (!$this->isLoginPage()) {
            $this->redirect('/user/authenticate');
        }
    }

    /**
     * @param array|string $url
     * @param int $statusCode
     * @return void|\yii\web\Response
     */
    public function redirect($url, $statusCode = 302)
    {
        $response = parent::redirect($url, $statusCode);
        $response->send();
        Yii::$app->end();
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setReturnUrl($url)
    {
        Yii::$app->getSession()->set($this->returnUrlParam, $url);
        return $this;
    }

    /**
     * @param null $defaultUrl
     * @return string
     */
    public function getReturnUrl($defaultUrl = null)
    {
        return Yii::$app->getSession()->get($this->returnUrlParam, $defaultUrl);
    }

    /**
     * @param string $view
     * @param array $params
     * @param null $context
     * @throws \yii\base\ExitException
     */
    public function render($view, $params = [], $context = null)
    {
        $this->registerMetaTags([
            ['http-equiv' => 'Content-Type', 'content' => 'text/html; charset=UTF-8'],
            ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'],
            ['charset' => 'utf-8'],
            ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']
        ]);
        $this->registerCssFiles([
            '@webPath/public/fonts/css/font-awesome.min.css',
            '@webPath/public/icheck/flat/green.css',
            '@webPath/public/css/bootstrap.min.css',
            '@webPath/public/css/animate.min.css',
            '@webPath/public/css/custom.css'
        ]);
        $this->registerJqueryFiles([
            '@webPath/public/js/bootstrap.min.js',
            '@webPath/public/js/custom.js',
            '@webPath/public/js/nicescroll/jquery.nicescroll.min.js',
            '@webPath/public/js/chartjs/chart.min.js',
            '@webPath/public/js/progressbar/bootstrap-progressbar.min.js',
            '@webPath/public/js/icheck/icheck.min.js'
        ]);
        $content = $this->getView()->render($view, $params, $context);
        echo $this->getView()->render($this->layout, ['content' => $content], $context);
        Yii::$app->end();
    }

    /**
     * @param array $files
     */
    protected function registerJqueryFiles($files = [])
    {
        foreach ($files as $file) {
            $this->getView()->registerJsFile(
                Yii::getAlias($file),
                ['depends' => ['yii\web\JqueryAsset']]
            );
        }
    }

    /**
     * @param array $files
     */
    protected function registerCssFiles($files = [])
    {
        foreach ($files as $file) {
            $this->getView()->registerLinkTag(['rel' => 'stylesheet', 'href' => Yii::getAlias($file)]);
        }
    }

    /**
     * @param array $tags
     */
    protected function registerMetaTags($tags = [])
    {
        foreach ($tags as $tag) {
            $this->getView()->registerMetaTag($tag);
        }
    }

    /**
     * @param string $title
     */
    protected function setTitle($title = '')
    {
        $this->getView()->title = Yii::t('app', $title);
    }

    /**
     * @return string
     */
    public function actionErrorHandler()
    {
        $ex = \Yii::$app->getErrorHandler()->exception;
        if ($ex instanceof NotFoundHttpException) {
            $this->render('404', [], $this);
        }
    }

    /**
     * @param int $id
     * @param string $hash
     */
    protected function setAuthCookies($id, $hash)
    {
        CookieHelper::setCookies(['id' => $id, 'hash' => $hash]);
    }

    /**
     * @return bool
     */
    private function isLoginPage()
    {
        return in_array(Yii::$app->request->getUrl(), $this->loginPages);
    }
}
