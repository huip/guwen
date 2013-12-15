define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  UnAnswerdModel = require '../../models/question/hostest'
  class HotestView extends Backbone.View
    initialize:()->
      that = @
      questionModel = new HotestModel id:@id
      questionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#hotest_template').html(),{data:data}
      @.$el.html template
  module.exports = HotestView
