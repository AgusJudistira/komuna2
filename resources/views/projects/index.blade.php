<!DOCTYPE html>
<html>
<head>
    <title>Komuna</title>
</head>
<body>
    <div>
        <h1>Komuna</h1>
    </div>

    <div class="projectSummary">

        @foreach ($projects as $project)

        <a href="/projects/{{$project->id}}">
            
            {{ $project->name }} 
        
        </a>
        

    </div>

    @endforeach

</body>
</html>