<div class="form-group">
    <label for="movie" class="control-label">Movie</label>
    {!! Form::label('movie_id', 'Movie (only coming soon movies are displayed)') !!}
    {!! Form::select('movie_id', $movies_comingsoon, null, ['class' => 'form-control', 'placeholder' => 'Pick a movie...']) !!}
</div>
<div class="form-group">
    {!! Form::label('comment', 'Comment') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>