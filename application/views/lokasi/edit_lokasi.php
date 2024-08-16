<div class="container">
	<h2>Edit Project</h2>
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
			const response = await fetch(`http://localhost:8081/api/lokasi/${id}`);

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
		document.getElementById('nama_lokasi').value = data.nama_lokasi || '';
		document.getElementById('negara').value = data.negara || '';
		document.getElementById('provinsi').value = data.provinsi || '';
		document.getElementById('kota').value = data.kota || '';
	}

	async function handleFormSubmit(event) {
		event.preventDefault();

		const id = getIdFromUrl();
		const formData = new FormData(event.target);

		try {
			const response = await fetch(`http://localhost:8081/api/lokasi/${id}`, {
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
			document.getElementById('response-message').innerText = 'Lokasi updated! kembali...';
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

		document.getElementById('create-location-form').addEventListener('submit', handleFormSubmit);
	};
</script>
