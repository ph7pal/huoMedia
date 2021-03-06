var tipsImgOrder = 0;
var beforeModal;
var ajaxReturn = true;
var url=window.location.href;
function rebind() {
    $("a[action=del-content]").unbind('click').click(function () {
        var dom = $(this);
        delContent(dom);
    });
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
function simpleDialog(diaObj){
    if (typeof diaObj !== "object") {
        return false;
    }
    var c = diaObj.content;
    var longstr='<div class="simpleDialog">'+c+'</div>';
    $("body").append(longstr);
    var dom=$('.simpleDialog');
    var w=dom.width();
    var h=dom.height();
    dom.css({
        'margin-left':-w/2,
        'margin-top':-h/2
    });
    dom.fadeIn(300);
    setTimeout("closeSimpleDialog()",2700);
}
function closeSimpleDialog(){
    $('.simpleDialog').fadeOut(100);
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
/*!
 * clipboard.js v1.5.5
 * https://zenorocha.github.io/clipboard.js
 *
 * Licensed MIT © Zeno Rocha
 */
!function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;e="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,e.Clipboard=t()}}(function(){var t,e,n;return function t(e,n,r){function o(a,c){if(!n[a]){if(!e[a]){var s="function"==typeof require&&require;if(!c&&s)return s(a,!0);if(i)return i(a,!0);var u=new Error("Cannot find module '"+a+"'");throw u.code="MODULE_NOT_FOUND",u}var l=n[a]={exports:{}};e[a][0].call(l.exports,function(t){var n=e[a][1][t];return o(n?n:t)},l,l.exports,t,e,n,r)}return n[a].exports}for(var i="function"==typeof require&&require,a=0;a<r.length;a++)o(r[a]);return o}({1:[function(t,e,n){var r=t("matches-selector");e.exports=function(t,e,n){for(var o=n?t:t.parentNode;o&&o!==document;){if(r(o,e))return o;o=o.parentNode}}},{"matches-selector":2}],2:[function(t,e,n){function r(t,e){if(i)return i.call(t,e);for(var n=t.parentNode.querySelectorAll(e),r=0;r<n.length;++r)if(n[r]==t)return!0;return!1}var o=Element.prototype,i=o.matchesSelector||o.webkitMatchesSelector||o.mozMatchesSelector||o.msMatchesSelector||o.oMatchesSelector;e.exports=r},{}],3:[function(t,e,n){function r(t,e,n,r){var i=o.apply(this,arguments);return t.addEventListener(n,i),{destroy:function(){t.removeEventListener(n,i)}}}function o(t,e,n,r){return function(n){n.delegateTarget=i(n.target,e,!0),n.delegateTarget&&r.call(t,n)}}var i=t("closest");e.exports=r},{closest:1}],4:[function(t,e,n){n.node=function(t){return void 0!==t&&t instanceof HTMLElement&&1===t.nodeType},n.nodeList=function(t){var e=Object.prototype.toString.call(t);return void 0!==t&&("[object NodeList]"===e||"[object HTMLCollection]"===e)&&"length"in t&&(0===t.length||n.node(t[0]))},n.string=function(t){return"string"==typeof t||t instanceof String},n.function=function(t){var e=Object.prototype.toString.call(t);return"[object Function]"===e}},{}],5:[function(t,e,n){function r(t,e,n){if(!t&&!e&&!n)throw new Error("Missing required arguments");if(!c.string(e))throw new TypeError("Second argument must be a String");if(!c.function(n))throw new TypeError("Third argument must be a Function");if(c.node(t))return o(t,e,n);if(c.nodeList(t))return i(t,e,n);if(c.string(t))return a(t,e,n);throw new TypeError("First argument must be a String, HTMLElement, HTMLCollection, or NodeList")}function o(t,e,n){return t.addEventListener(e,n),{destroy:function(){t.removeEventListener(e,n)}}}function i(t,e,n){return Array.prototype.forEach.call(t,function(t){t.addEventListener(e,n)}),{destroy:function(){Array.prototype.forEach.call(t,function(t){t.removeEventListener(e,n)})}}}function a(t,e,n){return s(document.body,t,e,n)}var c=t("./is"),s=t("delegate");e.exports=r},{"./is":4,delegate:3}],6:[function(t,e,n){function r(t){var e;if("INPUT"===t.nodeName||"TEXTAREA"===t.nodeName)t.focus(),t.setSelectionRange(0,t.value.length),e=t.value;else{t.hasAttribute("contenteditable")&&t.focus();var n=window.getSelection(),r=document.createRange();r.selectNodeContents(t),n.removeAllRanges(),n.addRange(r),e=n.toString()}return e}e.exports=r},{}],7:[function(t,e,n){function r(){}r.prototype={on:function(t,e,n){var r=this.e||(this.e={});return(r[t]||(r[t]=[])).push({fn:e,ctx:n}),this},once:function(t,e,n){function r(){o.off(t,r),e.apply(n,arguments)}var o=this;return r._=e,this.on(t,r,n)},emit:function(t){var e=[].slice.call(arguments,1),n=((this.e||(this.e={}))[t]||[]).slice(),r=0,o=n.length;for(r;o>r;r++)n[r].fn.apply(n[r].ctx,e);return this},off:function(t,e){var n=this.e||(this.e={}),r=n[t],o=[];if(r&&e)for(var i=0,a=r.length;a>i;i++)r[i].fn!==e&&r[i].fn._!==e&&o.push(r[i]);return o.length?n[t]=o:delete n[t],this}},e.exports=r},{}],8:[function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}n.__esModule=!0;var i=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),a=t("select"),c=r(a),s=function(){function t(e){o(this,t),this.resolveOptions(e),this.initSelection()}return t.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action=e.action,this.emitter=e.emitter,this.target=e.target,this.text=e.text,this.trigger=e.trigger,this.selectedText=""},t.prototype.initSelection=function t(){if(this.text&&this.target)throw new Error('Multiple attributes declared, use either "target" or "text"');if(this.text)this.selectFake();else{if(!this.target)throw new Error('Missing required attributes, use either "target" or "text"');this.selectTarget()}},t.prototype.selectFake=function t(){var e=this;this.removeFake(),this.fakeHandler=document.body.addEventListener("click",function(){return e.removeFake()}),this.fakeElem=document.createElement("textarea"),this.fakeElem.style.position="absolute",this.fakeElem.style.left="-9999px",this.fakeElem.style.top=(window.pageYOffset||document.documentElement.scrollTop)+"px",this.fakeElem.setAttribute("readonly",""),this.fakeElem.value=this.text,document.body.appendChild(this.fakeElem),this.selectedText=c.default(this.fakeElem),this.copyText()},t.prototype.removeFake=function t(){this.fakeHandler&&(document.body.removeEventListener("click"),this.fakeHandler=null),this.fakeElem&&(document.body.removeChild(this.fakeElem),this.fakeElem=null)},t.prototype.selectTarget=function t(){this.selectedText=c.default(this.target),this.copyText()},t.prototype.copyText=function t(){var e=void 0;try{e=document.execCommand(this.action)}catch(n){e=!1}this.handleResult(e)},t.prototype.handleResult=function t(e){e?this.emitter.emit("success",{action:this.action,text:this.selectedText,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)}):this.emitter.emit("error",{action:this.action,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)})},t.prototype.clearSelection=function t(){this.target&&this.target.blur(),window.getSelection().removeAllRanges()},t.prototype.destroy=function t(){this.removeFake()},i(t,[{key:"action",set:function t(){var e=arguments.length<=0||void 0===arguments[0]?"copy":arguments[0];if(this._action=e,"copy"!==this._action&&"cut"!==this._action)throw new Error('Invalid "action" value, use either "copy" or "cut"')},get:function t(){return this._action}},{key:"target",set:function t(e){if(void 0!==e){if(!e||"object"!=typeof e||1!==e.nodeType)throw new Error('Invalid "target" value, use a valid Element');this._target=e}},get:function t(){return this._target}}]),t}();n.default=s,e.exports=n.default},{select:6}],9:[function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function a(t,e){var n="data-clipboard-"+t;if(e.hasAttribute(n))return e.getAttribute(n)}n.__esModule=!0;var c=t("./clipboard-action"),s=r(c),u=t("tiny-emitter"),l=r(u),f=t("good-listener"),d=r(f),h=function(t){function e(n,r){o(this,e),t.call(this),this.resolveOptions(r),this.listenClick(n)}return i(e,t),e.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action="function"==typeof e.action?e.action:this.defaultAction,this.target="function"==typeof e.target?e.target:this.defaultTarget,this.text="function"==typeof e.text?e.text:this.defaultText},e.prototype.listenClick=function t(e){var n=this;this.listener=d.default(e,"click",function(t){return n.onClick(t)})},e.prototype.onClick=function t(e){var n=e.delegateTarget||e.currentTarget;this.clipboardAction&&(this.clipboardAction=null),this.clipboardAction=new s.default({action:this.action(n),target:this.target(n),text:this.text(n),trigger:n,emitter:this})},e.prototype.defaultAction=function t(e){return a("action",e)},e.prototype.defaultTarget=function t(e){var n=a("target",e);return n?document.querySelector(n):void 0},e.prototype.defaultText=function t(e){return a("text",e)},e.prototype.destroy=function t(){this.listener.destroy(),this.clipboardAction&&(this.clipboardAction.destroy(),this.clipboardAction=null)},e}(l.default);n.default=h,e.exports=n.default},{"./clipboard-action":8,"good-listener":5,"tiny-emitter":7}]},{},[9])(9)});
rebind();