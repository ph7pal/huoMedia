<?php

/**
 * This is the model class for table "{{area}}".
 *
 * The followings are the available columns in table '{{area}}':
 * @property integer $area_id
 * @property string $title
 * @property integer $pid
 */
class Area extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{area}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('pid,order', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'belongInfo' => array(self::BELONGS_TO, 'Area', 'pid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'area_id' => '地区ID',
            'title' => '地区名称',
            'pid' => '所属地区',
            'order' => '排序',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Area the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 根据所在区获取省份和城市
     * @param type $id
     * @return boolean
     */
    public static function findByArea($id) {
        if (!$id) {
            return false;
        }
        $info = Area::model()->findByPk($id);
        if (!$info) {
            return false;
        }
        $arr['area'] = array(
            'area_id' => $id,
            'title' => $info['title']
        );
        if ($info['pid'] > 0) {
            $beinfo = Area::model()->findByPk($info['pid']);
            if ($beinfo) {
                $arr['city'] = array(
                    'area_id' => $beinfo['area_id'],
                    'title' => $beinfo['title']
                );
                if ($beinfo['pid'] > 0) {
                    $first = Area::model()->findByPk($beinfo['pid']);
                    if ($first) {
                        $arr['province'] = array(
                            'area_id' => $first['area_id'],
                            'title' => $first['title']
                        );
                    }
                }
            }
        }
        return $arr;
    }
    
    /**
     * 根据ID获取详细层级名称
     * @param int $id
     * @return string
     */
    public static function getBelongInfo($id){
        $id=  zmf::myint($id);
        if(!$id){
            return '';
        }
        $arr=  self::findByArea($id);
        return trim($arr['province']['title'].' '.$arr['city']['title']. ' '.$arr['area']['title']);
    }

    public static function getFirst() {
        $criteria = new CDbCriteria();
        $criteria->order = '`order` ASC';
        $criteria->condition = 'pid=0';
        $criteria->select = 'area_id,title';
        $areas = Area::model()->findAll($criteria);
        return CHtml::listData($areas, 'area_id', 'title');
    }

    /**
     * 根据一地区获取该地区所有下级
     * @param type $id
     */
    public static function getChildren($id) {
        if (!$id) {
            return FALSE;
        }
        $sql = "SELECT t1.area_id AS areaId FROM {{area}} t1,{{area}} t2 WHERE(t1.area_id = t2.area_id OR t1.pid = t2.area_id) AND t2.pid = " . $id;
        $areaIds = Yii::app()->db->createCommand($sql)->queryAll();
        return array_keys(CHtml::listData($areaIds, 'areaId', ''));
    }

    public static function getOne($id) {
        return Area::model()->findByPk($id);
    }

}
