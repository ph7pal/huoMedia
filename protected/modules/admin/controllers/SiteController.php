<?php

class SiteController extends Q {

  public $layout = '';
  public $newMembers = array();

  public function init() {
    parent::init();
  }

  public function actions() {
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

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  public function actionLogin() {
    if (!Yii::app()->user->isGuest) {
      $this->message(0, '您已登录，请勿重复操作');
    }
    $model = new LoginForm;
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      if ($model->validate() && $model->login()) {
        $arr = array(
            'last_login_ip' => ip2long(Yii::app()->request->userHostAddress),
            'last_login_time' => time(),
        );
        Users::model()->updateByPk(Yii::app()->user->id, $arr);
        Users::model()->updateCounters(array('login_count' => 1), ':id=id', array(':id' => Yii::app()->user->id));
        if ($this->referer == '') {
          $this->referer = Yii::app()->homeUrl;
        }
        $this->redirect($this->referer);
      }
    } else {
      $this->newMembers = Users::getNew();
    }
    $this->pageTitle = '欢迎回来 - ' . zmf::config('sitename');
    $this->render('login', array('model' => $model));
  }

  public function actionLogout() {
    if (Yii::app()->user->isGuest) {
      $this->message(0, '您尚未登录');
    }
    Yii::app()->user->logout();
    if ($this->referer == '') {
      $this->referer = Yii::app()->homeUrl;
    }
    $this->redirect($this->referer);
  }

  public function actionReg() {
    if (!Yii::app()->user->isGuest) {
      $this->message(0, '您已登录，请勿重复操作');
    }
    $model = new Users();
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-addUser-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
    if (isset($_POST['Users'])) {
      if (UserAction::checkRegTimes()) {
        $this->message(0, '您今天的注册次数已用完');
      }
      $username = zmf::filterInput($_POST['Users']['username'], 't', 1);
      $truename = zmf::filterInput($_POST['Users']['truename'], 't', 1);
      $inputData = array(
          'username' => $username,
          'truename' => $truename,
          'password' => md5($_POST['Users']['password']),
          'email' => zmf::filterInput($_POST['Users']['email'], 't', 1),
          'cTime' => time(),
          'register_time' => time(),
          'last_login_time' => time(),
          'groupid' => zmf::config('userDefaultGroup'),
          'register_ip' => ip2long(Yii::app()->request->userHostAddress),
          'last_login_ip' => ip2long(Yii::app()->request->userHostAddress),
      );
      $model->attributes = $inputData;
      if ($model->validate()) {
        if ($model->save()) {
          $_model = new LoginForm;
          $_model->username = $username;
          $_model->password = $_POST['Users']['password'];
          $_model->login();
          if ($this->referer == '') {
            $this->referer = zmf::config('baseurl');
          }
          $this->redirect($this->referer);
        }
      }
    } else {
      $this->newMembers = Users::getNew();
    }
    $data = array(
        'model' => $model
    );
    $this->pageTitle = '免费注册 - ' . zmf::config('sitename');
    $this->render('addUser', $data);
  }

  public function actionSitemap() {
    $page=$_GET['id'];
    $page=isset($page) ? $page :1;
    $dir = Yii::app()->basePath . '/runtime/site/sitemap'.$page.'.xml';
    $a=$_GET['a'];
    $obj = new Sitemap();    
    if($a=='update' || !file_exists($dir)){
      $limit=10000;
      $start=($page-1)*$limit;
      $rss = $obj->show(Posts::CLASSIFY_POST,$start,$limit);
      if($rss){
        $obj->saveToFile($dir);
      }else{
        exit($page.'-->empty');
      }      
    }else{
      $rss=$obj->getFile($dir);  
    }
    //rss创建
    $this->render('//site/sitemap', array('rss' => $rss));
  }

}
