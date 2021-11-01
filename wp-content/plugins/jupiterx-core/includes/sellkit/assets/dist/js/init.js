(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

(function ($) {
  var SellkitFrontend = function SellkitFrontend() {
    var widgets = {
      'sellkit-product-images.default': require('./product-images')["default"]
    };

    function elementorInit() {
      for (var widget in widgets) {
        elementorFrontend.hooks.addAction("frontend/element_ready/".concat(widget), widgets[widget]);
      }
    }

    this.init = function () {
      $(window).on('elementor/frontend/init', elementorInit);
    };

    this.init();
  };

  window.sellkitFrontend = new SellkitFrontend();
})(jQuery);

},{"./product-images":2}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;
var $ = jQuery;
var ProductImages = elementorModules.frontend.handlers.Base.extend({
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    if (document.body.classList.contains('elementor-editor-active')) {
      this.$element.find('.woocommerce-product-gallery').wc_product_gallery();
    }

    var self = this;

    if (typeof window.elementor === 'undefined') {
      return;
    }

    window.elementor.channels.editor.on('change', function (controlView) {
      self.onElementChange(controlView.model.get('name'), controlView);
    });
    this.handleThumbnailBorderRadius(this.getElementSettings('thumbnail_border_radius'));
  },
  onElementChange: function onElementChange(propertyName, controlView) {
    if ('thumbnail_border_radius' === propertyName) {
      var borderRadius = controlView.container.settings.get('thumbnail_border_radius');
      this.handleThumbnailBorderRadius(borderRadius);
    }
  },
  handleThumbnailBorderRadius: function handleThumbnailBorderRadius(borderRadius) {
    var unit = borderRadius.unit;
    this.$element.find('.flex-control-nav li').css({
      'border-radius': borderRadius.top + unit + ' ' + borderRadius.right + unit + ' ' + borderRadius.bottom + unit + ' ' + borderRadius.left + unit
    });
  },
  bindEvents: function bindEvents() {
    this.$element.find('.woocommerce-product-gallery__image a').on('click', function (e) {
      e.stopImmediatePropagation();
      e.preventDefault();
    });
  }
});

function _default($scope) {
  new ProductImages({
    $element: $scope
  });
}

},{}]},{},[1]);
