<div class="container">
	<h2>Edit Project</h2>
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
			<div id="response-message"></div>
			<div class="text-center">
				<button type="submit" class="btn btn-success w-100">Update</button>
			</div>
		</form>
	</div>
</div>



<script>
	function getIdFromUrl() {
		const urlParams = new URLSearchParams(window.location.search);
		return urlParams.get('id');
	}
	async function getDataById(id) {
		try {
			const response = await fetch(`http://localhost:8081/api/proyek/${id}`);

			if (!response.ok) {
				throw new Error(`HTTP error!: ${response.status}`);
			}

			const data = await response.json();
			console.log(data);
			return data;
		} catch (error) {
			console.error('Error:', error);
		}
	}

	function populateForm(data) {
		document.getElementById('nama_proyek').value = data.nama_proyek || '';
		document.getElementById('client').value = data.client || '';
		document.getElementById('tgl_mulai').value = data.tgl_mulai || '';
		document.getElementById('tgl_selesai').value = data.tgl_selesai || '';
		document.getElementById('pimpinan_proyek').value = data.pimpinan_proyek || '';
		document.getElementById('keterangan').value = data.keterangan || '';
	}

	async function handleFormSubmit(event) {
		event.preventDefault();

		const id = getIdFromUrl();
		const formData = new FormData(event.target);

		try {
			const response = await fetch(`http://localhost:8081/api/proyek/${id}`, {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(Object.fromEntries(formData.entries()))
			});

			if (!response.ok) {
				throw new Error(`HTTP error!: ${response.status}`);
			}

			const result = await response.json();
			document.getElementById('response-message').innerText = 'Proyek updated! kembali...';
			setTimeout(() => {
				window.location.href = 'http://localhost/codeigniter3/';
			}, 2000);
		} catch (error) {
			document.getElementById('response-message').innerText = 'Error';
		}
	}

	window.onload = async () => {
		const id = getIdFromUrl();
		if (id) {
			const data = await getDataById(id);
			if (data) {
				populateForm(data);
			}
		} else {
			console.log('id not found');
		}

		document.getElementById('create-project-form').addEventListener('submit', handleFormSubmit);
	};
</script>
