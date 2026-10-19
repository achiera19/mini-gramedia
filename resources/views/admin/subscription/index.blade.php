@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-content-between align-items-center mb-3">
            <h2>Tambah Paket Langganan</h2>
            <a href="{{ route('admin.subscription.create') }}"
                class="justify-content-end ms-auto btn btn-primary">Tambah
                Paket Langganan</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="card container">
        <div class="card-body">
            <table class="table table-bordered table-responsive bg-" id="subscription-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket Langganan</th>
                        <th>Deskripsi</th>
                        <th>Kode Warna</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <scr
    $(document).ready(function() {
        $("#subscription-table").DataTable({
            //menampilkan ikon loading
            processing: true,
            //menggunakan server side(data di proses di controller)
            serverSide: false,
            //routing yang memproses datatables
            ajax: "{{ route('admin.subscription.index') }}",
            //isi td dari table nya
            columns: [
                //data dan name : nama kolom, searchable: bisa di search ga datanya,
                //orderable: bisa di urutin ga datanya
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'name', name: 'name', orderable: true, searchable: true},
                { data: 'description', name: 'description', orderable: true, searchable: true},
                { data: 'color', name: 'color', orderable: true, searchable: true},
                { data: 'price', name: 'price', orderable: true, searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        })
    })
</script>
@endpush
