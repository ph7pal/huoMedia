<style>
/*设置页面---*/
.settings-container{
    width: 960px;
    display: table;
    margin: 0 auto 50px;
    background: #fff;
    border: 1px solid #f2f2f2;        
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border: 1px solid #e9e9e9;
    border-bottom-width: 2px;
    border-top: 1px solid #eee;

}
.settings-side-box{
    width: 240px;
    border-right: 1px solid #f2f2f2;
    min-height: 520px;
    height: auto

}
.settings-side-box .list-group{
    margin: 0
}
.settings-side-box .list-group-item{
    border-left:  none;
    border-right:  none;
}
.settings-side-box .list-group-item:first-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-top: none;

}
.settings-side-box .list-group-item:last-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    margin-bottom: 0;
}
.settings-side-box .list-group-item.active,.settings-side-box .list-group-item.active:focus, .settings-side-box .list-group-item.active:hover{
    color: #C62C5C;
    background-color: #FFF0F0;
    border-color: #FFF0F0;
}
.settings-main-box{
    width: 700px;
    padding: 10px;
}
.settings-main-box h2{
    padding: 0 8px 20px;
    border-bottom: 1px solid #f2f2f2
}
.settings-main-box .table>tbody>tr>td{
    border: none
}
.settings-main-box table .colname{
    width: 80px;
    height: 38px;
    line-height: 20px;
    font-weight: bold;
}
.settings-main-box .passwd-form{
    padding-left: 8px;
}
.settings-main-box .passwd-form label{
    font-weight: normal
}

</style>
<div class="settings-container">
    <div class="settings-side-box pull-left">
        <div class="list-group">
            <a class="list-group-item active" href="/user/cec1291933768da643/settings?type=info">我的信息</a>        
            <a class="list-group-item" href="/user/cec1291933768da643/settings?type=passwd">修改密码</a>        
            <a class="list-group-item" href="/user/cec1291933768da643/settings?type=skin">主页设置</a>    
        </div>
    </div>
<div class="settings-main-box pull-left">
        <h2>基本信息</h2>
        <table class="table table-hover">
            <tbody><tr>
                <td class="colname">用户名</td>
                <td>阿年飞少</td>
            </tr>
            <tr>
                <td class="colname">手机号</td>
                <td>185*******9</td>
            </tr>
            <tr>
                <td class="colname">性别</td>
                <td>男</td>
            </tr>
            <tr>
                <td class="colname">地区</td>
                <td>重庆市 渝中区</td>
            </tr>
            <tr>
                <td class="colname">职业</td>
                <td>策划</td>
            </tr>
            <tr>
                <td class="colname">简介</td>
                <td><span class="color-grey">[未填写]</span></td>
            </tr>
        </tbody>
        </table>
    </div>
</div>