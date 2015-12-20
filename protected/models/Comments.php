<?php

class Comments extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{comments}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(            
            array('uid, logid,content,classify, status, cTime', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, touid, logid, commentid, tocommentid, cTime', 'length', 'max' => 11),
            array('content', 'length', 'max' => 255),
            array('platform, classify', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, touid, logid, commentid, tocommentid, content, platform, classify, status, cTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'authorInfo' => array(self::BELONGS_TO, 'Users', 'uid'),
            'postInfo' => array(self::BELONGS_TO, 'Posts', 'logid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uid' => '作者',
            'touid' => '回复某人',
            'logid' => '文章ID',
            'commentid' => '文章',
            'tocommentid' => '回复楼层',
            'content' => '类型',
            'platform' => '平台',
            'classify' => '分类',
            'status' => '状态',
            'cTime' => '回复时间',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('touid', $this->touid, true);
        $criteria->compare('logid', $this->logid, true);
        $criteria->compare('commentid', $this->commentid, true);
        $criteria->compare('tocommentid', $this->tocommentid, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('platform', $this->platform, true);
        $criteria->compare('classify', $this->classify, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    

    public static function getSimpleInfo($keyid) {
        $info = Comments::model()->findByPk($keyid);
        return $info;
    }

}
