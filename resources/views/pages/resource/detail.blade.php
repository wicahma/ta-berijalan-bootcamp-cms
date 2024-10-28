@extends('layouts.admin_layout')
@section('body')
    <div class="space-y-3 dark:text-gray-400">
        <div class="dark:text-gray-400 flex justify-between">
            <h2 class="text-lg font-semibold">
                Detail Resources
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('page.resource.edit', ['IdResource' => $detail_data->id]) }}"
                    class="h-7 rounded-lg items-center p-1 flex gap-2 cursor-pointer dark:hover:bg-gray-700 hover:bg-gray-300">
                    <p>Edit resource ini</p>
                    <x-iconsax-bol-edit-2 class="h-full" />
                </a>
                <form class="w-fit block" action="{{ route('req.resource.delete', ['id' => $detail_data->id]) }}" method="POST">
                    @csrf
                    <button data-modal-target="delete-resource-modal" data-modal-toggle="delete-resource-modal"
                        type="submit"
                        class="h-7 rounded-lg p-1 flex gap-2 items-center text-red-500 dark:hover:bg-red-300 hover:bg-red-300">
                        <p>Hapus resource ini</p>
                        <x-iconsax-bol-trash class="h-full" />
                    </button>
                </form>
            </div>
        </div>

        <div class="flex gap-3 w-full">
            <div
                class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden dark:bg-gray-800 bg-gray-200 py-4">
                <div class="px-4 pb-4">
                    <img src="" alt="user-image" class="rounded-full mx-auto aspect-square h-32 bg-gray-200" />
                    <h2 class="text-center">{{ $detail_data->name }}</h2>
                    <p class="mx-auto w-fit px-2 py-1 rounded-full bg-gray-700 text-center">{{ $detail_data->type->name }}
                    </p>
                    <div class="flex gap-2 items-center text-sm justify-center w-full px-3 my-7">
                        <div>
                            <h2 class="text-center font-semibold">Role</h2>
                            <div class="px-2 py-1 rounded-full bg-gray-700">{{ $detail_data->role->name }}</div>
                        </div>
                        <div>
                            <h2 class="text-center font-semibold">Grading</h2>
                            <div class="px-2 py-1 rounded-full bg-gray-700">{{ $detail_data->category->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="border-t dark:border-gray-700 p-4">
                    <h2 class="font-semibold">Competencies</h2>
                    @foreach ($detail_data->tbl_techstacks as $techstack)
                        <div class="flex gap-3 text-sm items-center mb-2">
                            <p class="font-medium">{{ $techstack->techstack->name }} -</p>
                            <div class="rounded-lg font-bold text-sm pb-1 px-2 bg-gray-700">
                                {{ $techstack->level }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div
                class="border grow border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden dark:bg-gray-800 bg-gray-200 py-4">
                <div class="px-4 pb-4 flex justify-between items-center border-b dark:border-gray-700 border-gray-200">
                    <h2 class="text-xl font-medium">Hello, this is {{ $detail_data->name }}</h2>
                    <div class="bg-gray-700 rounded-full px-2 py-1 text-gray-200">
                        <p>{{ $detail_data->npk }}</p>
                    </div>
                </div>
                <div class="p-4">
                    <h2 class="font-semibold text-lg">Information</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->npk }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->email }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->phone_number }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->updated_at }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->section->name }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->type->name }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->role->name }}</h2>
                    <h2 class="font-medium text-base">{{ $detail_data->category->name }}</h2>
                </div>
            </div>
        </div>
        <div id="delete-resource-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden backdrop-blur-sm transition-all duration-200 fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="delete-resource-modal">
                        <x-iconsax-lin-add class="aspect-square h-5 rotate-45" />
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <x-iconsax-bro-info-circle class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" />
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Apakah kamu yakin untuk
                            menghapus data resource ini?</h3>
                        <button data-modal-hide="delete-resource-modal" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Ya, hapus data
                        </button>
                        <button data-modal-hide="delete-resource-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
