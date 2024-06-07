<div class="table-responsive p-0" id="tableOnline" style="display: none">
                    <table class="table align-items-center mb-0" id="tablesiswa">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Cover</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Title</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Writer</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Publisher</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Category</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Type</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">File</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Page</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Rate</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Language</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Sinopsis</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($onlineBooks as $book)
                            <tr id="book_{{ $book->id }}" >
                                <td>
                                    <img src="{{ $book->book_picture ? asset('storage/' . $book->book_picture) : asset('default-book-cover.jpg') }}" alt="Book Cover" style="max-width: 100px; cursor: pointer;" onclick="showBookPicture('{{ asset('storage/' . $book->book_picture) }}')">
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->writer }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->type }}</td>
                                <td>
                                  @if($book->book_file)
                                      <p onclick="showPDF('{{ asset('storage/' . $book->book_file) }}')" style="cursor: pointer">View PDF</p>
                                  @else
                                      No file
                                  @endif
                                </td>
                                <td style="display: none">{{ $book->page }}</td>
                                <td style="display: none">{{ $book->rate }}</td>
                                <td style="display: none">{{ $book->language }}</td>
                                <td style="display: none">{{ $book->sinopsis }}</td>
                                <td>
                                    <button type="button" class="btn bg-gradient-info w-30 mt-0 mb-0" onclick="editBook('{{ $book->id }}')">Edit</button>
                                    <button type="button" class="btn bg-gradient-danger w-30 mt-0 mb-0" onclick="saveDeleteBook('{{ $book->id }}')" data-book-id="{{ $book->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive p-0" id="tableOffline">
                    <table class="table align-items-center mb-0" id="tablesiswa">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Cover</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Title</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Writer</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Publisher</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Category</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Type</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Stock</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Page</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Rate</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Language</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder" style="display: none">Sinopsis</th>
                                <th class="text-uppercase text-white text-xxs font-weight-bolder">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($offlineBooks as $book)
                            <tr id="book_{{ $book->id }}" >
                                <td>
                                    <img src="{{ $book->book_picture ? asset('storage/' . $book->book_picture) : asset('default-book-cover.jpg') }}" alt="Book Cover" style="max-width: 100px; cursor: pointer;" onclick="showBookPicture('{{ asset('storage/' . $book->book_picture) }}')">
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->writer }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->type }}</td>
                                <td>{{ $book->stock }}</td>
                                <td style="display: none">{{ $book->page }}</td>
                                <td style="display: none">{{ $book->rate }}</td>
                                <td style="display: none">{{ $book->language }}</td>
                                <td style="display: none">{{ $book->sinopsis }}</td>
                                <td>
                                    <button type="button" class="btn bg-gradient-info w-30 mt-0 mb-0" onclick="editBook('{{ $book->id }}')">Edit</button>
                                    <button type="button" class="btn bg-gradient-danger w-30 mt-0 mb-0" onclick="saveDeleteBook('{{ $book->id }}')" data-book-id="{{ $book->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>