@extends('layouts.app')

@section('title', 'Item History')

@push('styles')

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
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">Item
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">History</li>
        </ul>
    </div>

    <div class=" space-y-5">
        <div class="card">
            <header class=" card-header noborder">
                <h4 class="card-title">Histori Item</h4>                         
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
                                        <th scope="col" class="table-th">Type</th>
                                        <th scope="col" class="table-th">Kuantitas</th>
                                        <th scope="col" class="table-th">Stok Awal</th>
                                        <th scope="col" class="table-th">Stok Akhir</th>
                                        <th scope="col" class="table-th">Deskripsi</th>
                                        <th scope="col" class="table-th">Tanggal</th>
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
    <script>
        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#data-table')) {
                $('#data-table').DataTable().destroy();
            }
            
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('item.show', $id) }}",
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
                    { data: 'nama', name: 'nama' },
                    { data: 'type', name: 'type' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'previous_stock', name: 'previous_stock' },
                    { data: 'new_stock', name: 'new_stock' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
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

