define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  class QuestionModel extends Backbone.Model
    urlRoot:"index.php/api/question/list/page"
  module.exports = QuestionModel
