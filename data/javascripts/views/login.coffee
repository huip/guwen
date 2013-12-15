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
      array = [
        $(e.currentTarget).val()
        $(e.currentTarget).val().length
        $('span[name=email_status]')
      ]
      msg = ''
      if array[1]==0
        msg = '请填写邮箱!'
        array[2].html msg
        email_flag = email_val_length>0
      else
        reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
        email_flag = reg.test(array[0])
        if email_flag
          msg = '填写正确!'
        else    
          msg = '填写有误!'
        array[2].html msg

    pwd_check:(e)->
      array = [
        $(e.currentTarget).val()
        $(e.currentTarget).val().length
        $('span[name=pwd_status]')
      ]
      pwd_flag = array[1]
      msg = ''
      if array[1]==0
        msg = '请填写密码!'
      else
        if array[1]>0 & array[1]<6
          pwd_flag = false
          msg = '密码太短了!'
        else
          msg = ''
      array[2].html msg
      pwd_flag

    login: -> 
      array = [
        $('input[name=email]').val()
        $('input[name=pwd]').val()
        $('span[name=email_status]')
        $('span[name=pwd_status]')
      ]
      msg = ''
      reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
      email_flag = reg.test(array[0])
      pwd_flag = array[1].length>5
      console.log pwd_flag
      if !email_flag
        msg = '邮箱填写有误!'
        array[2].html msg
      else if !pwd_flag
        msg = '密码填写有误!'
        array[3].html msg
      else
        $.ajax
          url: 'index.php/api/user/login'
          type: 'post'
          data:{email:array[0],password:array[1]}
          success:(data)->
            console.log data.error_code

  module.exports = LoginView












