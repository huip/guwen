<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->model('user_model');
	   	$this->load->library('session');
             	$this->load->model('index/index_model');
             	$this->load->model('sns_model');
	}

    public function add_favour()
    {
    	$comment_id = $_POST['comment_id'];
             $quesid = $_POST['quesid'];
             $comment_uid = $_POST['comment_uid'];
    	$data = array(

    			'id'                             => $comment_id,
    			'comment_favour'    => '0',
                                       'comment_quesid'   =>$quesid,
                                       'comment_uid'         => $comment_uid

    		);
            $this->sns_model->set_favour_log($data);
            $res = $this->sns_model->add_favour($data);
            if( $res != NULL )
            {


                        if( count( $res ) != "0")
                        {

                                    foreach ($res as $value) {

                                        echo $value['comment_favour'];
                                     } 

                        } 
            }
            else
            {
                    echo "请先登录!";
            }

    }

    public function get_index_anwser()
    {
        $ques_id = $_POST['quesid'];
        $res = $this->index_model->get_index_anwser($ques_id);
        echo $res;
    }

    public function add_reply()
    {
        if( get_user_info("user_id") != NULL )
        {
            $reply_content = $_POST['reply_content'];
            $comment_id = $_POST['comment_id'];
            $data = array(
                    'reply_content' => $reply_content,
                    'reply_uid'         => get_user_info("user_id"),
                    'comment_id'    => $comment_id,
                    'time'                 => get_local_time()
                );

            $res   = $this->index_model->add_reply($data);
            if( $res )
            {
                $user_info =  array(

                                            'user_img' => get_user_info("user_img"),
                                            'user_name' => get_user_info("user_name"),
                                            'time'            => get_local_time(),
                                            'user_id'       => get_user_info("user_id")
                                  );

                echo  json_encode($user_info);
            }
        } 
        else
        {
            echo "请先登录!";
        }
    }

    public function get_reply_num()
    {
            $comment_id = $_POST['comment_id'];
            $res = $this->index_model->get_reply_num($comment_id);
            echo $res;

    }

    public function get_reply_list()
    {
        $comment_id = $_POST['comment_id'];
        $res = $this->index_model->get_reply_list($comment_id);
        echo $res;
     }
}
?>

