<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Controller extends CI_Controller {

	public function index()
	{
		
		$this->load->view('page/index');
	}

	public function layout_default()
	{
		
		$this->load->view('dist/layout-default');
	}



}
