<?php

namespace App\Models;

use CI_Model;

class ProjekModel extends CI_Model
{
	protected $table      = 'projek';
	protected $primaryKey = 'id';

	protected $allowedFields = [
		'nama_projek',
		'client',
		'tgl_mulai',
		'tgl_selesai',
		'pemimpin_projek',
		'deskripsi',
		'created_at',
	];
}
