<?php

/**
 * This is the model class for table "{{posts}}".
 *
 * The followings are the available columns in table '{{posts}}':
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $content
 * @property integer $faceimg
 * @property integer $classify
 * @property string $lat
 * @property string $long
 * @property integer $mapZoom
 * @property integer $comments
 * @property string $favors
 * @property string $favorite
 * @property integer $top
 * @property integer $hits
 * @property string $tagids
 * @property integer $status
 * @property integer $cTime
 * @property integer $updateTime
 */
class Posts extends CActiveRecord {

    const STATUS_NOTPASSED = 0;
    const STATUS_PASSED = 1;
    const STATUS_STAYCHECK = 2;
    const STATUS_DELED = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{posts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid, title, content', 'required'),
            array('uid, faceimg, classify, mapZoom, comments, top, hits, status, cTime, updateTime', 'numerical', 'integerOnly' => true),
            array('title, tagids', 'length', 'max' => 255),
            array('lat, long', 'length', 'max' => 50),
            array('favors', 'length', 'max' => 11),
            array('favorite', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, title, content, faceimg, classify, lat, long, mapZoom, comments, favors, favorite, top, hits, tagids, status, cTime, updateTime', 'safe', 'on' => 'search'),
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
            'title' => '标题',
            'content' => '正文',
            'faceimg' => '封面图',
            'classify' => '分类',
            'lat' => '纬度',
            'long' => '经度',
            'mapZoom' => '地图缩放级别',
            'comments' => '评论数',
            'favors' => '点赞数',
            'favorite' => '收藏数',
            'top' => '是否置顶',
            'hits' => '阅读数',
            'tagids' => '标签组',
            'status' => 'Status',
            'cTime' => '创建世界',
            'updateTime' => '最近更新时间',
        );
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

        $criteria->compare('id', $this->id);
        $criteria->compare('uid', $this->uid);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('faceimg', $this->faceimg);
        $criteria->compare('classify', $this->classify);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('long', $this->long, true);
        $criteria->compare('mapZoom', $this->mapZoom);
        $criteria->compare('comments', $this->comments);
        $criteria->compare('favors', $this->favors, true);
        $criteria->compare('favorite', $this->favorite, true);
        $criteria->compare('top', $this->top);
        $criteria->compare('hits', $this->hits);
        $criteria->compare('tagids', $this->tagids, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cTime', $this->cTime);
        $criteria->compare('updateTime', $this->updateTime);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Posts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
