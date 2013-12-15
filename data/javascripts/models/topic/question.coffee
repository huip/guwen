define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  class TopicQuestionModel extends Backbone.Model
    urlRoot:"index.php/api/topic/question"
    url:()->
      baseUrl = _.result @,'urlRoot'
      baseUrl if @isNew()
      baseUrl+
      "/id/"+encodeURIComponent( @.get("uid")  )+
      "/page/"+encodeURIComponent(@.get("page"))

  module.exports = TopicQuestionModel
