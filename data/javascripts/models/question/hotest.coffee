define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  class HotestModel extends Backbone.Model
    urlRoot:"index.php/api/question/hotest/page"
  module.exports = HotestModel
