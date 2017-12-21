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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 123);
/******/ })
/************************************************************************/
/******/ ({

/***/ 123:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(124);


/***/ }),

/***/ 124:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__snackbar_main__ = __webpack_require__(45);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__boot_js__ = __webpack_require__(9);




$(document).ready(function () {

  /** when page load complete then fetch prices asynchronously **/
  gatherInput();

  /** fetch price upon user interaction **/

  $("select[name='type']").change(function () {
    gatherInput();
  });
});

function erasePriceOverview() {
  var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'all';

  if (type == 'all') {
    $("span[id^=priceof]").each(function () {
      $(this).html('$ __');
    });
    $("span#qty-price").html('');
  } else if (type == 'size') {
    $("span[id^=priceof]").each(function () {
      $(this).html('$ __');
    });
  }
}

/** main price calculation ajax **/
function checkPrice(product, type) {
  $("span[id^=priceof]").html('<i class="fa fa-cog fa-spin fa-lg text-success"></i>');

  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url: __WEBPACK_IMPORTED_MODULE_1__boot_js__["a" /* default */] + "product/calculate-name-photo-price",
    type: "POST",
    dataType: 'json',
    data: { product: product, type: type },
    success: function success(result) {

      if (result['error'] == 1) {
        Object(__WEBPACK_IMPORTED_MODULE_0__snackbar_main__["a" /* default */])('Some server error occurred! please refresh and try again.', 'Dismiss');
      } else {

        var count = 0;
        $("span[id^=priceof]").each(function () {
          $(this).html('$ ' + result['setOfPrices'][count]);
          count++;
        });
      }
    },
    error: function error(xhr, status, _error) {
      Object(__WEBPACK_IMPORTED_MODULE_0__snackbar_main__["a" /* default */])('Some server error occurred! please refresh and try again.', 'Dismiss');

      erasePriceOverview('all');
    }
  });

  $.ajax();
}

function gatherInput() {
  var product = $("input#prodName").val();
  var type = $("select[name='type']").val();

  checkPrice(product, type);
}

/***/ }),

/***/ 45:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (immutable) */ __webpack_exports__["a"] = createSnackbar;
function createSnackbar(message, actionText, action) {
  // Any snackbar that is already shown
  var previous = null;

  if (previous) {
    previous.dismiss();
  }
  var snackbar = document.createElement('div');
  snackbar.className = 'paper-snackbar';
  snackbar.dismiss = function () {
    this.style.opacity = 0;
  };
  var text = document.createTextNode(message);
  snackbar.appendChild(text);
  if (actionText) {
    if (!action) {
      action = snackbar.dismiss.bind(snackbar);
    }
    var actionButton = document.createElement('button');
    actionButton.className = 'action';
    actionButton.innerHTML = actionText;
    actionButton.addEventListener('click', action);
    snackbar.appendChild(actionButton);
  }
  setTimeout(function () {
    if (previous === this) {
      previous.dismiss();
    }
  }.bind(snackbar), 5000);

  snackbar.addEventListener('transitionend', function (event, elapsed) {
    if (event.propertyName === 'opacity' && this.style.opacity == 0) {
      this.parentElement.removeChild(this);
      if (previous === this) {
        previous = null;
      }
    }
  }.bind(snackbar));

  previous = snackbar;
  document.body.appendChild(snackbar);
  // In order for the animations to trigger, I have to force the original style to be computed, and then change it.
  getComputedStyle(snackbar).bottom;
  snackbar.style.bottom = '0px';
  snackbar.style.opacity = 1;
}

/***/ }),

/***/ 9:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var APP_URL = 'http://printingamazon.site/';

/* harmony default export */ __webpack_exports__["a"] = (APP_URL);

/***/ })

/******/ });