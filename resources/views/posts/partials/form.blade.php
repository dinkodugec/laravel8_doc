
<div>
    <div class="form-group">
        <label for="title">Title</label>
    <input type="text" name="title" class="form-control" placeholder=" title " value="{{ old('title'), optional($post ?? null)->title }}">
    @error('title')
       <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

    <div class="form-group mt-5">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" placeholder="content here" value="{{ old('content', optional($post ?? null)->content) }}" id="" cols="30" rows="10">
        </textarea>
        @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
     @enderror
    </div>

    @if ($errors->any())
        <div class="mb-3">
            <ul class="list-group">
                @foreach ( $errors->all() as $error)
                  <li class="list-group-item list-group-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group mt-5">
        <label for="">Thumbnail</label>
        <input type="file" class="form-control-file" name="thumbnail" value="">
    </div>




</div>


