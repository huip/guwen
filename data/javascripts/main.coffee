define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  WidgetsView = require './views/widgets'
  QuestionView = require './views/question'
  QinfoView = require './views/qinfo'
  RelativeView = require './views/relative'
  UserInfoView = require './views/uinfo'
  MyQuestionView = require './views/myquestion'
  class Router extends Backbone.Router
    routes:
      '' : 'index'
      'index' : 'index'
      'index/:page' : 'index'
      'q/:qid' : 'question'
      'u/:uid' : 'uinfo'
      'login' : 'login'
  app_router = new Router()
  app_router.on 'route:index',(page)->
    page = 1 if not page?
    questionView = new QuestionView {el:$('.left-content'),id:page}
    widgetsView = new WidgetsView el:$ '.right-content'
  app_router.on 'route:question',(qid)->
    qinfoView = new QinfoView el:$('.left-content'),id:qid
    relativeView = new RelativeView el:$('.right-content'),id:qid
  app_router.on 'route:uinfo',(uid)->
    userInfoView = new UserInfoView el:$('.right-content'),id:uid
  app_router.on 'route:login',->
    alert 'test'
  Backbone.history.start()

