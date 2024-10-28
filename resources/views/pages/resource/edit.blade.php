@extends('layouts.admin_layout')
@section('body')
    <div class="space-y-3">
        <form action="{{ route('req.resource.update') }}" method="POST">
            @csrf
            <input type="text" hidden value="{{ $detail_data->id }}" name="id">
            <div class="dark:text-gray-400 flex justify-between items-center mb-3">
                <h2 class="text-lg font-semibold">
                    Edit Resources
                </h2>
                <div class="flex gap-1">
                    <button
                        class="h-7 items-center p-1 flex gap-2 cursor-pointer text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 text-center">
                        <x-iconsax-bol-tick-circle class="h-full" />
                        Save</button>
                </div>
            </div>

            <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                <section class="">
                    <div class="p-4 mx-auto max-w-2xl lg:py-5">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Resource Lama</h2>
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Resource</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Type product name" required="" value="{{ $detail_data->name }}">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="berijalan@bakwankawi.co" required="" value="{{ $detail_data->email }}">
                            </div>
                            <div class="w-full">
                                <label for="npk"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NPK</label>
                                <input type="text" name="npk" id="npk"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="NPK Resource" required="" value="{{ $detail_data->npk }}">
                            </div>
                            <div class="w-full">
                                <label for="phone_number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                    Number</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="084578965712" required="" value="{{ $detail_data->phone_number }}">
                            </div>
                            <div>
                                <label for="section_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                                <select id="section_id" name="section_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled>Select Section</option>
                                    <option {{ $detail_data->section_id === 1 ? 'selected=""' : '' }} value="1">
                                        Frontend</option>
                                    <option {{ $detail_data->section_id === 2 ? 'selected=""' : '' }} value="2">Backend
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="role_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select id="role_id" name="role_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected="" disabled>Select Role</option>
                                    <option {{ $detail_data->role_id === 1 ? 'selected=""' : '' }} value="1">Developer
                                    </option>
                                    <option {{ $detail_data->role_id === 2 ? 'selected=""' : '' }} value="2">System
                                        Analyst</option>
                                    <option {{ $detail_data->role_id === 3 ? 'selected=""' : '' }} value="3">Bussiness
                                        Analyst</option>
                                    <option {{ $detail_data->role_id === 4 ? 'selected=""' : '' }} value="4">Quality
                                        Control</option>
                                </select>
                            </div>

                            <div>
                                <label for="type_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select id="type_id" name="type_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected="" disabled>Select Type</option>
                                    <option {{ $detail_data->type_id === 1 ? 'selected=""' : '' }} value="1">Outsource
                                    </option>
                                    <option {{ $detail_data->type_id === 2 ? 'selected=""' : '' }} value="2">Freelance
                                    </option>
                                    <option {{ $detail_data->type_id === 3 ? 'selected=""' : '' }} value="3">Mitra
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="category_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category_id" name="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected="" disabled>Select Category</option>
                                    <option {{ $detail_data->category_id === 1 ? 'selected=""' : '' }} value="1">
                                        Graded</option>
                                    <option {{ $detail_data->category_id === 2 ? 'selected=""' : '' }} value="2">
                                        Ungraded</option>
                                </select>
                            </div>

                            <div
                                class="sm:col-span-2 rounded-lg border p-2 dark:bg-gray-800 bg-gray-200 border-gray-300 dark:border-gray-700">

                                @if (count($detail_data->tbl_techstacks) === 0)
                                    <div
                                        class="no-techstack text-center font-semibold text-xl my-5 dark:text-gray-200 text-gray-900">
                                        Tidak ada Techstack
                                    </div>
                                @endif

                                @foreach ($detail_data->tbl_techstacks as $techstack)
                                    <div class="techstack-item flex flex-nowrap gap-3 mb-3">
                                        <div class="grow">
                                            <label for="techstack[{{ $loop->index }}][id]"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Techstack</label>
                                            <select id="techstack[{{ $loop->index }}][id]"
                                                name="techstack[{{ $loop->index }}][id]"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option disabled>Select Section</option>
                                                @foreach ($techstack_data as $techstack_datas)
                                                    <option
                                                        {{ $techstack->id === $techstack_datas->id ? 'selected=""' : '' }}
                                                        value="{{ $techstack_datas->id }}">{{ $techstack_datas->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="grow">
                                            <label for="techstack[{{ $loop->index }}][level]"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level</label>
                                            <select id="techstack[{{ $loop->index }}][level]"
                                                name="techstack[{{ $loop->index }}][level]"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected="" disabled>Pilih Level</option>
                                                <option {{ $techstack->level === 1 ? 'selected=""' : '' }} value="1">
                                                    1</option>
                                                <option {{ $techstack->level === 2 ? 'selected=""' : '' }} value="2">
                                                    2</option>
                                                <option {{ $techstack->level === 3 ? 'selected=""' : '' }} value="3">
                                                    3</option>
                                                <option {{ $techstack->level === 4 ? 'selected=""' : '' }} value="4">
                                                    4</option>
                                            </select>
                                        </div>
                                        <button type="button" id="deleteTechstack"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg self-end shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm text-center aspect-square h-fit p-2.5"
                                            id="addTechstack"><x-iconsax-bol-trash class="aspect-square h-5" /></button>
                                    </div>
                                @endforeach

                                <button type="button"
                                    class="text-gray-900 w-full mt-5 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                    id="addTechstack">Add Techstack</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let i = {{ count($detail_data->tbl_techstacks) }};

        $('#addTechstack').click(function() {
            $('#addTechstack').before(addFieldSet(i));
            $('.no-techstack').remove();
            i++;
        });

        $(document).on('click', '#deleteTechstack', function() {
            $(this).closest('.techstack-item').remove();
            i--;

            if (i == 0) {
                $('#addTechstack').before(`
                    <div class="no-techstack text-center font-semibold text-xl my-5 dark:text-gray-200 text-gray-900">
                        Tidak ada Techstack
                    </div>
                `);
            }

            $('.techstack-item').each(function(index) {
                $(this).find('label[for^="techstack"]').each(function() {
                    let newFor = $(this).attr('for').replace(/\d+/, index);
                    $(this).attr('for', newFor);
                });

                $(this).find('select[id^="techstack"]').each(function() {
                    let newId = $(this).attr('id').replace(/\d+/, index);
                    $(this).attr('id', newId);

                    let newName = $(this).attr('name').replace(/\d+/, index);
                    $(this).attr('name', newName);
                });
            });
        });

        function addFieldSet(index) {
            return `
        <div class="techstack-item flex flex-nowrap gap-3 mb-3">
            <div class="grow">
                <label for="techstack[${index}][id]"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Techstack</label>
                <select id="techstack[${index}][id]" name="techstack[${index}][id]"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected="" disabled>Select Section</option>
                    @foreach ($techstack_data as $techstack)
                    <option value="{{ $techstack->id }}">{{ $techstack->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grow">
                <label for="techstack[${index}][level]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level</label>
                <select id="techstack[${index}][level]" name="techstack[${index}][level]"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected="" disabled>Pilih Level</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
                <button type="button"
                    id="deleteTechstack"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg self-end shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm text-center aspect-square h-fit p-2.5"
                    id="addTechstack"><x-iconsax-bol-trash class="aspect-square h-5" /></button>
        </div>
    `;
        }
    </script>
@endpush
