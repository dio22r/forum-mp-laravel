@extends('layouts.app')

@section('content')

<div class="d-flex mb-3 justify-content-between align-items-center">
    <div class="display-5">Detail Topic</div>
</div>
<div class="card border mb-3 rounded-3">
    <div class="card-body">
        <div class="card-title  d-flex justify-content-between align-items-center">
            <h5>{{ $tag->title }}</h5>
            <div>
                @can('update', $tag)
                <a href="{{ route('tag.edit', ['tag' => $tag]) }}" class="btn btn-sm btn-outline-warning">
                    <i class="fas fa-edit"></i>
                </a>
                @endcan

                @can('delete', $tag)
                <form class="d-inline" method="post" action="{{ route('tag.delete', ['tag' => $tag]) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin akan  menghapus data ini?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                @endcan
            </div>
        </div>
        <div class="card-text">{!! $tag->description !!}</div>
        <div class="row mt-3">
            <div class="col-12 fst-italic fw-lighter">
                Ada {{ $tag->mh_forum_topic_count }} Forum dalam Tag {{ $tag->title }}
            </div>
        </div>
    </div>
</div>

<hr class="mb-5" />
<div class="h3 mb-3 text-center ">List Forum</div>

@each('panel.forum.card_topic', $forums, 'forum')

{{ $forums->links() }}

@endsection
