<?php

/**
 * This is the model class for table "{{admins}}".
 * 后台管理员
 * The followings are the available columns in table '{{admins}}':
 * @property string $id
 * @property string $uid
 * @property string $powers
 */
class Admins extends CActiveRecord {

    public function tableName() {
        return '{{admins}}';
    }

    public function rules() {
        return array(
            array('uid, powers', 'required'),
            array('uid', 'length', 'max' => 11),
            array('powers', 'length', 'max' => 25),
            array('uid, powers', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'userInfo' => array(self::BELONGS_TO, 'Users', 'uid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uid' => '用户ID',
            'powers' => '用户权限',
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
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('powers', $this->powers, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Admins the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 权限描述
     * @param type $type 操作类型
     * @param type $name 获取某权限的描述
     * @return type]
     */
    public static function getDesc($type = 'admin', $name = '') {
        $lang['user']['desc'] = '用户相关，包括更新、删除等';
        $lang['user']['detail'] = array(
            'user' => '操作用户',
        );
        $lang['schedule']['desc'] = '档期相关，包括更新、删除等';
        $lang['schedule']['detail'] = array(
            'schedule' => '操作档期',
        );
        $lang['order']['desc'] = '订单相关';
        $lang['order']['detail'] = array(
            'order' => '操作订单',
        );
        $lang['group']['desc'] = '团队相关，包括增删改等';
        $lang['group']['detail'] = array(
            'group' => '团队相关',
        );
        $lang['posts']['desc'] = '作品相关，包括增删改等';
        $lang['posts']['detail'] = array(
            'posts' => '作品相关',
        );
        $lang['attachments']['desc'] = '图片相关';
        $lang['attachments']['detail'] = array(
            'attachments' => '图片相关',
        );

        $lang['system']['desc'] = '系统其它功能，包括意见反馈等';
        $lang['system']['detail'] = array(
            'system' => '系统其它信息入口',
        );
        $lang['appversion']['desc'] = '软件版本控制，包括新增、更新、删除等';
        $lang['appversion']['detail'] = array(
            'appversion' => '软件版本控制',
        );
        $lang['calendar']['desc'] = '黄历相关';
        $lang['calendar']['detail'] = array(
            'calendar' => '黄历',
        );
        $lang['feedback']['desc'] = '意见反馈';
        $lang['feedback']['detail'] = array(
            'feedback' => '意见反馈',
        );
        $lang['admins']['desc'] = '后台管理员';
        $lang['admins']['detail'] = array(
            'admins' => '后台管理员',
        );
        $lang['area']['desc'] = '地区管理';
        $lang['area']['detail'] = array(
            'area' => '地区管理',
        );
        $lang['config']['desc'] = '系统设置';
        $lang['config']['detail'] = array(
            'config' => '系统设置',
        );
        $lang['tools']['desc'] = '小工具';
        $lang['tools']['detail'] = array(
            'tools' => '小工具',
        );
        $lang['msg']['desc'] = '短信记录';
        $lang['msg']['detail'] = array(
            'msg' => '短信记录',
        );
        if ($type === 'admin') {
            $items = array();
            foreach ($lang as $key => $val) {
                $items = array_merge($items, $val['detail']);
            }
            unset($lang);
            $lang['admin'] = $items;
        } elseif ($type == 'super') {
            return $lang;
        }
        if (!empty($name)) {
            return $lang[$type][$name];
        } else {
            return $lang[$type];
        }
    }

}
