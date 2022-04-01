<div class="card border shadow mb-3 rounded-3">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center">
            <h5>
                <a href="{{ route('tag.detail', ['slug' => $tag->slug]) }}">
                    {{ Str::words($tag->title, 20) }}
                </a>
            </h5>
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

        <p class="card-text">{{ Str::words(strip_tags($tag->description), 40) }}</p>
        <div class="row">
            <div class="col-6">
                <div class="counter">{{ $tag->mh_forum_topic_count }} Forum</div>
            </div>
        </div>

    </div>
</div>
