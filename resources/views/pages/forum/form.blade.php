@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" integrity="sha512-0SPWAwpC/17yYyZ/4HSllgaK7/gg9OlVozq8K7rf3J8LvCjYEEIfzzpnA2/SSjpGIunCSD18r3UhvDcu/xncWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-header">
        Form Forum Topic
    </div>
    <div class="card-body">
        <form method="post" action="{{ $action_url }}" enctype="multipart/form-data">
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

            <div class="mb-1">
                <label for="images" class="form-label">Thumbnail</label>
                <input class="form-control" type="file" id="images" name="images" onchange="openImageCropper()">

                @error('images')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <img src="{{ $forum->images ? asset('storage/'.$forum->images) : '' }}" id="image-preview" width="50%">
                <input type="hidden" name="image_bas64" id="image_bas64">
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">Lampiran

                    @if ($forum->attachment)
                    <a href="{{ asset('storage/' . $forum->attachment) }}" target="_blank" class="btn btn-sm btn-warning">
                        <i class="fas fa-paperclip"></i>&nbsp; Download
                    </a>
                    @endif
                </label>
                <input class="form-control @error('attachment') is-invalid @enderror" type="file" id="attachment" name="attachment">
                @error('attachment')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>&nbsp; Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tiny.cloud/1/lpvzaq0rzbkg7bnqy10wvlse1hxnz24d38s2vs2hfljxpggx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

@include('panel.forum.modal-cropperjs')

<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        menubar: false,
        plugins: 'lists link image imagetools ',
        toolbar: 'undo redo | styleselect | bold italic | numlist bullist | link image',
        height: 300,
    });
</script>
@endsection
