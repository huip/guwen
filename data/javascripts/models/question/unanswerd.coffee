define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  class UnAnswerdModel extends Backbone.Model
    urlRoot:"index.php/api/question/unanswerd/page"
  module.exports = UnAnswerdModel
