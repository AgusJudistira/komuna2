 
<form method="">
	
<select multiple="">
 @foreach ($competences as $competence)
      <option>{{ $competence->competence }}</option>
  @endforeach
</select>

</form>