<!DOCTYPE html>
<html>
<head>
	<title>Create Location</title>
</head>
<body>
	<h1>Create Location</h1>
	<form action="/api/location" method="POST">
		@csrf
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name"><br>
		<label for="latitude">Latitude:</label><br>
		<input type="text" id="latitude" name="latitude"><br>
		<label for="longitude">Longitude:</label><br>
		<input type="text" id="longitude" name="longitude"><br><br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>
