<?php

class ProjekController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function create()
	{
		$this->load->view('head');
		$this->load->view('proyek/create_proyek');
		$this->load->view('foot');
	}
	public function edit()
	{
		$this->load->view('head');
		$this->load->view('proyek/edit_proyek');
		$this->load->view('foot');
	}
}
