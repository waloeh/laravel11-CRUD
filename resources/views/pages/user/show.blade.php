@extends('layouts.app')

@section('title', 'User')

@push('styles')
@endpush

@section('content')
    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                <a href="/">
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
                Detail</li>
        </ul>
    </div>
    <div class="space-y-5 profile-page">
        <div
            class="profiel-wrap px-[35px] pb-10 md:pt-[84px] pt-10 rounded-lg bg-white dark:bg-slate-800 lg:flex lg:space-y-0
                space-y-6 justify-between items-end relative z-[1]">
            <div class="bg-slate-900 dark:bg-slate-700 absolute left-0 top-0 md:h-1/2 h-[150px] w-full z-[-1] rounded-t-lg">
            </div>
            <div class="profile-box flex-none md:text-start text-center">
                <div class="md:flex items-end md:space-x-6 rtl:space-x-reverse">
                    <div class="flex-none">
                        <div
                            class="md:h-[186px] md:w-[186px] h-[140px] w-[140px] md:ml-0 md:mr-0 ml-auto mr-auto md:mb-0    mb-4 rounded-full ring-4
                            ring-slate-100 relative">
                            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt=""
                                class="w-full h-full object-cover rounded-full">
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-medium text-slate-900 dark:text-slate-200 mb-[3px]">
                            {{ $user->name }}
                        </div>
                        <div class="text-sm font-light text-slate-600 dark:text-slate-400">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-info-500 md:flex md:text-start text-center flex-1 max-w-[516px] md:space-y-0 space-y-4">
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                        {{ $user->created_at->diffForHumans() }}
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        Created at
                    </div>
                </div>
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                        {{ $user->updated_at->diffForHumans() }}
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        Update at
                    </div>
                </div>
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                        <span class="{{ $user->is_active ? 'text-green-500' : 'text-red-500' }}">
                            {{ $user->is_active ? 'Active' : 'Non Active' }}
                        </span>
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        Status Active
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
