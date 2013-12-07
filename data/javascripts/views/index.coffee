define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  IndexModel = require '../models/index'
  class IndexView extends Backbone.View
    initialize: ->
      that = @
      indexModel = new IndexModel()
      indexModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#widgets_template').html(),{data:data}
      @.$el.html template
  module.exports = IndexView
