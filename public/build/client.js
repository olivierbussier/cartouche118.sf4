(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["client"],{

/***/ "./assets/css/client.scss":
/*!********************************!*\
  !*** ./assets/css/client.scss ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/client.js":
/*!*****************************!*\
  !*** ./assets/js/client.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {/*
 * Fichier de dépendances Javascript et CSS utilisé par webpack encore
 * Ce fichier contient l'ensemble des dépendances nécessaires au chargement de toutes les pages
 * (inclus dans base.html.twig)
 */
// Fichiers CSS
__webpack_require__(/*! ../css/client.scss */ "./assets/css/client.scss"); //require('./clientAdr')
//require('./clientTel')

/**
 * Ajout d'une adresse vide en mode édition
 * @param id
 */


function cAdd(id) {
  var url = $(id).data('url');
  var client = $(id).data('clientId');
  var rec = $(id).data('receiver');
  $.ajax(url + '/' + client).done(function (data) {
    $(rec).html(data);
  });
}

window.cAdd = cAdd;
/**
 * Edition d'une adresse existante
 * @param id
 */

function cEdit(id) {
  var url = $(id).data('url');
  var rec = $(id).data('receiver');
  $.ajax(url).done(function (data) {
    $(rec).html(data);
  });
}

window.cEdit = cEdit;
/**
 * Aborter une édition d'adresse en cours
 * @param id
 */

function cCancel(id) {
  var url = $(id).data('url');
  var rec = $(id).data('receiver');
  $.ajax(url).done(function (data) {
    $(rec).html(data);
  });
}

window.cCancel = cCancel;
/**
 * Sauver une adresse en cours d'édition
 * @param id
 */

function cSave(id) {
  var adrId = $(id).data('id');
  var form = $(id).data('form');
  var url = $(id).data('url');
  var rec = $(id).data('receiver');

  if (adrId !== 0) {
    url = url + "/" + adrId;
  }

  var fields = $(form).serializeArray();
  $.ajax({
    method: 'POST',
    data: {
      fields: fields
    },
    url: url
  }).done(function (data) {
    $(rec).html(data);
  });
}

window.cSave = cSave;
/**
 * Suppression d'une adresse dans la base
 * @param id
 */

function cDel(id) {
  var url = $(id).data('url');
  var rec = $(id).data('receiver');

  if (id !== 0) {
    if (window.confirm('Êtes-vous sûr ?')) {
      $.ajax(url).done(function (data) {
        $(rec).html(data);
      });
    }
  }
}

window.cDel = cDel;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

},[["./assets/js/client.js","runtime","vendors~app~client"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2NsaWVudC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jbGllbnQuanMiXSwibmFtZXMiOlsicmVxdWlyZSIsImNBZGQiLCJpZCIsInVybCIsIiQiLCJkYXRhIiwiY2xpZW50IiwicmVjIiwiYWpheCIsImRvbmUiLCJodG1sIiwid2luZG93IiwiY0VkaXQiLCJjQ2FuY2VsIiwiY1NhdmUiLCJhZHJJZCIsImZvcm0iLCJmaWVsZHMiLCJzZXJpYWxpemVBcnJheSIsIm1ldGhvZCIsImNEZWwiLCJjb25maXJtIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7QUFBQSx1Qzs7Ozs7Ozs7Ozs7QUNBQTs7Ozs7QUFNQTtBQUVBQSxtQkFBTyxDQUFDLG9EQUFELENBQVAsQyxDQUVBO0FBQ0E7O0FBRUE7Ozs7OztBQUlBLFNBQVNDLElBQVQsQ0FBY0MsRUFBZCxFQUNBO0FBQ0ksTUFBSUMsR0FBRyxHQUFHQyxDQUFDLENBQUNGLEVBQUQsQ0FBRCxDQUFNRyxJQUFOLENBQVcsS0FBWCxDQUFWO0FBQ0EsTUFBSUMsTUFBTSxHQUFHRixDQUFDLENBQUNGLEVBQUQsQ0FBRCxDQUFNRyxJQUFOLENBQVcsVUFBWCxDQUFiO0FBQ0EsTUFBSUUsR0FBRyxHQUFJSCxDQUFDLENBQUNGLEVBQUQsQ0FBRCxDQUFNRyxJQUFOLENBQVcsVUFBWCxDQUFYO0FBQ0FELEdBQUMsQ0FBQ0ksSUFBRixDQUFPTCxHQUFHLEdBQUMsR0FBSixHQUFRRyxNQUFmLEVBQXVCRyxJQUF2QixDQUE0QixVQUFVSixJQUFWLEVBQWdCO0FBQ3hDRCxLQUFDLENBQUNHLEdBQUQsQ0FBRCxDQUFPRyxJQUFQLENBQVlMLElBQVo7QUFDSCxHQUZEO0FBR0g7O0FBQUNNLE1BQU0sQ0FBQ1YsSUFBUCxHQUFjQSxJQUFkO0FBRUY7Ozs7O0FBSUEsU0FBU1csS0FBVCxDQUFlVixFQUFmLEVBQ0E7QUFDSSxNQUFJQyxHQUFHLEdBQUdDLENBQUMsQ0FBQ0YsRUFBRCxDQUFE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Ly8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIiwiLypcbiAqIEZpY2hpZXIgZGUgZMOpcGVuZGFuY2VzIEphdmFzY3JpcHQgZXQgQ1NTIHV0aWxpc8OpIHBhciB3ZWJwYWNrIGVuY29yZVxuICogQ2UgZmljaGllciBjb250aWVudCBsJ2Vuc2VtYmxlIGRlcyBkw6lwZW5kYW5jZXMgbsOpY2Vzc2FpcmVzIGF1IGNoYXJnZW1lbnQgZGUgdG91dGVzIGxlcyBwYWdlc1xuICogKGluY2x1cyBkYW5zIGJhc2UuaHRtbC50d2lnKVxuICovXG5cbi8vIEZpY2hpZXJzIENTU1xuXG5yZXF1aXJlKCcuLi9jc3MvY2xpZW50LnNjc3MnKTtcblxuLy9yZXF1aXJlKCcuL2NsaWVudEFkcicpXG4vL3JlcXVpcmUoJy4vY2xpZW50VGVsJylcblxuLyoqXG4gKiBBam91dCBkJ3VuZSBhZHJlc3NlIHZpZGUgZW4gbW9kZSDDqWRpdGlvblxuICogQHBhcmFtIGlkXG4gKi9cbmZ1bmN0aW9uIGNBZGQoaWQpXG57XG4gICAgdmFyIHVybCA9ICQoaWQpLmRhdGEoJ3VybCcpO1xuICAgIHZhciBjbGllbnQgPSAkKGlkKS5kYXRhKCdjbGllbnRJZCcpO1xuICAgIHZhciByZWMgID0gJChpZCkuZGF0YSgncmVjZWl2ZXInKTtcbiAgICAkLmFqYXgodXJsKycvJytjbGllbnQpLmRvbmUoZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgJChyZWMpLmh0bWwoZGF0YSk7XG4gICAgfSlcbn0gd2luZG93LmNBZGQgPSBjQWRkO1xuXG4vKipcbiAqIEVkaXRpb24gZCd1bmUgYWRyZXNzZSBleGlzdGFudGVcbiAqIEBwYXJhbSBpZFxuICovXG5mdW5jdGlvbiBjRWRpdChpZClcbntcbiAgICB2YXIgdXJsID0gJChpZCkuZGF0YSgndXJsJyk7XG4gICAgdmFyIHJlYyAgPSAkKGlkKS5kYXRhKCdyZWNlaXZlcicpO1xuICAgICQuYWpheCh1cmwpLmRvbmUoZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgJChyZWMpLmh0bWwoZGF0YSk7XG4gICAgfSlcbn0gd2luZG93LmNFZGl0ID0gY0VkaXQ7XG5cbi8qKlxuICogQWJvcnRlciB1bmUgw6lkaXRpb24gZCdhZHJlc3NlIGVuIGNvdXJzXG4gKiBAcGFyYW0gaWRcbiAqL1xuZnVuY3Rpb24gY0NhbmNlbChpZClcbntcbiAgICB2YXIgdXJsID0gJChpZCkuZGF0YSgndXJsJyk7XG4gICAgdmFyIHJlYyAgPSAkKGlkKS5kYXRhKCdyZWNlaXZlcicpO1xuICAgICQuYWpheCh1cmwpLmRvbmUoZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgJChyZWMpLmh0bWwoZGF0YSk7XG4gICAgfSlcblxufSB3aW5kb3cuY0NhbmNlbCA9IGNDYW5jZWw7XG5cbi8qKlxuICogU2F1dmVyIHVuZSBhZHJlc3NlIGVuIGNvdXJzIGQnw6lkaXRpb25cbiAqIEBwYXJhbSBpZFxuICovXG5mdW5jdGlvbiBjU2F2ZShpZClcbntcbiAgICB2YXIgYWRySWQgPSAkKGlkKS5kYXRhKCdpZCcpO1xuICAgIHZhciBmb3JtICA9ICQoaWQpLmRhdGEoJ2Zvcm0nKTtcbiAgICB2YXIgdXJsID0gJChpZCkuZGF0YSgndXJsJyk7XG4gICAgdmFyIHJlYyA9ICQoaWQpLmRhdGEoJ3JlY2VpdmVyJyk7XG4gICAgaWYgKGFkcklkICE9PSAwKSB7XG4gICAgICAgIHVybCA9IHVybCArIFwiL1wiICsgYWRySWQ7XG4gICAgfVxuICAgIHZhciBmaWVsZHMgPSAkKGZvcm0pLnNlcmlhbGl6ZUFycmF5KCk7XG4gICAgJC5hamF4KHtcbiAgICAgICAgbWV0aG9kOiAnUE9TVCcsXG4gICAgICAgIGRhdGE6IHtmaWVsZHM6IGZpZWxkcyB9LFxuICAgICAgICB1cmw6IHVybFxuICAgIH0pLmRvbmUoZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgJChyZWMpLmh0bWwoZGF0YSlcbiAgICB9KVxufSB3aW5kb3cuY1NhdmUgPSBjU2F2ZTtcblxuLyoqXG4gKiBTdXBwcmVzc2lvbiBkJ3VuZSBhZHJlc3NlIGRhbnMgbGEgYmFzZVxuICogQHBhcmFtIGlkXG4gKi9cbmZ1bmN0aW9uIGNEZWwoaWQpXG57XG4gICAgdmFyIHVybCA9ICQoaWQpLmRhdGEoJ3VybCcpO1xuICAgIHZhciByZWMgID0gJChpZCkuZGF0YSgncmVjZWl2ZXInKTtcbiAgICBpZiAoaWQgIT09IDApIHtcbiAgICAgICAgaWYgKHdpbmRvdy5jb25maXJtKCfDinRlcy12b3VzIHPDu3IgPycpKSB7XG4gICAgICAgICAgICAkLmFqYXgodXJsKS5kb25lKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgJChyZWMpLmh0bWwoZGF0YSlcbiAgICAgICAgICAgIH0pXG4gICAgICAgIH1cbiAgICB9XG59IHdpbmRvdy5jRGVsID0gY0RlbDtcblxuIl0sInNvdXJjZVJvb3QiOiIifQ==