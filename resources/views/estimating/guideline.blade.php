<x-app-layout>
    <x-slot name="pageheader">
        {{ __('Guidelines') }}
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('guidelines.store')}}" method="POST" id="guidelinesForm" class="justify-center flex p-2">
                    @csrf
                    <div class="flex items-center w-full m-2">
                        <x-input-label class="mr-2">Guideline</x-input-label>
                        <x-text-input name='guideline' class="w-full" />
                    </div>
                </form>
                <div class="p-4">
                    @foreach($guidelines as $guideline)
                    <div class="flex items-center">
                        <x-text-input class="bg-gray-100 w-full" value="{{$guideline->guideline}}" :disabled="$guideline->id != $id" />
                        @if($guideline->user_id == auth()->user()->id)
                            @if($guideline->id != $id)
                                <a href="/references/guidelines/{{$guideline->id}}/edit"><i class="fa-solid p-2 fa-pen-to-square"></i></a>
                            @else
                                <form action="/references/guidelines/{{$guideline->id}}" method="POST" class="cursor-pointer">
                                    @csrf
                                    @method('PUT')
                                    <button>
                                        <i class="fa-solid fa-check p-2"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="/references/guidelines/{{$guideline->id}}" method="POST" class="cursor-pointer">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <i class="fa-solid fa-trash px-2"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="mt-6 p-4">
            {{$guidelines->links()}}
        </div>
    </div>
</x-app-layout>