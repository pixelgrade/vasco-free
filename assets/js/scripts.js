/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		1: 0,
/******/ 		2: 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
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
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push([6,0]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
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
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);

// EXTERNAL MODULE: external "Masonry"
var external_Masonry_ = __webpack_require__(2);

// EXTERNAL MODULE: external "jQuery"
var external_jQuery_ = __webpack_require__(0);
var external_jQuery_default = /*#__PURE__*/__webpack_require__.n(external_jQuery_);

// EXTERNAL MODULE: ./node_modules/circletype/dist/circletype.min.js
var circletype_min = __webpack_require__(4);
var circletype_min_default = /*#__PURE__*/__webpack_require__.n(circletype_min);

// EXTERNAL MODULE: ./node_modules/js-cookie/src/js.cookie.js
var js_cookie = __webpack_require__(3);
var js_cookie_default = /*#__PURE__*/__webpack_require__.n(js_cookie);

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
// EXTERNAL MODULE: ./node_modules/rx-dom/index.js
var rx_dom = __webpack_require__(1);

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
      return rx_dom["DOM"].fromEvent(this.getWindowEl(), 'load');
    }
  }, {
    key: "onResize",
    value: function onResize() {
      return rx_dom["DOM"].resize(this.getWindowEl());
    }
  }, {
    key: "onScroll",
    value: function onScroll() {
      return rx_dom["DOM"].scroll(this.getWindowEl());
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
      return rx_dom["Observable"].create(function (observer) {
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
      return rx_dom["Observable"].create(function (observer) {
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
      return rx_dom["DOM"].ready();
    }
  }]);

  return GlobalService;
}();
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
      global_service_GlobalService.onReady().take(1).subscribe(this.onReadyAction.bind(this));
      window_service_WindowService.onLoad().take(1).subscribe(this.onLoadAction.bind(this));
      window_service_WindowService.onResize().debounce(500).subscribe(this.onResizeAction.bind(this));
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
      this.keyupSub = rx_dom["DOM"].keyup(document.querySelector('body'));
    }
  }, {
    key: "createKeyupSubscription",
    value: function createKeyupSubscription() {
      var _this2 = this;

      this.keyupSubscriptionActive = true;
      this.keyupSub.takeWhile(function () {
        return _this2.keyupSubscriptionActive;
      }).subscribe(this.closeOnEsc.bind(this));
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
      window_service_WindowService.onResize().takeWhile(function () {
        return _this2.subscriptionActive;
      }).subscribe(function () {
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

    window_service_WindowService.onResize().debounce(300).takeWhile(function () {
      return _this.subscriptionActive;
    }).subscribe(function () {
      _this.layout();
    });
    global_service_GlobalService.onCustomizerRender().debounce(300).takeWhile(function () {
      return _this.subscriptionActive;
    }).subscribe(function () {
      _this.layout();
    });
    global_service_GlobalService.onCustomizerChange().debounce(300).takeWhile(function () {
      return _this.subscriptionActive;
    }).subscribe(function () {
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
// EXTERNAL MODULE: ./node_modules/animejs/lib/anime.es.js
var anime_es = __webpack_require__(5);

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
      anime_es({
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
    }, 50);

    _this.handleContent();

    _this.groupWidgets();

    _this.generateBlobs();

    global_service_GlobalService.onCustomizerRender().debounce(300).takeWhile(function () {
      return _this.subscriptionActive;
    }).subscribe(function () {
      _this.groupWidgets();

      _this.prepareFeatureHover();

      _this.initStamp();
    });
    global_service_GlobalService.onCustomizerChange().debounce(300).takeWhile(function () {
      return _this.subscriptionActive;
    }).subscribe(function () {
      _this.prepareFeatureHover();

      _this.initStamp();
    });
    global_service_GlobalService.onCustomizerChange().debounce(300).takeWhile(function () {
      return _this.subscriptionActive;
    }).subscribe(function () {
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
        this.revertAnnouncementChanges();
        this.initAnnouncementBar();
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
        circleType = new circletype_min_default.a($text[0]);
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
      js_cookie_default.a.remove(ANNOUNCEMENT_COOKIE_NAME);
    }
  }, {
    key: "initAnnouncementBar",
    value: function initAnnouncementBar() {
      var isDisabled = js_cookie_default.a.get('announcementClosed') === 'true';

      if (isDisabled) {
        return;
      }

      var adminBarHeight = external_jQuery_default()('#wpadminbar').outerHeight();
      var announcementBarHeight = this.$announcementBar.outerHeight();
      var headerHeight = this.$siteHeader.outerHeight();
      this.modifyCss(this.$siteHeader, 'top', announcementBarHeight, '+=');
      this.modifyCss(this.$toolbar, 'padding-top', announcementBarHeight, '+=');
      this.$contentPaddingContainer.css('padding-top', headerHeight + announcementBarHeight);
      this.modifyCss(this.$announcementBar, 'top', adminBarHeight, '+=');
      this.$announcementBar.removeClass('c-announcement-bar--hidden');
      external_jQuery_default()('.js-announcement-bar__close').on('click', this.onAnnouncementClose.bind(this));
    }
  }, {
    key: "modifyCss",
    value: function modifyCss($element, property, value, sign) {
      var unit = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 'px';
      $element.css(property, "".concat(sign).concat(value).concat(unit));
    }
  }, {
    key: "revertAnnouncementChanges",
    value: function revertAnnouncementChanges() {
      var animated = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var headerHeight = this.$siteHeader.outerHeight();

      if (animated) {
        this.$announcementBar.addClass('animated');
        this.$siteHeader.addClass('animated');
        this.$toolbar.addClass('animated');
        this.$contentPaddingContainer.addClass('animated');
      }

      this.$announcementBar.addClass('c-announcement-bar--hidden');
      this.$siteHeader.css('top', '');
      this.$toolbar.css('padding-top', '');
      this.$contentPaddingContainer.css('padding-top', headerHeight);
      this.$announcementBar.css('top', '');
    }
  }, {
    key: "onAnnouncementClose",
    value: function onAnnouncementClose(event) {
      event.preventDefault();
      this.revertAnnouncementChanges(true);

      if (!this.isLoggedIn) {
        js_cookie_default.a.set(ANNOUNCEMENT_COOKIE_NAME, 'true', {
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