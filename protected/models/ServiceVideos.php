<?php

/**
 * This is the model class for table "{{service_videos}}".
 *
 * The followings are the available columns in table '{{service_videos}}':
 * @property string $id
 * @property string $uid
 * @property string $type
 * @property string $classify
 * @property string $position
 * @property string $url
 * @property string $stayTime
 * @property string $price
 * @property string $cTime
 * @property integer $status
 */
class ServiceVideos extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_videos}}';
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
            array('uid, type, classify, position, url, stayTime, price', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, type, cTime', 'length', 'max' => 10),
            array('classify, position, url, stayTime, price', 'length', 'max' => 255),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'typeInfo' => array(self::BELONGS_TO, 'Tags', 'type'),
            'classifyInfo' => array(self::BELONGS_TO, 'Tags', 'classify'),
            'positionInfo' => array(self::BELONGS_TO, 'Tags', 'position'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '视频',
            'uid' => '作者ID',
            'type' => '视频网站',
            'classify' => '类别',
            'position' => '所在位置',
            'url' => '网站地址',
            'stayTime' => '保持时间',
            'price' => '价格',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceVideos the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
