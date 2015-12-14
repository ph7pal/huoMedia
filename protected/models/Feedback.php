<?php

class Feedback extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{feedback}}';
    }

    public function rules() {
        return array(
            array('content', 'required'),
            array('cTime, status', 'numerical', 'integerOnly' => true),
            array('uid', 'length', 'max' => 11),
            array('url, email, ip, appversion, os, platform', 'length', 'max' => 255),
            array('content', 'length', 'max' => 15000),
            array('classify', 'length', 'max' => 16),
            array('content', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uid' => '作者',
            'url' => '当页地址',
            'email' => '联系方式',
            'content' => '反馈内容',
            'ip' => '所在IP',
            'cTime' => '反馈时间',
            'status' => '处理状态',
            'classify' => '反馈分类',
            'appversion' => 'Appversion',
            'os' => 'Os',
            'platform' => '来源',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('content', $this->content, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
