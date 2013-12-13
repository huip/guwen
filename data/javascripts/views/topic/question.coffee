define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  TopicQuestionModel = require '../../models/topic/question'
  class TopicQuestionView extends Backbone.View
    initialize:()->
      that = @
      topicQuestionModel = new TopicQuestionModel()
      topicQuestionModel.set
        uid: @id.uid
        page: @id.page
      topicQuestionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#topicquestion_template').html(),data:data
      @.$el.html template
  module.exports = TopicQuestionView    
