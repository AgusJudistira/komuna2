<!DOCTYPE html>
<html>
<head>
    <title>Komuna</title>
</head>
<body>

    @foreach ($projects as $project)
    
    <div class="projectSummary">
        
       <a href="/projects/{{$project->id}}"> 

            {{ $project->name }} 

        </a>
         
    </div>

   @endforeach

</body>
</html>