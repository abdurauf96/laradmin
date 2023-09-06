<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ $book->title ?? ''}}" required>

    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ $book->description ?? ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('author') ? 'has-error' : ''}}">
    <label for="author" class="control-label">{{ 'Author' }}</label>
    <input class="form-control" name="author" type="text" id="author" value="{{ $book->author ?? ''}}" required>

    {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('year') ? 'has-error' : ''}}">
    <label for="year" class="control-label">{{ 'Year' }}</label>
    <input class="form-control" name="year" type="text" id="year" value="{{ $book->year ?? ''}}" required>

    {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('publisher') ? 'has-error' : ''}}">
    <label for="publisher" class="control-label">{{ 'Publisher' }}</label>
    <input class="form-control" name="publisher" type="text" id="publisher" value="{{ $book->publisher ?? ''}}" required>

    {!! $errors->first('publisher', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('pages') ? 'has-error' : ''}}">
    <label for="pages" class="control-label">{{ 'Pages' }}</label>
    <input class="form-control" name="pages" type="number" id="pages" value="{{ $book->pages ?? ''}}" required>

    {!! $errors->first('pages', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
