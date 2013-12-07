define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  WidgetsView = require './views/widgets'
  QuestionView = require './views/question'
  QinfoView = require './views/qinfo'
  RelativeView = require './views/relative'
  class Router extends Backbone.Router
    routes:
      '' : 'index'
      'index' : 'index'
      'index/:page' : 'index'
      'q/:qid' : 'question'
  app_router = new Router()
  app_router.on 'route:index',(page)->
    page = 1 if not page?
    questionView = new QuestionView {el:$('.left-content'),id:page}
    widgetsView = new WidgetsView el:$ '.right-content'
  app_router.on 'route:question',(qid)->
    qinfoView = new QinfoView el:$('.left-content'),id:qid
    relativeView = new RelativeView el:$('.right-content'),id:qid
  Backbone.history.start()

