define (require,exports,module)->
  Backbone = require 'backbone'
  _ = require 'underscore'
  class MyQuestionModel extends Backbone.Model
    urlRoot:"index.php/api/myquestion/"
    url:()->
      baseUrl = _.result @,'urlRoot'
      baseUrl if @isNew()
      baseUrl+
      "/"+encodeURIComponent( @.get("uid")  )+
      "/"+encodeURIComponent(@.get("page"))
  module.exports = MyQuestionModel
