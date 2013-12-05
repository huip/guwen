define (require,exports,module)->
  $ = require('./jquery-min')
  $(document).ready ->
    class Router extends Backbone.Router
      routes:
        '/*' : 'index'
        'index' : 'index'
    app_router = new Router()
    app_router.on 'route:index',->
    Backbone.history.start()

