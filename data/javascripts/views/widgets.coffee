define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  WidgetsModel = require '../models/widgets'
  class WidgetsView extends Backbone.View
    initialize: ->
      that = @
      indexModel = new WidgetsModel()
      indexModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#widgets_template').html(),{data:data}
      @.$el.html template
  module.exports = WidgetsView
