// Generated by CoffeeScript 1.6.3
var __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

define(function(require, exports, module) {
  var Backbone, QinfoModel, _ref;
  Backbone = require('backbone');
  QinfoModel = (function(_super) {
    __extends(QinfoModel, _super);

    function QinfoModel() {
      _ref = QinfoModel.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    QinfoModel.prototype.urlRoot = "index.php/api/qinfo/";

    return QinfoModel;

  })(Backbone.Model);
  return module.exports = QinfoModel;
});