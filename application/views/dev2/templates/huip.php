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
<script type="text/template" id="question_template">
    <%_.each(data,function(question) {%>
      <li><a href="#q/<%=question.qid%>"><%=question.qtitle%></a></li>
    <%})%>
</script>
<script type="text/template" id="qinfo_template">
    <%_.each(data.info,function(info) {%>
      <h2><%=info.qtitle%></h2>
      <p><%=info.qcontent%></p>
      <p><a href="#u/q/<%=info.uid%>"><%=info.name%></a></p>
      <p><%=info.score%></p>
      <p><%=info.ctime%></p>
    <%})%>
    <%_.each(data.comments,function(comment) {%>
      <p><a href="#u/q/<%=comment.uid%>"><%=comment.name%></a></p>
      <p><%=comment.comment_content%></p>
      <p><%=comment.comment_time%></p>
      <%_.each(comment.reply,function(reply) {%>
        <div style="text-indent:40px">
          <p><a href="#u/q/<%=reply.uid%>"><%=reply.name%></a></p>
          <p><%=reply.reply_content%></p>
          <p><%=reply.time%></p>
        </div>
      <%})%>
      <hr />
    <%})%>
</script>
<script type="text/template" id="relative_template">
    <%_.each(data,function(info) {%>
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
<script type="text/template" id="myquestion_template">
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
<script type="text/template" id="myanswer_template">
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
