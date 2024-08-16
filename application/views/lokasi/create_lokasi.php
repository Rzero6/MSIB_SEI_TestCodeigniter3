<div class="container mt-5">
	<div class="card">
		<div class="card-header">
			<h2 class="text-center">Buat Lokasi Baru</h2>
		</div>
		<div class="card-body">
			<form id="create-location-form">
				<div class="mb-3">
					<label for="nama_lokasi" class="form-label">Nama Lokasi:</label>
					<input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="negara" class="form-label">Negara:</label>
					<input type="text" id="negara" name="negara" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="provinsi" class="form-label">Provinsi:</label>
					<input type="text" id="provinsi" name="provinsi" class="form-control" required>
				</div>

				<div class="mb-3">
					<label for="kota" class="form-label">Kota:</label>
					<input type="text" id="kota" name="kota" class="form-control" required>
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
	document.getElementById('create-location-form').addEventListener('submit', function(event) {
		event.preventDefault();

		const formData = new FormData(this);
		const data = {};
		formData.forEach((value, key) => {
			data[key] = value;
		});

		const dataJson = JSON.stringify(data);

		fetch('http://localhost:8081/api/lokasi', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: dataJson
			})
			.then(response => {

				if (response.ok) {

					document.getElementById('response-message').innerHTML = `<div class="alert alert-success">Lokasi berhasil ditambahkan! Kembali...</div>`;

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
