 <!-- Modal -->
 <div class="modal fade" id="bookDetails{{ $book->id }}" tabindex="-1" aria-labelledby="bookDetailsLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="bookDetailsLabel">Modal title</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                <img src="{{$book->cover}}" width="150" class="float-end mb-4" alt="">
                 <form action="{{ route('book.update', ['book' => $book->id]) }}" method="POST">
                     @csrf
                     {{ method_field('PATCH') }}
                     <div class="mb-3">
                         <label for="exampleFormControlInput1" class="form-label">Name</label>
                         <input type="text" class="form-control" name="name"
                             value="{{ old('name', isset($book) ? $book->name : '') }}" id="exampleFormControlInput1"
                             placeholder="name@example.com" required>
                     </div>
                     <div class="mb-3">
                         <label for="exampleFormControlInput1" class="form-label">Author</label>
                         <input type="text" class="form-control" name="author"
                             value="{{ old('author', isset($book) ? $book->author : '') }}"
                             id="exampleFormControlInput1" placeholder="name@example.com" required>
                     </div>
                     <div class="mb-3">
                         <label for="exampleFormControlInput1" class="form-label">Cover</label>
                         <input type="file" class="form-control" name="cover" required id="exampleFormControlInput1">
                     </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                     data-bs-target="#bookDelete{{ $book->id }}">Delete</button>
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-outline-primary">Save
                     changes</button>
             </div>
             </form>
         </div>
     </div>
 </div>
