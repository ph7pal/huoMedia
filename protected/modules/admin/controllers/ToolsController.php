<?php

class ToolsController extends H {

    public $layout = 'admin';

    public function actionIndex() {
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if ($type == 'db') {
            $this->redirect(array('db/index'));
        }
        $data = array(
          'type' => $type,
        );
        $this->render('index', $data);
    }

    public function actionFunc() {
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if (!$type || !in_array($type, array('assets', 'runtime', 'config'))) {
            $this->message(0, '操作有误，不允许的操作类型', Yii::app()->createUrl('admin/tools/index'));
        }
        switch ($type) {
            case 'assets':
                $dir = Yii::app()->basePath . '/../assets/';
                header("Content-type:text/html;charset=UTF-8");
                zmf::destory($dir); //script
                $this->message('script', '删除成功', Yii::app()->createUrl('admin/tools/index'));
                break;
            case 'runtime':
                $dir = Yii::app()->basePath . '/runtime/';
                header("Content-type:text/html;charset=UTF-8");
                zmf::destory($dir);
                $this->message('script', '删除成功', Yii::app()->createUrl('admin/tools/index'));
                break;
            case 'config':
                tools::writeSet(array());
                $this->message('script', '删除成功', Yii::app()->createUrl('admin/tools/index'));
                break;
            default:
                $this->message(0, '操作有误，不允许的操作类型', Yii::app()->createUrl('admin/tools/index'));
        }
    }

    public function actionTJTags() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 100;
        $start = ($page - 1) * $num;
        $sql = "SELECT id FROM {{tags}} ORDER BY id DESC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/index');
        } else {
            foreach ($items as $it) {
                Tags::getCount($it['id']);
            }
            $url = Yii::app()->createUrl('admin/tools/tjtags', array('page' => ($page + 1)));
        }
        MsgController::redirect("正在处理第{$page}页", 1, $url, 1);
    }

    public function actionTagslen() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 100;
        $start = ($page - 1) * $num;
        $sql = "SELECT id,title FROM {{tags}} ORDER BY id DESC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/index');
        } else {
            foreach ($items as $it) {
                if (!$it['title']) {
                    continue;
                }
                $_len = mb_strlen($it['title'], 'GBK');
                Tags::model()->updateByPk($it['id'], array('length' => $_len));
            }
            $url = Yii::app()->createUrl('admin/tools/tagslen', array('page' => ($page + 1)));
        }
        MsgController::redirect("正在处理第{$page}页", 1, $url, 1);
    }

    public function actionTJComments() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 100;
        $start = ($page - 1) * $num;
        $sql = "SELECT id FROM {{posts}} ORDER BY id DESC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/index');
        } else {
            foreach ($items as $it) {
                $num = Comments::model()->count('logid=:keyid AND classify=:classify', array(':keyid' => $it['id'], ':classify' => 'posts'));
                Posts::model()->updateByPk($it['id'], array('comments' => $num));
            }
            $url = Yii::app()->createUrl('admin/tools/tjcomments', array('page' => ($page + 1)));
        }
        MsgController::redirect("正在处理第{$page}页", 1, $url, 1);
    }

    public function actionLinktags() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 100;
        $start = ($page - 1) * $num;
        $sql = "SELECT id,content FROM {{posts}} ORDER BY id DESC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/linktags');
        } else {
            foreach ($items as $it) {
                $content = $it['content'];
                preg_match_all('/<a.*?href=".*?".*?>.*?<\/a>/i', $content, $linkList);
                $linkList = $linkList[0];
                $content = preg_replace('/<a.*?href=".*?".*?>.*?<\/a>/i', '<{link}>', $content);
                $sql = "SELECT id,title FROM {{tags}} WHERE title!='' ORDER BY length DESC";
                $tags = Yii::app()->db->createCommand($sql)->queryAll();
                $guideList = array();
                $matchTags = array();
                foreach ($tags as $val) {
                    if (strpos($content, $val['title']) !== false) {
                        if (is_numeric($val['title'])) {
                            continue;
                        }
                        $_arrkey = md5($val['title']);
                        if (strpos($content, $_arrkey) !== false) {
                            continue;
                        } else {
                            $key = str_replace(array('/', '.', '(', ')'), array('\/', '\.', '\(', '\)'), $val['title']);
                            $find = "/($key)/i";
                            preg_match($find, $content, $_matchtmp);
                            if (!empty($_matchtmp[0])) {
                                $content = preg_replace($find, $_arrkey, $content, 1);
                                $_url = zmf::config('domain') . '/posts/tag-' . $val['id'] . '.html';
                                $url = CHtml::link($_matchtmp[1], $_url, array('class' => 'tag', 'data' => 'tag-' . $val['id'], 'target' => '_blank'));
                                $guideList[$_arrkey] = $url;
                                $_tagid = $val['id'];
                                $matchTags[$_tagid] = $_matchtmp[1];
                            }
                        }
                    } else {
                        continue;
                    }
                }
                $arrLen = count($linkList);
                for ($i = 0; $i < $arrLen; $i++) {
                    $content = preg_replace('/<{link}>/', $linkList[$i], $content, 1);
                }
                foreach ($guideList as $key => $glink) {
                    $content = preg_replace('/' . $key . '/i', $glink, $content, 1);
                }
                foreach ($matchTags as $key => $tag) {
                    TagRelation::checkAndWriteTag($it['id'], $tag, $key);
                }
                $content = str_replace(array('\(', '\)', '\/', '\.'), array('(', ')', '/', '.'), $content);
                Posts::model()->updateByPk($it['id'], array('content' => $content));
            }
            $url = Yii::app()->createUrl('admin/tools/linktags', array('page' => ($page + 1)));
        }
        MsgController::redirect("正在处理第{$page}页", 1, $url, 1);
    }

    public function actionPoi() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 100;
        $start = ($page - 1) * $num;
        $sql = "SELECT id FROM {{position}} WHERE attach>0 ORDER BY id DESC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/index');
        } else {
            foreach ($items as $it) {
                $_sql = "SELECT id FROM {{attachments}} WHERE logid={$it['id']} AND classify='poi' AND status=1 ORDER BY favor DESC LIMIT 1";
                $_info = Yii::app()->db->createCommand($_sql)->queryRow();
                if (!empty($_info)) {
                    Position::model()->updateByPk($it['id'], array('faceimg' => $_info['id']));
                }
            }
            $url = Yii::app()->createUrl('admin/tools/poi', array('page' => ($page + 1)));
        }
        MsgController::redirect("正在处理第{$page}页", 1, $url, 1);
    }

    /**
     * 将坐标的标题放入链接关键词中间表
     */
    public function actionKeywords() {
        $action = zmf::filterInput($_GET['action'], 't', 1);
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '1800');
        if ($action == '' OR $action == 'init') {
            @touch(Yii::app()->basePath . '/runtime/words_block.log');
            $url = Yii::app()->createUrl('admin/tools/keywords', array('action' => 'create'));
            KeywordIndexer::model()->deleteAll('classify=:classify', array(':classify' => 'poi'));
            MsgController::redirect("即将生成关键词，完成前请勿关闭浏览器", 0, $url);
        } elseif ($action == 'create') {
            
        } else {
            $url = Yii::app()->createUrl('admin/tools/index');
            MsgController::redirect("未知操作", 0, $url);
        }
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 1000;
        $start = ($page - 1) * $num;
        $sql = "SELECT id,areaid,title_cn,title_en,title_local,nickname,status,classify FROM {{position}} ORDER BY id ASC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/index');
            @unlink(Yii::app()->basePath . '/runtime/words_block.log');
            MsgController::redirect("已重新生成所有关键词", 1, $url);
        }
        foreach ($items as $val) {
            $_data = array(
              'logid' => $val['id'],
              'origin' => $val['classify'],
              'classify' => 'poi',
              'areaid' => $val['areaid'],
              'status' => $val['status']
            );
            if ($val['title_cn'] != '') {
                $_data['len'] = mb_strlen($val['title_cn'], 'GBK');
                $_data['title'] = htmlspecialchars_decode($val['title_cn']);
                $hash = md5($_data['title']);
                $_data['hash'] = $hash;
                $_exinfo = KeywordIndexer::model()->find('areaid=:areaid AND origin=:origin AND hash=:hash', array(':areaid' => $val['areaid'], ':origin' => $val['classify'], ':hash' => $hash));
                if (!$_exinfo) {
                    $_data['times'] = 0;
                } else {
                    $_data['times'] = 1;
                    KeywordIndexer::model()->updateCounters(array('times' => 1), 'id=:id', array(':id' => $_exinfo['id']));
                }
                $model = new KeywordIndexer();
                $model->attributes = $_data;
                $model->save(false);
                unset($_data['len']);
                unset($_data['title']);
                unset($_data['hash']);
            }

            if ($val['title_en'] != '') {
                $_data['len'] = mb_strlen($val['title_en'], 'GBK');
                $_data['title'] = htmlspecialchars_decode($val['title_en']);
                $hash = md5($_data['title']);
                $_data['hash'] = $hash;
                $_exinfo = KeywordIndexer::model()->find('areaid=:areaid AND origin=:origin AND hash=:hash', array(':areaid' => $val['areaid'], ':origin' => $val['classify'], ':hash' => $hash));
                if (!$_exinfo) {
                    $_data['times'] = 0;
                } else {
                    $_data['times'] = 1;
                    KeywordIndexer::model()->updateCounters(array('times' => 1), 'id=:id', array(':id' => $_exinfo['id']));
                }
                $model = new KeywordIndexer();
                $model->attributes = $_data;
                $model->save(false);
                unset($_data['len']);
                unset($_data['title']);
                unset($_data['hash']);
            }

            if ($val['title_local'] != '') {
                $_data['len'] = mb_strlen($val['title_local'], 'GBK');
                $_data['title'] = htmlspecialchars_decode($val['title_local']);
                $hash = md5($_data['title']);
                $_data['hash'] = $hash;
                $_exinfo = KeywordIndexer::model()->find('areaid=:areaid AND origin=:origin AND hash=:hash', array(':areaid' => $val['areaid'], ':origin' => $val['classify'], ':hash' => $hash));
                if (!$_exinfo) {
                    $_data['times'] = 0;
                } else {
                    $_data['times'] = 1;
                    KeywordIndexer::model()->updateCounters(array('times' => 1), 'id=:id', array(':id' => $_exinfo['id']));
                }
                $model = new KeywordIndexer();
                $model->attributes = $_data;
                $model->save(false);
                unset($_data['len']);
                unset($_data['title']);
                unset($_data['hash']);
            }
            if ($val['nickname'] != '') {
                $nicks = explode('#', $val['nickname']);
                $nicks = array_unique(array_filter($nicks));
                if (!empty($nicks)) {
                    foreach ($nicks as $nick) {
                        $_data['len'] = mb_strlen($nick, 'GBK');
                        $_data['title'] = htmlspecialchars_decode($nick);
                        $hash = md5($_data['title']);
                        $_data['hash'] = $hash;
                        $_exinfo = KeywordIndexer::model()->find('areaid=:areaid AND origin=:origin AND hash=:hash', array(':areaid' => $val['areaid'], ':origin' => $val['classify'], ':hash' => $hash));
                        if (!$_exinfo) {
                            $_data['times'] = 0;
                        } else {
                            $_data['times'] = 1;
                            KeywordIndexer::model()->updateCounters(array('times' => 1), 'id=:id', array(':id' => $_exinfo['id']));
                        }
                        $model = new KeywordIndexer();
                        $model->attributes = $_data;
                        $model->save(false);
                        unset($_data['len']);
                        unset($_data['title']);
                        unset($_data['hash']);
                    }
                }
            }
        }
        $url = Yii::app()->createUrl('admin/tools/keywords', array('page' => ($page + 1), 'action' => 'create'));
        MsgController::redirect("正在处理{$page}页", 1, $url, 1);
    }

}
