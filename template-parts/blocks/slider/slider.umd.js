(function (factory) {
  typeof define === 'function' && define.amd ? define(factory) :
  factory();
})((function () { 'use strict';

  function _arrayLikeToArray(r, a) {
    (null == a || a > r.length) && (a = r.length);
    for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e];
    return n;
  }

  function _arrayWithoutHoles(r) {
    if (Array.isArray(r)) return _arrayLikeToArray(r);
  }

  function _iterableToArray(r) {
    if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r);
  }

  function _unsupportedIterableToArray(r, a) {
    if (r) {
      if ("string" == typeof r) return _arrayLikeToArray(r, a);
      var t = {}.toString.call(r).slice(8, -1);
      return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0;
    }
  }

  function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
  }

  function _toConsumableArray(r) {
    return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread();
  }

  /**
   * initializeBlock
   *
   * Adds custom JavaScript to the block HTML.
   *
   * @date    02/08/24
   * @since   1.0.0
   *
   * @param   object $block The block jQuery element.
   * @param   object attributes The block attributes (only available when editing).
   * @return  void
   */
  var initializeBlock = function initializeBlock(slider) {
    new Swiper(slider, {
      // Optional parameters
      spaceBetween: 10,
      loop: false,
      watchSlidesProgress: true,
      // If we need pagination
      pagination: {
        el: '.swiper-pagination'
      },
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      }
    });
  };

  // Initialize each block on page load (front end).
  document.addEventListener('DOMContentLoaded', function () {
    var swiper = document.querySelectorAll('.swiper');
    if (swiper) {
      _toConsumableArray(swiper).map(function (slider) {
        initializeBlock(slider);
      });
    }
  });

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    window.acf.addAction('render_block_preview/type=slider', function (block) {
      var _block = block[0];
      var swiper = _block.querySelector('.swiper');
      var parent = _block.parentNode.parentNode.parentNode;
      if (parent) {
        parent.addEventListener('click', function (event) {
          return _block.style.pointerEvents = 'auto';
        });
        parent.addEventListener('mouseleave', function (event) {
          return _block.style.pointerEvents = 'none';
        });
      }
      if (swiper) {
        initializeBlock(swiper);
      }
    });
  }

}));
//# sourceMappingURL=slider.umd.js.map
