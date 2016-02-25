<?php

/**
 * This is the model class for table "{{service_forums}}".
 *
 * The followings are the available columns in table '{{service_forums}}':
 * @property string $id
 * @property string $uid
 * @property string $classify
 * @property string $forum
 * @property string $type
 * @property string $url
 * @property string $forDigest
 * @property string $forDay
 * @property string $forWeek
 * @property string $forTwoWeek
 * @property string $forMonth
 * @property string $forQuarter
 * @property string $forHalfYear
 * @property string $forYear
 * @property string $cTime
 * @property integer $status
 */
class ServiceForums extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_forums}}';
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
            array('uid, classify, forum, type, url', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('uid, classify, forum, type, cTime', 'length', 'max' => 10),
            array('url, forDigest, forDay, forWeek, forTwoWeek, forMonth, forQuarter, forHalfYear, forYear', 'length', 'max' => 255),
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
            'forumInfo' => array(self::BELONGS_TO, 'Tags', 'forum'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '社区',
            'uid' => '作者ID',
            'classify' => '类别',
            'forum' => '社区',
            'type' => '板块',
            'url' => '板块链接',
            'forDigest' => '精华永久',
            'forDay' => '置顶一天',
            'forWeek' => '置顶一周',
            'forTwoWeek' => '置顶二周',
            'forMonth' => '置顶一月',
            'forQuarter' => '置顶一季度',
            'forHalfYear' => '置顶半年',
            'forYear' => '置顶一年',
            'cTime' => '创建时间',
            'status' => '状态',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceForums the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getTags() {
        $cacheKey = Posts::cacheKeys('blogTags');
        $expire = Posts::CACHEEXPIRE;
        $posts = zmf::getFCache($cacheKey);
        if (!$posts) {
            $tags = Tags::model()->findAll(array(
                'condition' => "(classify='forumClassify' OR classify='forumForum')",
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
