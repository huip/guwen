// Generated by CoffeeScript 1.6.3
var __hasProp = {}.hasOwnProperty,
  __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

define(function(require, exports, module) {
  var $, Backbone, RelativeModel, RelativeView, _, _ref;
  $ = require('$');
  Backbone = require('backbone');
  _ = require('underscore');
  RelativeModel = require('../models/relative');
  RelativeView = (function(_super) {
    __extends(RelativeView, _super);

    function RelativeView() {
      _ref = RelativeView.__super__.constructor.apply(this, arguments);
      return _ref;
    }

    RelativeView.prototype.initialize = function() {
      var relativeModel, that;
      that = this;
      relativeModel = new RelativeModel({
        id: this.id
      });
      return relativeModel.fetch({
        success: function(data) {
          return that.render(data.toJSON());
        }
      });
    };

    RelativeView.prototype.render = function(data) {
      var template;
      template = _.template($('#relative_template').html(), {
        data: data
      });
      return this.$el.html(template);
    };

    return RelativeView;

  })(Backbone.View);
  return module.exports = RelativeView;
});