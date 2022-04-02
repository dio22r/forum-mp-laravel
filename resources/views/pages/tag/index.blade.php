@extends('layouts.app')

@section('content')
<div class="card border mb-3 rounded-3">
    <div class="card-body">
        <form method="GET">
            <div class="input-group rounded-pill">
                <input type="text" class="form-control" name="search" placeholder="Cari Topic" aria-describedby="button-addon2" value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="d-flex mb-3 justify-content-between align-items-center">
    <div class="display-5">List Topic</div>


    @can('create', new App\Models\MhForumTag())
    <a href="{{ route('tag.add') }}" class="btn px-3 rounded-pill btn-outline-primary">
        <i class="fas fa-tag"></i> Buat Topic
    </a>
    @endcan
</div>
@each('panel.forum.card_tag', $listTag, 'tag')
{{ $listTag->withQueryString()->links() }}

@endsection
