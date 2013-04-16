<div id="main" class="span12">
<table  class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>用户名</th>
                <th>登陆时间</th>
                <th>登陆ip</th>
                <th>登陆客户端</th>
              </tr>
            </thead>
            <tbody>
              <?foreach ($login_info as $key => $value) :{?>
                  <tr>
                    <td><?=$value['user_name']?></td>
                    <td><?=$value['login_time']?></td>
                    <td><?=$value['login_ip']?></td>
                    <td><?=$value['login_client']?></td>
                  </tr>
              <?} endforeach ?>
            </tbody>
</table>