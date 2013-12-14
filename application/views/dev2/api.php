<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>api routers</h2>
     <ul>
       <li>获取侧边栏组件:<a href="api/widgets/">/api/widgets</a></li>
       <li>获取问题列表 page means current page (default = 1):<a href="api/question/list/page/1">/api/question/list/page/1</a></li>
       <li>获取问题的详情 id means question id:<a href="api/question/info/id/586">/api/question/info/id/586</a></li>
       <li>获取相关问题 qid means question id:<a href="api/question/relative/id/614">/api/question/relative/qid</a></li>
       <li>得到用户的信息:<a href="api/user/info/id/515bccf8c3749">/api/user/info/id/</a></li>
       <li>得到用户问题:<a href="api/user/question/id/515bccf8c3749/page/1">/api/user/question/id/:id/page/:page</a></li>
       <li>得到用户的回答:<a href="api/user/answer/id/515bccf8c3749/page/1">/api/user/answer/id/:id/page/:page</a></li>
       <li>用户登录接口:post url /api/user/login
          post data email password
          error_code: 100 means username or password error
          error_code: 200 means login success
      </li>
       <li>用户注册接口:post url /api/user/register
          post data useremail userpassword username
          error_code: 102 means user exist,300 means argumens missing or not valid 
          error_code: 202 means regist success
       </li>
      <li>
        获取分类api page means current page<a href="api/topic/list/id/1">/api/topic/list/id/1</a>
      </li>
      <li>
        获取分类下的问题api page means current page tid means tag id<a href="api/topic/question/id/50/page/1">/api/topic/question/id/:id/page/:page</a>
      </li>
      <li>
        获取没回答的问题api page means current page <a href="api/question/unanswerd/page/1">/api/question/unanswerd/page/:page</a>
      </li>
      <li>
        获取没回答的问题api page means current page <a href="api/question/unanswerd/page/1">/api/question/unanswerd/page/:page</a>
      </li>
      <li>
        获取热门问题api page means current page <a href="api/question/hotest/page/1">/api/question/hotest/page/:page</a>
      </li>
     </ul>
     </ul>
  </body>
</html>
