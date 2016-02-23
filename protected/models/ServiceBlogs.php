<?php

/**
 * This is the model class for table "{{service_blogs}}".
 *
 * The followings are the available columns in table '{{service_blogs}}':
 * @property string $id
 * @property string $uid
 * @property string $type
 * @property string $classify
 * @property string $level
 * @property string $area
 * @property string $url
 * @property string $hits
 * @property string $price
 * @property string $cTime
 * @property integer $status
 */
class ServiceBlogs extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_blogs}}';
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
            array('uid, type, classify, level, area, url, hits, price', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, type, classify, level, area, cTime', 'length', 'max' => 10),
            array('url, hits, price', 'length', 'max' => 255),
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
            'id' => '博客',
            'uid' => '作者ID',
            'type' => '博客归属',
            'classify' => '类型',
            'level' => '级别',
            'area' => '地区',
            'url' => '主页地址',
            'hits' => '点击量',
            'price' => '价格',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceBlogs the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function level($return = '') {
        $arr = array(
            '十万' => '十万',
            '百万' => '百万',
            '千万' => '千万',
            '亿' => '亿',
            '十亿' => '十亿',
        );
        if ($return != 'admin') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

}
