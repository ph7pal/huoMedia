<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>序号</th>
            <th>网站</th>
            <th>分类</th>
            <th>昵称</th>
            <th>链接</th>
            <th>粉丝/万</th>
            <th>价格</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $row): ?> 
            <?php $this->renderPartial('_view', array('data' => $row)); ?>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

