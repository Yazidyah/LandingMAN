<!-- Main modal -->
<div id="createModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full backdrop-blur-sm bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create User
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="closeCreateModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="createForm" class="p-4 md:p-5" action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter name" required>
                    </div>
                    <div class="col-span-1">
                        <x-password-input 
                            id="password"
                            name="password"
                            :label="'Password'"
                            placeholder="Enter password"
                            required
                        />
                    </div>
                    <div class="col-span-1">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Confirm password" required>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeCreateModal()" class="bg-red-900 hover:bg-red-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>
