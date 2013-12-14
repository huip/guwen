define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  class LoginView extends Backbone.View
    initialize: ->
      that = @
      @render()
    render: ->
      template = _.template $('#login_template').html(),{}
      @.$el.html template

    events:
      'click .login-btn' : 'login'
      'keyup input[name=email]' : 'email_check'
      'keyup input[name=pwd]' : 'pwd_check'

    login: -> 
      console.log "The login button is working!!!"

    email_check:(e)->
      email_val = $(e.currentTarget).val()
      email_val_length = email_val.length
      if email_val_length==0
        $('span[name=email_status]').html("请填写邮箱!")
        console.log "请填写邮箱!"
      else
        email_status = $('span[name=email_status]')
        reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
        email_flag = reg.test(email_val)
        if email_flag
          email_status.html('填写正确!')
        else    
          email_status.html('填写有误!')

    pwd_check:(e)->
      pwd_val = $(e.currentTarget).val()
      pwd_val_length = pwd_val.length
      if pwd_val_length==0
        $('span[name=pwd_status]').html("请填写密码!")
        console.log "请填写密码"
      else
        pwd_status = $('span[name=pwd_status]')
        if pwd_val_length>0&pwd_val_length<6
          pwd_status.html("密码太短了!")
        else
          pwd_status.html('')
        console.log pwd_val_length    

      console.log $(e.currentTarget).val()
  module.exports = LoginView
