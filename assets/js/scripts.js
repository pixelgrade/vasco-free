/*!
 * @codingStandardsIgnoreFile
 * phpcs:ignoreFile
 */
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ }),
/* 1 */,
/* 2 */
/***/ (function(module, exports) {

module.exports = Masonry;

/***/ }),
/* 3 */
/***/ (function(module, exports) {

module.exports = Cookies;

/***/ }),
/* 4 */,
/* 5 */
/***/ (function(module, exports) {

module.exports = CircleType;

/***/ }),
/* 6 */
/***/ (function(module, exports) {

module.exports = anime;

/***/ }),
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);

// EXTERNAL MODULE: external "Masonry"
var external_Masonry_ = __webpack_require__(2);

// EXTERNAL MODULE: external "jQuery"
var external_jQuery_ = __webpack_require__(0);
var external_jQuery_default = /*#__PURE__*/__webpack_require__.n(external_jQuery_);

// EXTERNAL MODULE: external "CircleType"
var external_CircleType_ = __webpack_require__(5);
var external_CircleType_default = /*#__PURE__*/__webpack_require__.n(external_CircleType_);

// EXTERNAL MODULE: external "Cookies"
var external_Cookies_ = __webpack_require__(3);
var external_Cookies_default = /*#__PURE__*/__webpack_require__.n(external_Cookies_);

// CONCATENATED MODULE: ./components/base/ts/services/Helper.ts
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


var Helper_Helper =
/*#__PURE__*/
function () {
  function Helper() {
    _classCallCheck(this, Helper);
  }

  _createClass(Helper, null, [{
    key: "isTouch",
    value: function isTouch() {
      // return 'ontouchstart' in window || 'DocumentTouch' in window && document instanceof DocumentTouch;
      return 'ontouchstart' in window || 'DocumentTouch' in window;
    }
  }, {
    key: "handleCustomCSS",
    value: function handleCustomCSS($container) {
      var $elements = typeof $container !== 'undefined' ? $container.find('[data-css]') : external_jQuery_default()('[data-css]');

      if ($elements.length) {
        $elements.each(function (index, obj) {
          var $element = external_jQuery_default()(obj);
          var css = $element.data('css');

          if (typeof css !== 'undefined') {
            $element.replaceWith('<style type="text/css">' + css + '</style>');
          }
        });
      }
    }
    /**
     * Search every image that is alone in a p tag and wrap it
     * in a figure element to behave like images with captions
     *
     * @param $container
     */

  }, {
    key: "unwrapImages",
    value: function unwrapImages() {
      var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper.$body;
      $container.find('p > img:first-child:last-child, p > a:first-child:last-child > img').each(function (index, obj) {
        var $obj = external_jQuery_default()(obj);
        var $image = $obj.closest('img');
        var className = $image.attr('class');
        var $p = $image.closest('p');
        var $figure = external_jQuery_default()('<figure />').attr('class', className);
        console.log($figure, $p, external_jQuery_default.a.trim($p.text()).length);

        if (external_jQuery_default.a.trim($p.text()).length) {
          return;
        }

        $figure.append($image.removeAttr('class')).insertAfter($p);
        $p.remove();
      });
    }
  }, {
    key: "wrapEmbeds",
    value: function wrapEmbeds() {
      var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper.$body;
      $container.children('iframe, embed, object').wrap('<p>');
    }
    /**
     * Initialize video elements on demand from placeholders
     *
     * @param $container
     */

  }, {
    key: "handleVideos",
    value: function handleVideos() {
      var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper.$body;
      $container.find('.video-placeholder').each(function (index, obj) {
        var $placeholder = external_jQuery_default()(obj);
        var video = document.createElement('video');
        var $video = external_jQuery_default()(video).addClass('c-hero__video'); // play as soon as possible

        video.onloadedmetadata = function () {
          return video.play();
        };

        video.src = $placeholder.data('src');
        video.poster = $placeholder.data('poster');
        video.muted = true;
        video.loop = true;
        $placeholder.replaceWith($video);
      });
    }
  }, {
    key: "smoothScrollTo",
    value: function smoothScrollTo() {
      var to = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1000;
      var easing = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'swing';
      external_jQuery_default()('html, body').stop().animate({
        scrollTop: to
      }, duration, easing);
    } // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.

  }, {
    key: "debounce",
    value: function debounce(func, wait, immediate) {
      var _this = this,
          _arguments = arguments;

      var timeout;
      return function () {
        var context = _this;
        var args = _arguments;

        var later = function later() {
          timeout = null;

          if (!immediate) {
            func.apply(context, args);
          }
        };

        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);

        if (callNow) {
          func.apply(context, args);
        }
      };
    } // Returns a function, that, when invoked, will only be triggered at most once
    // during a given window of time. Normally, the throttled function will run
    // as much as it can, without ever going more than once per `wait` duration;
    // but if you'd like to disable the execution on the leading edge, pass
    // `{leading: false}`. To disable execution on the trailing edge, ditto.

  }, {
    key: "throttle",
    value: function throttle(callback, limit) {
      var wait = false;
      return function () {
        if (!wait) {
          callback();
          wait = true;
          setTimeout(function () {
            wait = false;
          }, limit);
        }
      };
    }
  }, {
    key: "mq",
    value: function mq(direction, query) {
      var $temp = external_jQuery_default()('<div class="u-mq-' + direction + '-' + query + '">').appendTo('body');
      var response = $temp.is(':visible');
      $temp.remove();
      return response;
    }
  }, {
    key: "below",
    value: function below(query) {
      return Helper.mq('below', query);
    }
  }, {
    key: "above",
    value: function above(query) {
      return Helper.mq('above', query);
    }
  }, {
    key: "getParamFromURL",
    value: function getParamFromURL(param, url) {
      var parameters = url.split('?');

      if (typeof parameters[1] === 'undefined') {
        return parameters[1];
      }

      parameters = parameters[1].split('&');

      var _arr = Array.from(Array(parameters.length).keys());

      for (var _i = 0; _i < _arr.length; _i++) {
        var i = _arr[_i];
        var parameter = parameters[i].split('=');

        if (parameter[0] === param) {
          return parameter[1];
        }
      }
    }
  }, {
    key: "reloadScript",
    value: function reloadScript(filename) {
      var $old = external_jQuery_default()('script[src*="' + filename + '"]');
      var $new = external_jQuery_default()('<script>');
      var src = $old.attr('src');

      if (!$old.length) {
        return;
      }

      $old.replaceWith($new);
      $new.attr('src', src);
    }
    /**
     * returns version of IE or false, if browser is not Internet Explorer
     */

  }, {
    key: "getIEversion",
    value: function getIEversion() {
      var ua = window.navigator.userAgent;
      var msie = ua.indexOf('MSIE ');

      if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
      }

      var trident = ua.indexOf('Trident/');

      if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
      }

      var edge = ua.indexOf('Edge/');

      if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
      } // other browser


      return false;
    }
  }, {
    key: "markFirstWord",
    value: function markFirstWord($el) {
      var text = $el.text().trim().split(' ');
      var first = text.shift();
      $el.html((text.length > 0 ? '<span class="first-word">' + first + '</span> ' : first) + text.join(' '));
    }
  }, {
    key: "fitText",
    value: function fitText($el) {
      var currentFontSize = parseFloat($el.css('fontSize'));
      var currentLineHeight = parseFloat($el.css('lineHeight'));
      var height = $el.outerHeight() || currentLineHeight;
      $el.css('fontSize', currentFontSize * height / currentLineHeight);
    }
  }]);

  return Helper;
}();
Helper_Helper.$body = external_jQuery_default()('body');
// CONCATENATED MODULE: ./node_modules/tslib/tslib.es6.js
/*! *****************************************************************************
Copyright (c) Microsoft Corporation. All rights reserved.
Licensed under the Apache License, Version 2.0 (the "License"); you may not use
this file except in compliance with the License. You may obtain a copy of the
License at http://www.apache.org/licenses/LICENSE-2.0

THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
MERCHANTABLITY OR NON-INFRINGEMENT.

See the Apache Version 2.0 License for specific language governing permissions
and limitations under the License.
***************************************************************************** */
/* global Reflect, Promise */

var extendStatics = function(d, b) {
    extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return extendStatics(d, b);
};

function __extends(d, b) {
    extendStatics(d, b);
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
}

var __assign = function() {
    __assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
        }
        return t;
    }
    return __assign.apply(this, arguments);
}

function __rest(s, e) {
    var t = {};
    for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
        t[p] = s[p];
    if (s != null && typeof Object.getOwnPropertySymbols === "function")
        for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) if (e.indexOf(p[i]) < 0)
            t[p[i]] = s[p[i]];
    return t;
}

function __decorate(decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
}

function __param(paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
}

function __metadata(metadataKey, metadataValue) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(metadataKey, metadataValue);
}

function __awaiter(thisArg, _arguments, P, generator) {
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : new P(function (resolve) { resolve(result.value); }).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
}

function __generator(thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
}

function __exportStar(m, exports) {
    for (var p in m) if (!exports.hasOwnProperty(p)) exports[p] = m[p];
}

function __values(o) {
    var m = typeof Symbol === "function" && o[Symbol.iterator], i = 0;
    if (m) return m.call(o);
    return {
        next: function () {
            if (o && i >= o.length) o = void 0;
            return { value: o && o[i++], done: !o };
        }
    };
}

function __read(o, n) {
    var m = typeof Symbol === "function" && o[Symbol.iterator];
    if (!m) return o;
    var i = m.call(o), r, ar = [], e;
    try {
        while ((n === void 0 || n-- > 0) && !(r = i.next()).done) ar.push(r.value);
    }
    catch (error) { e = { error: error }; }
    finally {
        try {
            if (r && !r.done && (m = i["return"])) m.call(i);
        }
        finally { if (e) throw e.error; }
    }
    return ar;
}

function __spread() {
    for (var ar = [], i = 0; i < arguments.length; i++)
        ar = ar.concat(__read(arguments[i]));
    return ar;
}

function __await(v) {
    return this instanceof __await ? (this.v = v, this) : new __await(v);
}

function __asyncGenerator(thisArg, _arguments, generator) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var g = generator.apply(thisArg, _arguments || []), i, q = [];
    return i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i;
    function verb(n) { if (g[n]) i[n] = function (v) { return new Promise(function (a, b) { q.push([n, v, a, b]) > 1 || resume(n, v); }); }; }
    function resume(n, v) { try { step(g[n](v)); } catch (e) { settle(q[0][3], e); } }
    function step(r) { r.value instanceof __await ? Promise.resolve(r.value.v).then(fulfill, reject) : settle(q[0][2], r); }
    function fulfill(value) { resume("next", value); }
    function reject(value) { resume("throw", value); }
    function settle(f, v) { if (f(v), q.shift(), q.length) resume(q[0][0], q[0][1]); }
}

function __asyncDelegator(o) {
    var i, p;
    return i = {}, verb("next"), verb("throw", function (e) { throw e; }), verb("return"), i[Symbol.iterator] = function () { return this; }, i;
    function verb(n, f) { i[n] = o[n] ? function (v) { return (p = !p) ? { value: __await(o[n](v)), done: n === "return" } : f ? f(v) : v; } : f; }
}

function __asyncValues(o) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var m = o[Symbol.asyncIterator], i;
    return m ? m.call(o) : (o = typeof __values === "function" ? __values(o) : o[Symbol.iterator](), i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i);
    function verb(n) { i[n] = o[n] && function (v) { return new Promise(function (resolve, reject) { v = o[n](v), settle(resolve, reject, v.done, v.value); }); }; }
    function settle(resolve, reject, d, v) { Promise.resolve(v).then(function(v) { resolve({ value: v, done: d }); }, reject); }
}

function __makeTemplateObject(cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};

function __importStar(mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (Object.hasOwnProperty.call(mod, k)) result[k] = mod[k];
    result.default = mod;
    return result;
}

function __importDefault(mod) {
    return (mod && mod.__esModule) ? mod : { default: mod };
}

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/isFunction.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
function isFunction(x) {
    return typeof x === 'function';
}
//# sourceMappingURL=isFunction.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/config.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
var _enable_super_gross_mode_that_will_cause_bad_things = false;
var config = {
    Promise: undefined,
    set useDeprecatedSynchronousErrorHandling(value) {
        if (value) {
            var error = /*@__PURE__*/ new Error();
            /*@__PURE__*/ console.warn('DEPRECATED! RxJS was set to use deprecated synchronous error handling behavior by code at: \n' + error.stack);
        }
        else if (_enable_super_gross_mode_that_will_cause_bad_things) {
            /*@__PURE__*/ console.log('RxJS: Back to a better error behavior. Thank you. <3');
        }
        _enable_super_gross_mode_that_will_cause_bad_things = value;
    },
    get useDeprecatedSynchronousErrorHandling() {
        return _enable_super_gross_mode_that_will_cause_bad_things;
    },
};
//# sourceMappingURL=config.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/hostReportError.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
function hostReportError(err) {
    setTimeout(function () { throw err; });
}
//# sourceMappingURL=hostReportError.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/Observer.js
/** PURE_IMPORTS_START _config,_util_hostReportError PURE_IMPORTS_END */


var empty = {
    closed: true,
    next: function (value) { },
    error: function (err) {
        if (config.useDeprecatedSynchronousErrorHandling) {
            throw err;
        }
        else {
            hostReportError(err);
        }
    },
    complete: function () { }
};
//# sourceMappingURL=Observer.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/isArray.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
var isArray = Array.isArray || (function (x) { return x && typeof x.length === 'number'; });
//# sourceMappingURL=isArray.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/isObject.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
function isObject(x) {
    return x !== null && typeof x === 'object';
}
//# sourceMappingURL=isObject.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/UnsubscriptionError.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
function UnsubscriptionErrorImpl(errors) {
    Error.call(this);
    this.message = errors ?
        errors.length + " errors occurred during unsubscription:\n" + errors.map(function (err, i) { return i + 1 + ") " + err.toString(); }).join('\n  ') : '';
    this.name = 'UnsubscriptionError';
    this.errors = errors;
    return this;
}
UnsubscriptionErrorImpl.prototype = /*@__PURE__*/ Object.create(Error.prototype);
var UnsubscriptionError = UnsubscriptionErrorImpl;
//# sourceMappingURL=UnsubscriptionError.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/Subscription.js
/** PURE_IMPORTS_START _util_isArray,_util_isObject,_util_isFunction,_util_UnsubscriptionError PURE_IMPORTS_END */




var Subscription_Subscription = /*@__PURE__*/ (function () {
    function Subscription(unsubscribe) {
        this.closed = false;
        this._parent = null;
        this._parents = null;
        this._subscriptions = null;
        if (unsubscribe) {
            this._unsubscribe = unsubscribe;
        }
    }
    Subscription.prototype.unsubscribe = function () {
        var hasErrors = false;
        var errors;
        if (this.closed) {
            return;
        }
        var _a = this, _parent = _a._parent, _parents = _a._parents, _unsubscribe = _a._unsubscribe, _subscriptions = _a._subscriptions;
        this.closed = true;
        this._parent = null;
        this._parents = null;
        this._subscriptions = null;
        var index = -1;
        var len = _parents ? _parents.length : 0;
        while (_parent) {
            _parent.remove(this);
            _parent = ++index < len && _parents[index] || null;
        }
        if (isFunction(_unsubscribe)) {
            try {
                _unsubscribe.call(this);
            }
            catch (e) {
                hasErrors = true;
                errors = e instanceof UnsubscriptionError ? flattenUnsubscriptionErrors(e.errors) : [e];
            }
        }
        if (isArray(_subscriptions)) {
            index = -1;
            len = _subscriptions.length;
            while (++index < len) {
                var sub = _subscriptions[index];
                if (isObject(sub)) {
                    try {
                        sub.unsubscribe();
                    }
                    catch (e) {
                        hasErrors = true;
                        errors = errors || [];
                        if (e instanceof UnsubscriptionError) {
                            errors = errors.concat(flattenUnsubscriptionErrors(e.errors));
                        }
                        else {
                            errors.push(e);
                        }
                    }
                }
            }
        }
        if (hasErrors) {
            throw new UnsubscriptionError(errors);
        }
    };
    Subscription.prototype.add = function (teardown) {
        var subscription = teardown;
        switch (typeof teardown) {
            case 'function':
                subscription = new Subscription(teardown);
            case 'object':
                if (subscription === this || subscription.closed || typeof subscription.unsubscribe !== 'function') {
                    return subscription;
                }
                else if (this.closed) {
                    subscription.unsubscribe();
                    return subscription;
                }
                else if (!(subscription instanceof Subscription)) {
                    var tmp = subscription;
                    subscription = new Subscription();
                    subscription._subscriptions = [tmp];
                }
                break;
            default: {
                if (!teardown) {
                    return Subscription.EMPTY;
                }
                throw new Error('unrecognized teardown ' + teardown + ' added to Subscription.');
            }
        }
        if (subscription._addParent(this)) {
            var subscriptions = this._subscriptions;
            if (subscriptions) {
                subscriptions.push(subscription);
            }
            else {
                this._subscriptions = [subscription];
            }
        }
        return subscription;
    };
    Subscription.prototype.remove = function (subscription) {
        var subscriptions = this._subscriptions;
        if (subscriptions) {
            var subscriptionIndex = subscriptions.indexOf(subscription);
            if (subscriptionIndex !== -1) {
                subscriptions.splice(subscriptionIndex, 1);
            }
        }
    };
    Subscription.prototype._addParent = function (parent) {
        var _a = this, _parent = _a._parent, _parents = _a._parents;
        if (_parent === parent) {
            return false;
        }
        else if (!_parent) {
            this._parent = parent;
            return true;
        }
        else if (!_parents) {
            this._parents = [parent];
            return true;
        }
        else if (_parents.indexOf(parent) === -1) {
            _parents.push(parent);
            return true;
        }
        return false;
    };
    Subscription.EMPTY = (function (empty) {
        empty.closed = true;
        return empty;
    }(new Subscription()));
    return Subscription;
}());

function flattenUnsubscriptionErrors(errors) {
    return errors.reduce(function (errs, err) { return errs.concat((err instanceof UnsubscriptionError) ? err.errors : err); }, []);
}
//# sourceMappingURL=Subscription.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/symbol/rxSubscriber.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
var rxSubscriber = typeof Symbol === 'function'
    ? /*@__PURE__*/ Symbol('rxSubscriber')
    : '@@rxSubscriber_' + /*@__PURE__*/ Math.random();
var $$rxSubscriber = rxSubscriber;
//# sourceMappingURL=rxSubscriber.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/Subscriber.js
/** PURE_IMPORTS_START tslib,_util_isFunction,_Observer,_Subscription,_internal_symbol_rxSubscriber,_config,_util_hostReportError PURE_IMPORTS_END */







var Subscriber_Subscriber = /*@__PURE__*/ (function (_super) {
    __extends(Subscriber, _super);
    function Subscriber(destinationOrNext, error, complete) {
        var _this = _super.call(this) || this;
        _this.syncErrorValue = null;
        _this.syncErrorThrown = false;
        _this.syncErrorThrowable = false;
        _this.isStopped = false;
        switch (arguments.length) {
            case 0:
                _this.destination = empty;
                break;
            case 1:
                if (!destinationOrNext) {
                    _this.destination = empty;
                    break;
                }
                if (typeof destinationOrNext === 'object') {
                    if (destinationOrNext instanceof Subscriber) {
                        _this.syncErrorThrowable = destinationOrNext.syncErrorThrowable;
                        _this.destination = destinationOrNext;
                        destinationOrNext.add(_this);
                    }
                    else {
                        _this.syncErrorThrowable = true;
                        _this.destination = new Subscriber_SafeSubscriber(_this, destinationOrNext);
                    }
                    break;
                }
            default:
                _this.syncErrorThrowable = true;
                _this.destination = new Subscriber_SafeSubscriber(_this, destinationOrNext, error, complete);
                break;
        }
        return _this;
    }
    Subscriber.prototype[rxSubscriber] = function () { return this; };
    Subscriber.create = function (next, error, complete) {
        var subscriber = new Subscriber(next, error, complete);
        subscriber.syncErrorThrowable = false;
        return subscriber;
    };
    Subscriber.prototype.next = function (value) {
        if (!this.isStopped) {
            this._next(value);
        }
    };
    Subscriber.prototype.error = function (err) {
        if (!this.isStopped) {
            this.isStopped = true;
            this._error(err);
        }
    };
    Subscriber.prototype.complete = function () {
        if (!this.isStopped) {
            this.isStopped = true;
            this._complete();
        }
    };
    Subscriber.prototype.unsubscribe = function () {
        if (this.closed) {
            return;
        }
        this.isStopped = true;
        _super.prototype.unsubscribe.call(this);
    };
    Subscriber.prototype._next = function (value) {
        this.destination.next(value);
    };
    Subscriber.prototype._error = function (err) {
        this.destination.error(err);
        this.unsubscribe();
    };
    Subscriber.prototype._complete = function () {
        this.destination.complete();
        this.unsubscribe();
    };
    Subscriber.prototype._unsubscribeAndRecycle = function () {
        var _a = this, _parent = _a._parent, _parents = _a._parents;
        this._parent = null;
        this._parents = null;
        this.unsubscribe();
        this.closed = false;
        this.isStopped = false;
        this._parent = _parent;
        this._parents = _parents;
        return this;
    };
    return Subscriber;
}(Subscription_Subscription));

var Subscriber_SafeSubscriber = /*@__PURE__*/ (function (_super) {
    __extends(SafeSubscriber, _super);
    function SafeSubscriber(_parentSubscriber, observerOrNext, error, complete) {
        var _this = _super.call(this) || this;
        _this._parentSubscriber = _parentSubscriber;
        var next;
        var context = _this;
        if (isFunction(observerOrNext)) {
            next = observerOrNext;
        }
        else if (observerOrNext) {
            next = observerOrNext.next;
            error = observerOrNext.error;
            complete = observerOrNext.complete;
            if (observerOrNext !== empty) {
                context = Object.create(observerOrNext);
                if (isFunction(context.unsubscribe)) {
                    _this.add(context.unsubscribe.bind(context));
                }
                context.unsubscribe = _this.unsubscribe.bind(_this);
            }
        }
        _this._context = context;
        _this._next = next;
        _this._error = error;
        _this._complete = complete;
        return _this;
    }
    SafeSubscriber.prototype.next = function (value) {
        if (!this.isStopped && this._next) {
            var _parentSubscriber = this._parentSubscriber;
            if (!config.useDeprecatedSynchronousErrorHandling || !_parentSubscriber.syncErrorThrowable) {
                this.__tryOrUnsub(this._next, value);
            }
            else if (this.__tryOrSetError(_parentSubscriber, this._next, value)) {
                this.unsubscribe();
            }
        }
    };
    SafeSubscriber.prototype.error = function (err) {
        if (!this.isStopped) {
            var _parentSubscriber = this._parentSubscriber;
            var useDeprecatedSynchronousErrorHandling = config.useDeprecatedSynchronousErrorHandling;
            if (this._error) {
                if (!useDeprecatedSynchronousErrorHandling || !_parentSubscriber.syncErrorThrowable) {
                    this.__tryOrUnsub(this._error, err);
                    this.unsubscribe();
                }
                else {
                    this.__tryOrSetError(_parentSubscriber, this._error, err);
                    this.unsubscribe();
                }
            }
            else if (!_parentSubscriber.syncErrorThrowable) {
                this.unsubscribe();
                if (useDeprecatedSynchronousErrorHandling) {
                    throw err;
                }
                hostReportError(err);
            }
            else {
                if (useDeprecatedSynchronousErrorHandling) {
                    _parentSubscriber.syncErrorValue = err;
                    _parentSubscriber.syncErrorThrown = true;
                }
                else {
                    hostReportError(err);
                }
                this.unsubscribe();
            }
        }
    };
    SafeSubscriber.prototype.complete = function () {
        var _this = this;
        if (!this.isStopped) {
            var _parentSubscriber = this._parentSubscriber;
            if (this._complete) {
                var wrappedComplete = function () { return _this._complete.call(_this._context); };
                if (!config.useDeprecatedSynchronousErrorHandling || !_parentSubscriber.syncErrorThrowable) {
                    this.__tryOrUnsub(wrappedComplete);
                    this.unsubscribe();
                }
                else {
                    this.__tryOrSetError(_parentSubscriber, wrappedComplete);
                    this.unsubscribe();
                }
            }
            else {
                this.unsubscribe();
            }
        }
    };
    SafeSubscriber.prototype.__tryOrUnsub = function (fn, value) {
        try {
            fn.call(this._context, value);
        }
        catch (err) {
            this.unsubscribe();
            if (config.useDeprecatedSynchronousErrorHandling) {
                throw err;
            }
            else {
                hostReportError(err);
            }
        }
    };
    SafeSubscriber.prototype.__tryOrSetError = function (parent, fn, value) {
        if (!config.useDeprecatedSynchronousErrorHandling) {
            throw new Error('bad call');
        }
        try {
            fn.call(this._context, value);
        }
        catch (err) {
            if (config.useDeprecatedSynchronousErrorHandling) {
                parent.syncErrorValue = err;
                parent.syncErrorThrown = true;
                return true;
            }
            else {
                hostReportError(err);
                return true;
            }
        }
        return false;
    };
    SafeSubscriber.prototype._unsubscribe = function () {
        var _parentSubscriber = this._parentSubscriber;
        this._context = null;
        this._parentSubscriber = null;
        _parentSubscriber.unsubscribe();
    };
    return SafeSubscriber;
}(Subscriber_Subscriber));

//# sourceMappingURL=Subscriber.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/canReportError.js
/** PURE_IMPORTS_START _Subscriber PURE_IMPORTS_END */

function canReportError(observer) {
    while (observer) {
        var _a = observer, closed_1 = _a.closed, destination = _a.destination, isStopped = _a.isStopped;
        if (closed_1 || isStopped) {
            return false;
        }
        else if (destination && destination instanceof Subscriber_Subscriber) {
            observer = destination;
        }
        else {
            observer = null;
        }
    }
    return true;
}
//# sourceMappingURL=canReportError.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/toSubscriber.js
/** PURE_IMPORTS_START _Subscriber,_symbol_rxSubscriber,_Observer PURE_IMPORTS_END */



function toSubscriber(nextOrObserver, error, complete) {
    if (nextOrObserver) {
        if (nextOrObserver instanceof Subscriber_Subscriber) {
            return nextOrObserver;
        }
        if (nextOrObserver[rxSubscriber]) {
            return nextOrObserver[rxSubscriber]();
        }
    }
    if (!nextOrObserver && !error && !complete) {
        return new Subscriber_Subscriber(empty);
    }
    return new Subscriber_Subscriber(nextOrObserver, error, complete);
}
//# sourceMappingURL=toSubscriber.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/symbol/observable.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
var observable = typeof Symbol === 'function' && Symbol.observable || '@@observable';
//# sourceMappingURL=observable.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/noop.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
function noop() { }
//# sourceMappingURL=noop.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/pipe.js
/** PURE_IMPORTS_START _noop PURE_IMPORTS_END */

function pipe() {
    var fns = [];
    for (var _i = 0; _i < arguments.length; _i++) {
        fns[_i] = arguments[_i];
    }
    return pipeFromArray(fns);
}
function pipeFromArray(fns) {
    if (!fns) {
        return noop;
    }
    if (fns.length === 1) {
        return fns[0];
    }
    return function piped(input) {
        return fns.reduce(function (prev, fn) { return fn(prev); }, input);
    };
}
//# sourceMappingURL=pipe.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/Observable.js
/** PURE_IMPORTS_START _util_canReportError,_util_toSubscriber,_internal_symbol_observable,_util_pipe,_config PURE_IMPORTS_END */





var Observable_Observable = /*@__PURE__*/ (function () {
    function Observable(subscribe) {
        this._isScalar = false;
        if (subscribe) {
            this._subscribe = subscribe;
        }
    }
    Observable.prototype.lift = function (operator) {
        var observable = new Observable();
        observable.source = this;
        observable.operator = operator;
        return observable;
    };
    Observable.prototype.subscribe = function (observerOrNext, error, complete) {
        var operator = this.operator;
        var sink = toSubscriber(observerOrNext, error, complete);
        if (operator) {
            sink.add(operator.call(sink, this.source));
        }
        else {
            sink.add(this.source || (config.useDeprecatedSynchronousErrorHandling && !sink.syncErrorThrowable) ?
                this._subscribe(sink) :
                this._trySubscribe(sink));
        }
        if (config.useDeprecatedSynchronousErrorHandling) {
            if (sink.syncErrorThrowable) {
                sink.syncErrorThrowable = false;
                if (sink.syncErrorThrown) {
                    throw sink.syncErrorValue;
                }
            }
        }
        return sink;
    };
    Observable.prototype._trySubscribe = function (sink) {
        try {
            return this._subscribe(sink);
        }
        catch (err) {
            if (config.useDeprecatedSynchronousErrorHandling) {
                sink.syncErrorThrown = true;
                sink.syncErrorValue = err;
            }
            if (canReportError(sink)) {
                sink.error(err);
            }
            else {
                console.warn(err);
            }
        }
    };
    Observable.prototype.forEach = function (next, promiseCtor) {
        var _this = this;
        promiseCtor = getPromiseCtor(promiseCtor);
        return new promiseCtor(function (resolve, reject) {
            var subscription;
            subscription = _this.subscribe(function (value) {
                try {
                    next(value);
                }
                catch (err) {
                    reject(err);
                    if (subscription) {
                        subscription.unsubscribe();
                    }
                }
            }, reject, resolve);
        });
    };
    Observable.prototype._subscribe = function (subscriber) {
        var source = this.source;
        return source && source.subscribe(subscriber);
    };
    Observable.prototype[observable] = function () {
        return this;
    };
    Observable.prototype.pipe = function () {
        var operations = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            operations[_i] = arguments[_i];
        }
        if (operations.length === 0) {
            return this;
        }
        return pipeFromArray(operations)(this);
    };
    Observable.prototype.toPromise = function (promiseCtor) {
        var _this = this;
        promiseCtor = getPromiseCtor(promiseCtor);
        return new promiseCtor(function (resolve, reject) {
            var value;
            _this.subscribe(function (x) { return value = x; }, function (err) { return reject(err); }, function () { return resolve(value); });
        });
    };
    Observable.create = function (subscribe) {
        return new Observable(subscribe);
    };
    return Observable;
}());

function getPromiseCtor(promiseCtor) {
    if (!promiseCtor) {
        promiseCtor = config.Promise || Promise;
    }
    if (!promiseCtor) {
        throw new Error('no Promise impl found');
    }
    return promiseCtor;
}
//# sourceMappingURL=Observable.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/operators/map.js
/** PURE_IMPORTS_START tslib,_Subscriber PURE_IMPORTS_END */


function map(project, thisArg) {
    return function mapOperation(source) {
        if (typeof project !== 'function') {
            throw new TypeError('argument is not a function. Are you looking for `mapTo()`?');
        }
        return source.lift(new MapOperator(project, thisArg));
    };
}
var MapOperator = /*@__PURE__*/ (function () {
    function MapOperator(project, thisArg) {
        this.project = project;
        this.thisArg = thisArg;
    }
    MapOperator.prototype.call = function (subscriber, source) {
        return source.subscribe(new map_MapSubscriber(subscriber, this.project, this.thisArg));
    };
    return MapOperator;
}());

var map_MapSubscriber = /*@__PURE__*/ (function (_super) {
    __extends(MapSubscriber, _super);
    function MapSubscriber(destination, project, thisArg) {
        var _this = _super.call(this, destination) || this;
        _this.project = project;
        _this.count = 0;
        _this.thisArg = thisArg || _this;
        return _this;
    }
    MapSubscriber.prototype._next = function (value) {
        var result;
        try {
            result = this.project.call(this.thisArg, value, this.count++);
        }
        catch (err) {
            this.destination.error(err);
            return;
        }
        this.destination.next(result);
    };
    return MapSubscriber;
}(Subscriber_Subscriber));
//# sourceMappingURL=map.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/observable/fromEvent.js
/** PURE_IMPORTS_START _Observable,_util_isArray,_util_isFunction,_operators_map PURE_IMPORTS_END */




var fromEvent_toString = Object.prototype.toString;
function fromEvent(target, eventName, options, resultSelector) {
    if (isFunction(options)) {
        resultSelector = options;
        options = undefined;
    }
    if (resultSelector) {
        return fromEvent(target, eventName, options).pipe(map(function (args) { return isArray(args) ? resultSelector.apply(void 0, args) : resultSelector(args); }));
    }
    return new Observable_Observable(function (subscriber) {
        function handler(e) {
            if (arguments.length > 1) {
                subscriber.next(Array.prototype.slice.call(arguments));
            }
            else {
                subscriber.next(e);
            }
        }
        setupSubscription(target, eventName, handler, subscriber, options);
    });
}
function setupSubscription(sourceObj, eventName, handler, subscriber, options) {
    var unsubscribe;
    if (isEventTarget(sourceObj)) {
        var source_1 = sourceObj;
        sourceObj.addEventListener(eventName, handler, options);
        unsubscribe = function () { return source_1.removeEventListener(eventName, handler, options); };
    }
    else if (isJQueryStyleEventEmitter(sourceObj)) {
        var source_2 = sourceObj;
        sourceObj.on(eventName, handler);
        unsubscribe = function () { return source_2.off(eventName, handler); };
    }
    else if (isNodeStyleEventEmitter(sourceObj)) {
        var source_3 = sourceObj;
        sourceObj.addListener(eventName, handler);
        unsubscribe = function () { return source_3.removeListener(eventName, handler); };
    }
    else if (sourceObj && sourceObj.length) {
        for (var i = 0, len = sourceObj.length; i < len; i++) {
            setupSubscription(sourceObj[i], eventName, handler, subscriber, options);
        }
    }
    else {
        throw new TypeError('Invalid event target');
    }
    subscriber.add(unsubscribe);
}
function isNodeStyleEventEmitter(sourceObj) {
    return sourceObj && typeof sourceObj.addListener === 'function' && typeof sourceObj.removeListener === 'function';
}
function isJQueryStyleEventEmitter(sourceObj) {
    return sourceObj && typeof sourceObj.on === 'function' && typeof sourceObj.off === 'function';
}
function isEventTarget(sourceObj) {
    return sourceObj && typeof sourceObj.addEventListener === 'function' && typeof sourceObj.removeEventListener === 'function';
}
//# sourceMappingURL=fromEvent.js.map

// CONCATENATED MODULE: ./components/base/ts/services/window.service.ts
function window_service_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function window_service_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function window_service_createClass(Constructor, protoProps, staticProps) { if (protoProps) window_service_defineProperties(Constructor.prototype, protoProps); if (staticProps) window_service_defineProperties(Constructor, staticProps); return Constructor; }



var window_service_WindowService =
/*#__PURE__*/
function () {
  function WindowService() {
    window_service_classCallCheck(this, WindowService);
  }

  window_service_createClass(WindowService, null, [{
    key: "onLoad",
    value: function onLoad() {
      return fromEvent(window, 'load');
    }
  }, {
    key: "onResize",
    value: function onResize() {
      return fromEvent(window, 'resize');
    }
  }, {
    key: "onScroll",
    value: function onScroll() {
      return fromEvent(window, 'scroll');
    }
  }, {
    key: "getWindow",
    value: function getWindow() {
      return WindowService.$window;
    }
  }, {
    key: "getScrollY",
    value: function getScrollY() {
      return (window.pageYOffset || document.documentElement.scrollTop) - (document.documentElement.clientTop || 0);
    }
  }, {
    key: "getWidth",
    value: function getWidth() {
      return WindowService.$window.width();
    }
  }, {
    key: "getHeight",
    value: function getHeight() {
      return WindowService.$window.height();
    }
  }, {
    key: "getWindowEl",
    value: function getWindowEl() {
      return WindowService.$window[0];
    }
  }, {
    key: "getOrientation",
    value: function getOrientation() {
      return WindowService.getWidth() > WindowService.getHeight() ? 'landscape' : 'portrait';
    }
  }]);

  return WindowService;
}();
window_service_WindowService.$window = external_jQuery_default()(window);
// CONCATENATED MODULE: ./components/base/ts/services/global.service.ts
function global_service_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function global_service_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function global_service_createClass(Constructor, protoProps, staticProps) { if (protoProps) global_service_defineProperties(Constructor.prototype, protoProps); if (staticProps) global_service_defineProperties(Constructor, staticProps); return Constructor; }


var global_service_GlobalService =
/*#__PURE__*/
function () {
  function GlobalService() {
    global_service_classCallCheck(this, GlobalService);
  }

  global_service_createClass(GlobalService, null, [{
    key: "onCustomizerRender",
    value: function onCustomizerRender() {
      var exWindow = window;
      return Observable_Observable.create(function (observer) {
        if (exWindow.wp && exWindow.wp.customize && exWindow.wp.customize.selectiveRefresh) {
          exWindow.wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
            observer.onNext($(placement.container));
          });
        }
      });
    }
  }, {
    key: "onCustomizerChange",
    value: function onCustomizerChange() {
      var exWindow = window;
      return Observable_Observable.create(function (observer) {
        if (exWindow.wp && exWindow.wp.customize) {
          exWindow.wp.customize.bind('change', function (setting) {
            observer.onNext(setting);
          });
        }
      });
    }
  }, {
    key: "onReady",
    value: function onReady() {
      return fromEvent(window.document, 'ready');
    }
  }]);

  return GlobalService;
}();
// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/util/ArgumentOutOfRangeError.js
/** PURE_IMPORTS_START  PURE_IMPORTS_END */
function ArgumentOutOfRangeErrorImpl() {
    Error.call(this);
    this.message = 'argument out of range';
    this.name = 'ArgumentOutOfRangeError';
    return this;
}
ArgumentOutOfRangeErrorImpl.prototype = /*@__PURE__*/ Object.create(Error.prototype);
var ArgumentOutOfRangeError = ArgumentOutOfRangeErrorImpl;
//# sourceMappingURL=ArgumentOutOfRangeError.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/observable/empty.js
/** PURE_IMPORTS_START _Observable PURE_IMPORTS_END */

var EMPTY = /*@__PURE__*/ new Observable_Observable(function (subscriber) { return subscriber.complete(); });
function empty_empty(scheduler) {
    return scheduler ? emptyScheduled(scheduler) : EMPTY;
}
function emptyScheduled(scheduler) {
    return new Observable_Observable(function (subscriber) { return scheduler.schedule(function () { return subscriber.complete(); }); });
}
//# sourceMappingURL=empty.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/operators/take.js
/** PURE_IMPORTS_START tslib,_Subscriber,_util_ArgumentOutOfRangeError,_observable_empty PURE_IMPORTS_END */




function take(count) {
    return function (source) {
        if (count === 0) {
            return empty_empty();
        }
        else {
            return source.lift(new take_TakeOperator(count));
        }
    };
}
var take_TakeOperator = /*@__PURE__*/ (function () {
    function TakeOperator(total) {
        this.total = total;
        if (this.total < 0) {
            throw new ArgumentOutOfRangeError;
        }
    }
    TakeOperator.prototype.call = function (subscriber, source) {
        return source.subscribe(new take_TakeSubscriber(subscriber, this.total));
    };
    return TakeOperator;
}());
var take_TakeSubscriber = /*@__PURE__*/ (function (_super) {
    __extends(TakeSubscriber, _super);
    function TakeSubscriber(destination, total) {
        var _this = _super.call(this, destination) || this;
        _this.total = total;
        _this.count = 0;
        return _this;
    }
    TakeSubscriber.prototype._next = function (value) {
        var total = this.total;
        var count = ++this.count;
        if (count <= total) {
            this.destination.next(value);
            if (count === total) {
                this.destination.complete();
                this.unsubscribe();
            }
        }
    };
    return TakeSubscriber;
}(Subscriber_Subscriber));
//# sourceMappingURL=take.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/scheduler/Action.js
/** PURE_IMPORTS_START tslib,_Subscription PURE_IMPORTS_END */


var Action_Action = /*@__PURE__*/ (function (_super) {
    __extends(Action, _super);
    function Action(scheduler, work) {
        return _super.call(this) || this;
    }
    Action.prototype.schedule = function (state, delay) {
        if (delay === void 0) {
            delay = 0;
        }
        return this;
    };
    return Action;
}(Subscription_Subscription));

//# sourceMappingURL=Action.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/scheduler/AsyncAction.js
/** PURE_IMPORTS_START tslib,_Action PURE_IMPORTS_END */


var AsyncAction_AsyncAction = /*@__PURE__*/ (function (_super) {
    __extends(AsyncAction, _super);
    function AsyncAction(scheduler, work) {
        var _this = _super.call(this, scheduler, work) || this;
        _this.scheduler = scheduler;
        _this.work = work;
        _this.pending = false;
        return _this;
    }
    AsyncAction.prototype.schedule = function (state, delay) {
        if (delay === void 0) {
            delay = 0;
        }
        if (this.closed) {
            return this;
        }
        this.state = state;
        var id = this.id;
        var scheduler = this.scheduler;
        if (id != null) {
            this.id = this.recycleAsyncId(scheduler, id, delay);
        }
        this.pending = true;
        this.delay = delay;
        this.id = this.id || this.requestAsyncId(scheduler, this.id, delay);
        return this;
    };
    AsyncAction.prototype.requestAsyncId = function (scheduler, id, delay) {
        if (delay === void 0) {
            delay = 0;
        }
        return setInterval(scheduler.flush.bind(scheduler, this), delay);
    };
    AsyncAction.prototype.recycleAsyncId = function (scheduler, id, delay) {
        if (delay === void 0) {
            delay = 0;
        }
        if (delay !== null && this.delay === delay && this.pending === false) {
            return id;
        }
        clearInterval(id);
        return undefined;
    };
    AsyncAction.prototype.execute = function (state, delay) {
        if (this.closed) {
            return new Error('executing a cancelled action');
        }
        this.pending = false;
        var error = this._execute(state, delay);
        if (error) {
            return error;
        }
        else if (this.pending === false && this.id != null) {
            this.id = this.recycleAsyncId(this.scheduler, this.id, null);
        }
    };
    AsyncAction.prototype._execute = function (state, delay) {
        var errored = false;
        var errorValue = undefined;
        try {
            this.work(state);
        }
        catch (e) {
            errored = true;
            errorValue = !!e && e || new Error(e);
        }
        if (errored) {
            this.unsubscribe();
            return errorValue;
        }
    };
    AsyncAction.prototype._unsubscribe = function () {
        var id = this.id;
        var scheduler = this.scheduler;
        var actions = scheduler.actions;
        var index = actions.indexOf(this);
        this.work = null;
        this.state = null;
        this.pending = false;
        this.scheduler = null;
        if (index !== -1) {
            actions.splice(index, 1);
        }
        if (id != null) {
            this.id = this.recycleAsyncId(scheduler, id, null);
        }
        this.delay = null;
    };
    return AsyncAction;
}(Action_Action));

//# sourceMappingURL=AsyncAction.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/Scheduler.js
var Scheduler = /*@__PURE__*/ (function () {
    function Scheduler(SchedulerAction, now) {
        if (now === void 0) {
            now = Scheduler.now;
        }
        this.SchedulerAction = SchedulerAction;
        this.now = now;
    }
    Scheduler.prototype.schedule = function (work, delay, state) {
        if (delay === void 0) {
            delay = 0;
        }
        return new this.SchedulerAction(this, work).schedule(state, delay);
    };
    Scheduler.now = function () { return Date.now(); };
    return Scheduler;
}());

//# sourceMappingURL=Scheduler.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/scheduler/AsyncScheduler.js
/** PURE_IMPORTS_START tslib,_Scheduler PURE_IMPORTS_END */


var AsyncScheduler_AsyncScheduler = /*@__PURE__*/ (function (_super) {
    __extends(AsyncScheduler, _super);
    function AsyncScheduler(SchedulerAction, now) {
        if (now === void 0) {
            now = Scheduler.now;
        }
        var _this = _super.call(this, SchedulerAction, function () {
            if (AsyncScheduler.delegate && AsyncScheduler.delegate !== _this) {
                return AsyncScheduler.delegate.now();
            }
            else {
                return now();
            }
        }) || this;
        _this.actions = [];
        _this.active = false;
        _this.scheduled = undefined;
        return _this;
    }
    AsyncScheduler.prototype.schedule = function (work, delay, state) {
        if (delay === void 0) {
            delay = 0;
        }
        if (AsyncScheduler.delegate && AsyncScheduler.delegate !== this) {
            return AsyncScheduler.delegate.schedule(work, delay, state);
        }
        else {
            return _super.prototype.schedule.call(this, work, delay, state);
        }
    };
    AsyncScheduler.prototype.flush = function (action) {
        var actions = this.actions;
        if (this.active) {
            actions.push(action);
            return;
        }
        var error;
        this.active = true;
        do {
            if (error = action.execute(action.state, action.delay)) {
                break;
            }
        } while (action = actions.shift());
        this.active = false;
        if (error) {
            while (action = actions.shift()) {
                action.unsubscribe();
            }
            throw error;
        }
    };
    return AsyncScheduler;
}(Scheduler));

//# sourceMappingURL=AsyncScheduler.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/scheduler/async.js
/** PURE_IMPORTS_START _AsyncAction,_AsyncScheduler PURE_IMPORTS_END */


var async_async = /*@__PURE__*/ new AsyncScheduler_AsyncScheduler(AsyncAction_AsyncAction);
//# sourceMappingURL=async.js.map

// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/operators/debounceTime.js
/** PURE_IMPORTS_START tslib,_Subscriber,_scheduler_async PURE_IMPORTS_END */



function debounceTime(dueTime, scheduler) {
    if (scheduler === void 0) {
        scheduler = async_async;
    }
    return function (source) { return source.lift(new DebounceTimeOperator(dueTime, scheduler)); };
}
var DebounceTimeOperator = /*@__PURE__*/ (function () {
    function DebounceTimeOperator(dueTime, scheduler) {
        this.dueTime = dueTime;
        this.scheduler = scheduler;
    }
    DebounceTimeOperator.prototype.call = function (subscriber, source) {
        return source.subscribe(new debounceTime_DebounceTimeSubscriber(subscriber, this.dueTime, this.scheduler));
    };
    return DebounceTimeOperator;
}());
var debounceTime_DebounceTimeSubscriber = /*@__PURE__*/ (function (_super) {
    __extends(DebounceTimeSubscriber, _super);
    function DebounceTimeSubscriber(destination, dueTime, scheduler) {
        var _this = _super.call(this, destination) || this;
        _this.dueTime = dueTime;
        _this.scheduler = scheduler;
        _this.debouncedSubscription = null;
        _this.lastValue = null;
        _this.hasValue = false;
        return _this;
    }
    DebounceTimeSubscriber.prototype._next = function (value) {
        this.clearDebounce();
        this.lastValue = value;
        this.hasValue = true;
        this.add(this.debouncedSubscription = this.scheduler.schedule(dispatchNext, this.dueTime, this));
    };
    DebounceTimeSubscriber.prototype._complete = function () {
        this.debouncedNext();
        this.destination.complete();
    };
    DebounceTimeSubscriber.prototype.debouncedNext = function () {
        this.clearDebounce();
        if (this.hasValue) {
            var lastValue = this.lastValue;
            this.lastValue = null;
            this.hasValue = false;
            this.destination.next(lastValue);
        }
    };
    DebounceTimeSubscriber.prototype.clearDebounce = function () {
        var debouncedSubscription = this.debouncedSubscription;
        if (debouncedSubscription !== null) {
            this.remove(debouncedSubscription);
            debouncedSubscription.unsubscribe();
            this.debouncedSubscription = null;
        }
    };
    return DebounceTimeSubscriber;
}(Subscriber_Subscriber));
function dispatchNext(subscriber) {
    subscriber.debouncedNext();
}
//# sourceMappingURL=debounceTime.js.map

// CONCATENATED MODULE: ./components/base/ts/BaseTheme.ts
function BaseTheme_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function BaseTheme_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function BaseTheme_createClass(Constructor, protoProps, staticProps) { if (protoProps) BaseTheme_defineProperties(Constructor.prototype, protoProps); if (staticProps) BaseTheme_defineProperties(Constructor, staticProps); return Constructor; }






var BaseTheme_BaseTheme =
/*#__PURE__*/
function () {
  function BaseTheme() {
    BaseTheme_classCallCheck(this, BaseTheme);

    this.$body = external_jQuery_default()('body');
    this.$window = external_jQuery_default()(window);
    this.$html = external_jQuery_default()('html');
    this.ev = external_jQuery_default()({});
    this.frameRendered = false;
    this.subscriptionActive = true;
    this.$html.toggleClass('is-IE', Helper_Helper.getIEversion() && Helper_Helper.getIEversion() < 12);
    this.bindEvents();
    this.renderLoop();
  }

  BaseTheme_createClass(BaseTheme, [{
    key: "bindEvents",
    value: function bindEvents() {
      global_service_GlobalService.onReady().pipe(take(1)).subscribe(this.onReadyAction.bind(this));
      window_service_WindowService.onLoad().pipe(take(1)).subscribe(this.onLoadAction.bind(this));
      window_service_WindowService.onResize().pipe(debounceTime(500)).subscribe(this.onResizeAction.bind(this));
      window_service_WindowService.onScroll().subscribe(this.onScrollAction.bind(this)); // Leave comments area visible by default and
      // show it only if the URL links to a comment

      if (window.location.href.indexOf('#comment') === -1) {
        external_jQuery_default()('.trigger-comments').removeAttr('checked');
      }

      this.$window.on('beforeunload', this.fadeOut.bind(this));
      this.ev.on('render', this.update.bind(this));
    }
  }, {
    key: "onScrollAction",
    value: function onScrollAction() {
      this.frameRendered = false;
    }
  }, {
    key: "onReadyAction",
    value: function onReadyAction() {
      this.$html.addClass('is-ready');
    }
  }, {
    key: "onLoadAction",
    value: function onLoadAction() {
      this.$html.addClass('is-loaded');
      this.fadeIn();
    }
  }, {
    key: "onResizeAction",
    value: function onResizeAction() {}
  }, {
    key: "destroy",
    value: function destroy() {
      this.subscriptionActive = false;
    }
  }, {
    key: "renderLoop",
    value: function renderLoop() {
      var _this = this;

      if (this.frameRendered === false) {
        this.ev.trigger('render');
      }

      requestAnimationFrame(function () {
        _this.renderLoop();

        _this.frameRendered = true;

        _this.ev.trigger('afterRender');
      });
    }
  }, {
    key: "update",
    value: function update() {
      this.backToTop();
    }
  }, {
    key: "backToTop",
    value: function backToTop() {
      external_jQuery_default()('.back-to-top').toggleClass('is-visible', window_service_WindowService.getScrollY() >= window_service_WindowService.getHeight());
    }
  }, {
    key: "eventHandlers",
    value: function eventHandlers($container) {
      $container.find('.back-to-top').on('click', function (e) {
        e.preventDefault();
        Helper_Helper.smoothScrollTo(0, 1000);
      });
    }
  }, {
    key: "fadeOut",
    value: function fadeOut() {
      this.$html.removeClass('fade-in').addClass('fade-out');
    }
  }, {
    key: "fadeIn",
    value: function fadeIn() {
      this.$html.removeClass('fade-out no-transitions').addClass('fade-in');
    }
  }]);

  return BaseTheme;
}();
// CONCATENATED MODULE: ./components/base/ts/models/DefaultComponent.ts
function DefaultComponent_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var BaseComponent = function BaseComponent() {
  DefaultComponent_classCallCheck(this, BaseComponent);
};
// CONCATENATED MODULE: ./node_modules/rxjs/_esm5/internal/operators/takeWhile.js
/** PURE_IMPORTS_START tslib,_Subscriber PURE_IMPORTS_END */


function takeWhile(predicate, inclusive) {
    if (inclusive === void 0) {
        inclusive = false;
    }
    return function (source) {
        return source.lift(new TakeWhileOperator(predicate, inclusive));
    };
}
var TakeWhileOperator = /*@__PURE__*/ (function () {
    function TakeWhileOperator(predicate, inclusive) {
        this.predicate = predicate;
        this.inclusive = inclusive;
    }
    TakeWhileOperator.prototype.call = function (subscriber, source) {
        return source.subscribe(new takeWhile_TakeWhileSubscriber(subscriber, this.predicate, this.inclusive));
    };
    return TakeWhileOperator;
}());
var takeWhile_TakeWhileSubscriber = /*@__PURE__*/ (function (_super) {
    __extends(TakeWhileSubscriber, _super);
    function TakeWhileSubscriber(destination, predicate, inclusive) {
        var _this = _super.call(this, destination) || this;
        _this.predicate = predicate;
        _this.inclusive = inclusive;
        _this.index = 0;
        return _this;
    }
    TakeWhileSubscriber.prototype._next = function (value) {
        var destination = this.destination;
        var result;
        try {
            result = this.predicate(value, this.index++);
        }
        catch (err) {
            destination.error(err);
            return;
        }
        this.nextOrComplete(value, result);
    };
    TakeWhileSubscriber.prototype.nextOrComplete = function (value, predicateResult) {
        var destination = this.destination;
        if (Boolean(predicateResult)) {
            destination.next(value);
        }
        else {
            if (this.inclusive) {
                destination.next(value);
            }
            destination.complete();
        }
    };
    return TakeWhileSubscriber;
}(Subscriber_Subscriber));
//# sourceMappingURL=takeWhile.js.map

// CONCATENATED MODULE: ./components/base/ts/components/SearchOverlay.ts
function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function SearchOverlay_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function SearchOverlay_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function SearchOverlay_createClass(Constructor, protoProps, staticProps) { if (protoProps) SearchOverlay_defineProperties(Constructor.prototype, protoProps); if (staticProps) SearchOverlay_defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }





var SearchOverlay_activeClass = 'show-search-overlay';
var openClass = '.js-search-trigger';
var closeClass = '.js-search-close';
var escKeyCode = 27;
var SearchOverlay_SearchOverlay =
/*#__PURE__*/
function (_BaseComponent) {
  _inherits(SearchOverlay, _BaseComponent);

  function SearchOverlay() {
    var _this;

    SearchOverlay_classCallCheck(this, SearchOverlay);

    _this = _possibleConstructorReturn(this, _getPrototypeOf(SearchOverlay).call(this));
    _this.$body = external_jQuery_default()('body');
    _this.$document = external_jQuery_default()(document);
    _this.$searchField = external_jQuery_default()('.c-search-overlay').find('.search-field');
    _this.keyupSubscriptionActive = true;

    _this.bindEvents();

    return _this;
  }

  SearchOverlay_createClass(SearchOverlay, [{
    key: "destroy",
    value: function destroy() {
      this.keyupSubscriptionActive = false;
      this.$document.off('click.SearchOverlay');
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      this.$document.on('click.SearchOverlay', openClass, this.open.bind(this));
      this.$document.on('click.SearchOverlay', closeClass, this.close.bind(this));
      this.keyupSub = fromEvent(window.document.body, 'keyup');
    }
  }, {
    key: "createKeyupSubscription",
    value: function createKeyupSubscription() {
      var _this2 = this;

      this.keyupSubscriptionActive = true;
      this.keyupSub.pipe(takeWhile(function () {
        return _this2.keyupSubscriptionActive;
      })).subscribe(this.closeOnEsc.bind(this));
    }
  }, {
    key: "open",
    value: function open() {
      this.$searchField.focus();
      this.$body.addClass(SearchOverlay_activeClass);
      this.createKeyupSubscription();
    }
  }, {
    key: "close",
    value: function close() {
      this.$body.removeClass(SearchOverlay_activeClass);
      this.$searchField.blur();
      this.keyupSubscriptionActive = false;
    }
  }, {
    key: "closeOnEsc",
    value: function closeOnEsc(e) {
      if (e.keyCode === escKeyCode) {
        this.close();
      }
    }
  }]);

  return SearchOverlay;
}(BaseComponent);
// CONCATENATED MODULE: ./components/header/ts/Header.ts
function Header_typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { Header_typeof = function _typeof(obj) { return typeof obj; }; } else { Header_typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return Header_typeof(obj); }

function Header_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Header_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Header_createClass(Constructor, protoProps, staticProps) { if (protoProps) Header_defineProperties(Constructor.prototype, protoProps); if (staticProps) Header_defineProperties(Constructor, staticProps); return Constructor; }

function Header_possibleConstructorReturn(self, call) { if (call && (Header_typeof(call) === "object" || typeof call === "function")) { return call; } return Header_assertThisInitialized(self); }

function Header_assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function Header_getPrototypeOf(o) { Header_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return Header_getPrototypeOf(o); }

function Header_inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) Header_setPrototypeOf(subClass, superClass); }

function Header_setPrototypeOf(o, p) { Header_setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return Header_setPrototypeOf(o, p); }







var Header_Header =
/*#__PURE__*/
function (_BaseComponent) {
  Header_inherits(Header, _BaseComponent);

  function Header() {
    var _this;

    Header_classCallCheck(this, Header);

    _this = Header_possibleConstructorReturn(this, Header_getPrototypeOf(Header).call(this));
    _this.$body = external_jQuery_default()('body');
    _this.$document = external_jQuery_default()(document);
    _this.$mainMenu = external_jQuery_default()('.menu--primary');
    _this.$mainMenuItems = _this.$mainMenu.find('li');
    _this.$menuToggle = external_jQuery_default()('#menu-toggle');
    _this.isMobileHeaderInitialised = false;
    _this.isDesktopHeaderInitialised = false;
    _this.areMobileBindingsDone = false;
    _this.subscriptionActive = true;
    _this.preventOneSelector = 'a.prevent-one';
    external_jQuery_default()('.c-navbar__zone').each(function (i, obj) {
      var $obj = external_jQuery_default()(obj);

      if ($obj.find('.c-branding').length) {
        $obj.addClass('c-navbar__zone--branding');
      }

      if ($obj.find('.jetpack-social-navigation').length) {
        $obj.addClass('c-navbar__zone--social');
      }
    });
    external_jQuery_default()('.c-navbar .c-logo').imagesLoaded(function () {
      _this.bindEvents();

      _this.eventHandlers();

      _this.updateOnResize();

      _this.toggleNavStateClass();
    });
    return _this;
  }

  Header_createClass(Header, [{
    key: "destroy",
    value: function destroy() {
      this.subscriptionActive = false;
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this2 = this;

      this.$menuToggle.on('change', this.onMenuToggleChange.bind(this));
      this.$mainMenuItems.hoverIntent({
        out: function out(e) {
          return _this2.toggleSubMenu(e, false);
        },
        over: function over(e) {
          return _this2.toggleSubMenu(e, true);
        },
        timeout: 300
      });
      window_service_WindowService.onResize().pipe(takeWhile(function () {
        return _this2.subscriptionActive;
      })).subscribe(function () {
        _this2.updateOnResize();
      });
    }
  }, {
    key: "eventHandlers",
    value: function eventHandlers() {
      if (Helper_Helper.below('lap') && !this.areMobileBindingsDone) {
        this.$document.on('click', this.preventOneSelector, this.onMobileMenuExpand.bind(this));
        this.areMobileBindingsDone = true;
      }

      if (Helper_Helper.above('lap') && this.areMobileBindingsDone) {
        this.$document.off('click', this.preventOneSelector, this.onMobileMenuExpand.bind(this));
        this.areMobileBindingsDone = false;
      }
    }
  }, {
    key: "updateOnResize",
    value: function updateOnResize() {
      this.eventHandlers();

      if (Helper_Helper.below('lap')) {
        this.prepareMobileMenuMarkup();
      } else {
        this.prepareDesktopMenuMarkup();
      }
    }
  }, {
    key: "prepareDesktopMenuMarkup",
    value: function prepareDesktopMenuMarkup() {
      if (this.isDesktopHeaderInitialised) {
        return;
      }

      this.isDesktopHeaderInitialised = true;
    }
  }, {
    key: "prepareMobileMenuMarkup",
    value: function prepareMobileMenuMarkup() {
      // If if has not been done yet, prepare the mark-up for the mobile navigation
      if (this.isMobileHeaderInitialised) {
        return;
      } // Append the branding


      var $branding = external_jQuery_default()('.c-branding');
      $branding.clone().addClass('c-branding--mobile');
      $branding.find('img').removeClass('is--loading'); // Create the mobile site header

      var $siteHeaderMobile = external_jQuery_default()('<div class="site-header-mobile  u-header-sides-spacing"></div>'); // Append the social menu

      var $searchTrigger = external_jQuery_default()('.js-mobile-search-trigger');
      $siteHeaderMobile.append($branding.clone());
      $siteHeaderMobile.append($searchTrigger.clone().show());
      $siteHeaderMobile.appendTo('.c-navbar'); // Handle sub menus:
      // Make sure there are no open menu items

      external_jQuery_default()('.menu-item-has-children').removeClass('hover'); // Add a class so we know the items to handle

      external_jQuery_default()('.menu-item-has-children > a').each(function (index, element) {
        external_jQuery_default()(element).addClass('prevent-one');
      });
      this.isMobileHeaderInitialised = true;
    }
  }, {
    key: "toggleSubMenu",
    value: function toggleSubMenu(e, toggle) {
      external_jQuery_default()(e.currentTarget).toggleClass('hover', toggle);
    }
  }, {
    key: "onMobileMenuExpand",
    value: function onMobileMenuExpand(e) {
      e.preventDefault();
      e.stopPropagation();
      var $button = external_jQuery_default()(e.currentTarget);
      var activeClass = 'active';
      var hoverClass = 'hover';

      if ($button.hasClass(activeClass)) {
        window.location.href = $button.attr('href');
        return;
      }

      external_jQuery_default()(this.preventOneSelector).removeClass(activeClass);
      $button.addClass(activeClass); // When a parent menu item is activated,
      // close other menu items on the same level

      $button.parent().siblings().removeClass(hoverClass); // Open the sub menu of this parent item

      $button.parent().addClass(hoverClass);
    }
  }, {
    key: "toggleNavStateClass",
    value: function toggleNavStateClass() {
      var isMenuOpen = this.$menuToggle.prop('checked');
      this.$body.toggleClass('nav--is-open', isMenuOpen);
      return isMenuOpen;
    }
  }, {
    key: "onMenuToggleChange",
    value: function onMenuToggleChange(e) {
      var _this3 = this;

      if (!this.toggleNavStateClass()) {
        setTimeout(function () {
          // Close the open submenus in the mobile menu overlay
          _this3.$mainMenuItems.removeClass('hover');

          _this3.$mainMenuItems.find('a').removeClass('active');
        }, 300);
      }
    }
  }]);

  return Header;
}(BaseComponent);
// CONCATENATED MODULE: ./components/base/ts/components/Gallery.ts
function Gallery_typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { Gallery_typeof = function _typeof(obj) { return typeof obj; }; } else { Gallery_typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return Gallery_typeof(obj); }

function Gallery_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Gallery_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Gallery_createClass(Constructor, protoProps, staticProps) { if (protoProps) Gallery_defineProperties(Constructor.prototype, protoProps); if (staticProps) Gallery_defineProperties(Constructor, staticProps); return Constructor; }

function Gallery_possibleConstructorReturn(self, call) { if (call && (Gallery_typeof(call) === "object" || typeof call === "function")) { return call; } return Gallery_assertThisInitialized(self); }

function Gallery_assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function Gallery_getPrototypeOf(o) { Gallery_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return Gallery_getPrototypeOf(o); }

function Gallery_inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) Gallery_setPrototypeOf(subClass, superClass); }

function Gallery_setPrototypeOf(o, p) { Gallery_setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return Gallery_setPrototypeOf(o, p); }






var Gallery_Gallery =
/*#__PURE__*/
function (_BaseComponent) {
  Gallery_inherits(Gallery, _BaseComponent);

  function Gallery(element) {
    var _this;

    Gallery_classCallCheck(this, Gallery);

    _this = Gallery_possibleConstructorReturn(this, Gallery_getPrototypeOf(Gallery).call(this));
    _this.subscriptionActive = true;
    _this.masonryGallerySelector = '.c-gallery--packed, .c-gallery--masonry';
    _this.element = element;

    _this.layout();

    window_service_WindowService.onResize().pipe(debounceTime(300)).pipe(takeWhile(function () {
      return _this.subscriptionActive;
    })).subscribe(function () {
      _this.layout();
    });
    global_service_GlobalService.onCustomizerRender().pipe(debounceTime(300)).pipe(takeWhile(function () {
      return _this.subscriptionActive;
    })).subscribe(function () {
      _this.layout();
    });
    global_service_GlobalService.onCustomizerChange().pipe(debounceTime(300)).pipe(takeWhile(function () {
      return _this.subscriptionActive;
    })).subscribe(function () {
      _this.layout();
    });
    return _this;
  }

  Gallery_createClass(Gallery, [{
    key: "bindEvents",
    value: function bindEvents() {}
  }, {
    key: "destroy",
    value: function destroy() {
      this.subscriptionActive = false;
    }
  }, {
    key: "layout",
    value: function layout() {
      var $items = this.element.children();
      var minColumnWidth;

      if (!$items.length || !this.element.is(this.masonryGallerySelector)) {
        return;
      }

      minColumnWidth = this.element.children().get(0).getBoundingClientRect().width;
      $items.each(function (index, element) {
        var width = element.getBoundingClientRect().width;
        minColumnWidth = width < minColumnWidth ? width : minColumnWidth;
      });

      if (this.masonry) {
        this.masonry.destroy();
      }

      this.masonry = new external_Masonry_(this.element.get(0), {
        columnWidth: minColumnWidth,
        transitionDuration: 0
      });
    }
  }]);

  return Gallery;
}(BaseComponent);
// EXTERNAL MODULE: external "anime"
var external_anime_ = __webpack_require__(6);
var external_anime_default = /*#__PURE__*/__webpack_require__.n(external_anime_);

// CONCATENATED MODULE: ./components/base/ts/components/blob.ts
function blob_typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { blob_typeof = function _typeof(obj) { return typeof obj; }; } else { blob_typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return blob_typeof(obj); }

function blob_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function blob_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function blob_createClass(Constructor, protoProps, staticProps) { if (protoProps) blob_defineProperties(Constructor.prototype, protoProps); if (staticProps) blob_defineProperties(Constructor, staticProps); return Constructor; }

function blob_possibleConstructorReturn(self, call) { if (call && (blob_typeof(call) === "object" || typeof call === "function")) { return call; } return blob_assertThisInitialized(self); }

function blob_assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function blob_getPrototypeOf(o) { blob_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return blob_getPrototypeOf(o); }

function blob_inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) blob_setPrototypeOf(subClass, superClass); }

function blob_setPrototypeOf(o, p) { blob_setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return blob_setPrototypeOf(o, p); }




var blob_Blob =
/*#__PURE__*/
function (_BaseComponent) {
  blob_inherits(Blob, _BaseComponent);

  function Blob(sides, complexity, preset) {
    var _this;

    var presetOffset = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;

    blob_classCallCheck(this, Blob);

    _this = blob_possibleConstructorReturn(this, blob_getPrototypeOf(Blob).call(this));
    _this.radius = 10;
    _this.complexity = 0.84;
    _this.sides = sides;
    _this.complexity = complexity;
    _this.preset = preset + presetOffset;
    _this.presetOffset = presetOffset;

    _this.bindEvents();

    _this.render();

    return _this;
  }

  blob_createClass(Blob, [{
    key: "generateSvg",
    value: function generateSvg() {
      var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
      var polygon = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
      svg.setAttribute('viewBox', '0 0 ' + 2 * this.radius + ' ' + 2 * this.radius);
      svg.setAttribute('fill', 'currentColor');
      polygon.setAttribute('points', this.generatePoints(true));
      svg.appendChild(polygon);
      return svg;
    }
  }, {
    key: "morph",
    value: function morph() {
      var morphDuration = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 300;
      external_anime_default()({
        duration: morphDuration,
        offset: 0,
        points: this.generatePoints(true),
        targets: this.element.find('polygon').get(0)
      });
    }
  }, {
    key: "render",
    value: function render() {
      var $svg = external_jQuery_default()(this.generateSvg());

      if (this.element) {
        this.element.replaceWith($svg);
      }

      this.element = $svg;
    }
  }, {
    key: "getRatio",
    value: function getRatio(preset, i) {
      var pow = Math.pow(preset, i);
      return (4 + 6 * this.getMagicDigit(pow) / 9) / 10;
    }
  }, {
    key: "setPreset",
    value: function setPreset(preset) {
      this.preset = preset + this.presetOffset;
    }
  }, {
    key: "getMagicDigit",
    value: function getMagicDigit(n) {
      var sum = 0;

      while (n > 0 || sum > 9) {
        if (n === 0) {
          n = sum;
          sum = 0;
        }

        sum += n % 10;
        n = Math.floor(n / 10);
      }

      return sum;
    }
  }, {
    key: "setComplexity",
    value: function setComplexity(complexity) {
      this.complexity = complexity;
    }
  }, {
    key: "setSides",
    value: function setSides(sides) {
      this.sides = sides;
    }
  }, {
    key: "generatePoints",
    value: function generatePoints() {
      var random = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var points = [];

      for (var i = 1; i <= this.sides; i++) {
        // generate a regular polygon
        // we add pi/2 to the angle to have the tip of polygons with odd number of edges pointing upwards
        var angle = 2 * Math.PI * i / this.sides - Math.PI / 2; // default ratio is 0.7 because the random one varies between 0.4 and 1

        var defaultRatio = 0.7;
        var ratio = defaultRatio + (this.getRatio(this.preset, i) - defaultRatio) * this.complexity;
        var x = this.radius * (Math.cos(angle) * ratio + 1);
        var y = this.radius * (Math.sin(angle) * ratio + 1);
        points.push(x + ',' + y);
      }

      return points.join(' ');
    }
  }, {
    key: "getSvg",
    value: function getSvg() {
      return this.element;
    }
  }, {
    key: "getPreset",
    value: function getPreset() {
      return this.preset;
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {}
  }, {
    key: "destroy",
    value: function destroy() {}
  }]);

  return Blob;
}(BaseComponent);
// CONCATENATED MODULE: ./variations/vasco/ts/Vasco.ts
function Vasco_typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { Vasco_typeof = function _typeof(obj) { return typeof obj; }; } else { Vasco_typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return Vasco_typeof(obj); }

function Vasco_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Vasco_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Vasco_createClass(Constructor, protoProps, staticProps) { if (protoProps) Vasco_defineProperties(Constructor.prototype, protoProps); if (staticProps) Vasco_defineProperties(Constructor, staticProps); return Constructor; }

function Vasco_possibleConstructorReturn(self, call) { if (call && (Vasco_typeof(call) === "object" || typeof call === "function")) { return call; } return Vasco_assertThisInitialized(self); }

function Vasco_assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = Vasco_getPrototypeOf(object); if (object === null) break; } return object; }

function Vasco_getPrototypeOf(o) { Vasco_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return Vasco_getPrototypeOf(o); }

function Vasco_inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) Vasco_setPrototypeOf(subClass, superClass); }

function Vasco_setPrototypeOf(o, p) { Vasco_setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return Vasco_setPrototypeOf(o, p); }













var ANNOUNCEMENT_COOKIE_NAME = 'announcementClosed';
var Vasco_Vasco =
/*#__PURE__*/
function (_BaseTheme) {
  Vasco_inherits(Vasco, _BaseTheme);

  function Vasco() {
    var _this;

    Vasco_classCallCheck(this, Vasco);

    _this = Vasco_possibleConstructorReturn(this, Vasco_getPrototypeOf(Vasco).call(this));
    _this.isLoggedIn = external_jQuery_default()('body').hasClass('logged-in');
    _this.windowDimensions = {
      height: _this.$window.height(),
      width: _this.$window.width()
    };
    _this.blobs = [];
    _this.$announcementBar = external_jQuery_default()('.c-announcement-bar');
    _this.$siteHeader = external_jQuery_default()('.site-header');
    _this.$toolbar = external_jQuery_default()('.c-toolbar');
    _this.$contentPaddingContainer = external_jQuery_default()('.u-header-height-padding-top');

    if (_this.isLoggedIn) {
      _this.clearAnnouncementCookie();
    }

    setTimeout(function () {
      _this.initAnnouncementBar();
    }, 2000);

    _this.handleContent();

    _this.groupWidgets();

    _this.generateBlobs();

    global_service_GlobalService.onCustomizerRender().pipe(debounceTime(300)).pipe(takeWhile(function () {
      return _this.subscriptionActive;
    })).subscribe(function () {
      _this.groupWidgets();

      _this.prepareFeatureHover();

      _this.initStamp();
    });
    global_service_GlobalService.onCustomizerChange().pipe(debounceTime(300)).pipe(takeWhile(function () {
      return _this.subscriptionActive;
    })).subscribe(function () {
      _this.prepareFeatureHover();

      _this.initStamp();
    });
    global_service_GlobalService.onCustomizerChange().pipe(debounceTime(300)).pipe(takeWhile(function () {
      return _this.subscriptionActive;
    })).subscribe(function () {
      _this.updateBlobParameters();
    });
    return _this;
  }

  Vasco_createClass(Vasco, [{
    key: "addBrowserClasses",
    value: function addBrowserClasses() {
      var extWindow = window;
      external_jQuery_default()('body').toggleClass('is-safari', !!extWindow.safari);
    }
  }, {
    key: "updateBlobParameters",
    value: function updateBlobParameters() {
      var extWindow = window;
      var wp = extWindow.wp;
      var $goo = external_jQuery_default()('#goo');
      var complexity = parseInt(wp.customize('vasco_options[blobs_complexity]')(), 10) / 100;
      var smoothness = parseInt(wp.customize('vasco_options[blobs_smoothness]')(), 10);
      var preset = parseInt(wp.customize('vasco_options[blobs_preset]')(), 10);
      this.blobs.forEach(function (blob) {
        if (blob.getPreset() !== preset) {
          blob.setPreset(preset);
        }

        blob.setComplexity(complexity);
        blob.morph(600);
      });
      requestAnimationFrame(function () {
        var stdDeviation = Math.max(smoothness, 0);
        var rgbaMatrix = '0 0 0 ' + (1 + smoothness) + ' -' + smoothness / 3;
        $goo.find('feGaussianBlur').attr('stdDeviation', stdDeviation);
        $goo.find('feColorMatrix').attr('values', '1 0 0 0 0  0 1 0 0 0  0 0 1 0 0 ' + rgbaMatrix);
      });
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      _get(Vasco_getPrototypeOf(Vasco.prototype), "bindEvents", this).call(this);

      this.handleFeatureCardMobileClick();
    }
  }, {
    key: "handleFeatureCardMobileClick",
    value: function handleFeatureCardMobileClick() {
      if (Helper_Helper.above('lap')) {
        return;
      }

      var $featureWidgets = external_jQuery_default()('.widget_feature_card');
      $featureWidgets.on('click', function (event) {
        var $actionButton = external_jQuery_default()(event.currentTarget).find('.c-feature__action').find('a');
        var href = $actionButton.attr('href');

        if (href) {
          window.location.href = $actionButton.attr('href');
        }
      });
    }
  }, {
    key: "onLoadAction",
    value: function onLoadAction() {
      _get(Vasco_getPrototypeOf(Vasco.prototype), "onLoadAction", this).call(this);

      this.Header = new Header_Header();
      this.SearchOverlay = new SearchOverlay_SearchOverlay();
      this.addNavigationClasses();
      this.addBrowserClasses();
      this.adjustLayout();
      this.initStamp();
    }
  }, {
    key: "onResizeAction",
    value: function onResizeAction() {
      _get(Vasco_getPrototypeOf(Vasco.prototype), "onResizeAction", this).call(this);

      this.adjustLayout(); // Fix for iOS Safari because it triggers and Resize event when scrolling in page and the address bar hides.
      // The window dimensions don't change, only the event is triggered

      if (this.windowDimensions.width !== this.$window.width() && this.windowDimensions.height !== this.$window.height()) {
        this.windowDimensions = {
          width: this.$window.width(),
          height: this.$window.height()
        };
        this.positionAnnouncementBar();
      }
    }
  }, {
    key: "onJetpackPostLoad",
    value: function onJetpackPostLoad() {
      var $container = external_jQuery_default()('#posts-container');
      this.handleContent($container);
      this.adjustLayout();
    }
  }, {
    key: "handleContent",
    value: function handleContent() {
      var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.$body;
      Helper_Helper.unwrapImages($container.find('.entry-content'));
      Helper_Helper.wrapEmbeds($container.find('.entry-content'));
      Helper_Helper.handleVideos($container);
      Helper_Helper.handleCustomCSS($container);
      this.handleGalleries($container);
      this.eventHandlers($container);
      var $commentForm = $container.find('.comment-form');

      if ($commentForm.length) {
        var $commentFormFooter = external_jQuery_default()('<div class="comment-form-subscriptions"></div>').appendTo($commentForm);
        $commentForm.find('.comment-subscription-form').appendTo($commentFormFooter);
      }

      $container.find('.c-gallery').not('.c-gallery--widget').each(function (index, element) {
        new Gallery_Gallery(external_jQuery_default()(element));
      });
    }
  }, {
    key: "generateBlobs",
    value: function generateBlobs() {
      var _this2 = this;

      var preset = parseInt(external_jQuery_default()('body').data('blobs-preset'), 10);
      var complexity = parseInt(external_jQuery_default()('body').data('blobs-complexity'), 10) / 100;
      var sides = 13;
      external_jQuery_default()('.blob--shape-1').each(function (i, obj) {
        var $obj = external_jQuery_default()(obj);
        var blob = new blob_Blob(sides, complexity, preset);

        _this2.blobs.push(blob);

        $obj.append(blob.getSvg());
      });
      external_jQuery_default()('.blob--shape-2').each(function (i, obj) {
        var $obj = external_jQuery_default()(obj);
        var blob = new blob_Blob(sides, complexity, preset, 1);

        _this2.blobs.push(blob);

        $obj.append(blob.getSvg());
      });
      external_jQuery_default()('.blob--shape-3').each(function (i, obj) {
        var $obj = external_jQuery_default()(obj);
        var blob = new blob_Blob(sides, complexity, preset, 2);

        _this2.blobs.push(blob);

        $obj.append(blob.getSvg());
      });
      setTimeout(function () {
        window.requestAnimationFrame(function () {
          external_jQuery_default()('.blob--shape').closest('.blob').addClass('blob--loaded');
        });
      }, 500);
    }
  }, {
    key: "groupWidgets",
    value: function groupWidgets() {
      if (!external_jQuery_default()('body.is-customizer-preview').length) {
        return;
      }

      var $sidebars = external_jQuery_default()('.widget-area--front-page-1, .widget-area--footer-featured');
      $sidebars.each(function (index, obj) {
        var $sidebar = external_jQuery_default()(obj);
        var $widgets = $sidebar.find('.widget');
        var featureWidgetSelector = '.widget_feature_card';
        var stampWidgetSelector = '.widget_stamp';
        var newsletterWidgetSelector = '.widget_mc4wp_form_widget';
        var socialWidgetSelector = '.widget_wpcom_social_media_icons_widget, .jetpack_widget_social_icons';
        var instagramWidgetSelector = '.null-instagram-feed';
        var groupDefaultClass = 'widget-group';
        $sidebar.children('.' + groupDefaultClass).children().unwrap(); // @todo check why there are still

        $sidebar.children('.' + groupDefaultClass).remove();

        for (var i = 0; i < $widgets.length; i++) {
          var $widget = $widgets.eq(i);
          var $second = $widget.next();
          var $third = $second.next();
          var $fourth = $third.next();
          var $group = void 0;
          var groupClass = void 0;
          var offset = 0;

          if ($widget.is(featureWidgetSelector) && $second.is(featureWidgetSelector)) {
            $group = $widget.add($second);
            groupClass = 'feature-group-2';
            offset = 1;

            if ($third.is(featureWidgetSelector)) {
              $group = $group.add($third);
              groupClass = 'feature-group-3';
              offset = 2;

              if ($fourth.is(featureWidgetSelector)) {
                $group = $group.add($fourth);
                groupClass = 'feature-group-4';
                offset = 3;
              }
            }
          }

          if ($widget.is(newsletterWidgetSelector) && $second.is(stampWidgetSelector) || $widget.is(stampWidgetSelector) && $second.is(newsletterWidgetSelector)) {
            $group = $widget.add($second);
            groupClass = 'stamp-newsletter-group';
            offset = 1;
          }

          if ($widget.is(socialWidgetSelector) && $second.is(instagramWidgetSelector) || $widget.is(instagramWidgetSelector) && $second.is(socialWidgetSelector)) {
            $group = $widget.add($second);
            groupClass = 'social-instagram-group';
            offset = 1;
          }

          if ($group) {
            $group.wrapAll('<div class="' + groupClass + ' ' + groupDefaultClass + '">');
          }

          i += offset;
        }
      });
    }
  }, {
    key: "handleGalleries",
    value: function handleGalleries() {
      var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper_Helper.$body;
      $container.find('.js-masonry, .u-gallery-type--masonry').each(function (index, element) {
        new external_Masonry_(element, {
          transitionDuration: 0
        });
      });
    }
  }, {
    key: "prepareFeatureHover",
    value: function prepareFeatureHover() {
      external_jQuery_default()('.c-feature').each(function (i, obj) {
        var $obj = external_jQuery_default()(obj);
        var objOffset = $obj.offset();
        var objHeight = $obj.outerHeight();
        var $title = $obj.find('.c-feature__title').css({
          transform: '',
          transition: 'none'
        });
        var titleOffset = $title.offset();
        var titleHeight = $title.outerHeight();
        var distanceTop = objOffset.top - titleOffset.top;
        var distanceBottom = titleOffset.top + titleHeight - (objOffset.top + objHeight);
        var $target = $obj.find('.c-feature__title, .c-feature__description, .c-feature__action');
        var transformString = 'translate3d(0,' + (distanceTop / 2 - distanceBottom / 2) + 'px ,0)';
        $target.css({
          transform: transformString,
          transition: 'none'
        });
        $title.css('opacity', 1);
        requestAnimationFrame(function () {
          $target.css('transition', '');
        });
      });
    }
  }, {
    key: "makeStampInGroupSquare",
    value: function makeStampInGroupSquare() {
      external_jQuery_default()('.stamp-newsletter-group').each(function (i, obj) {
        var $obj = external_jQuery_default()(obj);
        var $stampWidget = $obj.find('.widget_stamp').css('width', ''); // requestAnimationFrame( () => {

        $stampWidget.outerWidth($stampWidget.outerHeight()); // });
      });
    }
  }, {
    key: "profileWidget",
    value: function profileWidget() {
      var $widgets = external_jQuery_default()('.c-profile');
      $widgets.each(function (i, obj) {
        var $widget = external_jQuery_default()(obj);
        var widgetHeight = $widget.outerHeight();
        $widget.find('.c-profile__dropcap').css('fontSize', widgetHeight * 0.8);
      });
    }
  }, {
    key: "adjustLayout",
    value: function adjustLayout() {
      this.profileWidget();
      this.prepareFeatureHover();
      this.makeStampInGroupSquare();
    }
  }, {
    key: "addNavigationClasses",
    value: function addNavigationClasses() {
      var $pagination = external_jQuery_default()('ul.page-numbers');
      var $paginationItems = $pagination.find('li');
      $pagination.append('<div class="page-numbers__left"></div>');
      $pagination.append('<div class="page-numbers__middle"></div>');
      $pagination.append('<div class="page-numbers__right"></div>');
      $paginationItems.each(function (index, element) {
        var $element = external_jQuery_default()(element);

        if ($element.find('.prev').length) {
          $pagination.find('.page-numbers__left').append($element);
        }

        if ($element.find('.next').length) {
          $pagination.find('.page-numbers__right').append($element);
        }

        if (!$element.find('.next').length && !$element.find('.prev').length) {
          $pagination.find('.page-numbers__middle').append($element);
        }
      });
      $pagination.css('opacity', 1);
    }
  }, {
    key: "initStamp",
    value: function initStamp() {
      var $stamps = external_jQuery_default()('.c-stamp.c-stamp--auto');
      var circleType = null;
      $stamps.each(function (index, element) {
        var $element = external_jQuery_default()(element);
        var $text = $element.find('.c-stamp__text').first();
        circleType = new external_CircleType_default.a($text[0]);
        circleType.radius(89).dir(-1);

        if ($element.parent().hasClass('blob-container')) {
          $element.addClass('c-stamp--rotated');
        }

        setTimeout(function () {
          $element.css('opacity', 0.9);
        }, 200);
      });
    }
  }, {
    key: "clearAnnouncementCookie",
    value: function clearAnnouncementCookie() {
      external_Cookies_default.a.remove(ANNOUNCEMENT_COOKIE_NAME);
    }
  }, {
    key: "initAnnouncementBar",
    value: function initAnnouncementBar() {
      this.positionAnnouncementBar();
      this.$announcementBar.removeClass('c-announcement-bar--hidden');
      external_jQuery_default()('.js-announcement-bar__close').on('click', this.onAnnouncementClose.bind(this));
    }
  }, {
    key: "positionAnnouncementBar",
    value: function positionAnnouncementBar() {
      var isDisabled = external_Cookies_default.a.get('announcementClosed') === 'true';

      if (isDisabled) {
        return;
      }

      var adminBarHeight = external_jQuery_default()('#wpadminbar').outerHeight();
      var announcementBarHeight = this.$announcementBar.outerHeight();
      var headerHeight = this.$siteHeader.outerHeight();
      this.$siteHeader.css('top', announcementBarHeight + adminBarHeight);
      this.$toolbar.css('top', announcementBarHeight + adminBarHeight);
      this.$contentPaddingContainer.css('padding-top', headerHeight + announcementBarHeight);
      this.$announcementBar.css('top', adminBarHeight);
    }
  }, {
    key: "revertAnnouncementChanges",
    value: function revertAnnouncementChanges() {
      var headerHeight = this.$siteHeader.outerHeight();
      this.$siteHeader.css('top', '');
      this.$toolbar.css('top', '');
      this.$contentPaddingContainer.css('padding-top', headerHeight);
    }
  }, {
    key: "onAnnouncementClose",
    value: function onAnnouncementClose(event) {
      event.preventDefault();
      this.revertAnnouncementChanges();
      this.$announcementBar.addClass('c-announcement-bar--hidden');

      if (!this.isLoggedIn) {
        external_Cookies_default.a.set(ANNOUNCEMENT_COOKIE_NAME, 'true', {
          expires: 1
        });
      }
    }
  }]);

  return Vasco;
}(BaseTheme_BaseTheme);
// CONCATENATED MODULE: ./variations/vasco/ts/App.ts

new Vasco_Vasco();

/***/ })
/******/ ]);