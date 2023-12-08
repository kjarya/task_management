
<div class="justify-center py-3">
    @if (session('success'))
        <div class="text-green-600"  x-data="{show: true}" x-effect="setTimeout(() => show = false, 3000)" x-show="show">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent = "create">
        <span class="text-xs text-gray-500">Select Project</span>

        <select wire:model.live="project" class=" p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500">
            <option value=""> -- select project -- </option>
            @foreach($projects as $project)
                <option value="{{$project->id}}">{{$project->name}}</option>
           @endforeach
        </select>
        <span class="text-xs text-red-400" x-effect="setTimeout(() => show = false, 3000)" x-show="show">@error('project') {{ $message }} @enderror</span>



        <div class="flex items-center gap-x-1 mt-4" >
            <input wire:model="name" class="p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500" type="text" placeholder="Task name" />
            <button type="submit" class="items-center w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Add Task</button>
        </div>
        <span class="text-xs text-red-400" x-effect="setTimeout(() => show = false, 3000)" x-show="show">@error('name') {{ $message }} @enderror</span>
    </form>

</div>
