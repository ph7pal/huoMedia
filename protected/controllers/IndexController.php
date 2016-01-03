<?php

class IndexController extends Q {

    public function actionIndex() {
        $sql='SELECT id,title,faceimg,content,tagids,comments,favors FROM {{posts}} WHERE `status`=1 ORDER BY cTime DESC';
        Posts::getAll(array('sql'=>$sql), $pages, $posts);
        foreach ($posts as $k=>$val){
            if($val['tagids']!=''){
                $_tags=  Tags::getByIds($val['tagids']);
                $posts[$k]['tagids']=$_tags;
            }
            $posts[$k]['faceimg']=  Attachments::faceImg($val,'640');
        }
        $data=array(
            'posts'=>$posts
        );
        $this->render('/index/index',$data);
    }

}
