@extends('layouts.app')

@section('title', 'Customer')

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
        <li class="inline-block relative text-sm text-primary-500 font-Inter ">Customer
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
        </li>
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Edit</li>
    </ul>
</div>
<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
    <div class="card xl:col-span-2">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">FormEdit Customer</div>
                </div>
            </header>
            <div class="card-text h-full">
                <form action="{{ route('master-customer.update', $customer->id) }}" class="space-y-4" id="multipleValidation" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="input-area">
                            <label for="nama_customer" class="form-label">Nama Customer</label>
                            <input id="nama_customer" type="text" name="nama_customer" value="{{ $customer->nama_customer ?? old('nama_customer') }}" class="form-control" placeholder="Nama Customer" required>
                            @error('nama_customer')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="nomor_customer" class="form-label">Nomor Customer</label>
                            <input id="nomor_customer" type="text" name="nomor_customer" value="{{ $customer->nomor_customer ?? old('nomor_customer') }}" class="form-control" placeholder="Nomor Customer" disabled>
                            @error('nomor_customer')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control w-full mt-2 py-2" required>
                                <option value="L" {{ $customer->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $customer->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ $customer->tanggal_lahir->format('Y-m-d') }}" class="form-control" required>
                            @error('tanggal_lahir')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input id="no_hp" type="text" name="no_hp" value="{{ $customer->no_hp ?? old('no_hp') }}" class="form-control" placeholder="Nomor HP" required>
                            @error('no_hp')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ $customer->email ?? old('email') }}" class="form-control" placeholder="Email">
                            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Lengkap">{{ $customer->email ?? old('alamat') }}</textarea>
                            @error('alamat')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="input-area">
                            <label for="nik" class="form-label">NIK</label>
                            <input id="nik" type="text" name="nik" value="{{ $customer->nik ?? old('nik') }}" class="form-control" placeholder="Nomor NIK">
                            @error('nik')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div> 
                        <div class="flex items-center space-x-2">
                            <label class="relative inline-flex h-6 w-[46px] items-center rounded-full transition-all duration-150 cursor-pointer">
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" class="sr-only peer" value="1" {{ $customer->status ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer dark:bg-gray-900 peer-checked:bg-black-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full"></div>
                            </label>
                            <span class="text-sm text-slate-600 font-Inter font-normal">Status Active</span>
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
