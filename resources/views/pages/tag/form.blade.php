@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        Form Topic
    </div>
    <div class="card-body">
        <form method="post" action="{{ $action_url }}">
            @csrf
            @method($method)
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input value="{{ $tag->title }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Judul Forum">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control tinymce" id="description" name="description" rows="3">{{ $tag->description }}</textarea>
                @error('description')
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
