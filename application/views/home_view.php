<div class="container" id="container">
	<h1>Test MSIB SEI 2024 Reynold Kunarto - Universitas Atma Jaya Yogyakarta</h1>

	<div class="d-flex justify-content-between align-items-center mt-4">
		<h4>Tabel Proyek</h4>
		<a class="btn btn-success" href="<?php echo base_url(); ?>create-proyek">Tambah Proyek</a>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Nama Proyek</th>
				<th scope="col">Client</th>
				<th scope="col">Tanggal Mulai</th>
				<th scope="col">Tanggal Selesai</th>
				<th scope="col">Pimpinan Proyek</th>
				<th scope="col">Keterangan</th>
				<th scope="col">Created At</th>
				<th scope="col">Aksi</th>
			</tr>
		</thead>
		<tbody id="list-projek">
			<?php if (!empty($projek)): ?>
				<?php foreach ($projek as $pro): ?>
					<tr data-id="<?= $pro['id'] ?>">
						<th scope="row"><?= $pro['id'] ?></th>
						<td><?= $pro['nama_proyek'] ?></td>
						<td><?= $pro['client'] ?></td>
						<td><?= $pro['tgl_mulai'] ?></td>
						<td><?= $pro['tgl_selesai'] ?></td>
						<td><?= $pro['pimpinan_proyek'] ?></td>
						<td><?= $pro['keterangan'] ?></td>
						<td><?= $pro['created_at'] ?></td>
						<td>
							<div class="btn-group" role="group">
								<a class="btn btn-warning btn-sm" href="<?php echo base_url('edit-proyek?id=' . $pro['id']); ?>">
									<i class="fa fa-pencil"></i>
								</a>

								<button class="btn btn-danger btn-sm" data-id="<?= $pro['id'] ?>" data-type="proyek">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>

					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="9" class="text-center">Projek Kosong</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>


	<div class="d-flex justify-content-between align-items-center mt-4">
		<h4>Tabel Lokasi</h4>
		<a class="btn btn-success" href="<?php echo base_url(); ?>create-lokasi">Tambah Lokasi</a>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Nama Lokasi</th>
				<th scope="col">Negara</th>
				<th scope="col">Provinsi</th>
				<th scope="col">Kota</th>
				<th scope="col">Created At</th>
				<th scope="col">Aksi</th>
			</tr>
		</thead>
		<tbody id="list-projek">
			<?php if (!empty($lokasi)): ?>
				<?php foreach ($lokasi as $lok): ?>
					<tr data-id="<?= $lok['id'] ?>">
						<th scope="row"><?= $lok['id'] ?></th>
						<td><?= $lok['nama_lokasi'] ?></td>
						<td><?= $lok['negara'] ?></td>
						<td><?= $lok['provinsi'] ?></td>
						<td><?= $lok['kota'] ?></td>
						<td><?= $lok['created_at'] ?></td>
						<td class="text-end">
							<div class="btn-group" role="group">
								<a class="btn btn-warning btn-sm" href="<?php echo base_url('edit-lokasi?id=' . $lok['id']);  ?>">
									<i class="fa fa-pencil"></i>
								</a>
								<button class="btn btn-danger btn-sm" data-id="<?= $lok['id'] ?>" data-type="lokasi">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>

					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="9" class="text-center">Lokasi Kosong</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<script>
	function editProject(data) {
		const queryString = new URLSearchParams(project).toString();
		window.location.href = `<?php echo base_url(); ?>proyek/edit?${queryString}`;
	}

	function deleteItem(id, type) {
		const url = `http://localhost:8081/api/${type}/${id}`;
		if (confirm('yakin hapus ?')) {
			fetch(url, {
					method: 'DELETE',
					headers: {
						'Content-Type': 'application/json'
					}
				})
				.then(response => {
					if (response.ok) {
						document.querySelector(`tr[data-id="${id}"]`).remove();
						alert('terhapus...');
					} else {
						return response.text().then(text => {
							alert('error: ' + text);
						});
					}
				})
				.catch(error => {
					console.error('Error:', error);
					alert('error: ' + error.message);
				});
		}
	}

	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('.btn-danger').forEach(button => {
			button.addEventListener('click', function() {
				const id = this.dataset.id;
				const type = this.dataset.type;
				deleteItem(id, type);
			});
		});
	});
</script>
