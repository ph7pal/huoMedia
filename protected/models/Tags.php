<?php

class Tags extends CActiveRecord {

    public function tableName() {
        return '{{tags}}';
    }

    public function rules() {
        return array(
            array('title,classify', 'required'),
            array('cTime', 'default', 'setOnEmpty' => true, 'value' => zmf::now()),
            array('hits,cTime,posts,length,pid', 'length', 'max' => 10),
            array('title', 'length', 'max' => 255),
            array('name, classify', 'length', 'max' => 32),
            array('status', 'numerical', 'integerOnly' => true),
            array('title, name', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => '名称',
            'name' => '拼音',
            'classify' => '分类',
            'hits' => '点击',
            'cTime' => '创建时间',
            'status' => '状态',
            'posts' => '文章数量',
            'length' => '名称长度',
            'pid' => '所属标签',
        );
    }

    public function beforeSave() {
        $this->name = zmf::pinyin($this->title);
        $this->length = mb_strlen($this->title, 'GBK');
        return true;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function suggestTags($keyword, $limit = 10, $type = '') {
        if (!$keyword) {
            return false;
        }
        $items = Tags::model()->findAll(array(
            'condition' => '(title LIKE :keyword OR name LIKE :keyword)' . ($type != '' ? " AND classify='{$type}'" : ''),
            'order' => 'length ASC',
            'limit' => $limit,
            'params' => array(
                ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%'
            ),
        ));

        return $items;
    }

    public static function getSimpleInfo($keyid) {
        $info = Tags::model()->findByPk($keyid);
        return $info;
    }

    public static function findAndAdd($title, $classify, $logid) {
        $title = zmf::filterInput($title, 't', 1);
        if (!$title) {
            return false;
        }
        $info = Tags::model()->find('title=:title AND classify=:classify', array(':title' => $title, ':classify' => $classify));
        if (!$info) {
            if (Yii::app()->session['checkHasBadword'] == 'yes') {
                $status = Posts::STATUS_STAYCHECK;
            } else {
                $status = Posts::STATUS_PASSED;
            }
            unset(Yii::app()->session['checkHasBadword']);
            $_data = array(
                'title' => $title,
                'name' => zmf::pinyin($title),
                'classify' => $classify,
                'status' => $status,
                'cTime' => time(),
                'length' => mb_strlen($title, 'GBK')
            );
            $modelB = new Tags;
            $modelB->attributes = $_data;
            if ($modelB->save()) {
                $tagid = $modelB->id;
            }
        } else {
            $tagid = $info['id'];
        }
        if ($tagid && $logid) {
            $_info = TagRelation::model()->find('tagid=:tagid AND logid=:logid AND classify=:classify', array(':tagid' => $tagid, ':logid' => $logid, ':classify' => $classify));
            if (!$_info) {
                $_tagre = array(
                    'tagid' => $tagid,
                    'logid' => $logid,
                    'classify' => $classify,
                    'cTime' => zmf::now()
                );
                $modelC = new TagRelation;
                $modelC->attributes = $_tagre;
                $modelC->save();
            }
        }
        return $tagid;
    }

    public static function classify($return = '') {
        $arr = array(
            //'posts' => '文章',
            'forumClassify' => '社区类别',
            'forumForum' => '社区',
            'forumType' => '社区板块',
            'blogType' => '博客归属',
            'blogClassify' => '博客类型',
            'mediaClassify' => '媒体类型',
            'videoType' => '视频网站',
            'videoClassify' => '视频类别',
            'videoPosition' => '视频位置',
        );
        if ($return != 'admin') {
            return $arr[$return];
        } else {
            return $arr;
        }
    }

    public static function addRelation($tagid, $logid, $classify) {
        if (!$tagid || !$logid || !$classify) {
            return false;
        }
        $_info = TagRelation::model()->find('tagid=:tagid AND logid=:logid AND classify=:classify', array(':tagid' => $tagid, ':logid' => $logid, ':classify' => $classify));
        if (!$_info) {
            $_tagre = array(
                'tagid' => $tagid,
                'logid' => $logid,
                'classify' => $classify,
                'cTime' => zmf::now()
            );
            $modelC = new TagRelation;
            $modelC->attributes = $_tagre;
            return $modelC->save();
        }
        return true;
    }

    public static function getClassifyTags($classify) {
        $items = Tags::model()->findAll(array(
            'condition' => 'classify=:class',
            'params' => array(
                ':class' => $classify
            ),
            'select' => 'id,title',
            'limit' => '50'
        ));
        return CHtml::listData($items, 'id', 'title');
    }

    public static function getByIds($ids) {
        if (!$ids) {
            return false;
        }
        $sql = "SELECT id,title FROM {{tags}} WHERE id IN($ids) ORDER BY FIELD(id,$ids)";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        return $items;
    }

}
