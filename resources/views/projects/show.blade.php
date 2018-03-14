<!DOCTYPE html>
<html>
<head>
	<title> {{ $project->name }} </title>
</head>
<body> 
	<div>
		<h1> {{ $project->name }} </h1>
		<p> {{ $project->description }}</p>
		<p> start: {{ $project->start_date }} </p>
		<p> deadline: {{ $project->due_date }}</p>
	</div>
</body>
</html>