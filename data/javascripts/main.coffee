define (require,exports,module)->
  IndexView = require './views/index'
  class Router extends Backbone.Router
    routes:
      '/' : 'index'
      'index' : 'index'
  app_router = new Router()
  app_router.on 'route:index',->
  Backbone.history.start()

