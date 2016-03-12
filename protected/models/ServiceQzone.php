<?php

/**
 * This is the model class for table "{{service_qzone}}".
 * @filename {{service_qzone}}.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:44:57 
 * The followings are the available columns in table '{{service_qzone}}':
 * @property string $id
 * @property string $uid
 * @property string $nickname
 * @property string $url
 * @property string $favors
 * @property string $shuoshuo
 * @property string $cTime
 * @property integer $status
 */
class ServiceQzone extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_qzone}}';
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
            array('uid', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, cTime', 'length', 'max' => 10),
            array('nickname, url, favors, shuoshuo', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, nickname, url, favors, shuoshuo, cTime, status', 'safe', 'on' => 'search'),
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
            'nickname' => '昵称',
            'url' => '链接',
            'favors' => '粉丝数量',
            'shuoshuo' => '说说价格',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }
    
    public function beforeSave() {
        if ($this->url != '') {
            if (stripos($this->url, 'http://') === false && stripos($this->url, 'https://') === false) {
                $this->url = 'http://' . $this->url;
            }
        }
        return true;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('favors', $this->favors, true);
        $criteria->compare('shuoshuo', $this->shuoshuo, true);
        $criteria->compare('cTime', $this->cTime, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceQzone the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
