<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo zmf::config('sitename');?> 管理中心</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/common/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/common/admin/manage.css">
<?php assets::loadCssJs('admin');?>
</head>
<body scroll="no">   
 <nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo Yii::app()->createUrl('admin/index/index');?>" class="navbar-brand">
      <?php echo zmf::config('sitename');?>
      </a>
    </div>    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="nav navbar-nav navbar-right">
      <ul class="nav navbar-nav navbar-right">
        <li><?php echo CHtml::link('站点首页',zmf::config('baseurl'),array('target'=>'_blank'));?></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎：<?php echo Yii::app()->user->name;?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li ><?php echo CHtml::link('修改密码',array('users/update','id'=>Yii::app()->user->id));?></li>
            <li class="divider"></li>
            <li ><?php echo CHtml::link('退出',array('/site/logout'));?></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
    <form class="navbar-form navbar-right" role="search" method="GET" id="top-search">
        <div class="input-group">
            <div class="input-group-btn">
                <?php echo CHtml::dropDownList('type', '', SearchRecords::getTypes('admin'), array('class'=>'form-control'));?>
            </div><!-- /btn-group -->
            <input type="text" class="form-control" placeholder="请输入关键词" name="keyword">
        </div>
    </form>
  </div><!-- /.container-fluid -->
</nav>    
    <style>
        .panel-heading:hover{
            cursor: pointer;
        }
        .zmf-list-group{
            margin-bottom: 20px;
padding-left: 0;
        }

        .zmf-list-group .dropdown{            
            display: none;
        }
        .zmf-list-group .caret{
            margin-top:5px;
        }
        .zmf-list-group a b{
            padding-left: 10px;
        }
        
        .view{
background-color: #fff;
border-color: #ddd;
border-width: 1px;
position: relative;
padding: 15px 15px 15px;
margin: 0 -15px 15px;
border-color: #e5e5e5 #eee #eee;
border-style: solid;
border-width: 1px;
        }
        .manage-bar{
            margin-top: -16px;
margin-right: 0;
margin-left: 0;
border-width: 1px;
margin: -15px -15px 15px;
border-width: 0 0 1px;
padding: 9px 14px;
margin-bottom: 14px;
background-color: #f7f7f9;
border: 1px solid #e1e1e8;
        }
        .manage-bar a{
            color:#333
        }
    </style>    
    <?php $sideBars=Admins::adminBar();?>
<div class="container">
    <div class="row">
        <div class="col-xs-3 col-sm-3" style="height:100%;">
        <div class="zmf-list-group">
            <div class="panel-group">
            <?php foreach($sideBars as $aside){?>
            <div class="panel panel-<?php echo $aside['show'] ? 'primary' : 'default';?>">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo $aside['desc'];?><span class="caret pull-right"></span></h3>
                </div>
                <div class="panel-body row <?php echo $aside['show'] ? '' : 'dropdown';?>">
                    <table class="table table-hover">
                       <?php $items=$aside['items']; foreach ($items as $k => $v) {echo '<tr '.($v['active'] ? 'class="active"': '').'><td><a href="' . $v['url'] . '"><b>' . $v['title'] . '</b></a></td>'.($v['addurl']!='' ? '<td class="text-right">'.CHtml::link('<span class="icon-plus"></span> 新增',$v['addurl']).'</td>' : '<td>&nbsp;</td>').'<tr>';}?>
                    </table>
                </div>
            </div>
            <?php }?>     
            </div>
        </div>
        </div>
    <div  class="col-xs-9 col-sm-9">
        <?php echo $content;?>
    </div>  
    </div>
</div>
    <div id="footer">
        <?php $this->renderPartial('/common/footer');?>    
        Copyright&copy;newsoul.cn
    </div>
 <script>
    $(document).ready(function(){
        $('.panel-heading').click(function(){
            if($(this).parent('div').hasClass('panel-primary')){
                $(this).parent('div').removeClass('panel-primary').addClass('panel-default');
                $(this).next('div').slideUp();
            }else{
                $(this).parent('div').removeClass('panel-default').addClass('panel-primary');
                $(this).next('div').slideDown();
            }
        });
        $("#search-btn").click(function(){
            var c=$("#keyword").val();if(typeof c=="undefined"){return false}else{if(c==""){alert("<?php echo zmf::t('search_placeholder');?>")}else{var b="<?php echo zmf::config("domain").Yii::app()->createUrl("posts/search");?>";var a;if(b.indexOf("?")>0){a="&"}else{a="?"}location.href=b+a+"keyword="+c}}
        });
        $('#top-search').submit(function(){
            $(this).attr('action','<?php echo zmf::config("domain").Yii::app()->createUrl("admin/posts/search");?>');
        });
    });
</script>   
</body>
</html>
