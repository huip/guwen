define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  UserAnswerModel = require '../../models/user/answer'
  class UserAnswerView extends Backbone.View
    initialize:()->
      that = @
      userAnswerModel = new UserAnswerModel()
      userAnswerModel.set
        uid: @id.uid
        page: @id.page
      userAnswerModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#useranswer_template').html(),data:data
      @.$el.html template
  module.exports = UserAnswerView   
