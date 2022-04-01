@extends('layouts.app')

@section('content')
<div class="card border mb-3 rounded-3">
    <div class="card-body">
        <form method="GET">
            <div class="input-group rounded-pill">
                <input type="text" class="form-control" name="search" placeholder="Cari Forum" aria-describedby="button-addon2" value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@each('panel.forum.card_topic', $listForum, 'forum')
{{ $listForum->withQueryString()->onEachSide(3)->links() }}

@endsection
