
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class LayoutDefault extends CI_Controller {
    
    public function index()
	{
        $this->load->view('dist/layout-default');
	}



}
