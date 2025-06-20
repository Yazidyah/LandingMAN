<div x-data="{ show: false }">
    <x-input-label for="{{ $attributes->get('id', 'password') }}" :value="$label ?? __('Password')" />
    <div class="relative">
        <x-text-input 
            {{ $attributes->merge([
                'id' => 'password',
                'class' => 'block mt-1 w-full pr-10',
                'name' => 'password',
                'autocomplete' => 'current-password',
            ]) }}
            x-bind:type="show ? 'text' : 'password'"
        />
        <button type="button" 
            class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-500"
            tabindex="-1"
            @click="show = !show"
        >
            <span x-show="!show">
                <!-- Eye Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                  <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                  <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                </svg>
            </span>
            <span x-show="show">
                <!-- Eye Off Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                  <path fill-rule="evenodd" d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l10.5 10.5a.75.75 0 1 0 1.06-1.06l-1.322-1.323a7.012 7.012 0 0 0 2.16-3.11.87.87 0 0 0 0-.567A7.003 7.003 0 0 0 4.82 3.76l-1.54-1.54Zm3.196 3.195 1.135 1.136A1.502 1.502 0 0 1 9.45 8.389l1.136 1.135a3 3 0 0 0-4.109-4.109Z" clip-rule="evenodd" />
                  <path d="m7.812 10.994 1.816 1.816A7.003 7.003 0 0 1 1.38 8.28a.87.87 0 0 1 0-.566 6.985 6.985 0 0 1 1.113-2.039l2.513 2.513a3 3 0 0 0 2.806 2.806Z" />
                </svg>
            </span>
        </button>
    </div>
    @if(isset($error))
        <x-input-error :messages="$error" class="mt-2" />
    @endif
</div>