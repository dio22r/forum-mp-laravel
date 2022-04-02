<div class="card shadow border mb-3 rounded-3">
    <div class="row g-0">
        @if ($forum->images)
        <div class="col-lg-4" style="background: url({{ asset('storage/'. $forum->images) }});background-size: cover;background-position: center; ">
            <img src="{{ asset('storage/'. $forum->images) }}" class="d-lg-none" width="100%">
        </div>
        @endif
        <div class="col @if($forum->images) col-lg-8 @endif">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('forum.detail', ['slug' => $forum->slug]) }}">
                        {{ Str::words($forum->title, 20) }}
                    </a>
                </h4>
                <div class="author">oleh <span>{{ optional($forum->User)->name }}</span> pada {{ $forum->created_at }}</div>
                <p class="card-text  fw-lighter">{{ Str::words(strip_tags($forum->description), 40) }}</p>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('tag.detail', ['slug' => $forum->MhForumTag->slug]) }}" class="btn btn-sm rounded-pill btn-outline-warning">
                            &nbsp; {{ $forum->MhForumTag->title }} &nbsp;
                        </a>
                    </div>
                    <div class="col-sm-6 text-end">
                        @can('update', $forum)
                        <a href="{{ route('forum.edit', ['forum' => $forum->id]) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        @can('delete', $forum)
                        <form class="d-inline" method="post" action="{{ route('forum.delete', ['forum' => $forum->id]) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin akan  menghapus data ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
