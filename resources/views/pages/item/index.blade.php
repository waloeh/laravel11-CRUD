@extends('layouts.app')

@section('title', 'Item')

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
                Item
            </li>
        </ul>
    </div>

    <div class=" space-y-5">
        <div class="card">
            <header class=" card-header noborder">
                <h4 class="card-title">Data Item</h4>
                <a href="{{ route('item.create') }}" class="btn px-1 py-0.5 text-xs inline-flex items-center btn-dark dark:bg-slate-700 dark:text-slate-300 m-0.5 btn-sm">
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
                                        <th scope="col" class="table-th">Kode</th>
                                        <th scope="col" class="table-th">Nama</th>
                                        <th scope="col" class="table-th">Kategori</th>
                                        <th scope="col" class="table-th">Harga</th>
                                        <th scope="col" class="table-th">Stok</th>
                                        <th scope="col" class="table-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
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
    <script>
        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#data-table')) {
                $('#data-table').DataTable().destroy();
            }
            
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('item.index') }}",
                columns: [
                    { 
                        data: null, 
                        name: 'no', 
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Menampilkan nomor urut
                        },
                        orderable: false,
                        searchable: false,
                        className: 'text-center' // Posisi tengah
                    },
                    { data: 'code', name: 'code' },
                    { data: 'nama', name: 'nama' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'harga', name: 'harga' },
                    { data: 'stok', name: 'stok' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                dom: "<'grid grid-cols-12 gap-5 px-6 mt-6'<'col-span-4'l><'col-span-8 flex justify-end'f><'#pagination.flex items-center'>><'min-w-full't><'flex justify-end items-center'p>",
                paging: true,
                ordering: true,
                info: true,
                searching: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        previous: "<iconify-icon icon='ic:round-keyboard-arrow-left'></iconify-icon>",
                        next: "<iconify-icon icon='ic:round-keyboard-arrow-right'></iconify-icon>"
                    },
                    search: "Search:"
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass("hover:bg-slate-200 dark:hover:bg-slate-700 h-10");
                }
            });
        });
    </script>
@endpush

