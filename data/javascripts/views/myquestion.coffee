define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  MyQuestionModel = require '../models/myquestion'
  class MyQuestionView extends Backbone.View
    initialize:()->
      that = @
      myquestionModel = new MyQuestionModel id:@id
      myquestionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#myquestion_template').html(),{data:data}
      @.$el.html template
  module.exports = MyQuestionView    