define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  LoginView = require './views/login'
  WidgetsView = require './views/widget/widgets'
  QuestionView = require './views/question/list'
  QinfoView = require './views/question/info'
  RelativeView = require './views/question/relative'
  UserInfoView = require './views/user/info'
  UserQuestionView = require './views/user/question'
  #MyAnswerView = require './views/myanswer'
  #TopicView = require './views/topic'
  class Router extends Backbone.Router
    routes:
      '' : 'index'
      'index' : 'index'
      'index/:page' : 'index'
      'q/:id' : 'question'
      'u/q/:id' : 'uinfo'
      'u/q/:id/:page' : 'uinfo'
      'u/a/:id' : 'uanswer'
      'u/a/:id/:page' : 'uanswer'
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
  app_router.on 'route:question',(id)->
    qinfoView = new QinfoView el:$('.left-content'),id:id
    relativeView = new RelativeView el:$('.right-content'),id:id
  app_router.on 'route:uinfo',(id,page)->
    page = 1 if not page?
    args = 
      uid:id
      page:page
    userInfoView = new UserInfoView el:$('.right-content'),id:id
    userquestion = new UserQuestionView el:$('.left-content'),id:args
  app_router.on 'route:uanswer',(id,page)->
    page = 1 if not page?
    args = 
      uid:id
      page:page
    userInfoView = new UserInfoView el:$('.right-content'),id:id
    myanswer = new MyAnswerView el:$('.left-content'),id:args
  Backbone.history.start()

