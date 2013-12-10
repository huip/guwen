<h2>api routers</h2>
 <ul>
   <li>获取侧边栏组件:<a href="api/widgets">/api/widgets</a></li>
   <li>获取侧边栏组件 page means current page (default = 1):<a href="api/question/1">/api/question/page</a></li>
   <li>获取问题的详情 qid means question id:<a href="api/qinfo/586">/api/qinfo/qid</a></li>
   <li>获取相关问题 qid means question id:<a href="api/relative/614">/api/relative/qid</a></li>
   <li>得到用户的信息:<a href="api/uinfo/515bccf8c3749">/api/uninfo/uid</a></li>
   <li>得到用户问题:<a href="api/myquestion/515bccf8c3749/1">/api/myquestion/uid/page</a></li>
   <li>得到用户的回答:<a href="api/myanswer/515bccf8c3749/1">/api/myanswer/uid/page</a></li>
   <li>用户登录接口:post url /api/login
      post data email password
      error_code: 100 means username or password error
      error_code: 200 means login success
  </li>
   <li>用户注册接口:post url /api/register
      post data useremail userpassword username
      error_code: 102 means user exist,300 means argumens missing or not valid 
      error_code: 202 means regist success
 </ul>
