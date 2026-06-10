{{-- Inline Flash Messages (non-toast) --}}
@if ($errors->any())
    <div x-data="{ show: true }" x-show="show"
         class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 rounded-xl p-4 mb-4 flex items-start gap-3">
        <i class="fas fa-exclamation-circle mt-0.5 flex-shrink-0"></i>
        <div class="flex-1">
            <p class="font-medium text-sm">Terdapat beberapa kesalahan:</p>
            <ul class="mt-1 text-sm list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button @click="show = false" class="text-red-400 hover:text-red-600 flex-shrink-0">
            <i class="fas fa-times text-sm"></i>
        </button>
    </div>
@endif
