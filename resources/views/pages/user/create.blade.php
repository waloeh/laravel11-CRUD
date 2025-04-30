@extends('layouts.app')

@section('title', 'User')

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
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                User
                <iconify-icon icon="heroicons-outline:chevron-right"
                    class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                Create</li>
        </ul>
    </div>
    <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card xl:col-span-2">
            <div class="card-body flex flex-col p-6">
                <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                    <div class="flex-1">
                        <div class="card-title text-slate-900 dark:text-white">Form Add User</div>
                    </div>
                </header>
                <div class="card-text h-full">
                    <form action="{{ route('user.store') }}" class="space-y-4" id="multipleValidation" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="input-area">
                                <label for="name" class="form-label">Name</label>
                                <div class="relative">
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        placeholder="Name" required="required">
                                        @error('name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="input-area">
                                <label for="email" class="form-label">Email</label>
                                <div class="relative">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        placeholder="Enter Your Email" required="required">
                                        @error('email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="input-area">
                                <label for="password" class="form-label">Password</label>
                                <div class="relative">
                                    <input id="password" type="password" name="password" value="{{ old('password') }}" class="form-control pr-9"
                                        placeholder="Password" required="required">
                                        @error('password')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    <button id="passIcon"
                                        class="passIcon absolute top-2.5 right-3 text-slate-300 text-xl p-0 leading-none"
                                        type="button">
                                        <iconify-icon id="passwordhide" class="inline-block"
                                            icon="heroicons-solid:eye-off"></iconify-icon>
                                        <iconify-icon id="passwordshow" class="hidden"
                                            icon="heroicons-outline:eye"></iconify-icon>
                                    </button>
                                </div>
                            </div>

                            <div class="input-area">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="relative">
                                    <input id="confirm_password" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                        class="form-control pr-9" placeholder="Password" required="required">
                                        @error('password')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    <button id="ConfirmpassIcon"
                                        class="absolute top-2.5 right-3 text-slate-300 text-xl p-0 leading-none"
                                        type="button">
                                        <iconify-icon id="passwordhide" class="inline-block"
                                            icon="heroicons-solid:eye-off"></iconify-icon>
                                        <iconify-icon id="passwordshow" class="hidden"
                                            icon="heroicons-outline:eye"></iconify-icon>
                                    </button>
                                </div>
                            </div>

                            <div class="filegroup">
                                <label>
                                    <input type="file" class=" w-full hidden" name="image" required>
                                    @error('image')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    <span class="w-full h-[40px] file-control flex items-center custom-class">
                                        <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap">
                                            <span class="text-slate-400">Choose a file or drop it here...</span>
                                        </span>
                                        <span
                                            class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm rounded-tr rounded-br font-normal">Browse</span>
                                    </span>
                                </label>
                            </div>

                            <div class="flex items-center space-x-2">
                                <label
                                    class="relative inline-flex h-6 w-[46px] items-center rounded-full transition-all duration-150 cursor-pointer">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer dark:bg-gray-900 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-black-500">
                                    </div>
                                </label>
                                <span class="text-sm text-slate-600 font-Inter font-normal">Status Active</span>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2">
                            <a href="{{ url()->previous() }}" class="btn flex justify-center btn-danger btn-sm">
                                <span class="flex items-center">
                                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="humbleicons:arrow-go-back"></iconify-icon>
                                    <span>Back</span>
                                </span>
                            </a>
                            <button type="submit" class="btn flex justify-center btn-dark btn-sm">
                                <span class="flex items-center">
                                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:floppy-disk"></iconify-icon>
                                    <span>Submit</span>
                                </span>
                            </button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
