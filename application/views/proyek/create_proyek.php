<div class="container mt-5">
	<div class="card">
		<div class="card-header">
			<h2 class="text-center">Buat Proyek Baru</h2>
		</div>
		<div class="card-body">
			<form id="create-project-form">
				<div class="mb-3">
					<label for="nama_proyek" class="form-label">Nama Proyek:</label>
					<input type="text" id="nama_proyek" name="nama_proyek" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="client" class="form-label">Client:</label>
					<input type="text" id="client" name="client" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="tgl_mulai" class="form-label">Tanggal Mulai:</label>
					<input type="datetime-local" id="tgl_mulai" name="tgl_mulai" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="tgl_selesai" class="form-label">Tanggal Selesai:</label>
					<input type="datetime-local" id="tgl_selesai" name="tgl_selesai" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="pimpinan_proyek" class="form-label">Pimpinan Proyek:</label>
					<input type="text" id="pimpinan_proyek" name="pimpinan_proyek" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="keterangan" class="form-label">Keterangan:</label>
					<textarea id="keterangan" name="keterangan" class="form-control" rows="5" required></textarea>
				</div>
				<div id="response-message">

				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-success w-100">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	document.getElementById('create-project-form').addEventListener('submit', function(event) {
		event.preventDefault();

		const formData = new FormData(this);
		const data = {};
		formData.forEach((value, key) => {
			data[key] = value;
		});

		const dataJson = JSON.stringify(data);

		fetch('http://localhost:8081/api/proyek', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: dataJson
			})
			.then(response => {

				if (response.ok) {

					document.getElementById('response-message').innerHTML = `<div class="alert alert-success">Proyek berhasil ditambahkan! Kembali...</div>`;

					setTimeout(() => {
						window.location.href = 'http://localhost/codeigniter3/';
					}, 2000);
				} else {

					return response.text().then(text => {
						document.getElementById('response-message').innerHTML = `<div class="alert alert-danger">error: ${text}</div>`;
					});
				}
			})
			.catch(error => {
				console.error('Error:', error);
				document.getElementById('response-message').innerHTML = `<div class="alert alert-danger">error: ${error.message}</div>`;
			});
	});
</script>
