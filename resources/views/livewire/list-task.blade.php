<div>
    <div class="text-xs text-center">
        @if (session('success'))
            <div class="text-green-600"  x-data="{show: true}" x-effect="setTimeout(() => show = false, 3000)" x-show="show">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <ul role="list" class="divide-y divide-gray-100" wire:sortable="updateTaskOrder">

        @forelse($tasks as $task)

        <li class="flex justify-between gap-x-6 py-5" wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
            <div class="flex min-w-0 gap-x-4">

                <div class="min-w-0 flex-auto"  wire:sortable.handle>
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        {{$task->name}}
                    </p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">Created {{$task->created_at->diffForHumans()}}</p>
                </div>
            </div>

            <div class="shrink-0 items-end flex gap-x-2">

                <!------ Update Task Button ---------->
                <button
                    wire:click="$dispatch('show-task-modal', { task: {{ $task->id }} })"
                    class="bg-gray-600  p-2 rounded-lg bg-amber-500 text-center font-sans text-xs  uppercase text-black shadow-md transition-all hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button"
                    data-ripple-light="true"
                >

                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                    <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                    </svg>

                </button>

                <!----- Delete Task Button ---->
                <button
                    wire:click="delete({{$task}})"
                    wire:confirm="Are you sure you want to delete this task?"
                    class="bg-red-600 p-2 rounded-lg bg-amber-500 text-center font-sans text-xs  uppercase text-black shadow-md transition-all hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button"
                    data-ripple-light="true"
                >

                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                    </svg>

                </button>
            </div>
        </li>
        @empty

        <div class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
            <div class="text-center">

                <h1 class="mt-4 text-3xl font-bold tracking-tight text-red-600 sm:text-5xl">!</h1>
                <p class="mt-6 text-base leading-7 text-gray-600">No task added!</p>

            </div>
        </div>

        @endforelse


        <!---- Edit Task Modal Form --->

        <div x-data="{ showModal: @entangle('editTask')}">
            <!-- Background overlay -->
            <div x-show="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true"  @click="$wire.set('editTask', false)">
              <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <!-- Modal -->
            <div x-show="showModal" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
              <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Modal panel -->
                <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                  <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Modal content -->
                    <div class="sm:flex sm:items-start">

                        <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">Edit Task </h3>
                            <div class="mt-2">
                                <input wire:model="name" class="mt-2 p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500" >
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <!-- Update button -->
                    <button wire:click="update({{$id}})" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"> Update</button>

                    <!-- Cancel button -->
                    <button @click="$wire.set('editTask', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Cancel </button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </ul>
</div>

