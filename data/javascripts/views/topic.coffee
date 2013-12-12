define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  TopicModel = require '../models/topic'
  class TopicView extends Backbone.View
    initialize: ->
      that = @
      topicModel = new TopicModel id:@id
      topicModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      console.log data
      template = _.template $('#topic_template').html(),data:data
      @.$el.html template
  module.exports = TopicView
