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
