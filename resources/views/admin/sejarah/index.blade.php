<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Pengaturan Sejarah</h1>
                <form action="{{ route('admin.sejarah.store') }}" method="POST"
                    class="w-full max-w-4xl mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label for="sejarah" class="block text-gray-700 text-2xl font-bold mb-2">Sejarah:</label>
                        <textarea name="sejarah" id="sejarah" rows="12"
                            class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg ring-2 ring-tertiary h-64">{{ $sejarah->body ?? '' }}</textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="w-full flex justify-center">
                            <button type="submit"
                                class="bg-tertiary hover:bg-secondary hover:text-tertiary text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline text-lg">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>