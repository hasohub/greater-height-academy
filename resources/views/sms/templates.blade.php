@extends('layouts.app')

@section('title', 'SMS Templates')
@section('page_heading', 'SMS Templates')

@section('content')
<div class="max-w-5xl mx-auto">
   <div class="mb-8">
       <h2 class="text-2xl font-bold text-gray-900 dark:text-white">SMS Templates</h2>
       <p class="text-gray-500 dark:text-gray-400">Use these pre-defined templates for common messages. Copy and edit as needed.</p>
   </div>

   <div class="grid gap-6">
       @foreach($templates as $key => $template)
           <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden fade-in-scroll">
               <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-white dark:from-gray-700 dark:to-gray-800">
                   <div class="flex items-center justify-between">
                       <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $template['title'] }}</h3>
                       <span class="px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-semibold rounded-full">{{ $key }}</span>
                   </div>
               </div>
               <div class="p-6">
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Template Body</label>
                   <textarea readonly rows="6" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white bg-gray-50 font-mono text-sm">{{ $template['body'] }}</textarea>
                   <p class="text-xs text-gray-500 mt-2">Variables: {{ collect(explode('{{', $template['body']))
                       ->filter(fn($part) => str_contains($part, '}}'))
                       ->map(fn($part) => trim(explode('}}', $part)[0]))
                       ->implode(', ') }}</p>
               </div>
               <div class="px-6 pb-6 flex justify-end">
                   <button onclick="copyToClipboard(this)" data-template="{{ $template['body'] }}" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                       Copy Template
                   </button>
               </div>
           </div>
       @endforeach
   </div>
</div>

@push('scripts')
<script>
   function copyToClipboard(btn) {
       const text = btn.dataset.template;
       navigator.clipboard.writeText(text).then(() => {
           const original = btn.textContent;
           btn.textContent = 'Copied!';
           btn.classList.add('bg-green-600', 'hover:bg-green-700');
           btn.classList.remove('bg-primary-600', 'hover:bg-primary-700');
           setTimeout(() => {
               btn.textContent = original;
               btn.classList.remove('bg-green-600', 'hover:bg-green-700');
               btn.classList.add('bg-primary-600', 'hover:bg-primary-700');
           }, 2000);
       });
   }
</script>
@endpush

@endsection
