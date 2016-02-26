<?php

/**
 * This is the model class for table "{{service_medias}}".
 *
 * The followings are the available columns in table '{{service_medias}}':
 * @property string $id
 * @property string $uid
 * @property string $classify
 * @property string $isSource
 * @property string $hasLink
 * @property string $title
 * @property string $url
 * @property string $price
 * @property string $postscript
 * @property string $cTime
 * @property integer $status
 */
class ServiceMedias extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_medias}}';
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
            array('uid, classify, title, url, price', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, classify, isSource, hasLink, cTime', 'length', 'max' => 10),
            array('title, url, price, postscript', 'length', 'max' => 255),
            array('title', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'classifyInfo' => array(self::BELONGS_TO, 'Tags', 'classify'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '媒体',
            'uid' => '作者ID',
            'classify' => '类型',
            'isSource' => '是否新闻源',
            'hasLink' => '带链接情况',
            'title' => '媒体名称',
            'url' => '发稿案例网址',
            'price' => '零售价',
            'postscript' => '备注',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('title', $this->title, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function beforeSave() {
        if($this->url!=''){
            if (stripos($this->url, 'http://') === false && stripos($this->url, 'https://') === false){
                $this->url='http://'.$this->url;
            }
        }
        return true;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceMedias the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function isSource($return = '') {
        $arr = array(
            '1000' => '百度新闻源',
            '1001' => '网易新闻源',
            '1002' => '搜狐新闻源',
            '1003' => '新浪新闻源',
        );
        if ($return == 'returnArr') {
            $returnArr = array();
            foreach ($arr as $k => $v) {
                $returnArr[] = array(
                    'id' => $k,
                    'title' => $v,
                );
            }
            return $returnArr;
        } elseif ($return != 'admin') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function hasLink($return = '') {
        $arr = array(
            '1' => '不能带网址',
            '2' => '可带网址',
            '3' => '可做关键词超链',
        );
        if ($return == 'returnArr') {
            $returnArr = array();
            foreach ($arr as $k => $v) {
                $returnArr[] = array(
                    'id' => $k,
                    'title' => $v,
                );
            }
            return $returnArr;
        } elseif ($return != 'admin') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function getTags() {
        $cacheKey = Posts::cacheKeys('blogTags');
        $expire = Posts::CACHEEXPIRE;
        $posts = zmf::getFCache($cacheKey);
        if (!$posts) {
            $tags = Tags::model()->findAll(array(
                'condition' => "(classify='mediaClassify')",
                'select' => 'id,title,classify'
            ));
            if (empty($tags)) {
                return array();
            }
            $posts = array();
            foreach ($tags as $tag) {
                $_label = Tags::classify($tag['classify']);
                $posts[$tag['classify']]['label'] = $_label;
                $posts[$tag['classify']]['items'][] = array(
                    'id' => $tag['id'],
                    'title' => $tag['title'],
                );
            }
            zmf::setFCache($cacheKey, $posts, $expire);
        }
        return $posts;
    }

}
