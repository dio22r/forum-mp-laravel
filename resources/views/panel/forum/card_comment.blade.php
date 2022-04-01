<div class="card shadow border mb-3 rounded-3">
    <div class="card-body  d-flex justify-content-between">
        <div class="card-text">{{ $comment->comment }}</div>

        <div class="mt-2 ">
            @can('delete', $comment)
            <form class="d-inline" method="post" action="{{ route('comment.delete', ['comment' => $comment->id]) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin akan  menghapus data ini?')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            @endcan
        </div>
    </div>
    <div class=" card-footer">
        <div class="author">oleh <span>{{ optional($comment->User)->name }}</span> pada {{ $comment->created_at }}</div>
    </div>
</div>
