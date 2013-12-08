define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  UserInfoModel = require '../models/uinfo'
  class UserInfoView extends Backbone.View
    initialize:()->
      that = @
      qinfoModel = new UserInfoModel id:@id
      qinfoModel.fetch
        success: (data)->
          that.render data.toJSON()
    render: (data)->
      template = _.template $('#uinfo_template').html(),{data:data}
      @.$el.html template
  module.exports = UserInfoView    
