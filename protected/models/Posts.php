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
            array('uid', 'default', 'setOnEmpty' => true, 'value' => zmf::uid()),
            array('cTime,updateTime', 'default', 'setOnEmpty' => true, 'value' => zmf::now()),
            array('status', 'default', 'setOnEmpty' => true, 'value' => Posts::STATUS_PASSED),
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
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Posts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function encode($id, $type = 'post') {
        return zmf::jiaMi($id . '#' . $type);
    }

    public static function decode($code) {
        $_de = zmf::jieMi($code);
        $_arr = explode('#', $_de);
        return array(
            'id' => $_arr[0],
            'type' => $_arr[1],
        );
    }

    /**
     * 更新查看次数
     * @param type $keyid 对象ID
     * @param type $type 对象类型
     * @param type $num 更新数量
     * @param type $field 更新字段
     * @return boolean
     */
    public static function updateCount($keyid, $type, $num = 1, $field = 'hits') {
        if (!$keyid || !$type || !in_array($type, array('Posts'))) {
            return false;
        }
        $model = new $type;
        return $model->updateCounters(array($field => $num), ':id=id', array(':id' => $keyid));
    }

    /**
     * 处理内容
     * @param type $content
     * @return type
     */
    public static function handleContent($content) {
        $pattern = "/<[img|IMG].*?data=[\'|\"](.*?)[\'|\"].*?[\/]?>/i";
        preg_match_all($pattern, $content, $match);
        $arr_attachids = array();
        if (!empty($match[0])) {
            $arr = array();
            foreach ($match[0] as $key => $val) {
                $_key = $match[1][$key];
                $arr[$_key] = $val;
                $arr_attachids[] = $match[1][$key];
            }
            if (!empty($arr)) {
                foreach ($arr as $thekey => $imgsrc) {
                    $content = str_ireplace("{$imgsrc}", '[attach]' . $thekey . '[/attach]', $content);
                }
            }
        }
        $content = strip_tags($content, '<b><strong><em><span><a><p><u><i><img><br><br/>');
        $replace = array(
            "/style=\"[^\"]*?\"/i"
        );
        $to = array(
            ''
        );
        $content = preg_replace($replace, $to, $content);
        $data = array(
            'content' => $content,
            'attachids' => $arr_attachids,
        );
        return $data;
    }

    public static function getAll($params, &$pages, &$comLists) {
        $sql = $params['sql'];
        if (!$sql) {
            return false;
        }
        $pageSize = $params['pageSize'];
        $_size = isset($pageSize) ? $pageSize : 30;
        $com = Yii::app()->db->createCommand($sql)->query();
        //添加限制，最多取1000条记录
        //todo，按不同情况分不同最大条数
        $total = $com->rowCount > 1000 ? 1000 : $com->rowCount;
        $pages = new CPagination($total);
        $criteria = new CDbCriteria();
        $pages->pageSize = $_size;
        $pages->applylimit($criteria);
        $com = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $com->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $com->bindValue(':limit', $pages->pageSize);
        $comLists = $com->queryAll();
    }

    public static function getTopsByTag($tagid, $limit = 5) {
        $sql = "SELECT p.id,p.title FROM {{posts}} p,{{tag_relation}} tr WHERE tr.tagid='{$tagid}' AND tr.classify='posts' AND tr.logid=p.id AND p.status=" . self::STATUS_PASSED . " ORDER BY hits DESC LIMIT {$limit}";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        return $items;
    }

    public static function favorite($code, $type, $from = 'web', $uid = '') {
        if (!$code || !$type) {
            return array('status' => 0, 'msg' => '数据不全，请核实');
        }
        if (!in_array($type, array('post'))) {
            return array('status' => 0, 'msg' => '暂不允许的分类');
        }
        if (is_numeric($code)) {
            $id = $code;
        } else {
            $codeArr = Posts::decode($code);
            if ($codeArr['type'] != $type || !is_numeric($codeArr['id']) || $codeArr['id'] < 1) {
                $this->jsonOutPut(0, '您所查看的内容不存在');
            }
            $id = $codeArr['id'];
        }
        if ($from == 'web') {
            if (zmf::actionLimit('favorite-' . $type, $id)) {
                return array('status' => 0, 'msg' => '操作太频繁，请稍后再试');
            }
            if(!$uid){
                $uid = zmf::uid();
            }
        }
        if(!$uid){
            return array('status' => 0, 'msg' => '请先登录');
        }

        $attr = array(
            'uid' => $uid,
            'logid' => $id,
            'classify' => $type
        );
        $info = Favorites::model()->findByAttributes($attr);
        if ($info) {
            if (Favorites::model()->deleteByPk($info['id'])) {
                if ($type == 'post') {
                    Posts::updateCount($id, 'Posts', -1, 'favorite');
                }
                return array('status' => 1, 'msg' => '取消收藏成功', 'state' => 3);
            } else {
                return array('status' => 0, 'msg' => '取消收藏失败', 'state' => 4);
            }
        } else {
            $attr['cTime'] = zmf::now();
            $model = new Favorites();
            $model->attributes = $attr;
            if ($model->save()) {
                if ($type == 'post') {
                    Posts::updateCount($id, 'Posts', 1, 'favorite');
                }
                return array('status' => 1, 'msg' => '添加收藏成功', 'state' => 1);
            } else {
                return array('status' => 0, 'msg' => '添加收藏失败', 'state' => 2);
            }
        }
    }

}
