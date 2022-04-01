@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        Form Forum Topic
    </div>
    <div class="card-body">
        <form method="post" action="{{ $action_url }}">
            @csrf
            @method($method)
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input value="{{ $forum->title }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Judul Forum">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control tinymce" id="description" name="description" rows="3">{{ $forum->description }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mh_forum_tag_id" class="form-label">Tags</label>
                <select class="form-select  @error('mh_forum_tag_id') is-invalid @enderror" id="mh_forum_tag_id" name="mh_forum_tag_id">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @if($tag->id == $forum->mh_forum_tag_id) selected @endif>{{ $tag->title }}</option>
                    @endforeach
                </select>
                @error('mh_forum_tag_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/lpvzaq0rzbkg7bnqy10wvlse1hxnz24d38s2vs2hfljxpggx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        height: 300,
        menubar: false
    });
</script>
@endsection
