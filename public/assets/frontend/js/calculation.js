/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 2:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var APP_URL = 'http://localhost/srv/printing-amazone/public/';

/* harmony default export */ __webpack_exports__["a"] = (APP_URL);

/***/ }),

/***/ 29:
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

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(8);


/***/ }),

/***/ 8:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__snackbar_main__ = __webpack_require__(29);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__boot_js__ = __webpack_require__(2);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }





$(document).ready(function () {

	/** when page load complete then fetch prices asynchronously **/
	gatherInput();

	/** shows the custom input data enter boxes **/
	$("input[name='size']").change(function () {
		if ($(this).val() == 'custom') {
			$("div.custom-input").show();

			erasePriceOverview('all');
		} else {
			$("div.custom-input").hide();
			$("div.custom-input input:text").val('');
		}
	});

	$("input[name='qty']").change(function () {
		erasePriceOverview('qty');

		if ($(this).val() == 'custom') {
			$("div.custom-qty-input").show();
		} else {
			$("div.custom-qty-input").hide();
			$("div.custom-qty-input input:text").val('');
		}
	});
	/** shows the custom input data enter boxes **/

	/** fetch price upon user interaction **/

	$(".paperstock-opt").change(function () {
		gatherInput();
	});

	$(".size-opt").change(function () {
		gatherInput();
	});

	$("button.check-price").click(function () {
		//validate then check
		$("span#size-err").html('').hide();
		$("span#qty-err").html('').hide();

		gatherInput();
	});

	$("div.custom-input input:text").on('input', function () {
		$(this).css('border', '1px none');
		erasePriceOverview('all');
	});

	$("div.custom-qty-input input:text").on('input', function () {
		$(this).css('border', '1px none');
		erasePriceOverview('qty');
	});

	$("div.custom-input input:text").on('keydown', function (e) {
		if (e.keyCode == 13) {
			$("span#size-err").html('').hide();
			$("span#qty-err").html('').hide();
			gatherInput();
		}
	});
	$("div.custom-qty-input input:text").on('keydown', function (e) {
		if (e.keyCode == 13) {
			$("span#size-err").html('').hide();
			$("span#qty-err").html('').hide();
			gatherInput();
		}
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
	} else if (type == 'qty') {
		$("span#qty-price").html('');
	}
}

var calForm = function () {
	function calForm() {
		_classCallCheck(this, calForm);
	}

	_createClass(calForm, [{
		key: 'errorFor',
		value: function errorFor(field, msg) {
			var widthBox = $("input[name='size_w']");
			var heightBox = $("input[name='size_h']");
			var qtyBox = $("input[name='quantity']");

			if (field == 'h') {
				heightBox.focus();
				heightBox.css('border', '1px solid red');
				widthBox.css('border', '1px none');
				qtyBox.css('border', '1px none');

				erasePriceOverview('all');

				$("span#size-err").html(msg).show();
			} else if (field == 'w') {
				widthBox.focus();
				widthBox.css('border', '1px solid red');
				heightBox.css('border', '1px none');
				qtyBox.css('border', '1px none');

				erasePriceOverview('all');

				$("span#size-err").html(msg).show();
			} else {
				qtyBox.focus();
				qtyBox.css('border', '1px solid red');
				widthBox.css('border', '1px none');
				heightBox.css('border', '1px none');

				erasePriceOverview('all');

				$("span#qty-err").html(msg).show();
			}
		}
	}, {
		key: 'noError',
		value: function noError() {
			var widthBox = $("input[name='size_w']");
			var heightBox = $("input[name='size_h']");
			var qtyBox = $("input[name='quantity']");

			heightBox.css('border', '1px none');
			widthBox.css('border', '1px none');
			qtyBox.css('border', '1px none');
			$("span#size-err").html('').hide();
			$("span#qty-err").html('').hide();

			//removing the snackbar
			$("div.paper-snackbar").remove();
		}
	}]);

	return calForm;
}();

/** main price calculation ajax **/


function checkPrice(product, paperstock, size, quantityVal, customSize, customQty) {
	$("span[id^=priceof]").html('<i class="fa fa-spinner fa-pulse fa-lg text-success"></i>');
	$("span#qty-price").html('<i class="fa fa-spinner fa-pulse fa-lg text-success"></i>');

	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		url: __WEBPACK_IMPORTED_MODULE_1__boot_js__["a" /* default */] + "product/calculate-price",
		type: "POST",
		dataType: 'json',
		data: { product: product, paperstock: paperstock, customsize: customSize, size: size, qty: quantityVal, customqty: customQty },
		success: function success(result) {
			var calform = new calForm();

			if (result['error'] == 1) {

				if (result['for'] == 'h') {
					calform.errorFor('h', result['msg']);
				} else if (result['for'] == 'w') {
					calform.errorFor('w', result['msg']);
				} else {
					calform.errorFor('q', result['msg']);
				}
			} else {
				calform.noError();

				var count = 0;
				$("span[id^=priceof]").each(function () {
					$(this).html('$ ' + result['setOfPrices'][count]);
					count++;
				});

				if (result['quantityPrice'] != 0) {
					$("span#qty-price").html('$ ' + result['quantityPrice']);
				}
			}
		},
		error: function error(xhr, status, _error) {
			__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__snackbar_main__["a" /* default */])('Some server error occurred! please refresh and try again.', 'Dismiss');

			erasePriceOverview('all');
		}
	});

	$.ajax();
}

function gatherInput() {
	var product = $("input#prodName").val();
	var paperstock = $("input[name='paperstock']:checked").val();
	var size = $("input[name='size']:checked").val();
	var quantity = $("input[name='qty']:checked").val();
	var customSize = 0;
	var customQty = 0;
	if (size == 'custom' && quantity != 'custom') {
		var calform = new calForm();

		var widthBox = $("input[name='size_w']");
		var heightBox = $("input[name='size_h']");
		var width = $.trim(widthBox.val());
		var height = $.trim(heightBox.val());

		//validation
		if (isNaN(width) || width == "") {
			calform.errorFor('w', 'upss! invalid input');
		} else if (isNaN(height) || height == "") {
			calform.errorFor('h', 'upss! invalid input');
		} else {
			calform.noError();

			size = { "width": width, "height": height };
			customSize = 1;

			checkPrice(product, paperstock, size, 0, customSize, customQty);
		}
	} else if (quantity == 'custom' && size != 'custom') {
		var _calform = new calForm();

		var qtyBox = $("input[name='quantity']");
		var quantityVal = $.trim(qtyBox.val());

		//validation
		if (isNaN(quantityVal) || quantityVal == "") {
			_calform.errorFor('q', 'upss! invalid input');
		} else if (quantityVal.toString().indexOf('.') != -1) {
			_calform.errorFor('q', 'qty. should be integer');
		} else if (parseInt(quantityVal) / 10 % 1 !== 0) {
			_calform.errorFor('q', 'qty. must be multiple of 10');
		} else if (parseInt(quantityVal) > 50000) {
			_calform.errorFor('q', 'for quantity more than 50k please <a href="' + __WEBPACK_IMPORTED_MODULE_1__boot_js__["a" /* default */] + 'contact">contact us</a>');
		} else {
			_calform.noError();
			customQty = 1;

			checkPrice(product, paperstock, size, quantityVal, customSize, customQty);
		}
	} else if (quantity == 'custom' && size == 'custom') {
		var _calform2 = new calForm();

		var _widthBox = $("input[name='size_w']");
		var _heightBox = $("input[name='size_h']");
		var _qtyBox = $("input[name='quantity']");
		var _quantityVal = $.trim(_qtyBox.val());
		var _width = $.trim(_widthBox.val());
		var _height = $.trim(_heightBox.val());

		//validation
		if (isNaN(_width) || _width == "") {
			_calform2.errorFor('w', 'upss! invalid input');
		} else if (isNaN(_height) || _height == "") {
			_calform2.errorFor('h', 'upss! invalid input');
		} else if (isNaN(_quantityVal) || _quantityVal == "") {
			_calform2.errorFor('q', 'upss! invalid input');
		} else if (_quantityVal.toString().indexOf('.') != -1) {
			_calform2.errorFor('q', 'qty. should be integer');
		} else if (_quantityVal / 10 % 1 !== 0) {
			_calform2.errorFor('q', 'qty. must be multiple of 10');
		} else if (parseInt(_quantityVal) > 50000) {
			_calform2.errorFor('q', 'for quantity more than 50k please <a href="' + __WEBPACK_IMPORTED_MODULE_1__boot_js__["a" /* default */] + 'contact">contact us</a>');
		} else {
			_calform2.noError();

			size = { "width": _width, "height": _height };
			customSize = 1;
			customQty = 1;

			checkPrice(product, paperstock, size, _quantityVal, customSize, customQty);
		}
	} else {
		checkPrice(product, paperstock, size, 0, customSize, customQty);
	}
}

/***/ })

/******/ });