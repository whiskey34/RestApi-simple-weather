<!DOCTYPE html>
<html>
<head>
	<title>Create Weather Forecast</title>
</head>
<body>
	<h1>Create Weather Forecast</h1>
	<form action="/weather" method="POST">
		@csrf
		<label for="weather_id">Weather ID:</label><br>
		<input type="text" id="weather_id" name="weather_id"><br>
		<label for="date">Date:</label><br>
		<input type="text" id="date" name="date"><br>
		<label for="condition">Condition:</label><br>
		<input type="text" id="condition" name="condition"><br>
		<label for="temperature">Temperature:</label><br>
		<input type="text" id="temperature" name="temperature"><br>
		<label for="wind_speed">Wind Speed:</label><br>
		<input type="text" id="wind_speed" name="wind_speed"><br><br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>
