 <!-- Modal -->
 <div class="modal fade" id="bookDelete{{ $book->id }}" tabindex="-1" aria-labelledby="bookDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookDeleteLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure that you want to delete this book? You can't undo this action once
                    confirmed
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a class="btn btn-danger delete-user-button" href="#" id="deleteBook">Yes</a>
                <form id="delete-form" action="{{ url('books/delete/' . $book->id) }}" method="POST" class="d-none">
                    @csrf
                    {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
    </div>
</div>

