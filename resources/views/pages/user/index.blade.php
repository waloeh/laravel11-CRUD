@extends('layouts.app')

@section('title', 'User')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                <a href="index.html">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                    <iconify-icon icon="heroicons-outline:chevron-right"
                        class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                </a>
            </li>
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                User
            </li>
        </ul>
    </div>

    <div class=" space-y-5">
        <div class="card">
            <header class=" card-header noborder">
                <h4 class="card-title">Advanced Table</h4>
                <a href="{{ route('user.create') }}" class="btn px-1 py-0.5 text-xs inline-flex items-center btn-dark dark:bg-slate-700 dark:text-slate-300 m-0.5 btn-sm">
                    <iconify-icon class="text-base ltr:mr-0.5 rtl:ml-0.5" icon="ph:plus-bold"></iconify-icon>
                    <span>Add</span>
                </a>                             
            </header>
            <div class="card-body px-6 pb-6">
                <div class="overflow-x-auto -mx-6 dashcode-data-table">
                    <span class=" col-span-8  hidden"></span>
                    <span class="  col-span-4 hidden"></span>
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700"
                                id="data-table">
                                <thead class=" border-t border-slate-100 dark:border-slate-800">
                                    <tr>
                                        <th scope="col" class="table-th">No</th>
                                        <th scope="col" class="table-th">Nama</th>
                                        <th scope="col" class="table-th">Email</th>
                                        <th scope="col" class="table-th">Status</th>
                                        <th scope="col" class="table-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @foreach ($users as $u)
                                        <tr class="hover:bg-slate-200 dark:hover:bg-slate-700">
                                            <td class="table-td">{{ $loop->iteration }}</td>
                                            <td class="table-td">
                                                <span class="flex">
                                                    <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                        <img src="assets/images/all-img/customer_1.png" alt="1"
                                                            class="object-cover w-full h-full rounded-full">
                                                    </span>
                                                    <span
                                                        class="text-sm text-slate-600 dark:text-slate-300 capitalize">{{ $u->name }}</span>
                                                </span>
                                            </td>
                                            <td class="">{{ $u->email }}</td>
                                            <td class="table-td ">
                                                <span class="badge {{ $u->is_active ? 'bg-success-500 text-success-500' : 'bg-danger-500 text-danger-500' }} bg-opacity-30 capitalize rounded-3xl">{{ $u->is_active ? 'Aktif' : 'Non Aktif' }}</span>
                                            </td>
                                            <td class="table-td ">
                                                <div>
                                                    <div class="relative">
                                                        <div class="dropdown relative">
                                                            <button class="text-xl text-center block w-full" type="button" id="tableDropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                            </button>
                                                            <ul class="dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                                                <li>
                                                                    <a href="{{ route('user.show', $u->id) }}" class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">View</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('user.edit', $u->id) }}" class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">Edit</a>
                                                                </li>
                                                                <form id="delete-form-{{ $u->id }}" action="{{ route('user.destroy', $u->id)  }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <li>
                                                                        <button type="button" onclick="confirmDelete({{ $u->id }})" class="block px-4 py-2 font-Inter font-normal text-slate-600 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">Delete</button>
                                                                    </li>
                                                                </form>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush
