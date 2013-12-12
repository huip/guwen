define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  LoginView = require './views/login'
  WidgetsView = require './views/widgets'
  QuestionView = require './views/question'
  QinfoView = require './views/qinfo'
  RelativeView = require './views/relative'
  UserInfoView = require './views/uinfo'
  MyQuestionView = require './views/myquestion'
  MyAnswerView = require './views/myanswer'
  TopicView = require './views/topic'
  class Router extends Backbone.Router
    routes:
      '' : 'index'
      'index' : 'index'
      'index/:page' : 'index'
      'q/:qid' : 'question'
      'u/q/:uid' : 'uinfo'
      'u/q/:uid/:page' : 'uinfo'
      'u/a/:uid' : 'uanswer'
      'u/a/:uid/:page' : 'uanswer'
      'login' : 'login'
      'topic' : 'topic'
      'topic/:page' : 'topic'
  app_router = new Router()
  app_router.on 'route:login',->
    loginView = new LoginView el: $('.left-content')
  app_router.on 'route:index',(page)->
    page = 1 if not page?
    $('.navbar-nav li').eq(0).addClass('active').siblings().removeClass('active')
    questionView = new QuestionView {el:$('.left-content'),id:page}
    widgetsView = new WidgetsView el:$ '.right-content'
  app_router.on 'route:topic',(page)->
    page = 1 if not page?
    topicView = new TopicView {el:$('.left-content'),id:page}
    $('.navbar-nav li').eq(1).addClass('active').siblings().removeClass('active')
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
  app_router.on 'route:uanswer',(uid,page)->
    page = 1 if not page?
    args = 
      uid:uid
      page:page
    userInfoView = new UserInfoView el:$('.right-content'),id:uid
    myanswer = new MyAnswerView el:$('.left-content'),id:args
  Backbone.history.start()

