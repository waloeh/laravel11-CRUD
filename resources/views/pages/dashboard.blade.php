@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
    
@endpush

@section('content')
<div>
    <div class="grid grid-cols-12 gap-5 mb-5">
            <div class="2xl:col-span-3 lg:col-span-4 col-span-12">
                <div class="bg-no-repeat bg-cover bg-center p-4 rounded-[6px] relative" style="background-image: url(assets/images/all-img/widget-bg-1.png)">
                    <div class="max-w-[180px]">
                        <div class="text-xl font-medium text-slate-900 mb-2">
                            Upgrade your Dashcode
                        </div>
                        <p class="text-sm text-slate-800">
                            Pro plan for better results
                        </p>
                    </div>
                    <div class="absolute top-1/2 -translate-y-1/2 ltr:right-6 rtl:left-6 mt-2 h-12 w-12 bg-white rounded-full text-xs font-medium
                        flex flex-col items-center justify-center">Now
                    </div>
                </div>
            </div>
            <div class="2xl:col-span-9 lg:col-span-8 col-span-12">
                <div class="p-4 card">
                    <div class="grid md:grid-cols-3 col-span-1 gap-4">
                        <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF] dark:bg-slate-900	 ">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                                <div class="flex-none">
                                    <div id="wline1"></div>
                                </div>
                                <div class="flex-1">
                                    <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                        Totel revenue
                                    </div>
                                    <div class="text-slate-900 dark:text-white text-lg font-medium">
                                        3,564
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-[18px] px-4 rounded-[6px] bg-[#FFEDE5] dark:bg-slate-900	 ">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                                <div class="flex-none">
                                    <div id="wline2"></div>
                                </div>
                                <div class="flex-1">
                                    <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                        Products sold
                                    </div>
                                    <div class="text-slate-900 dark:text-white text-lg font-medium">
                                        564
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900	 ">
                            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                                <div class="flex-none">
                                    <div id="wline3"></div>
                                </div>
                                <div class="flex-1">
                                    <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                        Growth
                                    </div>
                                    <div class="text-slate-900 dark:text-white text-lg font-medium">
                                        +5.0%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END: Group Chart2 -->
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-5">
            <div class="lg:col-span-8 col-span-12">
                <div class="card">
                    <div class="card-body p-6">
                        <div class="legend-ring">
                            <div id="revenue-barchart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 col-span-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">Overview</h4>
                        <div>
                            <!-- BEGIN: Card Dropdown -->
                            <div class="relative">
                                <div class="dropdown relative">
                                    <button class="text-xl text-center block w-full " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="text-lg inline-flex h-6 w-6 flex-col items-center justify-center border border-slate-200 dark:border-slate-700
                                            rounded dark:text-slate-400">
                                            <iconify-icon icon="heroicons-outline:dots-horizontal"></iconify-icon>
                                        </span>
                                    </button>
                                    <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                        shadow z-[2] overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                        <li>
                                            <a href="#" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600
                                                dark:hover:text-white">
                                                Last 28 Days</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600
                                                dark:hover:text-white">
                                                Last Month</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600
                                                dark:hover:text-white">
                                                Last Year</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END: Card Droopdown -->
                        </div>
                    </header>
                    <div class="card-body p-6">
                        <div id="radial-bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection