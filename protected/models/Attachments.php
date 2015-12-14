<?php

class Attachments extends CActiveRecord {

    public function tableName() {
        return '{{attachments}}';
    }

    public function rules() {
        return array(
            array('covered, status,areaid', 'numerical', 'integerOnly' => true),
            array('uid, logid, hits, cTime,areaid,comments', 'length', 'max' => 11),
            array('filePath, fileDesc, classify, width, height, size,remote', 'length', 'max' => 255),
            array('id, uid, logid, filePath, fileDesc, classify, width, height, size, covered, hits, cTime, status,remote,areaid', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'authorInfo' => array(self::BELONGS_TO, 'Users', 'uid'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uid' => '作者',
            'logid' => '所属',
            'filePath' => '文件名',
            'fileDesc' => '描述',
            'classify' => '分类',
            'width' => '宽',
            'height' => '高',
            'size' => '大小',
            'covered' => '置顶',
            'hits' => '点击',
            'cTime' => '创建时间',
            'status' => '状态',
            'favor' => '赞',
            'remote' => '远程路径',
            'areaid' => '所属地区',
            'comments' => '评论数',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id, true);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('logid', $this->logid, true);
        $criteria->compare('classify', $this->classify, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 根据单条图片信息返回存放地址
     * @param type $data
     * @return string
     */
    public function getUrl($data) {
        $_imgurl = zmf::uploadDirs($data['cTime'], 'site', $data['classify'], 170) . $data['filePath'];
        return $_imgurl;
    }

    public static function tops($limit = 10, $faces = false) {
        if ($faces) {
            $where = 'WHERE covered=1 AND status=' . Posts::STATUS_PASSED;
        } else {
            $where = 'status=' . Posts::STATUS_PASSED;
        }
        $sql = "SELECT * FROM {{attachments}} {$where} ORDER BY hits LIMIT {$limit}";
        $info = Yii::app()->db->createCommand($sql)->queryAll();
        return $info;
    }

    public static function getColImgs($colid, $order = 'hits', $limit = 10) {
        if (!$colid) {
            return false;
        }
        $_info = zmf::getFCache("getColImgs{$colid}-{$order}-{$limit}");
        if ($_info) {
            //return $_info; 
        }
        $sql = "SELECT id FROM {{posts}} WHERE colid={$colid} AND status=" . Posts::STATUS_PASSED;
        $info = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($info)) {
            return false;
        }
        $idsArr = array();
        foreach ($info as $i) {
            $idsArr[] = $i['id'];
        }
        $ids = join(',', $idsArr);
        if ($ids == '') {
            return false;
        }
        $_sql = "SELECT logid,filePath,classify FROM {{attachments}} WHERE logid IN({$ids}) AND status=" . Posts::STATUS_PASSED . " ORDER BY {$order} LIMIT 0,{$limit}";
        $_info = Yii::app()->db->createCommand($_sql)->queryAll();
        zmf::setFCache("getColImgs{$colid}-{$order}-{$limit}", $_info, 3600);
        return $_info;
    }

    public function getClassify($type, $keyid = '') {
        if ($type == 'ads') {
            $_title = '展示';
            $arr = '';
        } elseif ($type == 'logo') {
            $_title = 'Logo封面';
        } elseif ($type == 'coverimg') {
            $_info = Posts::getOne($keyid, 'title');
            $_title = '文章【' . $_info . '】封面';
        } elseif ($type == 'album') {
            $_title = '相册';
        } else {
            $_title = '暂未完善该分类';
        }
        return $_title;
    }

    /**
     * 返回坐标的封面图
     * @param type $poiInfo
     * @param type $size
     * @return string
     */
    public static function faceImg($poiInfo, $size = '170') {
        $url = '';
        if ($poiInfo['faceimg']) {
            $info = Attachments::getOne($poiInfo['faceimg']);
            if ($info) {
                $url = zmf::uploadDirs($info['cTime'], 'site', $info['classify'], $size) . $info['filePath'];
            }
        }
        return $url;
    }
    
    /**
     * 根据图片ID返回图片信息
     * @param type $id
     * @return boolean
     */
    public static function getOne($id){
        if(!$id || !is_numeric($id)){
            return false;
        }
        //todo，图片分表，将图片表分为attachments0~9
        return Attachments::model()->findByPk($id);
    }

}
