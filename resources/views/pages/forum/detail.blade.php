@extends('layouts.app')

@section('content')
<div class="card border mb-3 rounded-3">
    <div class="card-body">
        <h5 class="card-title">{{ $forum->title }}</h5>
        <div class="author">oleh <span>{{ optional($forum->User)->name }}</span> pada {{ $forum->created_at }}</div>
        <div class="card-text">{!! $forum->description !!}</div>
        <div class="row my-2">
            <div class="col-6">
                <a href="#" class="btn btn-sm rounded-pill btn-outline-warning">
                    &nbsp; {{ $forum->MhForumTag->title }} &nbsp;
                </a>
            </div>
            <div class="col-6 text-end">
                @can('update', $forum)
                <a href="{{ route('forum.edit', ['forum' => $forum->id]) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                @endcan
                @can('delete', $forum)
                <form class="d-inline" method="post" action="{{ route('forum.delete', ['forum' => $forum->id]) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan  menghapus data ini?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>

<hr class="mb-3" />
@if (Auth::check())

@each('panel.forum.card_comment', $comments, 'comment')

@can('create', App\Models\ThForumComment::class)
<div class="card border mb-3 rounded-3">
    <div class="card-header">
        Tambahkan Tanggapan
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('comment.store', ['forum' => $forum->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">Tanggapan</label>
                <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
                @error('comment')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="mb-1">
                <button type="submit" class="btn btn-primary">
                    Kirim Tanggapan
                </button>
            </div>
        </form>
    </div>
</div>
@endcan

{{ $comments->links() }}

@endif

@endsection
