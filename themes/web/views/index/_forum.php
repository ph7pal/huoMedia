<table class="table table-hover">
    <thead>
    <tr>
        <th>序号</th>
        <th>类别</th>
        <th>社区</th>
        <th>板块</th>
        <th>板块链接</th>
        <th>精华</th>
        <th>一天</th>
        <th>一周</th>
        <th>二周</th>
        <th>一月</th>
        <th>季度</th>
        <th>半年</th>
        <th>一年</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $data): ?> 
        <tr>
            <th><?php echo $data->id;?></th>
            <td><?php echo $data->classifyInfo->title;?></td>
            <td><?php echo $data->forumInfo->title;?></td>
            <td><?php echo $data->typeInfo->title;?></td>    
            <td><?php echo zmf::subStr($data->url);?></td>

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

