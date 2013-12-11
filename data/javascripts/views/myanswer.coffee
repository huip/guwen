define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  MyAnswerModel = require '../models/myanswer'
  class MyAnswerView extends Backbone.View
    initialize:()->
      that = @
      myquestionModel = new MyAnswerModel()
      myquestionModel.set
        uid: @id.uid
        page: @id.page
      myquestionModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#myanswer_template').html(),data:data
      @.$el.html template
  module.exports = MyAnswerView   
