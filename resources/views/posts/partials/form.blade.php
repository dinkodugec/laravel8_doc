<div><input type="text" name="title" value="{{ old('title'), optional($post ?? null)->title }}">
    @error('title')
       <div>{{ $message }}</div>
    @enderror
    <div><textarea name="content" value="{{ old('content', optional($post ?? null)->content) }}" id="" cols="30" rows="10"></textarea></div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ( $errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div><input type="submit" value="Create"></div>
    </div>
