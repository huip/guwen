<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Index extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
  }

  /*
   * @author huip
   * api router page
   * render api router
   * Dec 2013-12-05
   */
  public function index_get()
  {
    $this->load->view('api');
  }
 }
