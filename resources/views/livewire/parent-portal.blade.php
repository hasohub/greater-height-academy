<div>
   <!-- Child Selector -->
   @if($children->count() > 1)
       <div class="mb-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 fade-in-scroll">
           <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Select Child</h3>
           <div class="flex flex-wrap gap-3">
               @foreach($children as $child)
                   <button wire:click="$set('selectedStudentId', {{ $child->id }})"
                           class="{{ ($selectedStudent?->id ?? 0) == $child->id ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}
                                  px-6 py-3 rounded-xl font-semibold transition-all hover:scale-105">
                       {{ $child->user->name ?? 'Child' }}
                   </button>
               @endforeach
           </div>
       </div>
   @endif

   @if(!$selectedStudent)
       <div class="text-center py-12">
           <p class="text-gray-500">No children linked to your account.</p>
       </div>
   @else
   <!-- Tab Navigation -->
   <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
       <nav class="flex space-x-8 overflow-x-auto" aria-label="Tabs">
           <button wire:click="$set('activeTab', 'overview')"
                   class="{{ $activeTab === 'overview' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}
                      py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
               Overview
           </button>
           <button wire:click="$set('activeTab', 'timetable')"
                   class="{{ $activeTab === 'timetable' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}
                      py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
               Timetable
           </button>
           <button wire:click="$set('activeTab', 'grades')"
                   class="{{ $activeTab === 'grades' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}
                      py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
               Grades
           </button>
           <button wire:click="$set('activeTab', 'fees')"
                   class="{{ $activeTab === 'fees' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}
                      py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
               Fees
           </button>
       </nav>
   </div>

   <!-- Overview Tab -->
   @if($activeTab === 'overview')
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
           <div class="dashboard-card bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl p-6 text-white shadow-lg">
               <h3 class="text-lg font-medium">Attendance</h3>
               <p class="text-4xl font-bold mt-2">{{ $attendanceRate }}%</p>
               <p class="text-sm opacity-90 mt-2">This semester</p>
           </div>
           <div class="dashboard-card bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-2xl p-6 text-white shadow-lg">
               <h3 class="text-lg font-medium">GPA</h3>
               <p class="text-4xl font-bold mt-2">{{ number_format($recentGrades->avg('score') / 100 * 4, 2) }}</p>
               <p class="text-sm opacity-90 mt-2">Based on recent exams</p>
           </div>
           <div class="dashboard-card bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl p-6 text-white shadow-lg">
               <h3 class="text-lg font-medium">Upcoming Exams</h3>
               <p class="text-4xl font-bold mt-2">{{ $upcomingExams->count() }}</p>
               <p class="text-sm opacity-90 mt-2">Next 7 days</p>
           </div>
           <div class="dashboard-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
               <h3 class="text-lg font-medium">Pending Fees</h3>
               <p class="text-4xl font-bold mt-2">${{ number_format($pendingFees->sum('amount'), 0) }}</p>
               <p class="text-sm opacity-90 mt-2">{{ $pendingFees->count() }} invoices</p>
           </div>
       </div>

       <div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
           <h3 class="text-xl font-bold font-serif-heading text-gray-900 dark:text-white mb-4">Quick Actions</h3>
           <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
               <a href="{{ route('students.print-profile', $selectedStudent->id) }}" class="p-6 bg-primary-50 dark:bg-primary-900/20 rounded-xl hover:bg-primary-100 dark:hover:bg-primary-900/30 transition-all text-center group">
                   <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                       <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                   </div>
                   <p class="font-semibold text-gray-900 dark:text-white">Download Profile</p>
               </a>
               <a href="#" class="p-6 bg-secondary-50 dark:bg-secondary-900/20 rounded-xl hover:bg-secondary-100 dark:hover:bg-secondary-900/30 transition-all text-center group">
                   <div class="w-12 h-12 bg-secondary-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                       <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                   </div>
                   <p class="font-semibold text-gray-900 dark:text-white">Timetable</p>
               </a>
               <a href="#" class="p-6 bg-accent-50 dark:bg-accent-900/20 rounded-xl hover:bg-accent-100 dark:hover:bg-accent-900/30 transition-all text-center group">
                   <div class="w-12 h-12 bg-accent-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                       <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                   </div>
                   <p class="font-semibold text-gray-900 dark:text-white">Exam Results</p>
               </a>
               <button class="p-6 bg-purple-50 dark:bg-purple-900/20 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all text-center group">
                   <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                       <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                   </div>
                   <p class="font-semibold text-gray-900 dark:text-white">Contact Teacher</p>
               </button>
           </div>
       </div>
   @endif

   <!-- Timetable Tab -->
   @if($activeTab === 'timetable')
       <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
           <h3 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">Weekly Timetable for {{ $selectedStudent?->user?->name ?? 'Student' }}</h3>
           <div class="overflow-x-auto">
               <table class="w-full text-left border-collapse">
                   <thead>
                       <tr class="bg-gray-50 dark:bg-gray-700">
                           <th class="p-4 text-gray-900 dark:text-white">Time</th>
                           @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $day)
                               <th class="p-4 text-gray-900 dark:text-white">{{ $day }}</th>
                           @endforeach
                       </tr>
                   </thead>
                   <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                       @for($hour = 8; $hour <= 15; $hour++)
                           <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                               <td class="p-4 text-gray-600 dark:text-gray-400">{{ sprintf('%02d:00', $hour) }} - {{ sprintf('%02d:00', $hour+1) }}</td>
                               @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $day)
                                   @php
                                       $slot = $timetable[$day]?->firstWhere('time_slot.hour', $hour);
                                   @endphp
                                   <td class="p-4">
                                       @if($slot)
                                           <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-lg border-l-4 border-primary-500">
                                               <p class="font-semibold text-gray-900 dark:text-white">{{ $slot->subject->name ?? 'Unknown' }}</p>
                                               <p class="text-sm text-gray-600 dark:text-gray-400">{{ $slot->teacher?->user?->name ?? 'TBD' }}</p>
                                           </div>
                                       @endif
                                   </td>
                               @endforeach
                           </tr>
                       @endfor
                   </tbody>
               </table>
           </div>
       </div>
   @endif

   <!-- Grades Tab -->
   @if($activeTab === 'grades')
       <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
           <div class="p-6 border-b border-gray-200 dark:border-gray-700">
               <h3 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white">Exam Results for {{ $selectedStudent?->user?->name ?? 'Student' }}</h3>
           </div>
           <div class="overflow-x-auto">
               <table class="w-full">
                   <thead class="bg-gray-50 dark:bg-gray-700">
                       <tr>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Exam</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Semester</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Subject</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Score</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">Grade</th>
                       </tr>
                   </thead>
                   <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                       @forelse($recentGrades as $record)
                           <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                               <td class="px-6 py-4">{{ $record->exam->title ?? 'N/A' }}</td>
                               <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $record->semester?->name ?? 'N/A' }}</td>
                               <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ optional($record->exam->subject)->name ?? 'Multiple' }}</td>
                               <td class="px-6 py-4">
                                   <span class="text-lg font-bold {{ $record->score >= 50 ? 'text-green-600' : 'text-red-600' }}">
                                       {{ $record->score }}%
                                   </span>
                               </td>
                               <td class="px-6 py-4">
                                   @php
                                       $grade = $record->gradeSystem->grade ?? 'N/A';
                                       $color = match(true) {
                                           $record->score >= 70 => 'bg-purple-100 text-purple-800',
                                           $record->score >= 60 => 'bg-blue-100 text-blue-800',
                                           $record->score >= 50 => 'bg-green-100 text-green-800',
                                           $record->score >= 40 => 'bg-yellow-100 text-yellow-800',
                                           default => 'bg-red-100 text-red-800',
                                       };
                                   @endphp
                                   <span class="px-2 py-1 text-sm font-semibold rounded-full {{ $color }}">{{ $grade }}</span>
                               </td>
                           </tr>
                       @empty
                           <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No exam records yet.</td></tr>
                       @endforelse
                   </tbody>
               </table>
           </div>
       </div>
   @endif

   <!-- Fees Tab -->
   @if($activeTab === 'fees')
       <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
           <h3 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">Fee Invoices</h3>
           @if($pendingFees->count() > 0)
               <div class="space-y-4">
                   @foreach($pendingFees as $invoice)
                       <div class="p-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex justify-between items-center">
                           <div>
                               <p class="font-bold text-gray-900 dark:text-white">{{ $invoice->feeCategory->name ?? 'Fee' }}</p>
                               <p class="text-sm text-gray-600 dark:text-gray-400">Due: {{ $invoice->due_date?->format('d M Y') ?? 'N/A' }}</p>
                               <p class="text-lg font-semibold text-red-600 dark:text-red-400 mt-2">${{ number_format($invoice->amount, 2) }}</p>
                           </div>
                           <button class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                               Pay Now
                           </button>
                       </div>
                   @endforeach
               </div>
           @else
               <div class="text-center py-12">
                   <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                       <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                   </div>
                   <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">All Caught Up!</h4>
                   <p class="text-gray-500 dark:text-gray-400">{{ $selectedStudent->user->name }} has no pending fees.</p>
               </div>
           @endif
       </div>
   @endif
   @endif
</div>
