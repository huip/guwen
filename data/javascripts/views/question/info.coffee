define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  QinfoModel = require '../../models/question/info'
  class QinfoView extends Backbone.View
    initialize:()->
      that = @
      qinfoModel = new QinfoModel id:@id
      qinfoModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#qinfo_template').html(),{data:data}
      @.$el.html template
  module.exports = QinfoView    
