<?php

namespace App\Http\Controllers;

use App\Models\HistoriItems;
use App\Models\Items;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Items::latest()->select(['id', 'code', 'nama', 'kategori', 'harga', 'stok'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('harga', function($row) {
                    return number_format($row->harga, 0, ',', '.');
                })
                ->addColumn('stok', function($row) {
                    return number_format($row->stok, 0, ',', '.');
                })
                ->addColumn('action', function($row) {
                    $deleteForm = '
                        <form id="delete-form-'. $row->id .'" action="'. route('item.destroy', $row->id) .'" method="POST">
                            '. csrf_field() . method_field('DELETE') .'
                            <button type="button" onclick="confirmDelete('. $row->id .')"
                                class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white 
                                hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">Delete
                            </button>
                        </form>
                    ';
    
                    return '<div>
                                <div class="relative">
                                    <div class="dropdown relative">
                                        <button class="text-xl text-center block w-full" type="button"
                                            id="tableDropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 
                                            shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                            <li>
                                                <a href="'. route('item.show', $row->id) .'"
                                                    class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white 
                                                    hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">View</a>
                                            </li>
                                            <li>
                                                <a href="'. route('item.edit', $row->id) .'"
                                                    class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white 
                                                    hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">Edit</a>
                                            </li>
                                            <li>'.$deleteForm.'</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.item.index');
    }

    public function create()
    {
        return view('pages.item.create');
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code' => 'required|string|max:100|unique:items,code',
            'nama' => 'required|string|max:128',
            'kategori' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $item = Items::create($validateData);
            HistoriItems::create([
                'item_id' => $item->id,
                'user_id' => Auth::id(),
                'type' => 'in',
                'quantity' => $item->stok,
                'previous_stock' => 0,
                'new_stock' => $item->stok,
                'description' => 'Add item'
            ]);

            DB::commit();
            return redirect()->route('item.index')->with('success', 'item added succesfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('item.index')->with('success', 'Filed to add item: ' . $e->getMessage());
        }
    }

    public function show(Request $request, string $id)
    {
        if($request->ajax()) {
            $data = HistoriItems::latest()->select('histori_item.id', 'items.nama', 'histori_item.type', 'histori_item.quantity', 'histori_item.previous_stock', 'histori_item.new_stock', 'histori_item.description', 'histori_item.created_at')
            ->join('items', 'items.id', '=', 'histori_item.item_id')
            ->where('item_id', $id)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function($row) {
                    return '<span class="badge '. ($row->type == 'in' ? 'bg-success-500 text-success-500' : 'bg-danger-500 text-danger-500') .' bg-opacity-30 capitalize rounded-3xl">'. ($row->type == 'in' ? 'MASUK' : 'KELUAR') .'</span>';
                })
                ->addColumn('quantity', function($row) {
                    return number_format($row->quantity, 0, ',', '.');
                })
                ->addColumn('previous_stock', function($row) {
                    return number_format($row->previous_stock, 0, ',', '.');
                })
                ->addColumn('new_stock', function($row) {
                    return number_format($row->new_stock, 0, ',', '.');
                })
                ->addColumn('created_at', function($row) {
                    return $row->created_at->format('d-m-Y H:i:s');
                })
                ->rawColumns(['type'])
                ->make(true);
        }

        return view('pages.item.show', compact('id'));
    }

    public function edit(string $id)
    {
        $item = Items::findOrFail($id);
        return view('pages.item.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = Items::findOrFail($id);
        $validateData = $request->validate([
            'code' => 'required|string|max:100|unique:items,code,' . $id,
            'nama' => 'required|string|max:128',
            'kategori' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'nullable|string'
        ]);

        $previous_stok = $item->stok;
        $type = 'in';
        $qty = 0;
        if ($request->stok > $item->stok) {
            $qty = $request->stok - $item->stok;
        } else if ($request->stok < $item->stok) {
            $type = 'out';
            $qty = $item->stok - $request->stok;
        }

        try {
            DB::beginTransaction();
            $item->updateOrFail($validateData);
            if ($request->stok !== $previous_stok) {
                HistoriItems::create([
                    'item_id' => $item->id,
                    'user_id' => Auth::id(),
                    'type' => $type,
                    'quantity' => $qty,
                    'previous_stock' => $previous_stok,
                    'new_stock' => $request->stok,
                    'description' => 'Update item'
                ]);
            }

            DB::commit();
            return redirect()->route('item.index')->with('success', 'item updated succesfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('item.index')->with('success', 'Filed to update item: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Items::destroy($id);
        return redirect()->route('item.index')->with('success', 'item deleted succesfully.');
    }
}
