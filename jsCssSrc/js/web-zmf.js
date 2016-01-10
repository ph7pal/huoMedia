var tipsImgOrder = 0;
var beforeModal;
var ajaxReturn = true;

var url=window.location.href;


function rebind() {
    $("img.lazy").lazyload();
    $("a[action=get-contents]").unbind('click').click(function () {
        var dom = $(this);
        getContents(dom);
    });
    $("a[action=del-content]").unbind('click').click(function () {
        var dom = $(this);
        delContent(dom);
    });
    $("a[action=favorite]").unbind('click').click(function () {
        var dom = $(this);
        favorite(dom);
    });
    $("a[action=select-tag]").unbind('click').click(function () {
        var dom = $(this);
        var tagid = dom.attr('action-data');
        if (!tagid) {
            return false;
        }
        var _pdom = dom.parent('.tag-item');
        if (_pdom.hasClass('active')) {
            _pdom.removeClass('active');
            dom.children('input').remove();
        } else {
            _pdom.addClass('active');
            var _html = '<input type="hidden" name="tags[]" value="' + tagid + '"/>';
            dom.append(_html);
        }
    });
    $(".comment-textarea").unbind('click').click(function () {
        $('.toggle-area').each(function(){
            $(this).fadeIn(500);
        });
    });
    $("a[action=add-comment]").click(function () {
        var dom = $(this);
        var k = dom.attr("action-data");
        var t = dom.attr("action-type");
        addComment(dom, t, k);
    });
    $("a[action=scroll]").unbind('click').click(function () {
        var dom = $(this);
        var to = dom.attr("action-target");
        if(!to){
            return false;
        }        
        $("body,html").animate({
            scrollTop: $('#'+to).offset().top
        }, 200);
    });
    $("a[action=share]").unbind('click').click(function () {
        var dom = $(this);
        share(dom);
    });
    $('[data-toggle="tooltip"]').tooltip();
    //输入框自动变大
    //textareaAutoResize();
    //意见反馈
    $("a[action=feedback]").unbind('click').click(function () {
        var html = '<div class="form-group"><label for="feedback-contact">联系方式</label><input type="text" id="feedback-contact" class="form-control" placeholder="常用联系方式(邮箱、QQ、微信等)，便于告知反馈处理进度(可选)"/></div><div class="form-group"><label for="feedback-content">反馈内容</label><textarea id="feedback-content" class="form-control" max-lenght="255" placeholder="您的意见或建议"></textarea></div>';
        dialog({msg: html, title: '意见反馈', action: 'feedback'});
        $("button[action=feedback]").unbind('click').click(function () {
            feedback();
        });
    });
}
/**
 * 获取内容
 * @param {type} dom
 * @param {type} t 类型
 * @param {type} k keyid
 * @param {type} p 页码
 * @returns {Boolean}
 */
function getContents(dom) {
    var acdata = dom.attr("action-data");
    var t = dom.attr("action-type");
    var p = dom.attr("action-page");
    var targetBox = dom.attr('action-target');
    if (!checkAjax()) {
        return false;
    }
    if (!targetBox) {
        return false;
    }
    if (!p) {
        p = 1;
    }
    var loading = '<div class="loading-holder"><a class="btn btn-default btn-block disabled" href="javascript:;">拼命加载中...</a></div>';
    $('#' + targetBox + '-box').children('.loading-holder').each(function () {
        $(this).remove();
    });
    $('#' + targetBox + '-box').append(loading);
    $.post(zmf.contentsUrl, {type: t, page: p, data: acdata, YII_CSRF_TOKEN: zmf.csrfToken}, function (result) {
        ajaxReturn = true;
        dom.attr('loaded', '1');
        result = $.parseJSON(result);
        if (result.status === 1) {
            var data = result.msg;

            var pageHtml = '', dataHtml = '';

            if (data.html !== '') {
                dataHtml += data.html;
            }

            if (data.loadMore === 1) {
                var _p = parseInt(p) + 1;
                pageHtml += '<div class="loading-holder"><a class="btn btn-default btn-block"  href="javascript:;" action="get-contents" action-type="' + t + '" action-data="' + acdata + '" action-page="' + _p + '" action-target="' + targetBox + '">加载更多</a></div>';
            } else {
                pageHtml += '<div class="loading-holder"><a class="btn btn-default btn-block disabled" href="javascript:;">已全部加载</a></div>';
            }

            if (p === 1) {
                $('#' + targetBox + '-box').append(data.formHtml);
                $('#' + targetBox + '-box .loading-holder').each(function () {
                    $(this).remove();
                });
            } else {
                $('#' + targetBox + '-box .loading-holder').each(function () {
                    $(this).remove();
                });
            }
            if (p > 1) {
                $('#' + targetBox).append(dataHtml);
            } else {
                $('#' + targetBox).html(dataHtml);
            }
            $('#' + targetBox + '-box').append(pageHtml);

            rebind();
        } else {
            dialog({msg: result.msg});
        }
    });

}

function delContent(dom) {
    var acdata = dom.attr("action-data");
    var t = dom.attr("action-type");
    var cf = dom.attr('action-confirm');
    var rurl = dom.attr('action-redirect');
    var targetBox = dom.attr('action-target');
    if (!acdata || !t) {
        return false;
    }
    var todo = true;
    if (parseInt(cf) === 1) {
        if (confirm('确定删除此内容？')) {
            todo = true;
        } else {
            todo = false;
        }
    }
    if (!todo) {
        return false;
    }
    if (!checkAjax()) {
        return false;
    }
    $.post(zmf.delContentUrl, {type: t, data: acdata, YII_CSRF_TOKEN: zmf.csrfToken}, function (result) {
        ajaxReturn = true;
        result = $.parseJSON(result);
        if (result.status === 1) {
            if (rurl) {
                window.location.href = rurl;
            } else if (targetBox) {
                $('#' + targetBox).fadeOut(500).remove();                
            }else {
                alert(result.msg);
            }
        } else {
            dialog({msg: result.msg});
        }
        return false;
    });
}
function favorite(dom) {
    var acdata = dom.attr("action-data");
    var t = dom.attr("action-type");
    var dt = dom.text();
    var num = parseInt(dt);
    if (!acdata || !t) {
        return false;
    }
    if (!checkAjax()) {
        return false;
    }
    $.post(zmf.favoriteUrl, {type: t, data: acdata, YII_CSRF_TOKEN: zmf.csrfToken}, function (result) {
        ajaxReturn = true;
        result = $.parseJSON(result);
        if (result.status === 1) {//收藏成功
            //dom.text((num + 1) + ' 赞').removeClass('btn-default').addClass('btn-success');
        } else if (result.status === 2) {//收藏失败
            //dom.text(dt);
        } else if (result.status === 3) {//取消成功
            //dom.text((num - 1) + ' 赞').removeClass('btn-success').addClass('btn-default');
        } else if (result.status === 4) {//取消失败
            //dom.text(dt);
        } else {
            //alert(result.msg);
        }
        alert(result.msg);
        return false;
    });
}
function addComment(dom) {
    var k = dom.attr("action-data");
    var t = dom.attr("action-type");
    var to = parseInt($('#replyoneHolder-' + k).attr('tocommentid'));
    var c = $('#content-' + t + '-' + k).val();
    var username=$('#username-' + t + '-' + k).val();
    var email=$('#email-' + t + '-' + k).val();
    if (!k || !t || !c) {
        dialog({msg: '请填写内容'});
        return false;
    }
    if (!username) {
        username = '';
    }
    if (!email) {
        email = '';
    }
    if(!checkLogin()){
        if(!username){
            dialog({msg: '请填写称呼'});
            return false;
        }
        if(email!=''){
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
            if(!reg.test(email)){
                dialog({msg: '请填写正确的邮箱地址'});
                return false;
            }
        }
    }
    if (!to) {
        to = 0;
    }    
    if (!checkAjax()) {
        return false;
    }
    $.post(zmf.addCommentUrl, {k: k, t: t, c: c, to: to,email:email,username:username, YII_CSRF_TOKEN: zmf.csrfToken}, function (result) {
        ajaxReturn = true;
        result = eval('(' + result + ')');
        if (result['status'] == '1') {
            $('#content-' + t + '-' + k).val('');
            $("#comments-" + t + "-" + k).append(result['msg']);
            cancelReplyOne(k);
        } else {
            dialog({msg: result['msg']});
        }
    });
}
function replyOne(id, logid, title) {
    var longstr = "<span class='label label-success'><span class='fa fa-share'></span>回复“" + title + "”<a href='javascript:' onclick='cancelReplyOne(" + logid + ")' title='取消设置'> <span class='fa fa-remove'></span></a></span>";
    var pos = $("#replyoneHolder-" + logid).offset().top;
    $("html,body").animate({scrollTop: pos}, 1000);
    $("#replyoneHolder-" + logid).attr('tocommentid', id).html(longstr);
}
function cancelReplyOne(logid) {
    $("#replyoneHolder-" + logid).attr('tocommentid', '').html('');
}
function setStatus(a, b, c) {
    if (!checkLogin()) {
        dialog({msg: '请先登录'});
        return false;
    }
    if (!checkAjax()) {
        return false;
    }
    $.post(zmf.setStatusUrl, {a: a, b: b, c: c, YII_CSRF_TOKEN: zmf.csrfToken}, function(result) {
        ajaxReturn = true;
        result = eval('(' + result + ')');
        if (result['status'] == 1) {
            dialog({msg: result['msg'], time: 3});
        } else if (result['status'] == 2) {
            window.location.href = zmf.userLoginUrl + "&redirect=" + window.location.href;
        } else {
            dialog({msg: result['msg']});
        }
    });
}
/**
 * 意见反馈
 */
function feedback() {
    var c = $('#feedback-content').val();
    if (!c) {
        alert('内容不能为空哦~');
        return false;
    }
    if (!checkAjax()) {
        return false;
    }
    var url = window.location.href, email = $("#feedback-contact").val();
    $.post(zmf.feedbackUrl, {content: c, email: email, url: url, YII_CSRF_TOKEN: zmf.csrfToken}, function (result) {
        ajaxReturn = true;
        result = $.parseJSON(result);
        dialog({msg: result['msg']});
        return false;
    });
}
function share(dom){
    var qr = dom.attr("action-qrcode");
    var url = dom.attr("action-url");
    var img = dom.attr("action-img");
    var title = dom.attr("action-title");
    var desc = dom.attr("action-desc");
    
    var html='<div class="float-share-holder"><div class="float-share-content"><span class="float-close"><i class="fa fa-close"></i></span><div class="row"><div class="col-xs-6 text-center"><img src="'+qr+'" class="img-responsive"/><p class="help-block">扫码分享到微信</p></div><div class="col-xs-6 float-btns"><a href="javascript:;" class="btn btn-default btn-block"><i class="fa fa-weibo"></i></a><a href="javascript:;" class="btn btn-default btn-block"><i class="fa fa-qq"></i></a><a href="javascript:;" class="btn btn-default btn-block">复制链接</a></div></div></div><div class="float-triangle"></div></div>';
    var html='<div class="share-body"><p><img src="'+qr+'" class="img-responsive"/></p><p class="help-block">扫码分享到微信</p><div class="more-awesome"><span>或</span></div><p><a href="javascript:;" class="btn btn-default btn-block"><i class="fa fa-weibo"></i> 分享到微博</a><a href="javascript:;" class="btn btn-default btn-block"><i class="fa fa-qq"></i> 分享到空间</a><a href="javascript:;" class="btn btn-default btn-block"><i class="fa fa-copy"></i> 复制此链接</a></p></div>';
    dialog({msg:html,title:'分享',modalSize:'modal-sm'});
//    var x=dom.offset().top;
//    var y=dom.offset().left;
//    var w=dom.width();
//    var h=dom.height();    
//    var w1=360;
//    var h1=222;
//    var x1=(y-w1);
//    var y1=(x+h/2-h1/2);
//    $('body').append(html);
//    var _dom=$('.float-share-holder');
//    _dom.css({left:x1-5,top:y1}).fadeIn(500);
}
function myUploadify() {
    $("#uploadfile").uploadify({
        height: 34,
        width: 120,
        swf: zmf.baseUrl + '/common/uploadify/uploadify.swf',
        queueID: 'fileQueue',
        auto: true,
        multi: true,
        fileObjName: 'filedata',
        uploadLimit: zmf.perAddImgNum,
        fileSizeLimit: zmf.allowImgPerSize,
        fileTypeExts: zmf.allowImgTypes,
        fileTypeDesc: 'Image Files',
        uploader: tipImgUploadUrl,
        buttonText: '请选择',
        buttonClass: 'btn btn-success',
        debug: false,
        formData: {'PHPSESSID': zmf.currentSessionId, 'YII_CSRF_TOKEN': zmf.csrfToken},
        onUploadSuccess: function (file, data, response) {
            data = eval("(" + data + ")");
            if (data['status'] == 1) {
                var img = "<p><img src='" + data['imgsrc'] + "' data='" + data['attachid'] + "' class='img-responsive'/><br/></p>";
                myeditor.execCommand("inserthtml", img);
            } else {                
                dialog({msg: data.msg});
            }
            tipsImgOrder++;
        }
    });
}
/**
 * placeHolder, inputId, limit,multi
 * @returns {undefined}
 */
function singleUploadify(params) {
    if (typeof params !== "object") {
        return false;
    }
    var multi = true;
    if (typeof params.multi === 'undefined') {
        multi = true;
    } else {
        multi = params.multi;
    }
    $("#" + params.placeHolder).uploadify({
        height: params.height ? params.height : 100,
        width: params.width ? params.width : 300,
        swf: zmf.baseUrl + '/common/uploadify/uploadify.swf',
        queueID: 'singleFileQueue',
        auto: true,
        multi: multi,
        queueSizeLimit: zmf.perAddImgNum,
        fileObjName: params.filedata ? params.filedata : 'filedata',
        fileTypeExts: zmf.allowImgTypes,
        fileSizeLimit: zmf.allowImgPerSize,
        fileTypeDesc: 'Image Files',
        uploader: params.uploadUrl,
        buttonText: params.buttonText ? params.buttonText : (params.buttonText === null ? '' : '添加图片'),
        buttonClass: 'btn btn-default',
        debug: false,
        formData: {'PHPSESSID': zmf.currentSessionId, 'YII_CSRF_TOKEN': zmf.csrfToken},
        onUploadStart: function (file) {
            if (params.type === 'posts') {
                var _params = {};
                var myDate = new Date();
                var _type = file.type;
                var _name = params.type + '/' + myDate.getFullYear() + '/' + (myDate.getMonth() + 1) + '/' + myDate.getDate() + '/' + uuid() + _type;
                _params.key = _name;
                _params.token = params.token;
                $("#" + params.placeHolder).uploadify('settings', 'formData', _params);
            }
        },
        onUploadSuccess: function (file, data, response) {
            data = $.parseJSON(data);
            if (params.type === 'posts') {
                if (!data.error) {
                    var passData = {
                        YII_CSRF_TOKEN: zmf.csrfToken,
                        filePath: data.key,
                        fileSize: file.size,
                        type: params.type
                    };
                    $.post(zmf.saveUploadImgUrl, passData, function (reJson) {
                        reJson = $.parseJSON(reJson);
                        if (reJson.status === 1) {
                            $("#fileSuccess").append(reJson.html);
                            $('.toggle-display').each(function () {
                                $(this).removeClass('toggle-display');
                            });
                            if ($('#Posts_title').val() === '') {
                                $('#Posts_title').focus();
                            }
                            $(window).bind('beforeunload', function () {
                                return '您输入的内容可能未保存，确定离开此页面吗？';
                            });
                            rebind();
                            if (params.inputId) {
                                $('#' + params.inputId).val(reJson.attachid);
                            }
                        } else {
                            alert(reJson.msg);
                            return false;
                        }
                    });
                } else {
                    alert(data.error);
                    return false;
                }
            } else {
                if (data.status === 1) {
                    $("#fileSuccess").html(data.html);
                    if (params.inputId) {
                        $('#' + params.inputId).val(data.attachid);
                    }
                    rebind();
                } else {
                    alert(data.msg);
                    return false;
                }
            }
        }
    });
}


function addVideo() {
    var html = '<div class="form-group"><label>请输入链接地址</label><input type="text" class="form-control" placeholder="视频地址" id="parse_video_url"/><p class="help-block">暂时仅支持优酷、土豆视频</p><textarea id="parse_video_desc" class="form-control" placeholder="视频描述（选填）"></textarea></div>';
    dialog({title: '分享视频', msg: html, action: 'parseVideo'});
    $("button[action=parseVideo]").unbind('click').click(function () {
        parseVideo();
    });
}
function parseVideo() {
    var url = $('#parse_video_url').val();
    var desc = $('#parse_video_desc').val();
    if (!url) {
        alert('请填写视频地址');
        return false;
    }
    if (!checkAjax()) {
        return false;
    }
    $.post(zmf.parseVideoUrl, {url: url, desc: desc, YII_CSRF_TOKEN: zmf.csrfToken}, function (data) {
        data = $.parseJSON(data);
        ajaxReturn = true;
        if (data.status === 1) {
            var result = data.msg;
//            var html = '<div class="thumbnail media-item" id="uploadVideo' + result.attachid + '"><span class="right-bar"><a action="del-content" action-type="video" action-data="' + result.attachid + '" action-confirm="1" action-target="uploadVideo' + result.attachid + '" href="javascript:;"><i class="fa fa-minus"></i></a></span><div id="' + result.holderid + '"><div class="media-cover" onclick="playVideo(\'' + result.company + '\',\'' + result.videoid + '\',\'' + result.holderid + '\')"><i class="fa fa-play-circle-o"></i><img src="' + result.faceimg + '"/></div></div><input type="hidden" name="attaches[video' + result.attachid + '][type]" value="video"/><input type="text" class="form-control" name="attaches[video' + result.attachid + '][title]" value="' + result.title + '"/><textarea class="form-control" name="attaches[video' + result.attachid + '][content]">' + result.content + '</textarea></div>';
            $("#fileSuccess").append(data.msg);
            $('.toggle-display').each(function () {
                $(this).removeClass('toggle-display');
            });
            if ($('#Posts_title').val() === '') {
                $('#Posts_title').focus();
            }
            $(window).bind('beforeunload', function () {
                return '您输入的内容可能未保存，确定离开此页面吗？';

            });
            closeDialog(beforeModal);
            rebind();
        } else {
            alert(data.msg);
            return false;
        }
    });
}

function playVideo(company, videoid, targetHolder, dom) {
    if (!company || !videoid || !targetHolder) {
        return false;
    }
    var html = '';
    if (company === 'youku') {
        html = '<iframe height=480 width=600 src="http://player.youku.com/embed/' + videoid + '" frameborder=0 allowfullscreen></iframe>';
    } else if (company === 'tudou') {
        html = '<iframe src="http://www.tudou.com/programs/view/html5embed.action?type=0&' + videoid + '" allowtransparency="true" allowfullscreen="true" allowfullscreenInteractive="true" scrolling="no" border="0" frameborder="0" style="width:600px;height:480px;"></iframe>';
    } else if (company === 'qq') {
        html = '<iframe frameborder="0" width="600" height="480" src="http://v.qq.com/iframe/player.html?vid=' + videoid + '&tiny=0&auto=0" allowfullscreen></iframe>';
    }
    $('#' + targetHolder).html(html);
    $(dom).remove();
}
/*
 * a:对话框id
 * t:提示
 * c:对话框内容
 * ac:下一步的操作名
 * time:自动关闭
 */
function dialog(diaObj) {
    if (typeof diaObj !== "object") {
        return false;
    }
    var c = diaObj.msg;
    var a = diaObj.id;
    var t = diaObj.title;
    var ac = diaObj.action;
    var acn = diaObj.actionName;
    var time = diaObj.time;
    var size = diaObj.modalSize;
    $('#' + beforeModal).modal('hide');
    if (typeof t === 'undefined' || t === '') {
        t = '提示';
    }
    if (typeof a === 'undefined' || a === '') {
        a = 'myDialog';
    }
    if (typeof ac === 'undefined') {
        ac = '';
    }
    if (typeof size === 'undefined') {
        size = '';
    }
    $('#' + a).remove();
    var longstr = '<div class="modal fade mymodal" id="' + a + '" tabindex="-1" role="dialog" aria-labelledby="' + a + 'Label" aria-hidden="true"><div class="modal-dialog '+size+'"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="' + a + 'Label">' + t + '</h4></div><div class="modal-body">' + c + '</div><div class="modal-footer">';
    longstr += '<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>';
    if (ac !== '' && typeof ac !== 'undefined') {
        var _t;
        if (acn !== '' && typeof acn !== 'undefined') {
            _t = acn;
        } else {
            _t = '确定';
        }
        longstr += '<button type="button" class="btn btn-primary" action="' + ac + '" data-loading-text="Loading...">' + _t + '</button>';
    }
    longstr += '</div></div></div></div>';
    $("body").append(longstr);
    $('#' + a).modal({
        backdrop: false,
        keyboard: false
    });
    beforeModal = a;
    if (time > 0 && typeof time !== 'undefined') {
        setTimeout("closeDialog('" + a + "')", time * 1000);
    }
}
function closeDialog(a) {
    if (!a) {
        a = 'myDialog';
    }
    $('#' + a).modal('hide');
    $('#' + a).remove();
    $("body").eq(0).removeClass('modal-open');
}
function checkAjax() {
    if (!ajaxReturn) {
        dialog({msg: '请求正在发送中，请稍后'});
        return false;
    }
    ajaxReturn = false;
    return true;
}
function checkLogin() {
    if (typeof zmf.hasLogin === 'undefined') {
        return false;
    } else if (zmf.hasLogin === 'true') {
        return true;
    } else {
        return false;
    }
}
function backToTop() {
    var x = $(window).width();
    var x1 = $(".container").width();
    var x2 = $("#back-to-top").width();
    if (x < x1) {
        var x3 = x1 + 8;
    } else {
        var x3 = parseInt((x + x1 + 16) / 2);
    }
    $("#back-to-top").css('left', x3 + 'px');
    //alert(x3);
}
function textareaAutoResize() {
    $('textarea').autoResize({
        // On resize:  
        onResize: function () {
            $(this).css({opacity: 0.8});
        },
        // After resize:  
        animateCallback: function () {
            $(this).css({opacity: 1});
        },
        // Quite slow animation:  
        animateDuration: 100,
        // More extra space:  
        extraSpace: 20
    });
}
function uuid(len, radix) {
    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
    var uuid = [], i;
    radix = radix || chars.length;

    if (len) {
        for (i = 0; i < len; i++)
            uuid[i] = chars[0 | Math.random() * radix];
    } else {
        var r;
        // rfc4122 requires these characters
        uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
        uuid[14] = '4';
        // Fill in random data.  At i==19 set the high bits of clock sequence as
        // per rfc4122, sec. 4.1.5
        for (i = 0; i < 36; i++) {
            if (!uuid[i]) {
                r = 0 | Math.random() * 16;
                uuid[i] = chars[(i === 19) ? (r & 0x3) | 0x8 : r];
            }
        }
    }
    return uuid.join('');
}
/*
 * jQuery autoResize (textarea auto-resizer)
 * @copyright James Padolsey http://james.padolsey.com
 * @version 1.04
 */
(function ($) {

    $.fn.autoResize = function (options) {

        // Just some abstracted details,
        // to make plugin users happy:
        var settings = $.extend({
            onResize: function () {
            },
            animate: true,
            animateDuration: 150,
            animateCallback: function () {
            },
            extraSpace: 20,
            limit: 1000
        }, options);

        // Only textarea's auto-resize:
        this.filter('textarea').each(function () {

            // Get rid of scrollbars and disable WebKit resizing:
            var textarea = $(this).css({resize: 'none', 'overflow-y': 'hidden'}),
                    // Cache original height, for use later:
                    origHeight = textarea.height(),
                    // Need clone of textarea, hidden off screen:
                    clone = (function () {

                        // Properties which may effect space taken up by chracters:
                        var props = ['height', 'width', 'lineHeight', 'textDecoration', 'letterSpacing'],
                                propOb = {};

                        // Create object of styles to apply:
                        $.each(props, function (i, prop) {
                            propOb[prop] = textarea.css(prop);
                        });

                        // Clone the actual textarea removing unique properties
                        // and insert before original textarea:
                        return textarea.clone().removeAttr('id').removeAttr('name').css({
                            position: 'absolute',
                            top: 0,
                            left: -9999
                        }).css(propOb).attr('tabIndex', '-1').insertBefore(textarea);

                    })(),
                    lastScrollTop = null,
                    updateSize = function () {

                        // Prepare the clone:
                        clone.height(0).val($(this).val()).scrollTop(10000);

                        // Find the height of text:
                        var scrollTop = Math.max(clone.scrollTop(), origHeight) + settings.extraSpace,
                                toChange = $(this).add(clone);

                        // Don't do anything if scrollTip hasen't changed:
                        if (lastScrollTop === scrollTop) {
                            return;
                        }
                        lastScrollTop = scrollTop;

                        // Check for limit:
                        if (scrollTop >= settings.limit) {
                            $(this).css('overflow-y', '');
                            return;
                        }
                        // Fire off callback:
                        settings.onResize.call(this);

                        // Either animate or directly apply height:
                        settings.animate && textarea.css('display') === 'block' ?
                                toChange.stop().animate({height: scrollTop}, settings.animateDuration, settings.animateCallback)
                                : toChange.height(scrollTop);
                    };

            // Bind namespaced handlers to appropriate events:
            textarea
                    .unbind('.dynSiz')
                    .bind('keyup.dynSiz', updateSize)
                    .bind('keydown.dynSiz', updateSize)
                    .bind('change.dynSiz', updateSize);

        });

        // Chain:
        return this;

    };



})(jQuery);
/*lazyload*/
!function (c, b, d, f) {
    var a = c(b);
    c.fn.lazyload = function (h) {
        function i() {
            var k = 0;
            e.each(function () {
                var l = c(this);
                if (!j.skip_invisible || l.is(":visible")) {
                    if (c.abovethetop(this, j) || c.leftofbegin(this, j)) {
                    } else {
                        if (c.belowthefold(this, j) || c.rightoffold(this, j)) {
                            if (++k > j.failure_limit) {
                                return !1
                            }
                        } else {
                            l.trigger("appear"), k = 0
                        }
                    }
                }
            })
        }
        var g, e = this, j = {threshold: 0, failure_limit: 0, event: "scroll", effect: "show", container: b, data_attribute: "original", skip_invisible: !0, appear: null, load: null};
        return h && (f !== h.failurelimit && (h.failure_limit = h.failurelimit, delete h.failurelimit), f !== h.effectspeed && (h.effect_speed = h.effectspeed, delete h.effectspeed), c.extend(j, h)), g = j.container === f || j.container === b ? a : c(j.container), 0 === j.event.indexOf("scroll") && g.bind(j.event, function () {
            return i()
        }), this.each(function () {
            var k = this, l = c(k);
            k.loaded = !1, l.one("appear", function () {
                if (!this.loaded) {
                    if (j.appear) {
                        var m = e.length;
                        j.appear.call(k, m, j)
                    }
                    c("<img />").bind("load", function () {
                        l.hide().attr("src", l.data(j.data_attribute))[j.effect](j.effect_speed), k.loaded = !0;
                        var p = c.grep(e, function (n) {
                            return !n.loaded
                        });
                        if (e = c(p), j.load) {
                            var o = e.length;
                            j.load.call(k, o, j)
                        }
                    }).attr("src", l.data(j.data_attribute))
                }
            }), 0 !== j.event.indexOf("scroll") && l.bind(j.event, function () {
                k.loaded || l.trigger("appear")
            })
        }), a.bind("resize", function () {
            i()
        }), /iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion) && a.bind("pageshow", function (k) {
            k.originalEvent && k.originalEvent.persisted && e.each(function () {
                c(this).trigger("appear")
            })
        }), c(d).ready(function () {
            i()
        }), this
    }, c.belowthefold = function (h, e) {
        var g;
        return g = e.container === f || e.container === b ? a.height() + a.scrollTop() : c(e.container).offset().top + c(e.container).height(), g <= c(h).offset().top - e.threshold
    }, c.rightoffold = function (h, e) {
        var g;
        return g = e.container === f || e.container === b ? a.width() + a.scrollLeft() : c(e.container).offset().left + c(e.container).width(), g <= c(h).offset().left - e.threshold
    }, c.abovethetop = function (h, e) {
        var g;
        return g = e.container === f || e.container === b ? a.scrollTop() : c(e.container).offset().top, g >= c(h).offset().top + e.threshold + c(h).height()
    }, c.leftofbegin = function (h, e) {
        var g;
        return g = e.container === f || e.container === b ? a.scrollLeft() : c(e.container).offset().left, g >= c(h).offset().left + e.threshold + c(h).width()
    }, c.inviewport = function (e, g) {
        return !(c.rightoffold(e, g) || c.leftofbegin(e, g) || c.belowthefold(e, g) || c.abovethetop(e, g))
    }, c.extend(c.expr[":"], {"below-the-fold": function (e) {
            return c.belowthefold(e, {threshold: 0})
        }, "above-the-top": function (e) {
            return !c.belowthefold(e, {threshold: 0})
        }, "right-of-screen": function (e) {
            return c.rightoffold(e, {threshold: 0})
        }, "left-of-screen": function (e) {
            return !c.rightoffold(e, {threshold: 0})
        }, "in-viewport": function (e) {
            return c.inviewport(e, {threshold: 0})
        }, "above-the-fold": function (e) {
            return !c.belowthefold(e, {threshold: 0})
        }, "right-of-fold": function (e) {
            return c.rightoffold(e, {threshold: 0})
        }, "left-of-fold": function (e) {
            return !c.rightoffold(e, {threshold: 0})
        }})
}(jQuery, window, document);

rebind();