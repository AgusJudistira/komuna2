<form method="POST" action="/projects">

  {{csrf_field()}}

  <div class="form-group">
    <label for="name ">Project naam:</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  
  <div class="form-group">
    <label for="description">Beschrijving van het project:</label>
    <input type="password" class="form-control" id="description" name="description">
  </div>
  
  <div class="form-group">
    <label for="start_date">Start van het project</label>
    <input type="date" class="form-control" id="start_date" name="start_date">
  </div>

  <div class="form-group">
    <label for="start_date">Start van het project</label>
    <input type="date" class="form-control" id="start_date" name="start_date">
  </div>

  <button type="submit" class="btn btn-default">creëer project</button>
</form>