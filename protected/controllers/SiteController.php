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
        $this->onlyOnPc();
        $this->layout = 'common';
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
                    $info=  Users::getOne($uid);
                    if($info['isAdmin']){
                        $this->redirect(array('admin/index/index'));
                    }elseif($this->referer){
                        $this->redirect($this->referer);
                    }else{
                        $this->redirect(zmf::config('baseurl'));
                    }
                } else {
                    zmf::updateFCacheCounter($cacheKey, 1, 3600);
                    zmf::setCookie('checkWithCaptcha', 1, 86400);
                }
            }
        }
        $this->pageTitle='登录';
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
    
    public function actionInfo(){
        $code = zmf::val('code',1);   
        $_title=  SiteInfo::exTypes($code);
        if(!$_title){
            throw new CHttpException(404, '您所查看的页面不存在');
        }
        $info=  SiteInfo::model()->find('code=:code', array(':code'=>$code));
        if(!$info){
            throw new CHttpException(404, '您所查看的页面不存在');
        }
        $allInfos=SiteInfo::model()->findAll(array(
            'select'=>'code,title',
            'condition'=>'code!=:code AND status='.Posts::STATUS_PASSED,
            'params'=>array(
                ':code'=>$code
            )
        ));       
        //更新访问统计
        Posts::updateCount($info['id'],'SiteInfo');
        $data=array(
            'info'=>$info,
            'code'=>$code,
            'allInfos'=>$allInfos,
        );
        $this->pageTitle=$info['title'].' - '.zmf::config('sitename');
        $this->selectNav='about';
        $this->render('about', $data);
    }
}
