<?php

/**
 * This is the model class for table "{{service_weixin}}".
 * @filename {{service_weixin}}.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:50:12 
 * The followings are the available columns in table '{{service_weixin}}':
 * @property string $id
 * @property string $uid
 * @property string $classify
 * @property string $nickname
 * @property string $account
 * @property string $favors
 * @property string $danTuwen
 * @property string $duoTuwen
 * @property string $renzhen
 * @property string $cTime
 * @property integer $status
 */
class ServiceWeixin extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_weixin}}';
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
            array('uid, classify, cTime', 'length', 'max' => 10),
            array('nickname, account, favors, danTuwen, duoTuwen, renzhen', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, classify, nickname, account, favors, danTuwen, duoTuwen, renzhen, cTime, status', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'uid' => '作者ID',
            'classify' => '分类',
            'nickname' => '微信名称',
            'account' => '微信号',
            'favors' => '粉丝数量',
            'danTuwen' => '单图文价格',
            'duoTuwen' => '多图文价格',
            'renzhen' => '认证情况',
            'cTime' => '创建时间',
            'status' => '状态',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('classify', $this->classify, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('account', $this->account, true);
        $criteria->compare('favors', $this->favors, true);
        $criteria->compare('danTuwen', $this->danTuwen, true);
        $criteria->compare('duoTuwen', $this->duoTuwen, true);
        $criteria->compare('renzhen', $this->renzhen, true);
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
     * @return ServiceWeixin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function getTags() {
        $cacheKey = Posts::cacheKeys('weixinTags');
        $expire = Posts::CACHEEXPIRE;
        $posts = zmf::getFCache($cacheKey);
        if (!$posts) {
            $tags = Tags::model()->findAll(array(
                'condition' => "classify='weixinClassify'",
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
