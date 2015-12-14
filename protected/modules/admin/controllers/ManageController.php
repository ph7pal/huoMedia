<?php

class ManageController extends H {

    public function actionTable() {
        $keyid = zmf::filterInput($_POST['id']);
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (!$keyid || !is_numeric($keyid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        $type = zmf::filterInput($_POST['type'], 't', 1);
        //$this->checkPower($type . 'shopping', true);
        if ($type === 'passed') {
            $status = '1';
        } elseif ($type === 'notpassed') {
            $status = '0';
        } elseif ($type === 'del') {
            $status = '3';
        } elseif ($type === 'shiftDel') {
            $status = '4';
        } elseif ($type === 'staycheck') {
            $status = '2';
        } else {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        $table = zmf::filterInput($_POST['table'], 't', 1);
        if(!$table){
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        $ucTable=  ucfirst($table);
        if(!class_exists($ucTable)){
            $this->jsonOutPut(0, '不存在的Table');
        }
        $model=new $ucTable;
        $sinfo = $model->findByPk($keyid);
        if (empty($sinfo)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if($table=='users'){
            if($sinfo['system']){
                $this->jsonOutPut(0, '该用户为系统用户，禁止操作！');
            }
        }
        if ($model->updateByPk($keyid, array('status' => $status))) {
            $this->jsonOutPut(1, '操作成功！');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

}