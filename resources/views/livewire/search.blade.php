<div class="ds-p-5 ds-border ds-border-neutral-300 ds-rounded-md ds-mb-8 py-8 px-8">
    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>

    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" id="search" wire:model.debounce.500ms.live="search"
            class="block w-1/2 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Search Title..." required>
    </div>


    @if (empty($response) && $hasSearched === true)
        <div class="text-center">
            <h1 class="text-lg p-2 font-bold">No Results Found</h1>
        </div>
    @endif
    <div class="grid gap-4 grid-cols-4 py-4">
        @if (count($response))
            @foreach ($response as $data)
                <div class="cursor-pointer flex flex-col rounded-md border-2">
                    <!-- Article -->
                    <article>
                        <img src="{{ $data['Poster'] }}" alt="poster" class="ml-auto mr-auto" />
                        <header>
                            <h1 class="text-lg p-2">
                                <p class="font-bold">
                                    {{ $data['Title'] }}
                                </p>
                            </h1>
                            <p class="text-grey-darker text-sm p-2">
                                Released: {{ $data['Released'] }}
                            </p>
                        </header>
                        <p class="text-grey-darker text-sm p-2">
                            {{ $data['Plot'] }}
                        </p>
                        <footer class="flex items-center justify-between leading-none">
                            <p class="ml-2 text-sm">
                                Director: {{ $data['Director'] }}
                            </p>
                        </footer>
                    </article>
                </div>
            @endforeach
        @endif
    </div>
</div>
