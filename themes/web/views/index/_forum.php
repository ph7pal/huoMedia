<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <?php if($from=='detail'){?>
            <th class="hidden-xs">选择</th>
            <?php }?>
            <th class="hidden-xs">类别</th>
            <th>社区</th>
            <th>板块</th>
            <th class="hidden-xs">板块链接</th>
            <th>精华永久（元）</th>
            <th>一天（元）</th>
            <th>一周（元）</th>
            <th>二周（元）</th>
            <th>一月（元）</th>
            <th>季度（元）</th>
            <th>半年（元）</th>
            <th>一年（元）</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $data): ?> 
            <tr>
                <?php if($from=='detail'){?>
                <th class="hidden-xs"><input type="checkbox" name="selected[]" value="<?php echo $data->id;?>"></th>
                <?php }?>
                <td class="hidden-xs"><?php echo $data->classifyInfo->title;?></td>
                <td><?php echo $data->forumInfo->title;?></td>
                <td><?php echo $data->typeInfo->title;?></td>    
                <td class="hidden-xs"><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>
                <td><?php echo $data->forDigest;?></td>
                <td><?php echo $data->forDay;?></td>
                <td><?php echo $data->forWeek;?></td>
                <td><?php echo $data->forTwoWeek;?></td>
                <td><?php echo $data->forMonth;?></td>
                <td><?php echo $data->forQuarter;?></td>
                <td><?php echo $data->forHalfYear;?></td>
                <td><?php echo $data->forYear;?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
