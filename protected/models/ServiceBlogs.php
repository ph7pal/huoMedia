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
            array('uid', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, type, classify, level, area, cTime', 'length', 'max' => 10),
            array('url, hits, price,location,nickname', 'length', 'max' => 255),
            array('nickname', 'safe', 'on' => 'search'),
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
            'nickname' => '昵称',
            'area' => '地区',
            'location' => '地区',
            'url' => '主页地址',
            'hits' => '点击量',
            'price' => '价格',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('nickname', $this->nickname, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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

    public function beforeSave() {
        $this->location = Area::getBelongInfo($this->area);
        if($this->url!=''){
            if (stripos($this->url, 'http://') === false && stripos($this->url, 'https://') === false){
                $this->url='http://'.$this->url;
            }
        }
        return true;
    }

    public static function level($return = '') {
        $arr = array(
            '1000' => '十万',
            '1001' => '百万',
            '1002' => '千万',
            '1003' => '亿',
            '1004' => '十亿',
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
        $expire=  Posts::CACHEEXPIRE;
        $posts = zmf::getFCache($cacheKey);
        if (!$posts) {
            $tags = Tags::model()->findAll(array(
                'condition' => "(classify='blogType' OR classify='blogClassify')",
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
            $posts['level'] = array(
                'label' => '级别',
                'items' => self::level('returnArr'),
            );
            zmf::setFCache($cacheKey, $posts, $expire);
        }
        return $posts;
    }

}
