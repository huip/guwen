<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sns_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
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
                        foreach ($favour_result as $value) {
                                $is_favour = $value['is_favour'];
                        }

                        $sql = "SELECT user_score FROM guwen_user WHERE user_id = ?";
                        $query = $this->db->query($sql,array($comment_uid));
                        $score = $query->result_array();
                        foreach ($score as $value) {
                                
                                $user_score = $value["user_score"];
                        }

                       if( $is_favour == 0 )
                       {

                            	foreach ($res as $value) {
                            	
                            		$current_favour = $value['comment_favour']+1;
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
                                
                                    $current_favour = $value['comment_favour'] - 1;
                                }
                                $data = array(

                                        'comment_favour' => $current_favour,

                                );
                                
                                $datas = array(
                                                'user_score' =>$user_score -1,
                                );
                                $this->db->where('id',$comment_id);
                                $this->db->update('guwen_comment',$data);
                                $this->db->where('user_id',get_user_info("user_id"));
                                $this->db->update("guwen_user",$datas);
                                $sql = "SELECT comment_favour FROM guwen_comment where id = ?";
                                $query = $this->db->query($sql,array($comment_id));
                                $res = $query->result_array();
                                return $res; 
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
                                    "favour_time"           => "0",
                                    "is_favour"                => "0"
                                );
                    $this->db->insert("guwen_snslog",$data);
            }
            else
            {
                foreach ($res as $value) {
                        
                        $is_favour = $value['is_favour'];
                }

                    if( $is_favour == "0") {

                        $data = array(

                            'favour_time'    => get_local_time(),
                            'is_favour'         => "1"

                        );

                        foreach ($res as $value) {


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

                        foreach ($res as $value) {


                            $this->db->where('id',$value['id']);
                            $this->db->update('guwen_snslog',$data);

                        }
                    }
            }

    }

   

    private function add_score($score)
    {
        $sql = "SELECT user_score FROM guwen_user WHERE user_id = ?";
        $query = $this->db->query($sql,array(get_user_info("user_id")));
        $res = $query->result_array();
        foreach ($res as $value) {
            $current_score = $value['user_score'];
        }
        return array("user_score" => $current_score + $score);
    }



}