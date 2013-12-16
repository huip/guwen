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
      $email_statu = $ 'span[name=email_status]'
      msg = ''
      if $(e.currentTarget).val() is 0
        msg = '请填写邮箱!'
        $email_statu.html msg
        email_flag = email_val_length > 0
      else
        reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
        if reg.test $(e.currentTarget).val()
          msg = '填写正确!'
        else    
          msg = '填写有误!'
        $email_statu.html msg
    pwd_check:(e)->
      $pwd =  $ e.currentTarget
      $pwd_status = $ 'span[name=pwd_status]'
      pwd_flag = true
      msg = ''
      if $pwd.val() is 0
        msg = '请填写密码!'
      else
        if $pwd.val().length > 0 and $pwd.val().length < 6
          pwd_flag = false
          msg = '密码太短了!'
        else
          msg = ''
      $pwd_status.html msg
      pwd_flag
    login: -> 
      msg = ''
      reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/
      email_flag = reg.test $('input[name=email]').val()
      pwd_flag = $('input[name=pwd]').val().length > 5
      if !email_flag
        msg = '邮箱填写有误!'
        $('span[name=email_status]').html msg
      else if !pwd_flag
        msg = '密码填写有误!'
        $('span[name=pwd_status]').html msg
      else
        $.ajax
          url: 'index.php/api/user/login'
          type: 'post'
          data:
            email:$('input[name=email]').val()
            password:$('input[name=pwd]').val()
          success:(data)->
            if data.error_code is 200
              window.location.href = '#index'
            # TODO 输出登录失败的原因
            else
              console.log 
  module.exports = LoginView


