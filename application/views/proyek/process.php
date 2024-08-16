<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get the form data
	$project_name = $_POST['project_name'];
	$client = $_POST['client'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$project_lead = $_POST['project_lead'];
	$description = $_POST['description'];

	// Prepare the data array to send to the API
	$data = array(
		'project_name' => $project_name,
		'client' => $client,
		'start_date' => $start_date,
		'end_date' => $end_date,
		'project_lead' => $project_lead,
		'description' => $description
	);

	// Convert the data array to JSON
	$data_json = json_encode($data);

	// Initialize cURL session
	$ch = curl_init('http://localhost:8081/api/proyek');

	// Set cURL options
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	// Execute the request
	$response = curl_exec($ch);

	// Check for cURL errors
	if ($response === false) {
		$error = curl_error($ch);
		curl_close($ch);
		die("cURL Error: $error");
	}

	// Close cURL session
	curl_close($ch);

	// Decode the API response
	$response_data = json_decode($response, true);

	// Handle the response as needed
	if (isset($response_data['success']) && $response_data['success']) {
		// Redirect or show a success message
		header("Location: success_page.php");
		exit();
	} else {
		// Handle the error
		echo "Error: " . $response_data['message'];
	}
} else {
	// If not a POST request, redirect to form page
	header("Location: create_project_form.php");
	exit();
}
