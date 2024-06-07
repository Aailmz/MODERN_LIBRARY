<div class="modal fade" id="createBookModal" tabindex="-1" aria-labelledby="createBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <h5 class="modal-title" id="createBookModalLabel">Add Book</h5>
                <form id="editBookForm">
                    <div class="mb-3">
                        <label for="createName" class="form-label">Title</label>
                        <input type="text" class="form-control" id="createTitle" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentEmail" class="form-label">Writer</label>
                        <input type="text" class="form-control" id="createWriter" name="writer">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentPassword" class="form-label">Publisher</label>
                        <input type="text" class="form-control" id="createPublisher" name="publisher">
                    </div>
                    <div class="mb-3">
                        <label for="createCategory" class="form-label">Category</label>
                        <select class="form-control" id="createCategory" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="createType" class="form-label">Type</label>
                        <select class="form-control" id="createType" name="type" onchange="toggleFields()">
                            <option value="offline">Offline</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editStudentPassword" class="form-label">Language</label>
                        <input type="text" class="form-control" id="createLanguage" name="language">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentEmail" class="form-label">Page</label>
                        <input type="number" class="form-control" id="createPage" name="page">
                    </div>
                    <div class="mb-3">
                        <label for="createRate" class="form-label">Rate</label>
                        <select class="form-control" id="createRate" name="rate">
                            <option value="All Ages">All Ages</option>
                            <option value="(17+) Teen">Teen</option>
                            <option value="(21+) Adult">Adult</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editStudentPassword" class="form-label">Synopsis</label>
                        <textarea class="form-control" id="createSynopsis" name="sinopsis"></textarea>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="book_picture" :value="__('Cover')" />
                        <input id="book_picture" type="file" class="form-control" name="book_picture" accept="image/*" required />
                        <x-input-error :messages="$errors->get('book_picture')" class="mt-2" />
                    </div>
                    <div class="mb-3" id="stockField">
                        <label for="editStudentEmail" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="createStock" name="stock">
                    </div>
                    <div class="mb-3" id="fileField">
                        <x-input-label for="book_file" :value="__('File')" />
                        <input id="book_file" type="file" class="form-control" name="book_file" accept="application/pdf" />
                        <x-input-error :messages="$errors->get('book_file')" class="mt-2" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveCreatedBook()">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editBookForm" enctype="multipart/form-data">
            <input type="hidden" id="editBookId" name="id">
            <div class="mb-3">
              <label for="editBookTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="editBookTitle" name="title" required>
            </div>
            <div class="mb-3">
              <label for="editBookWriter" class="form-label">Writer</label>
              <input type="text" class="form-control" id="editBookWriter" name="writer" required>
            </div>
            <div class="mb-3">
              <label for="editBookPublisher" class="form-label">Publisher</label>
              <input type="text" class="form-control" id="editBookPublisher" name="publisher" required>
            </div>
            <div class="mb-3">
                <label for="createCategory" class="form-label">Category</label>
                <select class="form-control" id="editBookCategory" name="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="createType" class="form-label">Type</label>
                <select class="form-control" id="editBookType" name="type" onchange="toggleEditFields()" disabled>
                    <option value="offline">offline</option>
                    <option value="online">online</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="editStudentPassword" class="form-label">Language</label>
                <input type="text" class="form-control" id="editBookLanguage" name="language">
            </div>
            <div class="mb-3">
                <label for="editStudentEmail" class="form-label">Page</label>
                <input type="number" class="form-control" id="editBookPage" name="page">
            </div>
            <div class="mb-3">
                <label for="createRate" class="form-label">Rate</label>
                <select class="form-control" id="editBookRate" name="rate">
                    <option value="All Ages">All Ages</option>
                    <option value="(17+) Teen">Teen</option>
                    <option value="(21+) Adult">Adult</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="editStudentPassword" class="form-label">Synopsis</label>
                <input type="text" class="form-control" id="editBookSynopsis" name="sinopsis">
            </div>
            <div class="mb-3" id="coverField">
                <label for="editBookCover" class="form-label">Cover</label>
                <input type="file" class="form-control" id="editBookCover" name="book_picture" required>
              </div>
            <div class="mb-3" id="stockEditField" style="display: none">
              <label for="editBookStock" class="form-label">Stock</label>
              <input type="number" class="form-control" id="editBookStock" name="stock">
            </div>
            <div class="mb-3" id="fileEditField" style="display: none">
              <label for="editBookFile" class="form-label">File</label>
              <input type="file" class="form-control" id="editBookFile" name="book_file">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveEditedBook()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleFields() {
        var type = document.getElementById('createType').value;
        var stockField = document.getElementById('stockField');
        var fileField = document.getElementById('fileField');

        if (type === 'offline') {
            stockField.style.display = 'block';
            fileField.style.display = 'none';
        } else if (type === 'online') {
            stockField.style.display = 'none';
            fileField.style.display = 'block';
        } 
    }

    
    // Initialize the form fields on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleFields();
    });


</script>

  

<div class="modal fade" id="bookFileModal" tabindex="-1" aria-labelledby="bookFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">View PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="bookFile" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookPictureModal" tabindex="-1" aria-labelledby="bookPictureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookPictureModalLabel">View Book Cover</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="bookPictureImage" src="" alt="Book Cover" style="width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <h5 class="modal-title" id="createCategoryModalLabel">Add Category</h5>
                <form id="editCategoryForm">
                    <div class="mb-3">
                        <label for="createdCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="createdCategory" name="category">
                    </div>
                </form>
                <hr>
                <h5>Existing Categories</h5>
                    <table class="table align-items-center mb-0" id="tablesiswa">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Category</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr id="category_{{ $category->id }}" >
                                <td style="color: black">{{ $category->category }}</td>
                                <td style="text-align: right">
                                    <i class="fas fa-trash w-30 mt-0 mb-0" onclick="saveDeleteCategory('{{ $category->id }}')" data-book-id="{{ $category->id }}" style="color: red; cursor: pointer;"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveCreatedCategory()">Add</button>
            </div>
        </div>
    </div>
</div>

