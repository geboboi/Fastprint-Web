<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;

class ProdukController extends Controller
{    
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'status']);

        if ($request->get('filter') !== 'semua') {
            $statusBisaDijual = Status::where('nama_status', 'bisa dijual')->first();
            
            if ($statusBisaDijual) {
                $query->where('status_id', $statusBisaDijual->id_status);
            }
        }
        $data = $query->paginate(10); 
        
        $data->appends($request->all());

        return view('produk.index', compact('data'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $kategori = Kategori::all();
        $status = Status::all();
        return view('produk.create', compact('kategori', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required',
            'status_id'   => 'required',
        ]);
        
        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        $status = Status::all();
        return view('produk.edit', compact('produk', 'kategori', 'status'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required',
            'status_id'   => 'required',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
