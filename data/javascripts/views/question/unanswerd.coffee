define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  UnAnswerdModel = require '../../models/question/unanswerd'
  class UnAnswerdView extends Backbone.View
    initialize:()->
      that = @
      questionModel = new UnAnswerdModel id:@id
      questionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#unanswerd_template').html(),{data:data}
      @.$el.html template
  module.exports = UnAnswerdView
