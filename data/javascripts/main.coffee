define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  WidgetsView = require './views/widgets'
  class Router extends Backbone.Router
    routes:
      '/' : 'index'
      'index' : 'index'
  app_router = new Router()
  app_router.on 'route:index',->
    indexView = new WidgetsView el:$ '.right-content'
  Backbone.history.start()

