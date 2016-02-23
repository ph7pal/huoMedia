<?php

/**
 * This is the model class for table "{{service_websites}}".
 *
 * The followings are the available columns in table '{{service_websites}}':
 * @property string $id
 * @property string $uid
 * @property string $type
 * @property string $classify
 * @property string $nickname
 * @property integer $sex
 * @property string $area
 * @property string $url
 * @property string $favors
 * @property string $vipInfo
 * @property string $price
 * @property string $postscript
 * @property string $cTime
 * @property integer $status
 */
class ServiceWebsites extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_websites}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid', 'default', 'setOnEmpty' => true, 'value' => zmf::uid()),
            array('cTime', 'default', 'setOnEmpty' => true, 'value' => zmf::now()),
            array('status', 'default', 'setOnEmpty' => true, 'value' => Posts::STATUS_PASSED),
            array('uid, type, classify, nickname, sex, area, url, favors, vipInfo, price', 'required'),
            array('sex, status', 'numerical', 'integerOnly' => true),
            array('uid, type, classify, area, cTime', 'length', 'max' => 10),
            array('nickname, url, favors, vipInfo, price, postscript', 'length', 'max' => 255),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uid' => '作者ID',
            'type' => '网站分类，如美丽说、人人等',
            'classify' => '分类',
            'nickname' => '昵称',
            'sex' => '性别',
            'area' => '地区',
            'url' => '链接',
            'favors' => '好友数量',
            'vipInfo' => '会员',
            'price' => '价格',
            'postscript' => '备注',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceWebsites the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
