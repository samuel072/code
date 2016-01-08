var JSON;
JSON || (JSON = {}),
function() {
    function f(e) {
        return e < 10 ? "0" + e: e
    }
    function quote(e) {
        return escapable.lastIndex = 0,
        escapable.test(e) ? '"' + e.replace(escapable,
        function(e) {
            var t = meta[e];
            return typeof t == "string" ? t: "\\u" + ("0000" + e.charCodeAt(0).toString(16)).slice( - 4)
        }) + '"': '"' + e + '"'
    }
    function str(e, t) {
        var n, r, i, s, o = gap,
        u, a = t[e];
        a && typeof a == "object" && typeof a.toJSON == "function" && (a = a.toJSON(e)),
        typeof rep == "function" && (a = rep.call(t, e, a));
        switch (typeof a) {
        case "string":
            return quote(a);
        case "number":
            return isFinite(a) ? String(a) : "null";
        case "boolean":
        case "null":
            return String(a);
        case "object":
            if (!a) return "null";
            gap += indent,
            u = [];
            if (Object.prototype.toString.apply(a) === "[object Array]") {
                s = a.length;
                for (n = 0; n < s; n += 1) u[n] = str(n, a) || "null";
                return i = u.length === 0 ? "[]": gap ? "[\n" + gap + u.join(",\n" + gap) + "\n" + o + "]": "[" + u.join(",") + "]",
                gap = o,
                i
            }
            if (rep && typeof rep == "object") {
                s = rep.length;
                for (n = 0; n < s; n += 1) typeof rep[n] == "string" && (r = rep[n], i = str(r, a), i && u.push(quote(r) + (gap ? ": ": ":") + i))
            } else for (r in a) Object.prototype.hasOwnProperty.call(a, r) && (i = str(r, a), i && u.push(quote(r) + (gap ? ": ": ":") + i));
            return i = u.length === 0 ? "{}": gap ? "{\n" + gap + u.join(",\n" + gap) + "\n" + o + "}": "{" + u.join(",") + "}",
            gap = o,
            i
        }
    }
    "use strict",
    typeof Date.prototype.toJSON != "function" && (Date.prototype.toJSON = function(e) {
        return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z": null
    },
    String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(e) {
        return this.valueOf()
    });
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
    escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
    gap, indent, meta = {
        "\b": "\\b",
        "	": "\\t",
        "\n": "\\n",
        "\f": "\\f",
        "\r": "\\r",
        '"': '\\"',
        "\\": "\\\\"
    },
    rep;
    typeof JSON.stringify != "function" && (JSON.stringify = function(e, t, n) {
        var r;
        gap = "",
        indent = "";
        if (typeof n == "number") for (r = 0; r < n; r += 1) indent += " ";
        else typeof n == "string" && (indent = n);
        rep = t;
        if (!t || typeof t == "function" || typeof t == "object" && typeof t.length == "number") return str("", {
            "": e
        });
        throw new Error("JSON.stringify")
    }),
    typeof JSON.parse != "function" && (JSON.parse = function(text, reviver) {
        function walk(e, t) {
            var n, r, i = e[t];
            if (i && typeof i == "object") for (n in i) Object.prototype.hasOwnProperty.call(i, n) && (r = walk(i, n), r !== undefined ? i[n] = r: delete i[n]);
            return reviver.call(e, t, i)
        }
        var j;
        text = String(text),
        cx.lastIndex = 0,
        cx.test(text) && (text = text.replace(cx,
        function(e) {
            return "\\u" + ("0000" + e.charCodeAt(0).toString(16)).slice( - 4)
        }));
        if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) return j = eval("(" + text + ")"),
        typeof reviver == "function" ? walk({
            "": j
        },
        "") : j;
        throw new SyntaxError("JSON.parse")
    })
} (),
function() {
    var e = {},
    t = "ns";
    e.localStorage = {
        test: function() {
            try {
                return window.localStorage ? !0 : !1
            } catch(e) {
                return ! 1
            }
        },
        methods: {
            init: function(e) {},
            set: function(e, t, n) {
                try {
                    localStorage.setItem(e + t, n)
                } catch(r) {
                    throw r
                }
            },
            get: function(e, t) {
                return localStorage.getItem(e + t)
            },
            remove: function(e, t) {
                localStorage.removeItem(e + t)
            },
            clear: function(e) {
                if (!e) localStorage.clear();
                else for (var t = 0,
                n; n = localStorage.key(t++);) n && n.indexOf(e) === 0 && localStorage.removeItem(n)
            }
        }
    },
    e.userData = {
        test: function() {
            try {
                return window.ActiveXObject && document.documentElement.addBehavior ? !0 : !1
            } catch(e) {
                return ! 1
            }
        },
        methods: {
            _owners: {},
            init: function(e) {
                if (!this._owners[e]) {
                    if (document.getElementById(e)) this._owners[e] = document.getElementById(e);
                    else {
                        var t = document.createElement("script"),
                        n = document.head || document.getElementsByTagName("head")[0] || document.documentElement;
                        t.id = e,
                        t.style.display = "none",
                        t.addBehavior("#default#userdata"),
                        n.insertBefore(t, n.firstChild),
                        this._owners[e] = t
                    }
                    try {
                        this._owners[e].load(e)
                    } catch(r) {}
                    var i = this;
                    window.attachEvent("onunload",
                    function() {
                        i._owners[e] = null
                    })
                }
            },
            set: function(e, t, n) {
                if (this._owners[e]) try {
                    this._owners[e].setAttribute(t, n),
                    this._owners[e].save(e)
                } catch(r) {
                    throw r
                }
            },
            get: function(e, t) {
                return this._owners[e] ? (this._owners[e].load(e), this._owners[e].getAttribute(t) || "") : ""
            },
            remove: function(e, t) {
                this._owners[e] && (this._owners[e].removeAttribute(t), this._owners[e].save(e))
            },
            clear: function(e) {
                if (this._owners[e]) {
                    var t = this._owners[e].XMLDocument.documentElement.attributes;
                    this._owners[e].load(e);
                    for (var n = 0,
                    r; r = t[n]; n++) this._owners[e].removeAttribute(r.name);
                    this._owners[e].save(e)
                }
            }
        }
    };
    var n = function() {
        return e.localStorage.test() ? e.localStorage.methods: e.userData.test() ? e.userData.methods: {
            init: function() {},
            get: function() {},
            set: function() {},
            remove: function() {},
            clear: function() {}
        }
    } (),
    r = {},
    i = function(e) {
        this._cache = {},
        this._ns = t + "_" + e + "_",
        this._inited = !1,
        n && !this._inited && n.init(this._ns)
    };
    i.serialize = function(e) {
        return JSON.stringify(e)
    },
    i.unserialize = function(e) {
        return JSON.parse(e)
    },
    i.prototype = {
        set: function(e, t) {
            this._cache[e] = t;
            try {
                return n.set(this._ns, e, i.serialize(t)),
                !0
            } catch(r) {
                return ! 1
            }
        },
        get: function(e) {
            if (this._cache[e]) return this._cache[e];
            try {
                return this._cache[e] = i.unserialize(n.get(this._ns, e))
            } catch(t) {
                return ""
            }
        },
        remove: function(e) {
            try {
                n.remove(this._ns, e)
            } catch(t) {}
            this._cache[e] = null,
            delete this._cache[e]
        },
        clear: function() {
            try {
                n.clear(this._ns)
            } catch(e) {}
            this._cache = {}
        }
    },
    i.ins = function(e) {
        return r[e] || (r[e] = new i(e)),
        r[e]
    },
    window.cacheSvc = i
} (); (function() {
    function n(e, t) {
	this._getdata = true,
        this._dom = e,
        this._dom.attr("autocomplete", "off"),
        this._doConfig(t),
        this._suggestProtectedTimer = null,
        this._checkInputTimer = null,
        this._checkInputSec = 200,
        this._invalidWords = [],
        this._history = [],
        this._parseDataStarted = !1,
        this._suggestList = W('<div class="suggest-pop"><div class="suggest-pop-bd"></div>'),
        this._inputWord = "",
        this._bindSuggestEvent(),
        W("body").appendChild(this._suggestList),
        this._configSuggestListPos(),
        this._bodyPos = DomU.getDocRect(),
        this.sugestInitedt = !1;
        var n = this,
        r;
        window.onresize && (r = window.onresize),
        window.onresize = function() {
            r && r();
            var e = DomU.getDocRect();
            if (e.scrollWidth != n._bodyPos.scrollWidth || e.scrollHeight != n._bodyPos.scrollHeight) n._configSuggestListPos(),
            n._bodyPos = e
        },
        W(".suggest-pop").delegate(".add", "click",
        function(t) {
            e.val(W(this).previousSibling(".title").html().stripTags()),
            t.preventDefault()
        })
    }
    var e = [9, 13, 16, 17, 18, 19, 20, 33, 34, 35, 36, 37, 39, 41, 42, 43, 45, 47],
    t = 0;
    n.prototype.getSuggestData = function(e) {
        return "undefined" != typeof self._history[e] ? this._history[e] : {}
    },
    n.prototype.changeListPos = function() {
        this._configSuggestListPos()
    },
    n.prototype._configSuggestListPos = function() {
        var e = NodeH.getRect(this._dom),
        t = typeof this.posAdjust.top == "undefined" ? e.bottom + "px": e.bottom + this.posAdjust.top + "px",
        n = typeof this.posAdjust.left == "undefined" ? e.left + "px": e.left + this.posAdjust.left + "px",
        r = typeof this.posAdjust.width == "undefined" ? (e.width-31) + "px": (e.width + this.posAdjust.width-31) + "px",
        i = typeof this.posAdjust.zIndex == "undefined" ? 201 : e.width + this.posAdjust.zIndex + "px";
        
        this._suggestList.css({
            position: "absolute",
            top: t,
            left: n,
            width: r,
            "z-index": i
        },
        1)
    },
    n.prototype._doConfig = function(e) {
        this.dataUrl = e.data_url || "",
        this.topDataUrl = e.topData_url || "",
        this.hasTopSuggest = e.hasTopSuggest || !1,
        this.suggestData = e.suggest_data || {},
        this.prefixProtected = typeof e.prefix_protected == "undefined" ? !0 : e.prefix_protected,
        this.lazySuggestTime = typeof e.lazy_suggest_time == "undefined" ? 200 : e.lazy_suggest_time,
        this.minWordLength = e.min_word_length | 0,
        this.itemHoverStyle = typeof e.item_hover_style == "undefined" ? "ahover": e.item_hover_style,
        this.posAdjust = typeof e.pos_adjust == "undefined" ? {}: e.pos_adjust,
        this.getDataFun = e.get_data_fun || "jsonp",
        this.onbeforesuggest = e.onbeforesuggest,
        this.onaftersuggest = e.onaftersuggest
    },
    n.prototype.updateConfig = function(e) {
        this.hasTopSuggest = e.hasTopSuggest || !1
    },
    n.prototype.getCurrentSearchWord = function(e) {
        return W(e).val()
    },
    n.prototype._isValidWord = function(e) {
        for (var t = 0,
        n = this._invalidWords; t < n; ++t) if (e.indexOf(this._invalidWords[t]) > -1) return ! 1;
        return ! 0
    },
    n.prototype._initList = function(e) {
        var n = [],
        r = W(this._dom).val().trim(),
        i,
        s = this,
        o = "";
        for (var u = 0; u < e.length; ++u) u < 3 ? o = "suggest-hot": o = "",
        i = e[u].replace(r, "<em class='red'>" + r + "</em>"),
        n.push('<div data-index="" class="suggest-item"><span class="suggest-index ' + o + '">' + (u + 1) + '</span><a class="title">' + i + '</a><a class="add"></a></div>');
        r == "" ? this._suggestList.addClass("top-suggest") : this._suggestList.removeClass("top-suggest"),
        this._suggestList.query(".suggest-pop-bd").html(n.join("")),
        this._suggestList.show(),
        this.sugestInitedt == 0 && (W(this._suggestList).delegate(".title", "mouseover",
        function() {
            W(this).addClass(s.itemHoverStyle);
        }), W(this._suggestList).delegate(".title", "mouseout",
        function() {
            W(this).removeClass(s.itemHoverStyle)
        }), W(this._suggestList).delegate(".title", "click",
        function() {
            s._suggestList.hide(),
            s._dom.val(W(this).html().stripTags()),
            s._dom.attr("form").submit()
        }), W("body").on("click",
        function(e) {
            W(e.target).attr("id") != "kw" && (s._suggestList.hide(), t = 0)
        }), W(".suggest-pop-ft .close").on("click",
        function(e) {
            s._suggestList.hide(),
            t = 0,
            e.preventDefault()
        }), this.sugestInitedt = !0)
    },
    n.prototype._parseData = function(e, t) {
        var n = {},
        r;
        if (this.onbeforesuggest && this.onbeforesuggest() === !1) return ! 1;
        try {
            n = t.evalExp()
        } catch(i) {}
        r = Object.stringify(n),
        r === "{}" || r == "[]" ? (this._invalidWords.push(e), this._suggestList.hide()) : (this._history[e] = t, this._initList(n)),
        this._parseDataStarted = !1;
        if (this.onaftersuggest && this.onaftersuggest() === !1) return ! 1
    },
    n.prototype._doGetData = function(e) {
        var n = this;
        if (this.prefixProtected && 0 == n._isValidWord(e)) return ! 1;
        if (e.length < n.minWordLength) return ! 1;
        if (n._parseDataStarted == 0) {
            n._parseDataStarted = !0;
            if ("undefined" != typeof n._history[e]) datas = n._history[e],
            n._parseData(e, datas);
            else if (this.dataUrl) {
                var r;
                if (e.indexOf("?") != -1) {
                    this._parseDataStarted = !1;
                    return
                }
                "" == e && n.hasTopSuggest ? r = n.topDataUrl.replace(/%%KEYWORD%%/, encodeURIComponent(e)) : r = n.dataUrl.replace(/%%KEYWORD%%/, encodeURIComponent(e));
                if (this.getDataFun == "ajax") {
                    var i = new Ajax;
                    i.open("GET", r, "", "TXT",
                    function(t) {
                        n._parseData(e, t)
                    })
                } else if (this.getDataFun == "jsonp") {
                    var s = "jsonp" + +(new Date);
                    window[s] = function(t) {
                        n._parseData(e, Object.stringify(t))
                    },
                    r = r.replace(/%%CALLBACKFUN%%/, s),
                    loadJs(r),
                    t = 0
                }
            } else n._parseData(e, n.suggestData)
        }
    },
    n.prototype._manageSuggester = function(e) {
        var t = this,
        n;
        this._suggestProtectedTimer && window.clearTimeout(this._suggestProtectedTimer),
        this._suggestProtectedTimer = window.setTimeout(function() {
	    if (t._getdata)
	    {
           	 var n = e.target,
           	 r = W(n).val().trim();
           	 t._inputWord = r,
           	 t._doGetData(r)
	    }
        },
        t.lazySuggestTime)
    },
    n.prototype._dealWithSuggestEvent = function(e) {
        var t = this,
        n = "";
        W(e).on("focus",
        function(r) {
	    t._getdata = true,
            t._checkInputTimer = window.setInterval(function() {
                e.val().trim() != n && (t._manageSuggester(r), n = e.val().trim())
            },
            t._checkInputSec)
        }).on("blur",
        function(e) {
            clearTimeout(t._checkInputTimer),
            n = ""
        }).on("keydown",
        function(e) {	
	    $("div.suggest-pop").trigger('mouseout');
            var theEvent = window.event || e;
            var code = theEvent.keyCode || theEvent.which;
            if (code == 38 || code == 40){
                t._getdata = false;
                var hover = $('a.ahover'), index = hover.prev().text();
                if (code == 38) {
                        if (index == 1){
                                hover.removeClass(t.itemHoverStyle);
                                hover = $('a.title:last').addClass(t.itemHoverStyle);
                        } else {
              //                   alert(hover.hasClass(t.itemHoverStyle));
            //                hover = hover.removeClass(t.itemHoverStyle);
                           // alert(hover.hasClass(t.itemHoverStyle));
                           hover= hover.removeClass(t.itemHoverStyle).parent().prev().children("a.title").addClass(t.itemHoverStyle);
                            alert(hover.hasClass(t.itemHoverStyle));
                        }
                } else {
                        if (index == $('a.title').length || index == 0)
                        {
                                hover.removeClass(t.itemHoverStyle);
                                hover = $('a.title:first').addClass(t.itemHoverStyle);
                        } else {
                                hover = hover.removeClass(t.itemHoverStyle).parent().next().children("a.title").addClass(t.itemHoverStyle);
                        }
                }
                document.getElementById("input_query").value = hover.text();
            }else{
                t._getdata = true;
                if (code == 13)
                   $("#btn_search").click();
            }
        })
    },
    n.prototype._bindSuggestEvent = function() {
        this._dealWithSuggestEvent(this._dom)
    },
    W("body").delegate(".top-suggest a", "click",
    function(e) {
        var t = W(this),
        n = {},
        r = "http://s.360.cn/yingsi/s.htm";
        n.r = "c",
        n.b = "emp_sug",
        n.num = t.query(".suggest-item").html(),
        n.kw = t.query(".title").html().stripTags(),
        n.u = window.location.host,
        monitor.buildLog(n, r)
    }),
    window.suggest = n
})();
function checkFlash() {
    var e = navigator;
    if (e.plugins && e.mimeTypes.length) {
        var t = e.plugins["Shockwave Flash"];
        if (t && t.description) return t.description.replace(/([a-zA-Z]|\s)+/, "").replace(/(\s)+r/, ".") + ".0"
    } else if (window.ActiveXObject && !window.opera) for (var n = 12; n >= 2; n--) try {
        var r = new ActiveXObject("ShockwaveFlash.ShockwaveFlash." + n);
        if (r) {
            var i = r.GetVariable("$version");
            return i.replace(/WIN/g, "").replace(/,/g, ".")
        }
    } catch(s) {}
}
function generSearchBar() {
    function e(e) {
        return document.getElementById(e)
    }
    function t(e) {
        return document.getElementsByClassName(e)
    }
    e("products-nav").className = /iphone|ipad/gi.test(navigator.userAgent) ? "iphone clearfix": "clearfix";
    var n = "\u641c\u7d22\u5f71\u89c6",
    r = e("searchInputBox"),
    i = t("q"),
    s = t("search-box-reset");
    for (var o = i.length - 1; o >= 0; o--)(function(e) {
        var t = i[e];
        t.value == "" && (t.value = n, t.style.color = "#bbb"),
        t.addEventListener("focus",
        function() {
            this.value == n && (this.value = "", this.style.color = "#333")
        },
        !1),
        t.addEventListener("blur",
        function() {
            this.value == "" && (this.value = n, this.style.color = "#bbb")
        },
        !1),
        s[e] && s[e].addEventListener("click",
        function(t) {
            i[e].value = "",
            i[e].focus(),
            t.preventDefault(),
            t.stopPropagation()
        },
        !1)
    })(o);
    setInterval(function() {
        for (var e = i.length - 1; e >= 0; e--)(function(e) {
            i[e].value != "" && i[e].value != n ? s[e].style.display = "block": s[e].style.display = "none"
        })(e)
    },
    50);
    var u = e("toggle-nav"),
    a = e("nav-container"),
    f = e("toggle-nav-state"),
    l = a.getElementsByTagName("a");
    u.addEventListener("click",
    function(e) {
        a.className = a.className == "" ? "show": "",
        f.className = a.className == "" ? "": "up",
        e.stopPropagation()
    },
    !1),
    document.addEventListener("click",
    function(e) {
        a.className == "show" && (a.className = "", f.className = "")
    },
    !1);
    for (var o = l.length - 1; o >= 0; o--) l[o].addEventListener("mousedown",
    function(e) {
        if (r.value != "" && r.value != n) {
            var t = this.getAttribute("data-search");
            t && (this.href = t + encodeURIComponent(r.value))
        }
        e.stopPropagation()
    },
    !1)
}
W(".return").click(function(e) {
    window.location.href.search("so.com") != -1 ? window.location.href = "/": window.location.href = "/"
}),
W(".search-submit").click(function(e) {
    W("#searchInputBox").val().replace(/ /g, "") != "" && W("#searchform").submit()
}),
function() {
    if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) return;
    var e = ["2.2.0", "2.3.1", "2.3.3", "2.3.4", "3.0.0", "3.1.0", "3.2.0"],
    t = location.search.queryUrl().os,
    n = checkFlash(),
    r = W("#download-flash"),
    i = cacheSvc.ins("store"),
    s = "flashBar",
    o = i.get(s);
    if (o && o == "close") return;
    if ( !! n) return;
    W(".topbar").show(),
    parseFloat(t) >= 4 ? r.attr("href", "http://shouji.360safe.com/360sj/adm/apk/20121212/com.adobe.flashplayer_111115034_113322.apk") : e.some(function(e) {
        return e == t
    }) ? r.attr("href", "http://static.nduoa.com/apk/434/434304/1151531/com.adobe.flashplayer.apk ") : r.hide(),
    W(".topbar .close").on("touchstart,click",
    function(e) {
        e.preventDefault(),
        W(".topbar").hide(),
        o = "close",
        i.set(s, o)
    })
} (),
W("#header").length && generSearchBar();
