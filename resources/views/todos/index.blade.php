<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-indigo-600 flex items-center gap-2">
                🚀 My Tasks
            </h2>
            <span class="bg-indigo-100 text-indigo-600 text-sm font-semibold px-4 py-1 rounded-full">
                {{ $todos->where('completed', true)->count() }} / {{ $todos->count() }} completed
            </span>
        </div>
    </x-slot>

    <div class="py-12" style="background: linear-gradient(135deg, #667eea22 0%, #764ba222 100%);">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-2xl border border-green-200 flex items-center gap-2 shadow-sm">
                    🎉 {{ session('success') }}
                </div>
            @endif

            {{-- Add todo form --}}
            <div class="p-6 rounded-3xl shadow-lg mb-6 border border-indigo-100"
                 style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-3 opacity-80">
                    ✨ New Task
                </h3>
                <form method="POST" action="{{ route('todos.store') }}" class="flex gap-3">
                    @csrf
                    <input
                        type="text"
                        name="title"
                        placeholder="What needs to be done?"
                        class="flex-1 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-white text-gray-700 shadow-inner"
                    />
                    <button type="submit"
                            class="bg-white text-indigo-600 font-bold px-6 py-3 rounded-xl hover:bg-indigo-50 transition-all shadow-md">
                        + Add
                    </button>
                </form>
                @error('title')
                <p class="text-yellow-200 text-sm mt-2">⚠️ {{ $message }}</p>
                @enderror
            </div>

            {{-- Stats --}}
            @if($todos->count() > 0)
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-white rounded-2xl p-4 text-center shadow-md border-t-4 border-indigo-400">
                        <div class="text-3xl font-black text-indigo-500">{{ $todos->count() }}</div>
                        <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">Total</div>
                    </div>
                    <div class="bg-white rounded-2xl p-4 text-center shadow-md border-t-4 border-green-400">
                        <div class="text-3xl font-black text-green-500">{{ $todos->where('completed', true)->count() }}</div>
                        <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">Done</div>
                    </div>
                    <div class="bg-white rounded-2xl p-4 text-center shadow-md border-t-4 border-orange-400">
                        <div class="text-3xl font-black text-orange-400">{{ $todos->where('completed', false)->count() }}</div>
                        <div class="text-xs font-semibold text-gray-400 mt-1 uppercase tracking-wider">Pending</div>
                    </div>
                </div>
            @endif

            {{-- Todo list --}}
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">

                {{-- Pending tasks --}}
                @php $pending = $todos->where('completed', false); @endphp
                @if($pending->count() > 0)
                    <div class="px-5 pt-5 pb-2">
                        <p class="text-xs font-bold text-orange-400 uppercase tracking-widest mb-3">📌 Pending</p>
                        @foreach($pending as $todo)
                            <div class="flex items-center justify-between p-3 mb-2 rounded-2xl bg-orange-50 border border-orange-100 hover:border-orange-300 transition-all">
                                <div class="flex items-center gap-3">
                                    <form method="POST" action="{{ route('todos.update', $todo) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                class="w-7 h-7 rounded-full border-2 border-orange-300 hover:border-indigo-500 hover:bg-indigo-500 flex items-center justify-center transition-all">
                                        </button>
                                    </form>
                                    <div>
                                        <p class="text-gray-700 font-medium">{{ $todo->title }}</p>
                                        <p class="text-xs text-gray-400">{{ $todo->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Completed tasks --}}
                @php $completed = $todos->where('completed', true); @endphp
                @if($completed->count() > 0)
                    <div class="px-5 pt-3 pb-5">
                        <p class="text-xs font-bold text-green-400 uppercase tracking-widest mb-3">✅ Completed</p>
                        @foreach($completed as $todo)
                            <div class="flex items-center justify-between p-3 mb-2 rounded-2xl bg-green-50 border border-green-100 hover:border-green-300 transition-all opacity-75">
                                <div class="flex items-center gap-3">
                                    <form method="POST" action="{{ route('todos.update', $todo) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                class="w-7 h-7 rounded-full bg-green-500 border-2 border-green-500 flex items-center justify-center text-white transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <div>
                                        <p class="text-gray-400 font-medium line-through">{{ $todo->title }}</p>
                                        <p class="text-xs text-gray-300">{{ $todo->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Empty state --}}
                @if($todos->count() === 0)
                    <div class="p-16 text-center">
                        <div class="text-6xl mb-4">🎯</div>
                        <p class="text-gray-500 font-bold text-lg">All clear!</p>
                        <p class="text-gray-300 text-sm mt-1">Add your first task above</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
