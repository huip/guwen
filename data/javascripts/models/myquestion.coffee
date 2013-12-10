define (require,exports,module)->
  Backbone = require 'backbone'
  class MyQuestionModel extends Backbone.Model
    urlRoot:"index.php/api/myquestion/"
  module.exports = MyQuestionModel
