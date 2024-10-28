@extends('layouts.admin_layout')
@section('body')
    <div class="space-y-3">
        <div class="dark:text-gray-400 flex justify-between items-center">
            <h2 class="text-lg font-semibold">
                Resources
            </h2>
            <a href="{{ route('page.resource.create') }}"
                class="h-7 flex gap-1 items-center justify-center text-nowrap p-1 px-3 w-fit text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm">
                <x-iconsax-lin-add class="h-full" />
                <p>
                    Add Resource
                </p>
            </a>
        </div>

        <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
            <div class="border-b-2 border-b-gray-400 px-4 py-3 dark:border-b-gray-700 flex justify-between">
                <div class="max-w-full flex gap-4">
                    <form class="flex items-center w-full h-[35px]">
                        <div class="relative w-full h-full">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-200 dark:text-gray-200 pointer-events-none">
                                <x-iconsax-lin-search-normal-1 class="aspect-square w-4" />
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 py-0 h-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search" required />
                        </div>
                        <button type="submit"
                            class="ms-2 text-sm font-medium text-blue-200 dark:text-blue-200 bg-blue-700 rounded-lg border aspect-square h-full flex justify-center items-center border-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <x-iconsax-bol-search-normal-1 class="aspect-square h-4" />
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="relative overflow-x-auto ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                NPK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Resource Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Section
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Job
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Grading
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resource_data as $resource)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-2">
                                    {{ $resource->npk }}
                                </td>
                                <th scope="row"
                                    class="px-6 uppercase py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $resource->name }}
                                </th>
                                <td class="px-6 py-2">
                                    {{ $resource->section->name }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $resource->type->is_active ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $resource->role->name }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $resource->category->name }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $resource->email }}
                                </td>
                                <td class="px-6 py-2">
                                    <div class="flex gap-1">
                                        <a href="{{ route('page.resource.detail', ['IdResource' => $resource->id]) }}"
                                            class="h-7 aspect-square rounded-lg p-1 dark:hover:bg-gray-700 hover:bg-gray-300">
                                            <x-iconsax-bol-eye class="h-full" />
                                        </a>
                                        <a href="{{ route('page.resource.edit', ['IdResource' => $resource->id]) }}"
                                            class="h-7 aspect-square rounded-lg p-1 dark:hover:bg-gray-700 hover:bg-gray-300">
                                            <x-iconsax-bol-edit-2 class="h-full" />
                                        </a>
                                        <button data-modal-target="delete-resource-modal-{{ $resource->id }}"
                                            data-modal-toggle="delete-resource-modal-{{ $resource->id }}" type="button"
                                            class="h-7 aspect-square rounded-lg p-1 dark:hover:bg-red-300 hover:bg-red-300">
                                            <x-iconsax-bol-trash class="h-full text-red-500" />
                                        </button>
                                        <div id="delete-resource-modal-{{ $resource->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden backdrop-blur-sm transition-all duration-200 fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="delete-resource-modal-{{ $resource->id }}">
                                                        <x-iconsax-lin-add class="aspect-square h-5 rotate-45" />
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <x-iconsax-bro-info-circle
                                                            class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" />
                                                        <h3
                                                            class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                            Apakah kamu yakin untuk
                                                            menghapus data resource ini?</h3>
                                                        <div class="flex gap-3 flex-nowrap justify-center">

                                                            <form class="w-fit block"
                                                                action="{{ route('req.resource.delete', ['id' => $resource->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button data-modal-hide="delete-resource-modal-{{ $resource->id }}"
                                                                    type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Ya, hapus data
                                                                </button>
                                                            </form>
                                                            <button data-modal-hide="delete-resource-modal-{{ $resource->id }}" type="button"
                                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center px-4 py-3">
                <p class="text-sm font-semibold dark:text-gray-400 text-gray-800">Showing 1 - 123 from
                    123 data</p>
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-sm">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
