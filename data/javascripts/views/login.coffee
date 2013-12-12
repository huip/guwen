define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require 'underscore'
  class LoginView extends Backbone.View
  	events:
    	'click .login-btn' : 'login'
    initialize: ->
      that = @
      @render()
    render: ->
      template = _.template $('#login_template').html(),{}
      @.$el.html template
    
    login: ->
    	alert 'test'

  module.exports = LoginView
