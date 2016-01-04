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
            array('uid,logid,tocommentid, cTime', 'length', 'max' => 11),
            array('content', 'length', 'max' => 255),
            array('platform, classify', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, logid,tocommentid, content, platform, classify, status, cTime', 'safe', 'on' => 'search'),
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
            'logid' => '文章ID',
            'tocommentid' => '回复楼层',
            'content' => '类型',
            'platform' => '平台',
            'classify' => '分类',
            'status' => '状态',
            'cTime' => '回复时间',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getSimpleInfo($keyid) {
        $info = Comments::model()->findByPk($keyid);
        return $info;
    }

    public static function getCommentsByPage($id, $classify, $page = 1, $pageSize = 30, $field = "id,uid,logid,tocommentid,content,cTime") {
        if (!$id || !$classify) {
            return array();
        }
        $page = $page <= 1 ? 1 : $page;
        $pageSize = !$pageSize ? 30 : $pageSize;
        $limitStart = ($page - 1) * $pageSize;
        $sql = "SELECT {$field} FROM {{comments}} WHERE logid='{$id}' AND classify='{$classify}' AND status=" . Posts::STATUS_PASSED . " ORDER BY cTime LIMIT {$limitStart},{$pageSize}";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        return $items;
    }

}
