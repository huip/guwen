  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_question_detail($ques_id)
	{
		$sql = " SELECT ms.msgid ,us.user_name,ms.ques_title,ms.ques_content,
			ms.user_id,ms.ques_socore, ms.post_time,ms.is_best,
			(SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate) AS ques_cate
			FROM guwen_message AS ms, guwen_user AS us  
			WHERE us.user_id = ms.user_id AND msgid = ?";

		$query = $this->db->query($sql,array($ques_id));
		$res = $query->result_array();
		return $res;
	}

	public function get_comment($ques_id)
	{
		$sql = "SELECT cmt.id,cmt.comment_content,cmt.comment_time,cmt.comment_quesid ,cmt.comment_uid,
			cmt.comment_favour,us.user_img,us.user_name,us.user_id,
			(SELECT count(id) FROM guwen_comment_reply WHERE comment_id = cmt.id) as reply_num,
			(SELECT uid FROM guwen_bestanwserlog WHERE comment_id = cmt.id) AS best_uid 
			FROM  guwen_comment AS cmt ,guwen_user AS us 
			WHERE  us.user_id = cmt.comment_uid  AND cmt.comment_quesid = ? 
			ORDER BY (SELECT time FROM guwen_bestanwserlog WHERE comment_id = cmt.id) DESC, cmt.id DESC";
		$query = $this->db->query($sql,array($ques_id));
		$res = $query->result_array($query);
		
		foreach ($res as $key => $value) 
		{
			$sql = "SELECT DISTINCT  reply.reply_content ,reply.time,us.user_name,us.user_img,us.user_id 
			FROM guwen_comment_reply as reply ,guwen_user as us ,guwen_comment AS cmt
			WHERE reply.comment_id  = ? AND reply.reply_uid = us.user_id 
			AND cmt.comment_quesid = ? ";

			$query = $this->db->query($sql,array($value['id'],$value['comment_quesid']));
			$re = $query->result_array();
			
			$res[$key]['reply'] = $re;

		}

		return $res;
	}


	public function set_ques_browser($ques_id)
	{

		$user_id = get_user_info('user_id');

		if( $user_id != NULL)
		{
			$data = array(
			'id'  => '',
			'user_id' => get_user_info('user_id'),
			'ques_id' => $ques_id,
			'time'      => get_local_time()
			);
		}
		else
		{
			$data = array(

				'id' => '',
				'user_id' => '',
				'ques_id' => $ques_id,
				'time'      => get_local_time()
			);

		}
		
		$sql = "SELECT browser FROM  guwen_message WHERE msgid = ?";
		$query = $this->db->query($sql,array($ques_id));
		$res = $query->result_array();
		foreach ($res as $value) {
		$current_browser = $value['browser'];
		}
		$datas = array(
			'browser' => $current_browser + 1,
		);
		$this->db->insert("guwen_browserlog",$data);
		$this->db->where("msgid",$ques_id);
		$this->db->update("guwen_message",$datas);
	}


}
?>