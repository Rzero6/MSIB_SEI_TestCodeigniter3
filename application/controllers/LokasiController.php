<?php

class LokasiController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function create()
	{
		$this->load->view('head');
		$this->load->view('lokasi/create_lokasi');
		$this->load->view('foot');
	}
	public function edit()
	{
		$this->load->view('head');
		$this->load->view('lokasi/edit_lokasi');
		$this->load->view('foot');
	}
}
