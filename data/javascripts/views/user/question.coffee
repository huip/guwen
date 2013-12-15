define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  UserQuestionModel = require '../../models/user/question'
  class UserQuestionView extends Backbone.View
    initialize:()->
      that = @
      myquestionModel = new UserQuestionModel()
      myquestionModel.set
        uid: @id.uid
        page: @id.page
      myquestionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#userquestion_template').html(),data:data
      @.$el.html template
  module.exports = UserQuestionView    
