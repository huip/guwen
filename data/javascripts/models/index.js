// Generated by CoffeeScript 1.6.3
var __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

define(function(require, exports, module) {
  var $, Backbone, IndexModel, _, _ref;
  $ = require('$');
  Backbone = require('backbone');
  _ = require("underscore");
  IndexModel = (function(_super) {
    __extends(IndexModel, _super);

    function IndexModel() {
      _ref = IndexModel.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    IndexModel.prototype.initialize = function() {};

    IndexModel.prototype.urlRoot = "index.php/api/widgets";

    return IndexModel;

  })(Backbone.Model);
  return module.exports = IndexModel;
});
