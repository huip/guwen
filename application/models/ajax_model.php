<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_model extends CI_Model
{
public function __construct()
{
  $this->load->database();
}

public function get_index_anwser($ques_id)
{
  $sql = "SELECT  cmt.comment_content,us.user_img,us.user_name,us.user_id FROM guwen_comment AS cmt ,guwen_user AS us WHERE cmt.comment_uid = us.user_id AND cmt.comment_quesid = ?";
  $query = $this->db->query($sql,array($ques_id));
  $res = $query->result_array();
  return json_encode($res);
}

public function check_is_register($data)
{	
  $info = $data['data'];
  if( $data['cate'] == "user_email")
  {
    $sql = "SELECT id FROM guwen_user WHERE user_email = ? ";
  }
  else
  {
    $sql = "SELECT id FROM guwen_user WHERE user_name = ? ";
  }
  $query = $this->db->query($sql,array($info));
  return count($query->result_array());
}

public function user_register($data)
{
  $this->db->insert('guwen_user',$data);
  return TRUE;
}

public function get_user_info($useremail)
{
  $sql = "SELECT user_id ,user_name,user_email,user_img,user_role FROM guwen_user WHERE user_email = ? ";
  $query = $this->db->query($sql,array($useremail));
  return $query->result_array();
}

public function user_login_log($data)
{
  $this->db->insert('guwen_log',$data);
}

public function login_score($data)
{
  $this->db->where('user_id',$data);
  $this->db->update('guwen_user',$this->add_score("2"));
  return TRUE;
}

public function get_message_score($msgid)
{
  $sql = "SELECT ques_socore FROM guwen_message WHERE msgid = ?";
  $query = $this->db->query($sql,array($msgid));
  $res = $query->result_array();
  return $res[0]['ques_socore'];
}

private function add_score($score)
{

  $sql = "SELECT user_score FROM guwen_user WHERE user_id = ?";
  $query = $this->db->query($sql,array(get_user_info("user_id")));
  $res = $query->result_array();
  foreach ($res as $value) {
    $current_score = intval($value['user_score']);
  }
  return array("user_score" => $current_score + intval($score));
}

public function add_comment($data)
{
  $uid = get_user_info("user_id");
  $sql = "SELECT count(id) as num FROM guwen_comment WHERE comment_quesid = ?";
  $query = $this->db->query($sql,$data['comment_quesid']);
  $res  = $query->result_array();
  $num = $res[0]['num'];
  $sqls = "SELECT user_id FROM guwen_message WHERE msgid = ?";
  $querys = $this->db->query($sqls,$data['comment_quesid']);
  $re = $querys->result_array();
  $msg_uid = $re[0]['user_id'];
  if( $uid != $msg_uid )
  {
    if( $num == "0" )
    {
      $this->db->where('user_id',$uid);
      $this->db->update("guwen_user",$this->add_score("3"));
      $this->db->insert('guwen_comment',$data);
    } 
    else if( $num == "1" )
    {
      $this->db->where('user_id',$uid);
      $this->db->update("guwen_user",$this->add_score("2"));
      $this->db->insert('guwen_comment',$data);
    } 
    else
    {
      $this->db->where('user_id',$uid);
      $this->db->update("guwen_user",$this->add_score("1"));
      $this->db->insert('guwen_comment',$data);
    }
  }
  else
  {
    $this->db->insert('guwen_comment',$data);	
  }
}

public function add_favour($data)
{
  $user_id = get_user_info('user_id');
  if( $user_id != NULL )
  {
    
    $comment_id = $data["id"];
    $comment_uid = $data['comment_uid'];
    $sql = "SELECT * FROM guwen_comment WHERE id = ?";
    $query = $this->db->query($sql,$comment_id);
    $res =$query->result_array();
    $time = get_local_time();
    $sql = "SELECT is_favour FROM guwen_snslog WHERE comment_id = ?";
    $querys = $this->db->query($sql,array($comment_id));
    $favour_result = $querys->result_array();
    foreach ($favour_result as $value) 
    {
      $is_favour = $value['is_favour'];
    }
    $sql = "SELECT user_score FROM guwen_user WHERE user_id = ?";
    $query = $this->db->query($sql,array($comment_uid));
    $score = $query->result_array();
    foreach ($score as $value) 
    {
      $user_score = intval($value["user_score"]);
    }
    if( $user_id != $data['comment_uid'] )
    {
      if( $is_favour == "0" )
      {
        foreach ($res as $value) 
        {
          $current_favour = intval($value['comment_favour'])+1;
        }
        $data = array(
          'comment_favour' => $current_favour,
        );
        $datas = array(
          'user_score' =>$user_score + 1,
        );
        $this->db->where('id',$comment_id);
        $this->db->update('guwen_comment',$data);
        $this->db->where('user_id',$comment_uid);
        $this->db->update("guwen_user",$datas);
        $sql = "SELECT comment_favour FROM guwen_comment where id = ?";
        $query = $this->db->query($sql,array($comment_id));
        $res = $query->result_array();
        return $res;
      }
      else
      {
        foreach ($res as $value) {
          $current_favour = intval($value['comment_favour']);
        }
        $data = array(
          'comment_favour' => $current_favour - 1,
        );
        $datas = array(
                'user_score' =>$user_score - 1,
        );
        $this->db->where('id',$comment_id);
        $this->db->update('guwen_comment',$data);
        $this->db->where('user_id',$comment_uid);
        $this->db->update("guwen_user",$datas);
        $sql = "SELECT comment_favour FROM guwen_comment where id = ?";
        $query = $this->db->query($sql,array($comment_id));
        $res = $query->result_array();
        return $res; 
      }
    }
  } 
  else 
  {
    return NULL;
  }
}
public function set_favour_log($data)
{
  $comment_id = $data["id"];
  $ques_id = $data['comment_quesid'];
  $user_id = get_user_info("user_id");

  if( $user_id != $data['comment_uid'] )
  {
    $sql  = "SELECT * FROM guwen_snslog WHERE comment_id = ? AND uid = ? AND quesid = ?";
    $query = $this->db->query($sql,array($comment_id,$user_id,$ques_id));
    $res = $query->result_array();
    $is_null = count($res);
    if( $is_null <= 0 )
    {
      $data = array(
      "id"         => "",
      "comment_id"          => $comment_id,
      "quesid"                    => $ques_id,
      "uid"                          => $user_id,
      "favour_time"           => get_local_time(),
      "is_favour"                => "0"
      );
      $this->db->insert("guwen_snslog",$data);
    }
    else
    {
      foreach ($res as $value) 
      {
        $is_favour = $value['is_favour'];
      }
      if( $is_favour == "0") {
        $data = array(
          'favour_time'    => get_local_time(),
          'is_favour'         => "1"
        );
        foreach ($res as $value) 
        {
          $this->db->where('id',$value['id']);
          $this->db->update('guwen_snslog',$data);
        }
      }
      else
      {
        $data = array(
          'favour_time'    => get_local_time(),
          'is_favour'         => "0"
        );
        foreach ($res as $value) 
        {
          $this->db->where('id',$value['id']);
          $this->db->update('guwen_snslog',$data);
        }
      }
    }
  }
  else
  {
    return NULL;
  }

}

public function add_reply($data)
{
  $this->db->insert("guwen_comment_reply",$data);
  return TRUE;

}

public function get_reply_list($comment_id)
{
  $sql = "SELECT reply.reply_content ,reply.time,us.user_name,us.user_img,us.user_id FROM guwen_comment_reply as reply ,guwen_user as us WHERE reply.comment_id  = ? AND reply.reply_uid = us.user_id ";
  $query = $this->db->query($sql,array($comment_id));
  $res = $query->result_array();
  return json_encode($res);

}

public function get_reply_num($comment_id)
{
  $sql = "SELECT count(id) FROM guwen_comment_reply WHERE comment_id = ?";
  $query = $this->db->query($sql,array($comment_id));
  $res = $query->result_array();
  return json_encode($res);
}

public function post_message($data)
{
  $res = $this->db->insert('guwen_message',$data);
  $this->db->where('user_id',$data['user_id']);
  $this->db->update('guwen_user',$this->add_score('-'.$data['ques_socore']));
  if($res) {

    $sql = "SELECT msgid FROM guwen_message WHERE user_id = ? ORDER BY msgid DESC LIMIT 1";
    $query = $this->db->query($sql,array(get_user_info("user_id")));
    $re = $query->result_array();
    return $re;
  }
}

public function profile_alter($data)
{
  $alter_info = array(
    'user_name'   => $data['user_name'],
    'user_motto'  => $data['profile']
  );
  $this->db->where('user_id',$data['user_id']);
  $this->db->update('guwen_user',$alter_info);
  return TRUE;
}

public function acount_alter($data)
{
  $this->db->where('user_id',$data['user_id']);
  $this->db->update('guwen_user',$data);
  return TRUE;
}

public function image_alter($data)
{
  $this->db->where('user_id',$data['user_id']);
  $this->db->update('guwen_user',$data);
  return TRUE;	
}

public function is_true_password($uid)
{
  $sql = "SELECT user_password FROM guwen_user WHERE user_id = ?";
  $query = $this->db->query($sql,array($uid));
  $res = $query->result_array();
  return $res;
}

public function set_best_answer($data)
{
  $current_score = 0;
  $uid = $data['user_id'];
  $mes_best = array(
    'is_best' => '1'
  );

  $bestlog = array(
    'id' => '',
    'ques_id' => $data['msgid'],
    'uid'         => $data['user_id'],
    'time'       => get_local_time(),
    'comment_id' => $data['comment_id']
  );
  $sql = "SELECT user_score FROM guwen_user WHERE user_id = ?";
  $query = $this->db->query($sql,array($uid));
  $res = $query->result_array();
  foreach ($res as $value) {
    $current_score = $value['user_score'] + $data['ques_score'];
  }
  $this->db->where('user_id',$data['user_id']);
  $this->db->update('guwen_user',array('user_score'=>$current_score));
  $this->db->where('msgid',$data['msgid']);
  $this->db->update('guwen_message',$mes_best);
  $this->db->insert('guwen_bestanwserlog',$bestlog);
  return TRUE;
}

public function check_score($data)
{
  $sql = "SELECT (user_score - '$data[user_score]') AS score  FROM guwen_user WHERE user_id = ?";
  $query = $this->db->query($sql,array($data['user_id']));
  $res = $query->result_array();
  foreach ($res as $value) 
  {
    return $value['score'];
  }
  
}

public function save_keywords($data)
{
  $this->db->insert("guwen_keywords",$data);
}

public function post_inbox($data)
{
  $sql = "SELECT user_id FROM guwen_user WHERE user_name = '$data[to_id]'";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  $uid = $res[0]['user_id'];
  $data['to_id'] = $uid;
  $res = $this->db->insert("guwen_inbox",$data);
  return TRUE;
}

public function get_new_inbox($data)
{
  $sql = "SELECT count(id) AS inboxnum FROM guwen_inbox WHERE is_check = 0 AND to_id = ? ORDER BY id DESC ";
  $query = $this->db->query($sql,array($data['my_id']));
  $res = $query->result_array();
  return $res;
}

public function update_inbox_link($data)
{
  $sqls = "SELECT user_id FROM guwen_user WHERE user_name = '$data[to_id]'  ";
  $query = $this->db->query($sqls);
  $re = $query->result_array();
  $uid = $re[0]['user_id'];
  $data['to_id'] = $uid;

  $sql = "SELECT count(id) AS num FROM guwen_inbox_link WHERE  my_id = ? AND to_id = ?";
  $query = $this->db->query($sql,array($data['my_id'],$data['to_id']));
  $res = $query->result_array();

  if( $res[0]['num'] > 0)
  {
    $this->db->where('my_id',$data['my_id']);
    $up_time = array(
      'time' => $data['time'],
    );
    $this->db->update('guwen_inbox_link',$up_time);
  }
  else
  {
    $this->db->insert("guwen_inbox_link",$data);
  }
}

public function get_user_infos($user_name)
{
  $sql = "SELECT user_name,user_id FROM guwen_user WHERE user_name LIKE '%$user_name%' "  ;
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
}

public function create_cate($data)
{
  $this->db->insert("guwen_tag",$data);
  $sql = "SELECT id, tag_name FROM guwen_tag";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res;
}

public function get_reg_inbox()
{
  $sql = "SELECT reg_inbox FROM guwen_help WHERE id = 1";
  $query = $this->db->query($sql);
  $res = $query->result_array();
  return $res[0]['reg_inbox'];
}

}
