@extends('layouts.app')

@section('title', 'SMS History')
@section('page_heading', 'SMS History')

@section('content')
<div class="max-w-7xl mx-auto">
   <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
       <div>
           <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Message Log</h2>
           <p class="text-gray-500 dark:text-gray-400">View and manage all sent SMS messages</p>
       </div>
       <a href="{{ route('sms.index') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-xl font-semibold shadow hover:bg-primary-700 transition-colors">
           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
           Compose New
       </a>
   </div>

   <!-- Filters -->
   <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 mb-6">
       <form method="GET" action="{{ route('sms.history') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
           <div>
               <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
               <select name="type" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                   <value="" {{ !request('type') ? 'selected' : '' }}>All</value>
                   <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>General</option>
                   <option value="attendance" {{ request('type') == 'attendance' ? 'selected' : '' }}>Attendance</option>
                   <option value="fees" {{ request('type') == 'fees' ? 'selected' : '' }}>Fees</option>
                   <option value="exam" {{ request('type') == 'exam' ? 'selected' : '' }}>Exam</option>
                   <option value="notice" {{ request('type') == 'notice' ? 'selected' : '' }}>Notice</option>
               </select>
           </div>
           <div>
               <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
               <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                   <option value="">All</option>
                   <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                   <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                   <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
               </select>
           </div>
           <div>
               <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
               <input type="date" name="from" value="{{ request('from') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
           </div>
           <div>
               <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
               <input type="date" name="to" value="{{ request('to') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
           </div>
           <div class="flex items-end">
               <button type="submit" class="w-full px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                   Filter
               </button>
           </div>
       </form>
   </div>

   <!-- Messages Table -->
   <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
       <div class="overflow-x-auto">
           <table class="w-full text-left">
               <thead class="bg-gray-50 dark:bg-gray-700">
                   <tr>
                       <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Recipient</th>
                       <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Message</th>
                       <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Type</th>
                       <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Status</th>
                       <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Date</th>
                       <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Actions</th>
                   </tr>
               </thead>
               <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                   @forelse($messages as $msg)
                       <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                           <td class="px-6 py-4">
                               <div class="flex items-center">
                                   <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center text-primary-600 dark:text-primary-400 font-medium text-xs">
                                       {{ strtoupper(substr($msg->recipient, -2)) }}
                                   </div>
                                   <div class="ml-3">
                                       <p class="text-sm text-gray-900 dark:text-white">{{ $msg->recipient }}</p>
                                   </div>
                               </div>
                           </td>
                           <td class="px-6 py-4">
                               <p class="text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate" title="{{ $msg->message }}">
                                   {{ Str::limit($msg->message, 60) }}
                               </p>
                           </td>
                           <td class="px-6 py-4">
                               <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                   {{$msg->type == 'attendance' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : ''}}
                                   {{$msg->type == 'fees' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : ''}}
                                   {{$msg->type == 'exam' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : ''}}
                                   {{$msg->type == 'notice' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' : ''}}
                                   {{$msg->type == 'general' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : ''}}">
                                   {{ ucfirst(str_replace('_', ' ', $msg->type)) }}
                               </span>
                           </td>
                           <td class="px-6 py-4">
                               <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                   {{$msg->status == 'sent' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : ''}}
                                   {{$msg->status == 'failed' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : ''}}
                                   {{$msg->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : ''}}">
                                   {{ ucfirst($msg->status) }}
                               </span>
                           </td>
                           <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                               {{ $msg->created_at->format('d M Y, h:i A') }}
                           </td>
                           <td class="px-6 py-4 text-sm">
                               <form action="{{ route('sms.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this SMS record?');">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                               </form>
                           </td>
                       </tr>
                   @empty
                       <tr>
                           <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                               No SMS messages sent yet. <a href="{{ route('sms.index') }}" class="text-primary-600 hover:underline">Send your first message</a>.
                           </td>
                       </tr>
                   @endforelse
               </tbody>
           </table>
       </div>

       <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
           {{ $messages->links() }}
       </div>
   </div>
</div>
@endsection
