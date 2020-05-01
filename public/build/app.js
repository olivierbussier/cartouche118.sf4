(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/bootstrap.scss":
/*!***********************************!*\
  !*** ./assets/css/bootstrap.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/css/c118_frame.scss":
/*!************************************!*\
  !*** ./assets/css/c118_frame.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/css/modern-business.css":
/*!****************************************!*\
  !*** ./assets/css/modern-business.css ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {__webpack_require__(/*! core-js/modules/es.date.to-string */ "./node_modules/core-js/modules/es.date.to-string.js");

/*
 * Fichier de dépendances Javascript et CSS utilisé par webpack encore
 * Ce fichier contient l'ensemble des dépendances nécessaires au chargement de toutes les pages
 * (inclus dans base.html.twig)
 */
// Fichiers CSS
__webpack_require__(/*! ../css/bootstrap.scss */ "./assets/css/bootstrap.scss");

__webpack_require__(/*! ../css/c118_frame.scss */ "./assets/css/c118_frame.scss");

__webpack_require__(/*! ../css/modern-business.css */ "./assets/css/modern-business.css"); // jQuery


var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

__webpack_require__(/*! jquery-ui/ui/widgets/autocomplete */ "./node_modules/jquery-ui/ui/widgets/autocomplete.js");

global.$ = global.jQuery = $; // Bootstrap

__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js"); // Preview (TODO : n'est utilisé que par l'édition de la page d'accueil, a déplacer)
// Affichare du message d'avertissement cookie RGPD


__webpack_require__(/*! ./components/cookiebanner.min.js */ "./assets/js/components/cookiebanner.min.js");

var options = {
  'position': "top",
  'fg': "#ffffff",
  'bg': "#3b5269",
  'link': "#dddddd",
  'moreinfo': "http://www.cnil.fr/vos-obligations/sites-web-cookies-et-autres-traceurs/que-dit-la-loi/",
  'message': "Les cookies assurent le bon fonctionnement de notre site Internet En utilisant ce dernier, vous acceptez leur utilisation.",
  'linkmsg': "En savoir plus",
  'effect': "fade",
  'expires': 30 * 24 * 60 * 60,
  'zindex': "11000",
  'height': "64px",
  'font-size': "22px"
};
var cb = new Cookiebanner(options);
cb.run();
window.dataLayer = window.dataLayer || [];

function gtag() {
  dataLayer.push(arguments);
}

gtag('js', new Date());
gtag('config', 'UA-36637245-1');
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./assets/js/components/cookiebanner.min.js":
/*!**************************************************!*\
  !*** ./assets/js/components/cookiebanner.min.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"/*! (C) Cookie Banner v1.2.1 - MIT License - http://cookiebanner.eu/ */";

__webpack_require__(/*! core-js/modules/es.array.index-of */ "./node_modules/core-js/modules/es.array.index-of.js");

__webpack_require__(/*! core-js/modules/es.date.to-string */ "./node_modules/core-js/modules/es.date.to-string.js");

__webpack_require__(/*! core-js/modules/es.function.name */ "./node_modules/core-js/modules/es.function.name.js");

__webpack_require__(/*! core-js/modules/es.number.constructor */ "./node_modules/core-js/modules/es.number.constructor.js");

__webpack_require__(/*! core-js/modules/es.number.to-fixed */ "./node_modules/core-js/modules/es.number.to-fixed.js");

__webpack_require__(/*! core-js/modules/es.parse-float */ "./node_modules/core-js/modules/es.parse-float.js");

__webpack_require__(/*! core-js/modules/es.parse-int */ "./node_modules/core-js/modules/es.parse-int.js");

__webpack_require__(/*! core-js/modules/es.regexp.constructor */ "./node_modules/core-js/modules/es.regexp.constructor.js");

__webpack_require__(/*! core-js/modules/es.regexp.exec */ "./node_modules/core-js/modules/es.regexp.exec.js");

__webpack_require__(/*! core-js/modules/es.regexp.to-string */ "./node_modules/core-js/modules/es.regexp.to-string.js");

__webpack_require__(/*! core-js/modules/es.string.replace */ "./node_modules/core-js/modules/es.string.replace.js");

__webpack_require__(/*! core-js/modules/es.string.link */ "./node_modules/core-js/modules/es.string.link.js");

__webpack_require__(/*! core-js/modules/web.timers */ "./node_modules/core-js/modules/web.timers.js");

!function (e) {
  "use strict";

  function t(e, t) {
    var i = !1,
        o = !0,
        n = e.document,
        s = n.documentElement,
        r = n.addEventListener ? "addEventListener" : "attachEvent",
        a = n.addEventListener ? "removeEventListener" : "detachEvent",
        c = n.addEventListener ? "" : "on",
        l = function l(o) {
      "readystatechange" == o.type && "complete" != n.readyState || (("load" == o.type ? e : n)[a](c + o.type, l, !1), !i && (i = !0) && t.call(e, o.type || o));
    },
        p = function p() {
      try {
        s.doScroll("left");
      } catch (e) {
        return void setTimeout(p, 50);
      }

      l("poll");
    };

    if ("complete" == n.readyState) t.call(e, "lazy");else {
      if (n.createEventObject && s.doScroll) {
        try {
          o = !e.frameElement;
        } catch (e) {}

        o && p();
      }

      n[r](c + "DOMContentLoaded", l, !1), n[r](c + "readystatechange", l, !1), e[r](c + "load", l, !1);
    }
  }

  var i = e,
      o = i.document,
      n = "cbinstance",
      s = {
    get: function get(e) {
      return decodeURIComponent(o.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(e).replace(/[-.+*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
    },
    set: function set(e, t, i, n, s, r) {
      if (!e || /^(?:expires|max-age|path|domain|secure)$/i.test(e)) return !1;
      var a = "";
      if (i) switch (i.constructor) {
        case Number:
          a = i === 1 / 0 ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + i;
          break;

        case String:
          a = "; expires=" + i;
          break;

        case Date:
          a = "; expires=" + i.toUTCString();
      }
      return o.cookie = encodeURIComponent(e) + "=" + encodeURIComponent(t) + a + (s ? "; domain=" + s : "") + (n ? "; path=" + n : "") + (r ? "; secure" : ""), !0;
    },
    has: function has(e) {
      return new RegExp("(?:^|;\\s*)" + encodeURIComponent(e).replace(/[-.+*]/g, "\\$&") + "\\s*\\=").test(o.cookie);
    },
    remove: function remove(e, t, i) {
      return !(!e || !this.has(e)) && (o.cookie = encodeURIComponent(e) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (i ? "; domain=" + i : "") + (t ? "; path=" + t : ""), !0);
    }
  },
      r = {
    merge: function merge() {
      var e,
          t = {},
          i = 0,
          o = arguments.length;
      if (0 === o) return t;

      for (; i < o; i++) {
        for (e in arguments[i]) {
          Object.prototype.hasOwnProperty.call(arguments[i], e) && (t[e] = arguments[i][e]);
        }
      }

      return t;
    },
    str2bool: function str2bool(e) {
      switch (e = String(e), e.toLowerCase()) {
        case "false":
        case "no":
        case "0":
        case "":
          return !1;

        default:
          return !0;
      }
    },
    fade_in: function fade_in(e) {
      e.style.opacity < 1 && (e.style.opacity = (parseFloat(e.style.opacity) + .05).toFixed(2), i.setTimeout(function () {
        r.fade_in(e);
      }, 50));
    },
    get_data_attribs: function get_data_attribs(e) {
      var t = {};
      if (Object.prototype.hasOwnProperty.call(e, "dataset")) t = e.dataset;else {
        var i,
            o = e.attributes;

        for (i in o) {
          if (Object.prototype.hasOwnProperty.call(o, i)) {
            var n = o[i];

            if (/^data-/.test(n.name)) {
              var s = r.camelize(n.name.substr(5));
              t[s] = n.value;
            }
          }
        }
      }
      return t;
    },
    normalize_keys: function normalize_keys(e) {
      var t = {};

      for (var i in e) {
        if (Object.prototype.hasOwnProperty.call(e, i)) {
          var o = r.camelize(i);
          t[o] = e[o] ? e[o] : e[i];
        }
      }

      return t;
    },
    camelize: function camelize(e) {
      for (var t = "-", i = e.indexOf(t); i !== -1;) {
        var o = i === e.length - 1,
            n = o ? "" : e[i + 1],
            s = n.toUpperCase(),
            r = o ? t : t + n;
        e = e.replace(r, s), i = e.indexOf(t);
      }

      return e;
    },
    find_script_by_id: function find_script_by_id(e) {
      for (var t = o.getElementsByTagName("script"), i = 0, n = t.length; i < n; i++) {
        if (e === t[i].id) return t[i];
      }

      return null;
    }
  },
      a = r.find_script_by_id("cookiebanner"),
      c = e.Cookiebanner = function (e) {
    this.init(e);
  };

  c.prototype = {
    cookiejar: s,
    init: function init(t) {
      this.inserted = !1, this.closed = !1, this.test_mode = !1;
      var i = "We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.",
          o = "Learn more";

      if (this.default_options = {
        cookie: "cookiebanner-accepted",
        closeText: "&#10006;",
        closeStyle: "float:right;padding-left:5px;",
        closePrecedes: !0,
        cookiePath: "/",
        cookieDomain: null,
        cookieSecure: !1,
        debug: !1,
        expires: 1 / 0,
        zindex: 255,
        mask: !1,
        maskOpacity: .5,
        maskBackground: "#000",
        height: "auto",
        minHeight: "21px",
        bg: "#000",
        fg: "#ddd",
        link: "#aaa",
        position: "bottom",
        message: i,
        linkmsg: o,
        moreinfo: "http://aboutcookies.org",
        moreinfoTarget: "_blank",
        moreinfoRel: "noopener noreferrer",
        moreinfoDecoration: "none",
        moreinfoFontWeight: "normal",
        moreinfoFontSize: null,
        effect: null,
        fontSize: "14px",
        fontFamily: "arial, sans-serif",
        instance: n,
        textAlign: "center",
        acceptOnScroll: !1,
        acceptOnClick: !1,
        acceptOnTimeout: null,
        acceptOnFirstVisit: !1
      }, this.options = this.default_options, this.script_el = a, this.script_el) {
        var s = r.get_data_attribs(this.script_el);
        this.options = r.merge(this.options, s);
      }

      t && (t = r.normalize_keys(t), this.options = r.merge(this.options, t)), n = this.options.instance, this.options.zindex = parseInt(this.options.zindex, 10), this.options.mask = r.str2bool(this.options.mask), this.options.closePrecedes = r.str2bool(this.options.closePrecedes), "string" == typeof this.options.expires && "function" == typeof e[this.options.expires] && (this.options.expires = e[this.options.expires]), "function" == typeof this.options.expires && (this.options.expires = this.options.expires()), this.script_el && this.run();
    },
    log: function log() {
      "undefined" != typeof console && console.log.apply(console, arguments);
    },
    run: function run() {
      if (!this.agreed()) {
        var e = this;
        t(i, function () {
          e.insert();
        });
      }
    },
    build_viewport_mask: function build_viewport_mask() {
      var e = null;

      if (!0 === this.options.mask) {
        var t = this.options.maskOpacity,
            i = this.options.maskBackground,
            n = '<div id="cookiebanner-mask" style="position:fixed;top:0;left:0;width:100%;height:100%;background:' + i + ";zoom:1;filter:alpha(opacity=" + 100 * t + ");opacity:" + t + ";z-index:" + this.options.zindex + ';"></div>',
            s = o.createElement("div");
        s.innerHTML = n, e = s.firstChild;
      }

      return e;
    },
    agree: function agree() {
      return this.cookiejar.set(this.options.cookie, 1, this.options.expires, this.options.cookiePath, "" !== this.options.cookieDomain ? this.options.cookieDomain : "", !!this.options.cookieSecure), !0;
    },
    agreed: function agreed() {
      return this.cookiejar.has(this.options.cookie);
    },
    close: function close() {
      return this.inserted && (this.closed || (this.element && this.element.parentNode.removeChild(this.element), this.element_mask && this.element_mask.parentNode.removeChild(this.element_mask), this.closed = !0)), this.closed;
    },
    agree_and_close: function agree_and_close() {
      return this.agree(), this.close();
    },
    cleanup: function cleanup() {
      return this.close(), this.unload();
    },
    unload: function unload() {
      return this.script_el && this.script_el.parentNode.removeChild(this.script_el), e[n] = void 0, !0;
    },
    insert: function insert() {
      function e(e, t, i) {
        var o = e.addEventListener ? "addEventListener" : "attachEvent",
            n = e.addEventListener ? "" : "on";
        e[o](n + t, i, !1);
      }

      this.element_mask = this.build_viewport_mask();
      var t = this.options.zindex;
      this.element_mask && (t += 1);
      var i = o.createElement("div");
      i.className = "cookiebanner", i.style.position = "fixed", i.style.left = 0, i.style.right = 0, i.style.height = this.options.height, i.style.minHeight = this.options.minHeight, i.style.zIndex = t, i.style.background = this.options.bg, i.style.color = this.options.fg, i.style.lineHeight = i.style.minHeight, i.style.padding = "5px 16px", i.style.fontFamily = this.options.fontFamily, i.style.fontSize = this.options.fontSize, i.style.textAlign = this.options.textAlign, "top" === this.options.position ? i.style.top = 0 : i.style.bottom = 0;
      var n = '<div class="cookiebanner-close" style="' + this.options.closeStyle + '">' + this.options.closeText + "</div>",
          s = "<span>" + this.options.message + (this.options.linkmsg ? " <a>" + this.options.linkmsg + "</a>" : "") + "</span>";
      this.options.closePrecedes ? i.innerHTML = n + s : i.innerHTML = s + n, this.element = i;
      var a = i.getElementsByTagName("a")[0];
      a.href = this.options.moreinfo, a.target = this.options.moreinfoTarget, this.options.moreinfoRel && "" !== this.options.moreinfoRel && (a.rel = this.options.moreinfoRel), a.style.textDecoration = this.options.moreinfoDecoration, a.style.color = this.options.link, a.style.fontWeight = this.options.moreinfoFontWeight, "" !== this.options.moreinfoFontSize && (a.style.fontSize = this.options.moreinfoFontSize);
      var c = i.getElementsByTagName("div")[0];
      c.style.cursor = "pointer";
      var l = this;
      e(c, "click", function () {
        l.agree_and_close();
      }), this.element_mask && (e(this.element_mask, "click", function () {
        l.agree_and_close();
      }), o.body.appendChild(this.element_mask)), this.options.acceptOnScroll && e(window, "scroll", function () {
        l.agree_and_close();
      }), this.options.acceptOnClick && e(window, "click", function () {
        l.agree_and_close();
      }), this.options.acceptOnTimeout && !isNaN(parseFloat(this.options.acceptOnTimeout)) && isFinite(this.options.acceptOnTimeout) && setTimeout(function () {
        l.agree_and_close();
      }, this.options.acceptOnTimeout), this.options.acceptOnFirstVisit && l.agree(), o.body.appendChild(this.element), this.inserted = !0, "fade" === this.options.effect ? (this.element.style.opacity = 0, r.fade_in(this.element)) : this.element.style.opacity = 1;
    }
  }, a && (e[n] || (e[n] = new c()));
}(window);

/***/ })

},[["./assets/js/app.js","runtime","vendors~app~client","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2Jvb3RzdHJhcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9jc3MvYzExOF9mcmFtZS5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9jc3MvbW9kZXJuLWJ1c2luZXNzLmNzcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jb21wb25lbnRzL2Nvb2tpZWJhbm5lci5taW4uanMiXSwibmFtZXMiOlsicmVxdWlyZSIsIiQiLCJnbG9iYWwiLCJqUXVlcnkiLCJvcHRpb25zIiwiY2IiLCJDb29raWViYW5uZXIiLCJydW4iLCJ3aW5kb3ciLCJkYXRhTGF5ZXIiLCJndGFnIiwicHVzaCIsImFyZ3VtZW50cyIsIkRhdGUiLCJlIiwidCIsImkiLCJvIiwibiIsImRvY3VtZW50IiwicyIsImRvY3VtZW50RWxlbWVudCIsInIiLCJhZGRFdmVudExpc3RlbmVyIiwiYSIsImMiLCJsIiwidHlwZSIsInJlYWR5U3RhdGUiLCJjYWxsIiwicCIsImRvU2Nyb2xsIiwic2V0VGltZW91dCIsImNyZWF0ZUV2ZW50T2JqZWN0IiwiZnJhbWVFbGVtZW50IiwiZ2V0IiwiZGVjb2RlVVJJQ29tcG9uZW50IiwiY29va2llIiwicmVwbGFjZSIsIlJlZ0V4cCIsImVuY29kZVVSSUNvbXBvbmVudCIsInNldCIsInRlc3QiLCJjb25zdHJ1Y3RvciIsIk51bWJlciIsIlN0cmluZyIsInRvVVRDU3RyaW5nIiwiaGFzIiwicmVtb3ZlIiwibWVyZ2UiLCJsZW5ndGgiLCJPYmplY3QiLCJwcm90b3R5cGUiLCJoYXNPd25Qcm9wZXJ0eSIsInN0cjJib29sIiwidG9Mb3dlckNhc2UiLCJmYWRlX2luIiwic3R5bGUiLCJvcGFjaXR5IiwicGFyc2VGbG9hdCIsInRvRml4ZWQiLCJnZXRfZGF0YV9hdHRyaWJzIiwiZGF0YXNldCIsImF0dHJpYnV0ZXMiLCJuYW1lIiwiY2FtZWxpemUiLCJzdWJzdHIiLCJ2YWx1ZSIsIm5vcm1hbGl6ZV9rZXlzIiwiaW5kZXhPZiIsInRvVXBwZXJDYXNlIiwiZmluZF9zY3JpcHRfYnlfaWQiLCJnZXRFbGVtZW50c0J5VGFnTmFtZSIsImlkIiwiaW5pdCIsImNvb2tpZWphciIsImluc2VydGVkIiwiY2xvc2VkIiwidGVzdF9tb2RlIiwiZGVmYXVsdF9vcHRpb25zIiwiY2xvc2VUZXh0IiwiY2xvc2VTdHlsZSIsImNsb3NlUHJlY2VkZXMiLCJjb29raWVQYXRoIiwiY29va2llRG9tYWluIiwiY29va2llU2VjdXJlIiwiZGVidWciLCJleHBpcmVzIiwiemluZGV4IiwibWFzayIsIm1hc2tPcGFjaXR5IiwibWFza0JhY2tncm91bmQiLCJoZWlnaHQiLCJtaW5IZWlnaHQiLCJiZyIsImZnIiwibGluayIsInBvc2l0aW9uIiwibWVzc2FnZSIsImxpbmttc2ciLCJtb3JlaW5mbyIsIm1vcmVpbmZvVGFyZ2V0IiwibW9yZWluZm9SZWwiLCJtb3JlaW5mb0RlY29yYXRpb24iLCJtb3JlaW5mb0ZvbnRXZWlnaHQiLCJtb3JlaW5mb0ZvbnRTaXplIiwiZWZmZWN0IiwiZm9udFNpemUiLCJmb250RmFtaWx5IiwiaW5zdGFuY2UiLCJ0ZXh0QWxpZ24iLCJhY2NlcHRPblNjcm9sbCIsImFjY2VwdE9uQ2xpY2siLCJhY2NlcHRPblRpbWVvdXQiLCJhY2NlcHRPbkZpcnN0VmlzaXQiLCJzY3JpcHRfZWwiLCJwYXJzZUludCIsImxvZyIsImNvbnNvbGUiLCJhcHBseSIsImFncmVlZCIsImluc2VydCIsImJ1aWxkX3ZpZXdwb3J0X21hc2siLCJjcmVhdGVFbGVtZW50IiwiaW5uZXJIVE1MIiwiZmlyc3RDaGlsZCIsImFncmVlIiwiY2xvc2UiLCJlbGVtZW50IiwicGFyZW50Tm9kZSIsInJlbW92ZUNoaWxkIiwiZWxlbWVudF9tYXNrIiwiYWdyZWVfYW5kX2Nsb3NlIiwiY2xlYW51cCIsInVubG9hZCIsImNsYXNzTmFtZSIsImxlZnQiLCJyaWdodCIsInpJbmRleCIsImJhY2tncm91bmQiLCJjb2xvciIsImxpbmVIZWlnaHQiLCJwYWRkaW5nIiwidG9wIiwiYm90dG9tIiwiaHJlZiIsInRhcmdldCIsInJlbCIsInRleHREZWNvcmF0aW9uIiwiZm9udFdlaWdodCIsImN1cnNvciIsImJvZHkiLCJhcHBlbmRDaGlsZCIsImlzTmFOIiwiaXNGaW5pdGUiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7OztBQUFBLHVDOzs7Ozs7Ozs7OztBQ0FBLHVDOzs7Ozs7Ozs7OztBQ0FBLHVDOzs7Ozs7Ozs7Ozs7O0FDQUE7Ozs7O0FBTUE7QUFFQUEsbUJBQU8sQ0FBQywwREFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLDREQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsb0VBQUQsQ0FBUCxDLENBRUE7OztBQUVBLElBQU1DLENBQUMsR0FBR0QsbUJBQU8sQ0FBQyxvREFBRCxDQUFqQjs7QUFDQUEsbUJBQU8sQ0FBQyw4RkFBRCxDQUFQOztBQUVBRSxNQUFNLENBQUNELENBQVAsR0FBV0MsTUFBTSxDQUFDQyxNQUFQLEdBQWdCRixDQUEzQixDLENBRUE7O0FBRUFELG1CQUFPLENBQUMsZ0VBQUQsQ0FBUCxDLENBRUE7QUFHQTs7O0FBRUFBLG1CQUFPLENBQUMsb0ZBQUQsQ0FBUDs7QUFFQSxJQUFJSSxPQUFPLEdBQUc7QUFDVixjQUFnQixLQUROO0FBRVYsUUFBZ0IsU0FGTjtBQUdWLFFBQWdCLFNBSE47QUFJVixVQUFnQixTQUpOO0FBS1YsY0FBZ0IseUZBTE47QUFNVixhQUFnQiw0SEFOTjtBQU9WLGFBQWdCLGdCQVBOO0FBUVYsWUFBZ0IsTUFSTjtBQVNWLGFBQWdCLEtBQUssRUFBTCxHQUFVLEVBQVYsR0FBZSxFQVRyQjtBQVVWLFlBQWdCLE9BVk47QUFXVixZQUFnQixNQVhOO0FBWVYsZUFBZ0I7QUFaTixDQUFkO0FBZUEsSUFBSUMsRUFBRSxHQUFHLElBQUlDLFlBQUosQ0FBaUJGLE9BQWpCLENBQVQ7QUFBb0NDLEVBQUUsQ0FBQ0UsR0FBSDtBQUVwQ0MsTUFBTSxDQUFDQyxTQUFQLEdBQW1CRCxNQUFNLENB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a3RCO0FBQTU5SixHQUFaLEVBQTArSmxDLENBQUMsS0FBR1YsQ0FBQyxDQUFDSSxDQUFELENBQUQsS0FBT0osQ0FBQyxDQUFDSSxDQUFELENBQUQsR0FBSyxJQUFJTyxDQUFKLEVBQVosQ0FBSCxDQUEzK0o7QUFBa2dLLENBQXp6UCxDQUEwelBqQixNQUExelAsQ0FBRCxDIiwiZmlsZSI6ImFwcC5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIi8qXG4gKiBGaWNoaWVyIGRlIGTDqXBlbmRhbmNlcyBKYXZhc2NyaXB0IGV0IENTUyB1dGlsaXPDqSBwYXIgd2VicGFjayBlbmNvcmVcbiAqIENlIGZpY2hpZXIgY29udGllbnQgbCdlbnNlbWJsZSBkZXMgZMOpcGVuZGFuY2VzIG7DqWNlc3NhaXJlcyBhdSBjaGFyZ2VtZW50IGRlIHRvdXRlcyBsZXMgcGFnZXNcbiAqIChpbmNsdXMgZGFucyBiYXNlLmh0bWwudHdpZylcbiAqL1xuXG4vLyBGaWNoaWVycyBDU1NcblxucmVxdWlyZSgnLi4vY3NzL2Jvb3RzdHJhcC5zY3NzJyk7XG5yZXF1aXJlKCcuLi9jc3MvYzExOF9mcmFtZS5zY3NzJyk7XG5yZXF1aXJlKCcuLi9jc3MvbW9kZXJuLWJ1c2luZXNzLmNzcycpO1xuXG4vLyBqUXVlcnlcblxuY29uc3QgJCA9IHJlcXVpcmUoJ2pxdWVyeScpO1xucmVxdWlyZSgnanF1ZXJ5LXVpL3VpL3dpZGdldHMvYXV0b2NvbXBsZXRlJyk7XG5cbmdsb2JhbC4kID0gZ2xvYmFsLmpRdWVyeSA9ICQ7XG5cbi8vIEJvb3RzdHJhcFxuXG5yZXF1aXJlKCdib290c3RyYXAnKTtcblxuLy8gUHJldmlldyAoVE9ETyA6IG4nZXN0IHV0aWxpc8OpIHF1ZSBwYXIgbCfDqWRpdGlvbiBkZSBsYSBwYWdlIGQnYWNjdWVpbCwgYSBkw6lwbGFjZXIpXG5cblxuLy8gQWZmaWNoYXJlIGR1IG1lc3NhZ2UgZCdhdmVydGlzc2VtZW50IGNvb2tpZSBSR1BEXG5cbnJlcXVpcmUoJy4vY29tcG9uZW50cy9jb29raWViYW5uZXIubWluLmpzJyk7XG5cbnZhciBvcHRpb25zID0ge1xuICAgICdwb3NpdGlvbic6ICAgICBcInRvcFwiLFxuICAgICdmZyc6ICAgICAgICAgICBcIiNmZmZmZmZcIixcbiAgICAnYmcnOiAgICAgICAgICAgXCIjM2I1MjY5XCIsXG4gICAgJ2xpbmsnOiAgICAgICAgIFwiI2RkZGRkZFwiLFxuICAgICdtb3JlaW5mbyc6ICAgICBcImh0dHA6Ly93d3cuY25pbC5mci92b3Mtb2JsaWdhdGlvbnMvc2l0ZXMtd2ViLWNvb2tpZXMtZXQtYXV0cmVzLXRyYWNldXJzL3F1ZS1kaXQtbGEtbG9pL1wiLFxuICAgICdtZXNzYWdlJzogICAgICBcIkxlcyBjb29raWVzIGFzc3VyZW50IGxlIGJvbiBmb25jdGlvbm5lbWVudCBkZSBub3RyZSBzaXRlIEludGVybmV0IEVuIHV0aWxpc2FudCBjZSBkZXJuaWVyLCB2b3VzIGFjY2VwdGV6IGxldXIgdXRpbGlzYXRpb24uXCIsXG4gICAgJ2xpbmttc2cnOiAgICAgIFwiRW4gc2F2b2lyIHBsdXNcIixcbiAgICAnZWZmZWN0JzogICAgICAgXCJmYWRlXCIsXG4gICAgJ2V4cGlyZXMnOiAgICAgIDMwICogMjQgKiA2MCAqIDYwLFxuICAgICd6aW5kZXgnOiAgICAgICBcIjExMDAwXCIsXG4gICAgJ2hlaWdodCc6ICAgICAgIFwiNjRweFwiLFxuICAgICdmb250LXNpemUnOiAgICBcIjIycHhcIlxufTtcblxudmFyIGNiID0gbmV3IENvb2tpZWJhbm5lcihvcHRpb25zKTsgY2IucnVuKCk7XG5cbndpbmRvdy5kYXRhTGF5ZXIgPSB3aW5kb3cuZGF0YUxheWVyIHx8IFtdO1xuXG5mdW5jdGlvbiBndGFnKCkge1xuICAgIGRhdGFMYXllci5wdXNoKGFyZ3VtZW50cylcbn1cbmd0YWcoJ2pzJywgbmV3IERhdGUoKSk7XG5ndGFnKCdjb25maWcnLCAnVUEtMzY2MzcyNDUtMScpO1xuXG4iLCJcIi8qISAoQykgQ29va2llIEJhbm5lciB2MS4yLjEgLSBNSVQgTGljZW5zZSAtIGh0dHA6Ly9jb29raWViYW5uZXIuZXUvICovXCIgXHJcbiFmdW5jdGlvbihlKXtcInVzZSBzdHJpY3RcIjtmdW5jdGlvbiB0KGUsdCl7dmFyIGk9ITEsbz0hMCxuPWUuZG9jdW1lbnQscz1uLmRvY3VtZW50RWxlbWVudCxyPW4uYWRkRXZlbnRMaXN0ZW5lcj9cImFkZEV2ZW50TGlzdGVuZXJcIjpcImF0dGFjaEV2ZW50XCIsYT1uLmFkZEV2ZW50TGlzdGVuZXI/XCJyZW1vdmVFdmVudExpc3RlbmVyXCI6XCJkZXRhY2hFdmVudFwiLGM9bi5hZGRFdmVudExpc3RlbmVyP1wiXCI6XCJvblwiLGw9ZnVuY3Rpb24obyl7XCJyZWFkeXN0YXRlY2hhbmdlXCI9PW8udHlwZSYmXCJjb21wbGV0ZVwiIT1uLnJlYWR5U3RhdGV8fCgoXCJsb2FkXCI9PW8udHlwZT9lOm4pW2FdKGMrby50eXBlLGwsITEpLCFpJiYoaT0hMCkmJnQuY2FsbChlLG8udHlwZXx8bykpfSxwPWZ1bmN0aW9uKCl7dHJ5e3MuZG9TY3JvbGwoXCJsZWZ0XCIpfWNhdGNoKGUpe3JldHVybiB2b2lkIHNldFRpbWVvdXQocCw1MCl9bChcInBvbGxcIil9O2lmKFwiY29tcGxldGVcIj09bi5yZWFkeVN0YXRlKXQuY2FsbChlLFwibGF6eVwiKTtlbHNle2lmKG4uY3JlYXRlRXZlbnRPYmplY3QmJnMuZG9TY3JvbGwpe3RyeXtvPSFlLmZyYW1lRWxlbWVudH1jYXRjaChlKXt9byYmcCgpfW5bcl0oYytcIkRPTUNvbnRlbnRMb2FkZWRcIixsLCExKSxuW3JdKGMrXCJyZWFkeXN0YXRlY2hhbmdlXCIsbCwhMSksZVtyXShjK1wibG9hZFwiLGwsITEpfX12YXIgaT1lLG89aS5kb2N1bWVudCxuPVwiY2JpbnN0YW5jZVwiLHM9e2dldDpmdW5jdGlvbihlKXtyZXR1cm4gZGVjb2RlVVJJQ29tcG9uZW50KG8uY29va2llLnJlcGxhY2UobmV3IFJlZ0V4cChcIig/Oig/Ol58Lio7KVxcXFxzKlwiK2VuY29kZVVSSUNvbXBvbmVudChlKS5yZXBsYWNlKC9bLS4rKl0vZyxcIlxcXFwkJlwiKStcIlxcXFxzKlxcXFw9XFxcXHMqKFteO10qKS4qJCl8Xi4qJFwiKSxcIiQxXCIpKXx8bnVsbH0sc2V0OmZ1bmN0aW9uKGUsdCxpLG4scyxyKXtpZighZXx8L14oPzpleHBpcmVzfG1heC1hZ2V8cGF0aHxkb21haW58c2VjdXJlKSQvaS50ZXN0KGUpKXJldHVybiExO3ZhciBhPVwiXCI7aWYoaSlzd2l0Y2goaS5jb25zdHJ1Y3Rvcil7Y2FzZSBOdW1iZXI6YT1pPT09MS8wP1wiOyBleHBpcmVzPUZyaSwgMzEgRGVjIDk5OTkgMjM6NTk6NTkgR01UXCI6XCI7IG1heC1hZ2U9XCIraTticmVhaztjYXNlIFN0cmluZzphPVwiOyBleHBpcmVzPVwiK2k7YnJlYWs7Y2FzZSBEYXRlOmE9XCI7IGV4cGlyZXM9XCIraS50b1VUQ1N0cmluZygpfXJldHVybiBvLmNvb2tpZT1lbmNvZGVVUklDb21wb25lbnQoZSkrXCI9XCIrZW5jb2RlVVJJQ29tcG9uZW50KHQpK2ErKHM/XCI7IGRvbWFpbj1cIitzOlwiXCIpKyhuP1wiOyBwYXRoPVwiK246XCJcIikrKHI/XCI7IHNlY3VyZVwiOlwiXCIpLCEwfSxoYXM6ZnVuY3Rpb24oZSl7cmV0dXJuIG5ldyBSZWdFeHAoXCIoPzpefDtcXFxccyopXCIrZW5jb2RlVVJJQ29tcG9uZW50KGUpLnJlcGxhY2UoL1stLisqXS9nLFwiXFxcXCQmXCIpK1wiXFxcXHMqXFxcXD1cIikudGVzdChvLmNvb2tpZSl9LHJlbW92ZTpmdW5jdGlvbihlLHQsaSl7cmV0dXJuISghZXx8IXRoaXMuaGFzKGUpKSYmKG8uY29va2llPWVuY29kZVVSSUNvbXBvbmVudChlKStcIj07IGV4cGlyZXM9VGh1LCAwMSBKYW4gMTk3MCAwMDowMDowMCBHTVRcIisoaT9cIjsgZG9tYWluPVwiK2k6XCJcIikrKHQ/XCI7IHBhdGg9XCIrdDpcIlwiKSwhMCl9fSxyPXttZXJnZTpmdW5jdGlvbigpe3ZhciBlLHQ9e30saT0wLG89YXJndW1lbnRzLmxlbmd0aDtpZigwPT09bylyZXR1cm4gdDtmb3IoO2k8bztpKyspZm9yKGUgaW4gYXJndW1lbnRzW2ldKU9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChhcmd1bWVudHNbaV0sZSkmJih0W2VdPWFyZ3VtZW50c1tpXVtlXSk7cmV0dXJuIHR9LHN0cjJib29sOmZ1bmN0aW9uKGUpe3N3aXRjaChlPVN0cmluZyhlKSxlLnRvTG93ZXJDYXNlKCkpe2Nhc2VcImZhbHNlXCI6Y2FzZVwibm9cIjpjYXNlXCIwXCI6Y2FzZVwiXCI6cmV0dXJuITE7ZGVmYXVsdDpyZXR1cm4hMH19LGZhZGVfaW46ZnVuY3Rpb24oZSl7ZS5zdHlsZS5vcGFjaXR5PDEmJihlLnN0eWxlLm9wYWNpdHk9KHBhcnNlRmxvYXQoZS5zdHlsZS5vcGFjaXR5KSsuMDUpLnRvRml4ZWQoMiksaS5zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7ci5mYWRlX2luKGUpfSw1MCkpfSxnZXRfZGF0YV9hdHRyaWJzOmZ1bmN0aW9uKGUpe3ZhciB0PXt9O2lmKE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChlLFwiZGF0YXNldFwiKSl0PWUuZGF0YXNldDtlbHNle3ZhciBpLG89ZS5hdHRyaWJ1dGVzO2ZvcihpIGluIG8paWYoT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG8saSkpe3ZhciBuPW9baV07aWYoL15kYXRhLS8udGVzdChuLm5hbWUpKXt2YXIgcz1yLmNhbWVsaXplKG4ubmFtZS5zdWJzdHIoNSkpO3Rbc109bi52YWx1ZX19fXJldHVybiB0fSxub3JtYWxpemVfa2V5czpmdW5jdGlvbihlKXt2YXIgdD17fTtmb3IodmFyIGkgaW4gZSlpZihPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwoZSxpKSl7dmFyIG89ci5jYW1lbGl6ZShpKTt0W29dPWVbb10/ZVtvXTplW2ldfXJldHVybiB0fSxjYW1lbGl6ZTpmdW5jdGlvbihlKXtmb3IodmFyIHQ9XCItXCIsaT1lLmluZGV4T2YodCk7aSE9PS0xOyl7dmFyIG89aT09PWUubGVuZ3RoLTEsbj1vP1wiXCI6ZVtpKzFdLHM9bi50b1VwcGVyQ2FzZSgpLHI9bz90OnQrbjtlPWUucmVwbGFjZShyLHMpLGk9ZS5pbmRleE9mKHQpfXJldHVybiBlfSxmaW5kX3NjcmlwdF9ieV9pZDpmdW5jdGlvbihlKXtmb3IodmFyIHQ9by5nZXRFbGVtZW50c0J5VGFnTmFtZShcInNjcmlwdFwiKSxpPTAsbj10Lmxlbmd0aDtpPG47aSsrKWlmKGU9PT10W2ldLmlkKXJldHVybiB0W2ldO3JldHVybiBudWxsfX0sYT1yLmZpbmRfc2NyaXB0X2J5X2lkKFwiY29va2llYmFubmVyXCIpLGM9ZS5Db29raWViYW5uZXI9ZnVuY3Rpb24oZSl7dGhpcy5pbml0KGUpfTtjLnByb3RvdHlwZT17Y29va2llamFyOnMsaW5pdDpmdW5jdGlvbih0KXt0aGlzLmluc2VydGVkPSExLHRoaXMuY2xvc2VkPSExLHRoaXMudGVzdF9tb2RlPSExO3ZhciBpPVwiV2UgdXNlIGNvb2tpZXMgdG8gZW5oYW5jZSB5b3VyIGV4cGVyaWVuY2UuIEJ5IGNvbnRpbnVpbmcgdG8gdmlzaXQgdGhpcyBzaXRlIHlvdSBhZ3JlZSB0byBvdXIgdXNlIG9mIGNvb2tpZXMuXCIsbz1cIkxlYXJuIG1vcmVcIjtpZih0aGlzLmRlZmF1bHRfb3B0aW9ucz17Y29va2llOlwiY29va2llYmFubmVyLWFjY2VwdGVkXCIsY2xvc2VUZXh0OlwiJiMxMDAwNjtcIixjbG9zZVN0eWxlOlwiZmxvYXQ6cmlnaHQ7cGFkZGluZy1sZWZ0OjVweDtcIixjbG9zZVByZWNlZGVzOiEwLGNvb2tpZVBhdGg6XCIvXCIsY29va2llRG9tYWluOm51bGwsY29va2llU2VjdXJlOiExLGRlYnVnOiExLGV4cGlyZXM6MS8wLHppbmRleDoyNTUsbWFzazohMSxtYXNrT3BhY2l0eTouNSxtYXNrQmFja2dyb3VuZDpcIiMwMDBcIixoZWlnaHQ6XCJhdXRvXCIsbWluSGVpZ2h0OlwiMjFweFwiLGJnOlwiIzAwMFwiLGZnOlwiI2RkZFwiLGxpbms6XCIjYWFhXCIscG9zaXRpb246XCJib3R0b21cIixtZXNzYWdlOmksbGlua21zZzpvLG1vcmVpbmZvOlwiaHR0cDovL2Fib3V0Y29va2llcy5vcmdcIixtb3JlaW5mb1RhcmdldDpcIl9ibGFua1wiLG1vcmVpbmZvUmVsOlwibm9vcGVuZXIgbm9yZWZlcnJlclwiLG1vcmVpbmZvRGVjb3JhdGlvbjpcIm5vbmVcIixtb3JlaW5mb0ZvbnRXZWlnaHQ6XCJub3JtYWxcIixtb3JlaW5mb0ZvbnRTaXplOm51bGwsZWZmZWN0Om51bGwsZm9udFNpemU6XCIxNHB4XCIsZm9udEZhbWlseTpcImFyaWFsLCBzYW5zLXNlcmlmXCIsaW5zdGFuY2U6bix0ZXh0QWxpZ246XCJjZW50ZXJcIixhY2NlcHRPblNjcm9sbDohMSxhY2NlcHRPbkNsaWNrOiExLGFjY2VwdE9uVGltZW91dDpudWxsLGFjY2VwdE9uRmlyc3RWaXNpdDohMX0sdGhpcy5vcHRpb25zPXRoaXMuZGVmYXVsdF9vcHRpb25zLHRoaXMuc2NyaXB0X2VsPWEsdGhpcy5zY3JpcHRfZWwpe3ZhciBzPXIuZ2V0X2RhdGFfYXR0cmlicyh0aGlzLnNjcmlwdF9lbCk7dGhpcy5vcHRpb25zPXIubWVyZ2UodGhpcy5vcHRpb25zLHMpfXQmJih0PXIubm9ybWFsaXplX2tleXModCksdGhpcy5vcHRpb25zPXIubWVyZ2UodGhpcy5vcHRpb25zLHQpKSxuPXRoaXMub3B0aW9ucy5pbnN0YW5jZSx0aGlzLm9wdGlvbnMuemluZGV4PXBhcnNlSW50KHRoaXMub3B0aW9ucy56aW5kZXgsMTApLHRoaXMub3B0aW9ucy5tYXNrPXIuc3RyMmJvb2wodGhpcy5vcHRpb25zLm1hc2spLHRoaXMub3B0aW9ucy5jbG9zZVByZWNlZGVzPXIuc3RyMmJvb2wodGhpcy5vcHRpb25zLmNsb3NlUHJlY2VkZXMpLFwic3RyaW5nXCI9PXR5cGVvZiB0aGlzLm9wdGlvbnMuZXhwaXJlcyYmXCJmdW5jdGlvblwiPT10eXBlb2YgZVt0aGlzLm9wdGlvbnMuZXhwaXJlc10mJih0aGlzLm9wdGlvbnMuZXhwaXJlcz1lW3RoaXMub3B0aW9ucy5leHBpcmVzXSksXCJmdW5jdGlvblwiPT10eXBlb2YgdGhpcy5vcHRpb25zLmV4cGlyZXMmJih0aGlzLm9wdGlvbnMuZXhwaXJlcz10aGlzLm9wdGlvbnMuZXhwaXJlcygpKSx0aGlzLnNjcmlwdF9lbCYmdGhpcy5ydW4oKX0sbG9nOmZ1bmN0aW9uKCl7XCJ1bmRlZmluZWRcIiE9dHlwZW9mIGNvbnNvbGUmJmNvbnNvbGUubG9nLmFwcGx5KGNvbnNvbGUsYXJndW1lbnRzKX0scnVuOmZ1bmN0aW9uKCl7aWYoIXRoaXMuYWdyZWVkKCkpe3ZhciBlPXRoaXM7dChpLGZ1bmN0aW9uKCl7ZS5pbnNlcnQoKX0pfX0sYnVpbGRfdmlld3BvcnRfbWFzazpmdW5jdGlvbigpe3ZhciBlPW51bGw7aWYoITA9PT10aGlzLm9wdGlvbnMubWFzayl7dmFyIHQ9dGhpcy5vcHRpb25zLm1hc2tPcGFjaXR5LGk9dGhpcy5vcHRpb25zLm1hc2tCYWNrZ3JvdW5kLG49JzxkaXYgaWQ9XCJjb29raWViYW5uZXItbWFza1wiIHN0eWxlPVwicG9zaXRpb246Zml4ZWQ7dG9wOjA7bGVmdDowO3dpZHRoOjEwMCU7aGVpZ2h0OjEwMCU7YmFja2dyb3VuZDonK2krXCI7em9vbToxO2ZpbHRlcjphbHBoYShvcGFjaXR5PVwiKzEwMCp0K1wiKTtvcGFjaXR5OlwiK3QrXCI7ei1pbmRleDpcIit0aGlzLm9wdGlvbnMuemluZGV4Kyc7XCI+PC9kaXY+JyxzPW8uY3JlYXRlRWxlbWVudChcImRpdlwiKTtzLmlubmVySFRNTD1uLGU9cy5maXJzdENoaWxkfXJldHVybiBlfSxhZ3JlZTpmdW5jdGlvbigpe3JldHVybiB0aGlzLmNvb2tpZWphci5zZXQodGhpcy5vcHRpb25zLmNvb2tpZSwxLHRoaXMub3B0aW9ucy5leHBpcmVzLHRoaXMub3B0aW9ucy5jb29raWVQYXRoLFwiXCIhPT10aGlzLm9wdGlvbnMuY29va2llRG9tYWluP3RoaXMub3B0aW9ucy5jb29raWVEb21haW46XCJcIiwhIXRoaXMub3B0aW9ucy5jb29raWVTZWN1cmUpLCEwfSxhZ3JlZWQ6ZnVuY3Rpb24oKXtyZXR1cm4gdGhpcy5jb29raWVqYXIuaGFzKHRoaXMub3B0aW9ucy5jb29raWUpfSxjbG9zZTpmdW5jdGlvbigpe3JldHVybiB0aGlzLmluc2VydGVkJiYodGhpcy5jbG9zZWR8fCh0aGlzLmVsZW1lbnQmJnRoaXMuZWxlbWVudC5wYXJlbnROb2RlLnJlbW92ZUNoaWxkKHRoaXMuZWxlbWVudCksdGhpcy5lbGVtZW50X21hc2smJnRoaXMuZWxlbWVudF9tYXNrLnBhcmVudE5vZGUucmVtb3ZlQ2hpbGQodGhpcy5lbGVtZW50X21hc2spLHRoaXMuY2xvc2VkPSEwKSksdGhpcy5jbG9zZWR9LGFncmVlX2FuZF9jbG9zZTpmdW5jdGlvbigpe3JldHVybiB0aGlzLmFncmVlKCksdGhpcy5jbG9zZSgpfSxjbGVhbnVwOmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuY2xvc2UoKSx0aGlzLnVubG9hZCgpfSx1bmxvYWQ6ZnVuY3Rpb24oKXtyZXR1cm4gdGhpcy5zY3JpcHRfZWwmJnRoaXMuc2NyaXB0X2VsLnBhcmVudE5vZGUucmVtb3ZlQ2hpbGQodGhpcy5zY3JpcHRfZWwpLGVbbl09dm9pZCAwLCEwfSxpbnNlcnQ6ZnVuY3Rpb24oKXtmdW5jdGlvbiBlKGUsdCxpKXt2YXIgbz1lLmFkZEV2ZW50TGlzdGVuZXI/XCJhZGRFdmVudExpc3RlbmVyXCI6XCJhdHRhY2hFdmVudFwiLG49ZS5hZGRFdmVudExpc3RlbmVyP1wiXCI6XCJvblwiO2Vbb10obit0LGksITEpfXRoaXMuZWxlbWVudF9tYXNrPXRoaXMuYnVpbGRfdmlld3BvcnRfbWFzaygpO3ZhciB0PXRoaXMub3B0aW9ucy56aW5kZXg7dGhpcy5lbGVtZW50X21hc2smJih0Kz0xKTt2YXIgaT1vLmNyZWF0ZUVsZW1lbnQoXCJkaXZcIik7aS5jbGFzc05hbWU9XCJjb29raWViYW5uZXJcIixpLnN0eWxlLnBvc2l0aW9uPVwiZml4ZWRcIixpLnN0eWxlLmxlZnQ9MCxpLnN0eWxlLnJpZ2h0PTAsaS5zdHlsZS5oZWlnaHQ9dGhpcy5vcHRpb25zLmhlaWdodCxpLnN0eWxlLm1pbkhlaWdodD10aGlzLm9wdGlvbnMubWluSGVpZ2h0LGkuc3R5bGUuekluZGV4PXQsaS5zdHlsZS5iYWNrZ3JvdW5kPXRoaXMub3B0aW9ucy5iZyxpLnN0eWxlLmNvbG9yPXRoaXMub3B0aW9ucy5mZyxpLnN0eWxlLmxpbmVIZWlnaHQ9aS5zdHlsZS5taW5IZWlnaHQsaS5zdHlsZS5wYWRkaW5nPVwiNXB4IDE2cHhcIixpLnN0eWxlLmZvbnRGYW1pbHk9dGhpcy5vcHRpb25zLmZvbnRGYW1pbHksaS5zdHlsZS5mb250U2l6ZT10aGlzLm9wdGlvbnMuZm9udFNpemUsaS5zdHlsZS50ZXh0QWxpZ249dGhpcy5vcHRpb25zLnRleHRBbGlnbixcInRvcFwiPT09dGhpcy5vcHRpb25zLnBvc2l0aW9uP2kuc3R5bGUudG9wPTA6aS5zdHlsZS5ib3R0b209MDt2YXIgbj0nPGRpdiBjbGFzcz1cImNvb2tpZWJhbm5lci1jbG9zZVwiIHN0eWxlPVwiJyt0aGlzLm9wdGlvbnMuY2xvc2VTdHlsZSsnXCI+Jyt0aGlzLm9wdGlvbnMuY2xvc2VUZXh0K1wiPC9kaXY+XCIscz1cIjxzcGFuPlwiK3RoaXMub3B0aW9ucy5tZXNzYWdlKyh0aGlzLm9wdGlvbnMubGlua21zZz9cIiA8YT5cIit0aGlzLm9wdGlvbnMubGlua21zZytcIjwvYT5cIjpcIlwiKStcIjwvc3Bhbj5cIjt0aGlzLm9wdGlvbnMuY2xvc2VQcmVjZWRlcz9pLmlubmVySFRNTD1uK3M6aS5pbm5lckhUTUw9cytuLHRoaXMuZWxlbWVudD1pO3ZhciBhPWkuZ2V0RWxlbWVudHNCeVRhZ05hbWUoXCJhXCIpWzBdO2EuaHJlZj10aGlzLm9wdGlvbnMubW9yZWluZm8sYS50YXJnZXQ9dGhpcy5vcHRpb25zLm1vcmVpbmZvVGFyZ2V0LHRoaXMub3B0aW9ucy5tb3JlaW5mb1JlbCYmXCJcIiE9PXRoaXMub3B0aW9ucy5tb3JlaW5mb1JlbCYmKGEucmVsPXRoaXMub3B0aW9ucy5tb3JlaW5mb1JlbCksYS5zdHlsZS50ZXh0RGVjb3JhdGlvbj10aGlzLm9wdGlvbnMubW9yZWluZm9EZWNvcmF0aW9uLGEuc3R5bGUuY29sb3I9dGhpcy5vcHRpb25zLmxpbmssYS5zdHlsZS5mb250V2VpZ2h0PXRoaXMub3B0aW9ucy5tb3JlaW5mb0ZvbnRXZWlnaHQsXCJcIiE9PXRoaXMub3B0aW9ucy5tb3JlaW5mb0ZvbnRTaXplJiYoYS5zdHlsZS5mb250U2l6ZT10aGlzLm9wdGlvbnMubW9yZWluZm9Gb250U2l6ZSk7dmFyIGM9aS5nZXRFbGVtZW50c0J5VGFnTmFtZShcImRpdlwiKVswXTtjLnN0eWxlLmN1cnNvcj1cInBvaW50ZXJcIjt2YXIgbD10aGlzO2UoYyxcImNsaWNrXCIsZnVuY3Rpb24oKXtsLmFncmVlX2FuZF9jbG9zZSgpfSksdGhpcy5lbGVtZW50X21hc2smJihlKHRoaXMuZWxlbWVudF9tYXNrLFwiY2xpY2tcIixmdW5jdGlvbigpe2wuYWdyZWVfYW5kX2Nsb3NlKCl9KSxvLmJvZHkuYXBwZW5kQ2hpbGQodGhpcy5lbGVtZW50X21hc2spKSx0aGlzLm9wdGlvbnMuYWNjZXB0T25TY3JvbGwmJmUod2luZG93LFwic2Nyb2xsXCIsZnVuY3Rpb24oKXtsLmFncmVlX2FuZF9jbG9zZSgpfSksdGhpcy5vcHRpb25zLmFjY2VwdE9uQ2xpY2smJmUod2luZG93LFwiY2xpY2tcIixmdW5jdGlvbigpe2wuYWdyZWVfYW5kX2Nsb3NlKCl9KSx0aGlzLm9wdGlvbnMuYWNjZXB0T25UaW1lb3V0JiYhaXNOYU4ocGFyc2VGbG9hdCh0aGlzLm9wdGlvbnMuYWNjZXB0T25UaW1lb3V0KSkmJmlzRmluaXRlKHRoaXMub3B0aW9ucy5hY2NlcHRPblRpbWVvdXQpJiZzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7bC5hZ3JlZV9hbmRfY2xvc2UoKX0sdGhpcy5vcHRpb25zLmFjY2VwdE9uVGltZW91dCksdGhpcy5vcHRpb25zLmFjY2VwdE9uRmlyc3RWaXNpdCYmbC5hZ3JlZSgpLG8uYm9keS5hcHBlbmRDaGlsZCh0aGlzLmVsZW1lbnQpLHRoaXMuaW5zZXJ0ZWQ9ITAsXCJmYWRlXCI9PT10aGlzLm9wdGlvbnMuZWZmZWN0Pyh0aGlzLmVsZW1lbnQuc3R5bGUub3BhY2l0eT0wLHIuZmFkZV9pbih0aGlzLmVsZW1lbnQpKTp0aGlzLmVsZW1lbnQuc3R5bGUub3BhY2l0eT0xfX0sYSYmKGVbbl18fChlW25dPW5ldyBjKSl9KHdpbmRvdyk7XHJcbiJdLCJzb3VyY2VSb290IjoiIn0=