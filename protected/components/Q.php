<?php

/**
 * 前台共用类
 */
class Q extends Controller {

    public $layout = 'main';
    public $referer;
    public $uid;
    public $userInfo;
    public $selectNav = '';
    public $platform;
    public $isMobile = false;
    public $keywords;
    public $pageDescription;

    function init() {
        parent::init();
        Yii::app()->theme = 'web';
        if (zmf::config('mobile')) {
            if (zmf::checkmobile($this->platform)) {
                Yii::app()->theme = 'mobile';
                $this->isMobile = true;
            }
        }
        $uid = zmf::uid();
        if ($uid) {
            $this->uid = $uid;
            $this->userInfo = Users::getOne($uid);
        }
        self::_referer();
    }

    function _referer() {
        $currentUrl = Yii::app()->request->url;
        $arr = array(
             'login',
            '/site/',
            '/error/',
            '/attachments/',
            '/weibo/',
            '/qq/',
            '/weixin/',
        );
        $set = true;
        if ($set) {
            foreach ($arr as $val) {
                if (!$set) {
                    break;
                }
                if (strpos($currentUrl, $val) !== false) {
                    $set = false;
                    break;
                }
            }
        }
        if ($set && Yii::app()->request->isAjaxRequest) {
            $set = false;
        }
        $referer = zmf::getCookie('refererUrl');
        if ($set) {
            zmf::setCookie('refererUrl', $currentUrl, 86400);
        }
        if ($referer != '') {
            $this->referer = $referer;
        }
    }
    
    public function onlyOnPc(){
        if($this->isMobile){
            $this->layout='common';
            $this->render('//common/onlyOnPc');
            Yii::app()->end();
        }
    }

}
