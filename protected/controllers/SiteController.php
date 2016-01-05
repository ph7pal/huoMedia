<?php

class SiteController extends Q {

    public function actions() {
        $cookieInfo = zmf::getCookie('checkWithCaptcha');
        if ($cookieInfo == '1') {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                    'backColor' => 0xFFFFFF,
                    'minLength' => '2', // 最少生成几个字符
                    'maxLength' => '3', // 最多生成几个字符
                    'height' => '30',
                    'width' => '60'
                ),
                'page' => array(
                    'class' => 'CViewAction',
                ),
            );
        }
    }

    public function actionError() {
        $this->layout='common';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                $outPutData = array(
                    'status' => 0,
                    'msg' => $error['message'],
                    'code' => $error['code']
                );
                $json = CJSON::encode($outPutData);
                header("Content-type:application/json;charset=UTF-8");
                echo $json;
                Yii::app()->end();
            } else {
                $this->pageTitle='提示';
                $this->render('error', $error);
            }
        }
    }

    public function actionLogin() {
        if (!Yii::app()->user->isGuest) {
            $this->message(0, '您已登录，请勿重复操作');
        }
        $canLogin = true;
        $ip = Yii::app()->request->getUserHostAddress();
        $cacheKey = 'loginErrors-' . $ip;
        $errorTimes = zmf::getFCache($cacheKey);
        if ($errorTimes >= 5) {
            $canLogin = false;
        }
        if ($canLogin) {
            $model = new FrontLogin;
            if (isset($_POST['FrontLogin'])) {
                $model->attributes = $_POST['FrontLogin'];
                if ($model->validate() && $model->login()) {
                    $arr = array(
                        'latestLoginTime' => zmf::now(),
                    );
                    
                    $uid = Yii::app()->user->id;
//                    User::model()->updateByPk($uid, $arr);
                    
                    zmf::delCookie('checkWithCaptcha');
                    zmf::delFCache($cacheKey);
                    $this->redirect(array('user/view', 'code' => $uid));
                } else {
                    zmf::updateFCacheCounter($cacheKey, 1, 3600);
                    zmf::setCookie('checkWithCaptcha', 1, 86400);
                }
            }
        }
        $this->render('login', array(
            'model' => $model,
        ));
    }

    public function actionLogout() {
        if (Yii::app()->user->isGuest) {
            $this->message(0, '您尚未登录');
        }
        Yii::app()->user->logout();
        if ($this->referer == '') {
            $this->referer = Yii::app()->request->urlReferrer;
        }
        $this->redirect($this->referer);
    }
    
    public function actionAbout(){
        $this->pageTitle='关于';
        $this->selectNav='about';
        $this->render('about', array(
            'model' => $model,
        ));
    }

    public function actionSitemap() {
        $page = $_GET['id'];
        $page = isset($page) ? $page : 1;
        $dir = Yii::app()->basePath . '/runtime/site/sitemap' . $page . '.xml';
        $a = $_GET['a'];
        $obj = new Sitemap();
        if ($a == 'update' || !file_exists($dir)) {
            $limit = 10000;
            $start = ($page - 1) * $limit;
            $rss = $obj->show(Posts::CLASSIFY_POST, $start, $limit);
            if ($rss) {
                $obj->saveToFile($dir);
            } else {
                exit($page . '-->empty');
            }
        } else {
            $rss = $obj->getFile($dir);
        }
        //rss创建
        $this->render('//site/sitemap', array('rss' => $rss));
    }

}
