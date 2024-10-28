@extends('layouts.auth_layout')
@section('body')
    <section class="bg-white dark:bg-gray-900 h-screen flex items-center justify-center">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <a href="#"
                class="inline-flex justify-between items-center py-1 px-1 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                role="alert">
                <span class="text-sm font-medium bg-primary-600 rounded-full text-white px-4 py-1.5">Hey</span>
            </a>
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Did you just Forgot your password?</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                Calm, we got your back, we can fix it for you. Just write your email in the input below, so we can send the
                reset email into your account and you can get your email back!</p>

            <form class="max-w-md mx-auto mb-10">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <x-iconsax-bro-attach-circle class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="youremail@bakwankawi.corp" required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send</button>
                </div>
            </form>

            <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                <span class="font-semibold text-gray-400 uppercase">OR</span>
                <div class="flex flex-nowrap justify-center items-center gap-3 mt-8 text-gray-500 sm:justify-between">
                    <a href="{{ route('page.auth.login') }}"
                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Back
                        to login</a>
                    <a href="{{ route('page.auth.register') }}"
                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Create
                        an account</a>
                </div>
            </div>
        </div>
    </section>
@endsection
