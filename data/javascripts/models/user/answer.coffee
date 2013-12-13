define (require,exports,module)->
  Backbone = require 'backbone'
  _ = require 'underscore'
  class UserAnswerModel extends Backbone.Model
    urlRoot:"index.php/api/user/answer"
    url:()->
      baseUrl = _.result @,'urlRoot'
      baseUrl if @isNew()
      baseUrl+
      "/id/"+encodeURIComponent( @.get("uid")  )+
      "/page/"+encodeURIComponent(@.get("page"))
  module.exports = UserAnswerModel
