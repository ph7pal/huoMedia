<table class="table table-hover">
    <tr>
        <th style="width: 25%">用户名</th>
        <th style="width: 25%">邮箱</th>
        <th>用户组</th>
        <th>操作</th>
    </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>