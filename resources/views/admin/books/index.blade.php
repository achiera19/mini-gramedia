@extends('layout.app')

@section('content')
    <div class="container mp-3">
        @if (session('success'))
            <div class="alert alert-success my-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Data Buku</h3>
            <a href="{{ route('admin.books.create') }}" class="btn btn-success">Tambah Data Buku</a>
        </div>
        <table class="table table-bordered mt-3" id="data-buku">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sampul Buku</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    {{-- Modal Detail --}}
    <div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <img src="" id="data-cover" class="img-fluid rounded" alt="Sampul buku" />
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-primary mb-2" id="data-title"></h3>
                            <span class="badge mb-3" id="data-category"></span>

                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Harga<br><span id="data-price" class="text-success"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Penerbit<br><span id="data-publisher"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Tanggal Rilis<br><span id="data-release-date"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Penulis<br><span id="data-writer"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Bahasa<br><span id="data-language"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Jumlah Halaman<br><span id="data-page-of-book"></span> halaman</p>
                                </div>
                            </div>
                        </div>
                          <div class="col-12">
                            <h5>Deskripsi</h5>
                            <div id="data-description" class="bg-light border rounded p-3 text-break overflow-auto"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#data-buku").DataTable({
                //menampilkan ikon loading
                processing: true,
                //menggunakan server side(data di proses di controller)
                serverSide: true,
                //routing yang memproses datatables
                ajax: "{{ route('admin.books.index') }}",
                //isi td dari table nya
                columns: [
                    //data dan name : nama kolom, searchable: bisa di search ga datanya,
                    //orderable: bisa di urutin ga datanya
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'coverImg',
                        name: 'coverImg',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    //data : dari nama field/addcolumn/editcolumn
                    //name : bookcategory.name : unutk search/sort carinya dari relasi
                    {
                        data: 'book_category_id',
                        name: 'bookCategory.name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }

                ],
            });
            //proses memunculkan modal ketika btn detail di klik
            $("#data-buku").on('click', '#btn-detail', function() {
                const btn = $(this);
                //ambil data attribut data-title="" yang dikirimn di datatable controller
                let title = btn.data('title');
                let category = btn.data('category');
                let price = "Rp" + btn.data('price');
                let publisher = btn.data('publisher');
                let writer = btn.data('writer');
                let pageOfBook = btn.data('pageOfBook');
                let releaseDate = btn.data('releaseDate');
                let language = btn.data('language');
                let description = btn.data('description');

                //simpan data ke spam yang dikosongkan modal
                $("#data-title").text(title);
                $("#data-category").text(category);
                $("#data-price").text(price);
                $("#data-publisher").text(publisher);
                $("#data-writer").text(writer);
                $("#data-page-of-book").text(pageOfBook);
                $("#data-release-date").text(releaseDate);
                $("#data-language").text(language);
                $("#data-description").html(description);

                //isi src gambar di modal dengan data cover yang dikirim di datatable controller
                let cover = btn.data('cover');
                $("#data-cover").attr("src", cover)

                //panggil modal, munculkan
                $("#modal-detail").modal("show");
            });
        });
    </script>
@endpush
