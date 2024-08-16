<?php

namespace App\Models;

use CI_Model;

class LokasiModel extends CI_Model
{
	protected $table      = 'lokasi';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'nama_lokasi',
		'negara',
		'provinsi',
		'kota',
		'created_at',
	];
}
