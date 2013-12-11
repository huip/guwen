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
      'u/:uid/:page' : 'uninfo'
  app_router = new Router()
  app_router.on 'route:index',(page)->
    page = 1 if not page?
    questionView = new QuestionView {el:$('.left-content'),id:page}
    widgetsView = new WidgetsView el:$ '.right-content'
  app_router.on 'route:question',(qid)->
    qinfoView = new QinfoView el:$('.left-content'),id:qid
    relativeView = new RelativeView el:$('.right-content'),id:qid
  app_router.on 'route:uinfo',(uid,page)->
    page = 1 if not page?
    args = 
      uid:uid
      page:page
    userInfoView = new UserInfoView el:$('.right-content'),id:uid
    myquestion = new MyQuestionView el:$('.left-content'),id:args
  Backbone.history.start()

