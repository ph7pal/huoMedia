<?php

class AjaxController extends Q {

    public function init() {
        parent::init();
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
    }

    private function checkLogin() {
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
    }
    
    public function actionFeedback() {
        $content = zmf::val('content', 1);
        if (!$content) {
            $this->jsonOutPut(0, '内容不能为空哦~');
        }
        //一个小时内最多只能反馈5条
        if (zmf::actionLimit('feedback', '', 5, 3600)) {
            $this->jsonOutPut(0, '操作太频繁，请稍后再试');
        }
        $attr['uid'] = $this->uid;
        $attr['type'] = 'web';
        $attr['contact'] = zmf::val('email', 1);
        $attr['appinfo'] = zmf::val('url', 1);
        $attr['sysinfo'] = Yii::app()->request->userAgent;
        $attr['content'] = $content;
        $model = new Feedback();
        $model->attributes = $attr;
        if ($model->validate()) {
            if ($model->save()) {
                $this->jsonOutPut(1, '感谢您的反馈');
            } else {
                $this->jsonOutPut(1, '感谢您的反馈');
            }
        } else {
            $this->jsonOutPut(0, '反馈失败，请重试');
        }
    }

    public function actionDelContent() {
        $this->checkLogin();
        $data = zmf::val('data', 1);
        $type = zmf::val('type', 1);
        if (!$data || !$type) {
            $this->jsonOutPut(0, '数据不全，请核实');
        }
        if (!in_array($type, array('comment', 'post', 'notice', 'tag'))) {
            $this->jsonOutPut(0, '暂不允许的分类');
        }
        switch ($type) {
            case 'comment':
                $info = Comments::model()->findByPk($data);
                if (!$info) {
                    $this->jsonOutPut(0, '您所查看的内容不存在');
                } elseif ($info['uid'] != $this->uid) {
                    if ($this->checkPower('delComment', $this->uid, true)) {
                        //我是管理员，我就可以删除
                    } else {
                        $this->jsonOutPut(0, '您无权操作');
                    }
                }
                if (Comments::model()->updateByPk($data, array('status' => Posts::STATUS_DELED))) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            case 'post':
                $info = Posts::model()->findByPk($data);
                if (!$info) {
                    $this->jsonOutPut(0, '您所查看的内容不存在');
                } elseif ($info['uid'] != $this->uid) {
                    if ($this->checkPower('delPost', $this->uid, true)) {
                        //我是管理员，我就可以删除
                    } else {
                        $this->jsonOutPut(0, '您无权操作');
                    }
                }
                if (Posts::model()->updateByPk($data, array('status' => Posts::STATUS_DELED))) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            case 'notice':
                if (!$data || !is_numeric($data)) {
                    $this->jsonOutPut(0, '您所操作的内容不存在');
                }
                if (Notification::model()->deleteByPk($data)) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            case 'tag':
                if (!$data || !is_numeric($data)) {
                    $this->jsonOutPut(0, '您所操作的内容不存在');
                }
                if (!$this->checkPower('delTag', $this->uid, true)) {
                    $this->jsonOutPut(0, '您无权操作');
                }
                if (Tags::model()->updateByPk($data, array('status' => Posts::STATUS_DELED))) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            default:
                $this->jsonOutPut(0, '操作有误');
                break;
        }
    }

    public function actionSetStatus() {
        $this->checkLogin();
        $keyid = zmf::val('a', 2);
        $classify = zmf::val('b', 1);
        $_status = zmf::val('c', 1);
        if (!$keyid) {
            $this->jsonOutPut(0, '请选择对象');
        }
        if (!in_array($classify, array('posts', 'comments'))) {
            $this->jsonOutPut(0, '不允许的类型');
        }
        if (!in_array($_status, array('del', 'passed'))) {
            $this->jsonOutPut(0, '不允许的类型');
        }
        if ($_status == 'top') {
            if ($classify == 'posts') {
                $attr = array(
                    'top' => 1,
                    'updateTime' => zmf::now()
                );
            } else {
                $attr = array(
                    'top' => 1
                );
            }
        } else if ($_status == 'canceltop') {
            $attr = array(
                'top' => 0,
            );
        } else if ($_status == 'del') {
            $attr = array(
                'status' => Posts::STATUS_DELED,
            );
        } else if ($_status == 'passed') {
            $attr = array(
                'status' => Posts::STATUS_PASSED,
            );
        }
        $ucClassify = ucfirst($classify);
        if (!class_exists($ucClassify)) {
            $this->jsonOutPut(0, '不存在的类型');
        }
        $model = new $ucClassify;
        if ($model->updateByPk($keyid, $attr)) {
            if($classify=='comments'){
                Posts::updateCommentsNum($keyid);
            }
            $this->jsonOutPut(1, '操作成功');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

    public function actionAreaChildren(){
        $id=  zmf::val('areaid', 2);
        $type=  zmf::val('type', 1);
        if(!$id){
            $this->jsonOutPut(0, '请选择地区');
        }
        if($type=='area'){
            $name='areaFirst';
        }elseif($type=='areaFirst'){
            $name='areaSecond';
        }
        $areas=  Area::model()->findAll(array(
            'condition'=>'pid=:id',
            'order'=>'`order` ASC',
            'select'=>'area_id,title',
            'params'=>array(
                ':id'=>$id
            )
        ));
        if(empty($areas)){
            $this->jsonOutPut(1, '');
        }
        $this->jsonOutPut(1, CHtml::dropDownList($name, '', CHtml::listData($areas, 'area_id', 'title'), array('class'=>'form-control','empty'=>'--请选择--','onclick'=>'getAreaChildren("'.$name.'");')));
    }

}
