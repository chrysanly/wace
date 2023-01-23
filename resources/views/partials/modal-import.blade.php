 <!-- Modal -->
 <div class="modal fade" id="importBook" tabindex="-1" aria-labelledby="importBookLabel" aria-hidden="true">
     <div class="modal-dialog">
         <form action="{{ url('/books/import') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="importBookLabel">Import CSV</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="mb-3">
                         <div class="input-group mb-3">
                             <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="csvFile" name="csvFile">
                                 <label class="custom-file-label" for="csvFile"
                                     aria-describedby="inputGroupFileAddon02">Choose file</label>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Import</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
