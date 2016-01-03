<?php

class SiteController extends Admin {

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

    function actionLogin() {
        $this->layout='common';
        if (!Yii::app()->user->isGuest) {
            $this->message(0, '您已登录，请勿重复操作', Yii::app()->createUrl('admin/index/index'));
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
                    'latestLoginTime' => zmf::now(),
                );
                $uid = Yii::app()->user->id;
                if (!$this->checkPower('user', $uid, true)) {
                    Yii::app()->user->logout();
                    $model->addError('username', '您不是管理员');
                } else {
                    //User::model()->updateByPk($uid, $arr);
                    zmf::delCookie('checkWithCaptcha');
                    //只允许单点登录
                    $randKey = zmf::randMykeys(8);
                    zmf::setCookie('adminRandKey' . $uid, $randKey, 86400);
                    zmf::setFCache('adminRandKey' . $uid, $randKey, 86400);
                    //记录操作
                    //UserLog::add($uid, '登录后台'.Yii::app()->request->userHostAddress);
                    $uuid = zmf::uuid();
                    zmf::setCookie('userCheckedLogin' . $uid, $uuid, 86400); 
                    $this->redirect(array('index/index'));
                }
            } else {
                $times = zmf::getCookie('checkWithCaptcha');
                zmf::setCookie('checkWithCaptcha', (intval($times) + 1), 86400);
            }
        }
        $data = array(
            'model' => $model
        );
        $this->render('login', $data);
    }

    function actionLogout() {
        if (Yii::app()->user->isGuest) {
            $this->message(0, '您尚未登录');
        }
        $uid = zmf::uid();
        zmf::delCookie('adminRandKey' . $uid);
        zmf::delFCache('adminRandKey' . $uid);
        Yii::app()->user->logout();
        $this->redirect(array('site/login'));
    }

    function actionNavbar() {
        $this->render('navbar');
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            $outPutData = array(
                'status' => 0,
                'msg' => $error['message'],
                'code' => $error['code']
            );
            $json = CJSON::encode($outPutData);
            header("Content-type:application/json;charset=UTF-8");
            echo $json;
            Yii::app()->end();
        }
    }

    function actionVisitStat() {
        $date = $_GET['date'];
        if (!$date) {
            $this->statByDay();
            Yii::app()->end();
        }
        $dir = Yii::app()->basePath . '/runtime/appLogs';
        $files = zmf::readDir($dir);
        $realFiles = $apiArr = $apiTimesArr = $apiTmpTimes = array();
        $sizeTotal = 0;
        foreach ($files as $file) {
            if (strpos($file, $date) !== false) {
                $_file = $dir . '/' . $file . '.txt';
                $_size = filesize($_file);
                $_content = file_get_contents($_file);
                preg_match_all('/api\/(.*?)\/(.*?)[\r\n\t|\?]\s*(.*?)[\r\n\t]/si', $_content, $_matches);
                foreach ($_matches[1] as $k => $v) {
                    $_api = $v . '/' . $_matches[2][$k];
                    $_time = $_matches[3][$k];
                    $apiTmpTimes[$_api]+=$_time;
                    $apiArr[$_api]+=1;
                }
                $sizeTotal+=$_size;
                $realFiles[] = array(
                    'file' => $file,
                    'fileSize' => $_size,
                    'cTime' => filectime($_file)
                );
            }
        }
        $realFiles = zmf::multi_array_sort($realFiles, 'cTime', SORT_ASC);
        foreach ($realFiles as $k => $v) {
            $realFiles[$k]['rate'] = number_format($v['fileSize'] / $sizeTotal * 100, 0, '.', '');
        }
        $apiTotal = array_sum($apiArr);
        natsort($apiArr);
        $data = array(
            'files' => $realFiles,
            'apiTotal' => $apiTotal,
            'apiArr' => $apiArr,
            'apiTimes' => $apiTmpTimes,
            'preDay' => zmf::time(strtotime($date, zmf::now()) - 86400, 'Y-m-d'),
            'nextDay' => zmf::time(strtotime($date, zmf::now()) + 86400, 'Y-m-d'),
        );
        $this->render('visitStat', $data);
    }

    private function statByDay() {
        $dir = Yii::app()->basePath . '/runtime/appLogs';
        $files = zmf::readDir($dir);
        $sizeTotal = $sizeTem=0;
        $realFiles =  array();
        foreach ($files as $file) {
            $_day = substr($file, 0,  strlen($file)-3);            
            $_fileTime=  str_replace('-', '', $_day);
            $_file = $dir . '/' . $file . '.txt';
            $_size = filesize($_file);
            $sizeTotal+=$_size;
            $realFiles[$_day]['fileSize']+=$_size;
            $realFiles[$_day]['cTime']=  $_fileTime;
        }
        foreach ($realFiles as $v){
            if($v['fileSize']>$sizeTem){
                $sizeTem=$v['fileSize'];
            }
        }
        foreach ($realFiles as $k => $v) {
            $realFiles[$k]['rate'] = number_format($v['fileSize'] / $sizeTem*100, 0, '.', '');
        }
        $realFiles=  zmf::multi_array_sort($realFiles, 'cTime', SORT_DESC);
        $data=array(
            'files'=>$realFiles,
            'totalSize'=>$sizeTotal,
        );
        $this->render('statByDay',$data);
    }

}
