<script type="text/template" id="widgets_template">
  <div class="hot-ques">
    <p>热门问题</p>
    <%_.each(data.hot_ques,function(ques) {%>
    <li><a href="#q/<%=ques.msgid%>"><%=ques.ques_title%></a></li>
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
      <li><img src="<%=person.user_img%>" alt="<%=person.user_name%>" class="img-rounded img-responsive" /><a href="<%=person.user_id%>"><%=person.user_name%></a></li>
    <%})%>
  </div>
</script>
<script type="text/template" id="question_template">
    <%_.each(data,function(question) {%>
      <li><a href="#q/<%=question.msgid%>"><%=question.ques_title%></a></li>
    <%})%>
</script>
<script type="text/template" id="qinfo_template">
    <%_.each(data.info,function(info) {%>
      <h2><%=info.ques_title%></h2>
      <p><%=info.ques_content%></p>
      <p><a href="#u/<%=info.user_id%>"><%=info.user_name%></a></p>
      <p><%=info.ques_score%></p>
      <p><%=info.post_time%></p>
    <%})%>
    <%_.each(data.comments,function(comment) {%>
      <p><a href="#u/<%=comment.user_id%>"><%=comment.user_name%></a></p>
      <p><%=comment.comment_content%></p>
      <p><%=comment.comment_time%></p>
      <%_.each(comment.reply,function(reply) {%>
        <div style="text-indent:40px">
          <p><a href="#u/<%=reply.user_id%>"><%=reply.user_name%></a></p>
          <p><%=reply.reply_content%></p>
          <p><%=reply.time%></p>
        </div>
      <%})%>
      <hr />
    <%})%>
</script>
<script type="text/template" id="relative_template">
    <%_.each(data,function(info) {%>
      <li><a href="#q/<%=info[0].msgid%>"><%=info[0].ques_title%></a></li>
    <%})%>
</script>
<script type="text/template" id="uinfo_template">
  <p><%=data[0].user_name%></p>
  <p><%=data[0].user_motto%></p>
  <img src="<%=data[0].user_img%>" alt="<%=data[0].user_name%>" />
  <p><%=data[0].user_score%></p>
  <p><%=data[0].rank%></p>
  <p><%=data[0].gap%></p>
</script>