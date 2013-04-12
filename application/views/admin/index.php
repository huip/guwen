<div id="main" class="span12">
<table  class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>用户名</th>
                <th>积分</th>
                <th>邮箱</th>
                <th>注册时间</th>
              </tr>
            </thead>
            <tbody>
              <?foreach ($user_info as $key => $value) :{?>
                  <tr>
                    <td><?=$value['user_name']?></td>
                    <td><?=$value['user_score']?></td>
                    <td><?=$value['user_email']?></td>
                    <td><?=$value['reg_time']?></td>
                  </tr>
              <?} endforeach ?>
            </tbody>
</table>