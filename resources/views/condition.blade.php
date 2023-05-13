<!DOCTYPE html>
<html>
<head>
	<title>Create Weather Condition</title>
</head>
<body>
	<h1>Create Weather Condition</h1>
	<form action="/api/weather" method="POST">
		@csrf
		<label for="location_id">Location ID:</label><br>
		<input type="text" id="location_id" name="location_id"><br>
		<label for="temperature">Temperature:</label><br>
		<input type="text" id="temperature" name="temperature"><br>
		<label for="wind_speed">Wind Speed:</label><br>
		<input type="text" id="wind_speed" name="wind_speed"><br>
		<label for="humidity">humidity:</label><br>
		<input type="text" id="humidity" name="humidity"><br>
		<label for="description">Description:</label><br>
		<input type="text-area" id="description" name="description"><br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
