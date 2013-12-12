define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  QuestionModel = require '../../models/question/list'
  class QuestionView extends Backbone.View
    initialize:()->
      that = @
      questionModel = new QuestionModel id:@id
      questionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#question_template').html(),{data:data}
      @.$el.html template
  
  module.exports = QuestionView
