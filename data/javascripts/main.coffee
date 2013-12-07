define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  #IndexView = require './views/index'
  class Router extends Backbone.Router
    routes:
      '/' : 'index'
      'index' : 'index'
  app_router = new Router()
  app_router.on 'route:index',->
    console.log 'test'
    #indexView = new IndexView el:$ '.left-content'
  Backbone.history.start()

