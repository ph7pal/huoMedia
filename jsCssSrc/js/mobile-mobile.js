var ajaxReturn = true;

function rebind() {
    $("a[action=get-contents]").unbind('click').click(function () {
        var dom = $(this);
        getContents(dom);
    });
    $("a[action=favorite]").unbind('tap').tap(function () {
        var dom = $(this);
        favorite(dom);
    });
    $("a[action=vote]").unbind('tap').tap(function () {
        cancelBindLink();
        var dom = $(this);        
        addVote(dom);        
    });
    $("img.lazy").lazyload({
        threshold:600
    });
    bindLink();    
}
function bindLink(){
    $('.ui-grid-full li,.ui-list li,.ui-row li,.ui-avatar,.ui-col').unbind('click').click(function () {
        if ($(this).attr('data-href')) {
            location.href = $(this).attr('data-href');
        }
    });
}

function cancelBindLink(){
    $('.ui-grid-full li,.ui-list li,.ui-row li,.ui-avatar,.ui-col').unbind('tap');
}

function dialog(diaObj) {
    if (typeof diaObj !== "object") {
        return false;
    }
    if(!diaObj.title){
        diaObj.title='';
    }
    if (zmf.fromApp === '1') {
        loadApp('dialog',{diaTitle:diaObj.title,diaContent:diaObj.msg});
        return false;
    }
    var buttons = [];
    if (!diaObj.buttons) {
//        buttons=["确认", "取消"];
        buttons = ["关闭"];
    } else {
        buttons = diaObj.buttons;
    }
    var dia = $.dialog({
        title: diaObj.title,
        content: diaObj.msg,
        button: buttons
    });
    dia.on("dialog:action", function (e) {
        if (buttons[e.index] === '下载') {
            window.location.href = "http://www.inwedding.cn/";
        }
    });
    dia.on("dialog:hide", function (e) {

    });
}

function checkAjax() {
    if (!ajaxReturn) {
        dialog({msg: '请求正在发送中，请稍后'});
        return false;
    }
    ajaxReturn = false;
    return true;
}

function favorite(dom) {
    if (!checkLogin()) {
        dialog({msg: '请先登录'});
        return false;
    }
    var acdata = dom.attr("action-data");
    var t = dom.attr("action-type");
    var dt = dom.html();
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
            dom.html('<i class="ui-icon-liked"></i>');
        } else if (result.status === 2) {//收藏失败
            dom.text(dt);
        } else if (result.status === 3) {//取消成功
            dom.html('<i class="ui-icon-like"></i>');
        } else if (result.status === 4) {//取消失败
            dom.text(dt);
        } else {
            dialog({msg: result.msg});
        }
        return false;
    });
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
/*lazyload*/
!function (a, b, c, d) {
    var e = a(b);
    a.fn.lazyload = function (c) {
        function i() {
            var b = 0;
            f.each(function () {
                var c = a(this);
                if (!h.skip_invisible || "none" !== c.css("display"))
                    if (a.abovethetop(this, h) || a.leftofbegin(this, h))
                        ;
                    else if (a.belowthefold(this, h) || a.rightoffold(this, h)) {
                        if (++b > h.failure_limit)
                            return!1
                    } else
                        c.trigger("appear"), b = 0
            })
        }
        var g, f = this, h = {threshold: 0, failure_limit: 0, event: "scroll", effect: "show", container: b, data_attribute: "original", skip_invisible: !0, appear: null, load: null};
        return c && (d !== c.failurelimit && (c.failure_limit = c.failurelimit, delete c.failurelimit), d !== c.effectspeed && (c.effect_speed = c.effectspeed, delete c.effectspeed), a.extend(h, c)), g = h.container === d || h.container === b ? e : a(h.container), 0 === h.event.indexOf("scroll") && g.on(h.event, function () {
            return i()
        }), this.each(function () {
            var b = this, c = a(b);
            b.loaded = !1, c.one("appear", function () {
                if (!this.loaded) {
                    if (h.appear) {
                        var d = f.length;
                        h.appear.call(b, d, h)
                    }
                    a("<img />").on("load", function () {
                        var d, e;
                        c.hide().attr("src", c.data(h.data_attribute))[h.effect](h.effect_speed), b.loaded = !0, d = a.grep(f, function (a) {
                            return!a.loaded
                        }), f = a(d), h.load && (e = f.length, h.load.call(b, e, h))
                    }).attr("src", c.data(h.data_attribute))
                }
            }), 0 !== h.event.indexOf("scroll") && c.on(h.event, function () {
                b.loaded || c.trigger("appear")
            })
        }), e.on("resize", function () {
            i()
        }), /iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion) && e.on("pageshow", function (b) {
            b = b.originalEvent || b, b.persisted && f.each(function () {
                a(this).trigger("appear")
            })
        }), a(b).on("load", function () {
            i()
        }), this
    }, a.belowthefold = function (c, f) {
        var g;
        return g = f.container === d || f.container === b ? e.height() + e.scrollTop() : a(f.container).offset().top + a(f.container).height(), g <= a(c).offset().top - f.threshold
    }, a.rightoffold = function (c, f) {
        var g;
        return g = f.container === d || f.container === b ? e.width() + e[0].scrollX : a(f.container).offset().left + a(f.container).width(), g <= a(c).offset().left - f.threshold
    }, a.abovethetop = function (c, f) {
        var g;
        return g = f.container === d || f.container === b ? e.scrollTop() : a(f.container).offset().top, g >= a(c).offset().top + f.threshold + a(c).height()
    }, a.leftofbegin = function (c, f) {
        var g;
        return g = f.container === d || f.container === b ? e[0].scrollX : a(f.container).offset().left, g >= a(c).offset().left + f.threshold + a(c).width()
    }, a.inviewport = function (b, c) {
        return!(a.rightoffold(b, c) || a.leftofbegin(b, c) || a.belowthefold(b, c) || a.abovethetop(b, c))
    }, a.extend(a.fn, {"below-the-fold": function (b) {
            return a.belowthefold(b, {threshold: 0})
        }, "above-the-top": function (b) {
            return!a.belowthefold(b, {threshold: 0})
        }, "right-of-screen": function (b) {
            return a.rightoffold(b, {threshold: 0})
        }, "left-of-screen": function (b) {
            return!a.rightoffold(b, {threshold: 0})
        }, "in-viewport": function (b) {
            return a.inviewport(b, {threshold: 0})
        }, "above-the-fold": function (b) {
            return!a.belowthefold(b, {threshold: 0})
        }, "right-of-fold": function (b) {
            return a.rightoffold(b, {threshold: 0})
        }, "left-of-fold": function (b) {
            return!a.rightoffold(b, {threshold: 0})
        }})
}($, window, document);

rebind();