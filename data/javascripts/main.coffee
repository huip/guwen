define (require,exports,module)->
  class Router extends Backbone.Router
    routes:
      '/' : 'index'
      'index' : 'index'
  app_router = new Router()
  app_router.on 'route:index',->
    console.log 'index'
  Backbone.history.start()

