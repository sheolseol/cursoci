<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout("template");
	}

	public function index()
	{
		$this->layout->setTitle("Nuestros productos");
		$this->layout->view('index');
	}
}

