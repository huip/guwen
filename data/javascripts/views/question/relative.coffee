define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  RelativeModel = require '../../models/question/relative'
  class RelativeView extends Backbone.View
    initialize:()->
      that = @
      relativeModel = new RelativeModel id:@id
      relativeModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#relative_template').html(),{data:data}
      @.$el.html template
  module.exports = RelativeView    
