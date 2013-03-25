  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_question_detail($ques_id)
	{
		$sql = " SELECT msgid ,user_name,ques_title,ques_content,user_id,ques_socore, post_time,is_best,
		(SELECT tag_name FROM guwen_tag WHERE id = ques_cate) AS ques_cate FROM guwen_message WHERE msgid = ? ";
		$query = $this->db->query($sql,array($ques_id));
		$res = $query->result_array();
		return $res;
	}

	public function get_comment($ques_id)
	{
		$sql = "SELECT cmt.id,cmt.comment_content,cmt.comment_time,cmt.comment_quesid ,cmt.comment_uid,cmt.comment_favour,us.user_img,us.user_name,us.user_id,
		(SELECT count(id) FROM guwen_comment_reply WHERE comment_id = cmt.id) as reply_num
		FROM guwen_comment AS cmt ,guwen_user AS us
		WHERE  us.user_id = cmt.comment_uid  AND cmt.comment_quesid = ?  ORDER BY cmt.id DESC";
		$query = $this->db->query($sql,array($ques_id));
		$res = $query->result_array($query);
		return $res;
	}

}
?>