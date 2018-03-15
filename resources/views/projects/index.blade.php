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

            <div>
            
                    <a href="/projects/{{$project->id}}">
                    
                        {{ $project->name }} 
                    
                    </a>
                        
                    <p>

                        {{ $project->description }}

                    </p>

                    <p>
                        deadline: {{ $project->due_date }}

                    </p>
                
                </div>
            
           
        @endforeach

    </div>


</body>
</html>