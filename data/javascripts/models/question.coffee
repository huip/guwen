define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  class QuestionModel extends Backbone.Model
    urlRoot:"index.php/api/question/"
  module.exports = QuestionModel
