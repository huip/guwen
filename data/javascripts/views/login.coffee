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

    email_check:(e)->
      email_val = $(e.currentTarget).val()
      email_val_length = email_val.length
      if email_val_length==0
        $('span[name=email_status]').html("请填写邮箱!")
        email_flag = email_val_length>0
        console.log "请填写邮箱!"
      else
        email_status = $('span[name=email_status]')
        reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
        email_flag = reg.test(email_val)
        msg = ''
        if email_flag
          msg = '填写正确!'
        else    
          msg = '填写有误!'
        $('span[name=email_status]').html msg
        console.log email_flag

    pwd_check:(e)->
      pwd_val = $(e.currentTarget).val()
      pwd_val_length = pwd_val.length
      pwd_flag = pwd_val_length>5
      if pwd_val_length==0
        $('span[name=pwd_status]').html("请填写密码!")
        console.log "请填写密码"
      else
        pwd_status = $('span[name=pwd_status]')
        if pwd_val_length>0&pwd_val_length<6
          pwd_flag = false
          pwd_status.html("密码太短了!")
        else
          pwd_status.html('')
        console.log pwd_val_length    
      console.log $(e.currentTarget).val()
      pwd_flag

    login: -> 
      email_val = $('input[name=email]').val()
      pwd_val = $('input[name=pwd]').val()
      reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
      email_flag = reg.test(email_val)
      pwd_flag = pwd_val.length>5
      console.log pwd_flag
      if !email_flag
        $('span[name=email_status]').html("邮箱填写有误!")
      else if !pwd_flag
        $('span[name=pwd_status]').html("密码填写有误!")
      else
        $.ajax
          url: 'index.php/api/user/login'
          type: 'post'
          data:{email:email_val,password:pwd_val}
          success:(data)->
            console.log data

  module.exports = LoginView












