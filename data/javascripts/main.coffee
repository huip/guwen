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
>>>>>>> 3cb043a8245fe5b89efbf33665cb9b9b6a774f08
      'login' : 'login'
  app_router = new Router()
  app_router.on 'route:login',->
    loginView = new LoginView el: $('.left-content')
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
  app_router.on 'route:uanswer',(uid,page)->
    page = 1 if not page?
    args = 
      uid:uid
      page:page
    console.log args
    userInfoView = new UserInfoView el:$('.right-content'),id:uid
<<<<<<< HEAD
  app_router.on 'route:login',->
    alert 'test'
=======
    myanswer = new MyAnswerView el:$('.left-content'),id:args
>>>>>>> 3cb043a8245fe5b89efbf33665cb9b9b6a774f08
  Backbone.history.start()

