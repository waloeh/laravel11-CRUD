@extends('layouts.app')

@section('title', 'Item')

@push('styles')
@endpush

@section('content')
<div class="mb-5">
    <ul class="m-0 p-0 list-none">
        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
            <a href="index.html">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
            </a>
        </li>
        <li class="inline-block relative text-sm text-primary-500 font-Inter ">Item
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
        </li>
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Create</li>
    </ul>
</div>
<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
    <div class="card xl:col-span-2">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">Form Add Item</div>
                </div>
            </header>
            <div class="card-text h-full">
                <form action="{{ route('item.store') }}" class="space-y-4" id="multipleValidation" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="input-area">
                            <label for="code" class="form-label">Kode Item</label>
                            <input id="code" type="text" name="code" value="{{ old('code') }}" class="form-control" placeholder="Kode Item" required>
                            @error('code')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="nama" class="form-label">Nama Item</label>
                            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Nama Item" required>
                            @error('nama')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control w-full mt-2 py-2" required>
                                <option value="gas" {{ old('kategori') == 'Gas' ? 'selected' : '' }}>Gas</option>
                                <option value="cair" {{ old('kategori') == 'Cair' ? 'selected' : '' }}>Cair</option>
                            </select>
                            @error('jenis_kelamin')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="harga" class="form-label">Harga</label>
                            <input id="harga" type="number" name="harga" value="{{ old('harga') }}" class="form-control" placeholder="0" required>
                            @error('harga')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="stok" class="form-label">Stok</label>
                            <input id="stok" type="number" name="stok" value="{{ old('stok') }}" class="form-control" placeholder="0" required>
                            @error('stok')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input id="satuan" type="text" name="satuan" value="{{ old('satuan') }}" class="form-control" placeholder="Satuan" required>
                            @error('satuan')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ url()->previous() }}" class="btn flex justify-center btn-danger btn-sm">
                            <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="humbleicons:arrow-go-back"></iconify-icon>
                            <span>Back</span>
                        </a>
                        <button type="submit" class="btn flex justify-center btn-dark btn-sm">
                            <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:floppy-disk"></iconify-icon>
                            <span>Submit</span>
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection
