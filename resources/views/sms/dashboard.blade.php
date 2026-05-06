@extends('layouts.app')

@section('title', 'SMS Dashboard')
@section('page_heading', 'SMS Center')

@section('content')
<div class="max-w-7xl mx-auto">
   <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

     <!-- Compose SMS -->
     <div class="lg:col-span-2 fade-in-scroll">
         <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
             <div class="flex items-center space-x-3 mb-6">
                 <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                     <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                     </svg>
                 </div>
                 <div>
                     <h2 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white">Compose SMS</h2>
                     <p class="text-sm text-gray-500 dark:text-gray-400">Send messages to individuals or groups</p>
                 </div>
             </div>

             <form action="{{ route('sms.send') }}" method="POST" class="space-y-6">
                 @csrf

                 <!-- Recipients -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Select Recipients</label>
                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                         <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                             <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500" value="all-students" name="recipients[]" onchange="toggleAllStudents(this)">
                             <span class="ml-3 text-gray-700 dark:text-gray-300">All Students</span>
                         </label>
                         <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                             <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500" value="all-teachers" name="recipients[]">
                             <span class="ml-3 text-gray-700 dark:text-gray-300">All Teachers</span>
                         </label>
                         <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                             <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500" value="all-parents" name="recipients[]">
                             <span class="ml-3 text-gray-700 dark:text-gray-300">All Parents</span>
                         </label>
                     </div>

                     <!-- Individual selection -->
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                         <div>
                             <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Students</label>
                             <select multiple class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500" name="recipients[]" size="5">
                                 @foreach($students as $student)
                                     <option value="{{ $student->user->phone ?? 'N/A' }}">{{ $student->user->name ?? 'Unknown' }} ({{ $student->user->phone ?? 'No phone' }})</option>
                                 @endforeach
                             </select>
                             <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
                         </div>
                         <div>
                             <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Teachers</label>
                             <select multiple class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500" name="recipients[]" size="5">
                                 @foreach($teachers as $teacher)
                                     <option value="{{ $teacher->user->phone ?? 'N/A' }}">{{ $teacher->user->name ?? 'Unknown' }} ({{ $teacher->user->phone ?? 'No phone' }})</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>

                 <!-- Message Type -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message Type</label>
                     <select name="type" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                         <option value="general">General</option>
                         <option value="attendance">Attendance Alert</option>
                         <option value="fees">Fee Reminder</option>
                         <option value="exam">Exam Notification</option>
                         <option value="notice">School Notice</option>
                     </select>
                 </div>

                 <!-- Message Body -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                     <textarea name="message" rows="6" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500" placeholder="Type your message here... (max 160 chars)" maxlength="160" required></textarea>
                     <div class="flex justify-end mt-1">
                         <span id="char-count" class="text-sm text-gray-500">0/160</span>
                     </div>
                 </div>

                 <!-- Send Button -->
                 <div class="flex items-center space-x-4">
                     <button type="submit" class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                         Send SMS
                     </button>
                     <a href="{{ route('sms.history') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                         View History
                     </a>
                 </div>
             </form>
         </div>
     </div>

     <!-- Recent Messages Sidebar -->
     <div class="fade-in-scroll">
         <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
             <div class="flex items-center justify-between mb-6">
                 <h3 class="text-lg font-bold font-serif-heading text-gray-900 dark:text-white">Recent SMS</h3>
                 <a href="{{ route('sms.history') }}" class="text-primary-600 dark:text-primary-400 text-sm hover:underline">View All</a>
             </div>
             <div class="space-y-4">
                 @forelse($recentMessages as $msg)
                     <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-100 dark:border-gray-600">
                         <div class="flex items-start justify-between">
                             <div class="flex-1">
                                 <p class="text-sm text-gray-900 dark:text-white font-medium line-clamp-2">{{ Str::limit($msg->message, 50) }}</p>
                                 <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                     To: {{ Str::limit($msg->recipient, 15) }}</p>
                                 <p class="text-xs text-gray-400">{{ $msg->created_at->diffForHumans() }}</p>
                             </div>
                             <span class="px-2 py-1 text-xs font-semibold rounded-full
                                 {{$msg->status === 'sent' ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : ''}}
                                 {{$msg->status === 'failed' ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' : ''}}
                                 {{$msg->status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' : ''}}">
                                 {{ ucfirst($msg->status) }}
                             </span>
                         </div>
                     </div>
                 @empty
                     <p class="text-center text-gray-500 dark:text-gray-400 py-8">No SMS sent yet</p>
                 @endforelse
             </div>
         </div>
     </div>
   </div>
</div>

@push('scripts')
<script>
   // Character counter
   document.querySelector('textarea[name="message"]').addEventListener('input', function() {
       const count = this.value.length;
       document.getElementById('char-count').textContent = count + '/160';
       if (count > 150) {
           document.getElementById('char-count').classList.add('text-red-500');
       } else {
           document.getElementById('char-count').classList.remove('text-red-500');
       }
   });

   // Toggle all students
   function toggleAllStudents(checkbox) {
       // Expand to implement if needed
   }
</script>
@endpush

@endsection
