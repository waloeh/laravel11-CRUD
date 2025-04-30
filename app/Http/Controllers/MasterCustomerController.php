<?php

namespace App\Http\Controllers;

use App\Models\MasterCustomer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterCustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterCustomer::latest()->select(['id', 'nama_customer', 'nomor_customer', 'jenis_kelamin', 'no_hp', 'status', 'alamat'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('jenis_kelamin', function($row) {
                    return $row->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki';
                })
                ->addColumn('status', function($row) {
                    return '<span class="badge '. ($row->status ? 'bg-success-500 text-success-500' : 'bg-danger-500 text-danger-500') .' bg-opacity-30 capitalize rounded-3xl">'. ($row->status ? 'Aktif' : 'Non Aktif') .'</span>';
                })
                ->addColumn('action', function($row) {
                    $deleteForm = '
                        <form id="delete-form-'. $row->id .'" action="'. route('master-customer.destroy', $row->id) .'" method="POST">
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
                                                <a href="'. route('master-customer.show', $row->id) .'"
                                                    class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white 
                                                    hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">View</a>
                                            </li>
                                            <li>
                                                <a href="'. route('master-customer.edit', $row->id) .'"
                                                    class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white 
                                                    hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">Edit</a>
                                            </li>
                                            <li>'.$deleteForm.'</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('pages.customer.index');
    }
    
    public function create()
    {
        return view('pages.customer.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nomor_customer' => 'required|string|max:100|unique:master_customer,nomor_customer',
            'nama_customer'  => 'required|string|max:128',
            'jenis_kelamin'  => 'required|in:L,P',
            'tanggal_lahir'  => 'required|date',
            'no_hp'          => 'required|string|max:15|unique:master_customer,no_hp',
            'email'          => 'nullable|email|max:255|unique:master_customer,email',
            'alamat'         => 'nullable|string',
            'nik'            => 'nullable|string|max:16|unique:master_customer,nik',
            'status'         => 'required|boolean',
        ]);

        $customer = MasterCustomer::create($validateData);
        return redirect()->route('master-customer.index')->with('success', 'Customer created successfully.');
    }

    public function show(string $id)
    {
        $customer = MasterCustomer::findOrFail($id);
        return view('pages.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = MasterCustomer::find($id);
        return view('pages.customer.edit', compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $customer = MasterCustomer::find($id);
        $validateData = $request->validate([
            'nama_customer'  => 'required|string|max:128',
            'jenis_kelamin'  => 'required|in:L,P',
            'tanggal_lahir'  => 'required|date',
            'no_hp'          => 'required|string|max:15|unique:master_customer,no_hp,' . $id,
            'email'          => 'nullable|email|max:255|unique:master_customer,email,' . $id,
            'alamat'         => 'nullable|string',
            'nik'            => 'nullable|string|max:16|unique:master_customer,nik,' . $id,
            'status'         => 'required|boolean',
        ]);

        $customer->update($validateData);
        return redirect()->route('master-customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(string $id)
    {
        $customer = MasterCustomer::find($id);
        $customer->delete();
        return redirect()->route('master-customer.index')->with('success', 'Customer deleted successfully.');
    }
}
