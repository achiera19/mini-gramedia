<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;
use Yajra\DataTables\Facades\DataTables;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $model = BookCategory::query();
            //hanya data yang ada di database
            //data tabel akan masuk ke halaman tabel ajax, memproses ajax secara server side
            //setelah membaca kembali control, siapkan query(menjalankan semua query terkait dengan data bookcategory)
            //selain menggunakan, data akan menampilkan hal lain tampilan yang di sesuaikan

            return DataTables::eloquent($model)
                //memberikan nomor urut
                ->addIndexColumn()
                //menambah/ mengubah data atau untuk button aksi
                ->addColumn('action', function ($data) { //dipake kalau tampilan data nya mau di styling lagi
                    $editurl = route('admin.book-categories.edit', $data->id);
                    $deleteurl = route('admin.book-categories.destroy', $data->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    $btnedit = '<a href="' . $editurl . '"class="btn btn-sm btn-warning">Edit</a>';
                    $btndelete = '<form action="' . $deleteurl . '" method="POST" class="d-inline">' . $csrf .
                        $method .
                        '<button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm(\'Apakah anda yakin ingin menghapus paket langganan ini?\')">
                                        Hapus
                                    </button>
                                </form>';
                        return $btnedit . $btndelete;
                })
                //menyimpan nama dari addColumn yang ada di html didalemnya
                ->rawColumns(['action'])
                ->toJson();
        }
        //all = mengambil semua data dari model bookcategory dan menyimpannya ke dalam variabel
        //$bookcategorys
        //compact : membuat array asosiatif dengan key 'BookCategorys' dan value $bookCategorys,
        //kemudian mengirimkan ke view 'admin.book-categories.index
        return view('admin.book-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.book-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        BookCategory::create($validateData);
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //findorFail : menacri data berdasarkan id, jika tidak ditemukan akan menampilkan error 404
        //atau bisa gunakan find() untuk mencari data berdasarkan id, jika tidak ditemukan akan mengembalikan null
        $bookCategory = BookCategory::findOrFail($id);
        return view('admin.book-categories.edit', compact('bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $bookCategory->update($validateData);
        //update digunakan pada model untuk mengubah data. namun penggunanya harus setelah proses pencarian data yang akan di ubahnya
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku telah berhasil di perbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        $bookCategory->delete();
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku telah berhasil di hapus.');
    }
}
