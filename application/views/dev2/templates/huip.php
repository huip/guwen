<script type="text/template" id="widgets_template">
  <div class="hot-ques">
    <p>热门问题</p>
    <%_.each(data.hot_ques,function(ques) {%>
    <li><a href="#q/<%=ques.qid%>"><%=ques.qtitle%></a></li>
    <%})%>
  </div>
  <div class="hot-cate">
    <p>热门分类</p>
    <%_.each(data.hot_cate,function(cate) {%>
    <li><img src="<%=cate.tag_img%>" class="img-responsive img-rounded"><a href="<%=cate.id%>"><%=cate.tag_name%></a></li>
    <%})%>
  </div>
  <div class="hot-person">
    <p>热门分类</p>
    <%_.each(data.hot_person,function(person) {%>
      <li><a href="#u/q/<%=person.uid%>"><img src="<%=person.gravatar%>" alt="<%=person.name%>" class="img-rounded img-responsive" /><%=person.name%></a></li>
    <%})%>
  </div>
</script>

<script type="text/template" id="qinfo_template">
    <%_.each(data.questions,function(question) {%>
      <h2><%=question.qtitle%></h2>
      <p><%=question.qcontent%></p>
      <p><a href="#u/q/<%=question.uid%>"><%=question.name%></a></p>
      <p><%=question.qscore%></p>
      <p><%=question.ctime%></p>
    <%})%>
    <%_.each(data.answers,function(answer) {%>
      <p><a href="#u/q/<%=answer.uid%>"><%=answer.name%></a></p>
      <p><%=answer.content%></p>
      <p><%=answer.ctime%></p>
      <%_.each(answer.reply,function(reply) {%>
        <div style="text-indent:40px">
          <p><a href="#u/q/<%=reply.uid%>"><%=reply.name%></a></p>
          <p><%=reply.content%></p> <p><%=reply.ctime%></p> </div>
      <%})%>
      <hr />
    <%})%>
</script>

<script type="text/template" id="relative_template">
    <%_.each(data.relative,function(info) {%>
      <li><a href="#q/<%=info[0].qid%>"><%=info[0].qtitle%></a></li>
    <%})%>
</script>

<script type="text/template" id="uinfo_template">
  <p><%=data[0].name%></p>
  <p><%=data[0].motto%></p>
  <img src="<%=data[0].gravatar%>" alt="<%=data[0].name%>" />
  <p><%=data[0].score%></p>
  <p><%=data[0].rank%></p>
  <p><%=data[0].gap%></p>
</script>

<script type="text/template" id="userquestion_template">
  <div class="myquestion">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#u/q/<%=data.uid%>">TA的提问</a></li>
      <li><a href="#u/a/<%=data.uid%>">TA的回答</a></li>
    </ul>
    <div class="ques-list">
      <%_.each(data.question,function(list) {%>
          <li>
            <a href="#/q/<%=list.qid%>"><%=list.qtitle%></a>
            <p><span><%=list.answer%>个答案</span><span>浏览：<%=list.click%></span><span><%=list.ctime%></span></p>
            <hr />
          </li>
      <% }) %>
    </div>
  </div>
</script>

<script type="text/template" id="useranswer_template">
  <div class="myanswer">
    <ul class="nav nav-tabs">
      <li><a href="#u/q/<%=data.uid%>">TA的提问</a></li>
      <li class="active"><a href="#u/a/<%=data.uid%>">TA的回答</a></li>
    </ul>
    <div class="ques-list">
      <%_.each(data.answer,function(list) {%>
          <li>
            <a href="#/q/<%=list.qid%>"><%=list.qtitle%></a>
            <p><span><%=list.answer%>个答案</span><span>浏览：<%=list.click%></span><span><%=list.ctime%></span></p>
            <hr />
          </li>
      <% }) %>
    </div>
  </div>
</script>

<script type="text/template" id="topiq_template">
    <%_.each(data.question,function(q) {%>
      <li><a href="#q/<%=q.qid%>"><%=q.qtitle%></a></li>
    <%})%>
</script>





<script type="text/template" id="question_template">  //首页
    <%_.each(data,function(question) {%>
      <div class='col-md-10 col-md-offset-1' id='question_wrap'>
        <ul class="col-md-12">
          <li class="li_one">
            <a href="#q/<%=question.qid%>" class="col-md-9"><%=question.qtitle%></a>
            <span class="col-md-3"><%=question.ctime%></span>
          </li>
          <li class="li_one">
            <span class="col-md-2 span_reward">悬赏：<%=question.qscore%></span><span class="col-md-2 span_watch">浏览：<%=question.click%></span><span class="col-md-2 pull-right">回答：<%=question.anwser%></span>
          </li>
          <li class="clearSpan"></li> 
        </ul>
      </div>
    <%})%>
</script>









<script type="text/template" id="topic_template">       // 分类
  <div class="topic">
    <ul>
      <%_.each(data.topics,function(topic) {%>
        <li>
            <a href="#topic/q/<%=topic.id%>"><%=topic.tag_name%></a>
            <ul>
              <%_.each(topic.qlist,function(q) {%>
                <li>
                  <a href="#q/<%=q.qid%>"><%=q.qtitle%></a>
                  <p><%=q.ctime%></p>
                  <p>回答:(<%=q.anwser%>)</p>
                </li>
              <%})%>
            </ul>
        </li> 
      <%})%>
   </ul>
  </div>
</script>

<script type="text/template" id="unanswerd_template">   //未回答
    <%_.each(data.unanswerd,function(list) {%>
      <li>
        <a href="#/q/<%=list.qid%>"><%=list.qtitle%></a>
        <p><span>浏览：<%=list.click%></span><span><%=list.ctime%></span></p>
        <hr />
      </li>
    <%})%>
</script>

<script type="text/template" id="hotest_template">      //热门
  <%_.each(data.hotests,function(hotest) {%>
    <li>
      <a href="#/q/<%=hotest.qid%>"><%=hotest.qtitle%></a>
      <p><span>浏览：<%=hotest.click%></span><span><%=hotest.ctime%></span></p>
      <hr />
    </li>
  <%})%>
</script>
