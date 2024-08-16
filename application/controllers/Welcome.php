<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{

		$proyekData = $this->fetchData('http://localhost:8081/api/proyek');

		$lokasiData = $this->fetchData('http://localhost:8081/api/lokasi');


		$data['projek'] = $proyekData;
		$data['lokasi'] = $lokasiData;

		$this->load->view('head');
		$this->load->view('home_view', $data);
		$this->load->view('foot');
	}

	private function fetchData($url)
	{
		$response = file_get_contents($url);
		return json_decode($response, true);
	}
}
