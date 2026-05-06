@extends('layouts.app')

@section('title', 'SMS Settings')
@section('page_heading', 'SMS Settings')

@section('content')
<div class="max-w-3xl mx-auto">
   <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 fade-in-scroll">
       <div class="mb-8">
           <h2 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white">Africa's Talking Configuration</h2>
           <p class="text-gray-600 dark:text-gray-400">Enter your Africa's Talking API credentials to enable SMS sending.</p>
       </div>

       <form action="{{ route('sms.settings.update') }}" method="POST">
           @csrf
           <div class="space-y-6">
               <div>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">API Username</label>
                   <input type="text" name="africastalking_username" value="{{ old('africastalking_username', $settings['provider'] ?? '') }}"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500"
                          placeholder="e.g., greaterheight" required>
               </div>
               <div>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">API Key</label>
                   <input type="password" name="africastalking_api_key" value="{{ old('africastalking_api_key', '') }}"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500"
                          placeholder="••••••••" required>
                   <p class="text-xs text-gray-500 mt-1">Find this in your Africa's Talking dashboard → Settings → API Key</p>
               </div>
               <div>
                   <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sender ID (optional)</label>
                   <input type="text" name="africastalking_sender_id" value="{{ old('africastalking_sender_id', $settings['sender_id'] ?? 'GHA') }}"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500"
                          placeholder="e.g., GHA"
                          maxlength="11">
                   <p class="text-xs text-gray-500 mt-1">Up to 11 characters. Defaults to GHA. Register a custom Sender ID with Africa's Talking for branding.</p>
               </div>

               <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                   <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Auto-SMS Settings</h3>
                   <div class="space-y-3">
                       <label class="flex items-center">
                           <input type="checkbox" name="auto_sms_attendance" {{ ($settings['auto_sms_attendance'] ?? true) ? 'checked' : '' }}
                                  class="rounded text-primary-600 focus:ring-primary-500">
                           <span class="ml-3 text-gray-700 dark:text-gray-300">Send SMS alerts when student is absent/late</span>
                       </label>
                       <label class="flex items-center">
                           <input type="checkbox" name="auto_sms_fees" {{ ($settings['auto_sms_fees'] ?? true) ? 'checked' : '' }}
                                  class="rounded text-primary-600 focus:ring-primary-500">
                           <span class="ml-3 text-gray-700 dark:text-gray-300">Send fee payment reminders automatically</span>
                       </label>
                       <label class="flex items-center">
                           <input type="checkbox" name="auto_sms_results" {{ ($settings['auto_sms_results'] ?? true) ? 'checked' : '' }}
                                  class="rounded text-primary-600 focus:ring-primary-500">
                           <span class="ml-3 text-gray-700 dark:text-gray-300">Notify parents when exam results are published</span>
                       </label>
                   </div>
               </div>

               <div class="flex justify-end">
                   <button type="submit" class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                       Save Settings
                   </button>
               </div>
           </div>
       </form>
   </div>

   <!-- Test SMS -->
   <div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 fade-in-scroll">
       <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Test Connection</h3>
       <p class="text-gray-600 dark:text-gray-400 mb-4">Send a test SMS to verify your API credentials are working.</p>
       <form action="{{ route('sms.send') }}" method="POST" class="flex gap-4">
           @csrf
           <input type="hidden" name="recipients[]" value="+263XXXXXXXX">
           <input type="hidden" name="message" value="Test message from Greater Height Academy portal — everything is working! 🎉">
           <input type="hidden" name="type" value="general">
           <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
               Send Test SMS
           </button>
       </form>
   </div>
</div>
@endsection
