<div>
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
               My Schedule
           </button>
           <button wire:click="$set('activeTab', 'subjects')"
                   class="{{ $activeTab === 'subjects' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}
                      py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
               Classes
           </button>
           <button wire:click="$set('activeTab', 'grading')"
                   class="{{ $activeTab === 'grading' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}
                      py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
               Grading
           </button>
       </nav>
   </div>

   <!-- Overview -->
   @if($activeTab === 'overview')
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
           <div class="dashboard-card bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl p-6 text-white shadow-lg">
               <p class="text-4xl font-bold">{{ $assignedSubjects->count() }}</p>
               <p class="text-sm opacity-90 mt-2">Subjects Teaching</p>
           </div>
           <div class="dashboard-card bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-2xl p-6 text-white shadow-lg">
               <p class="text-4xl font-bold">{{ $todayTimetable->count() }}</p>
               <p class="text-sm opacity-90 mt-2">Classes Today</p>
           </div>
           <div class="dashboard-card bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl p-6 text-white shadow-lg">
               <p class="text-4xl font-bold">{{ $upcomingExams->count() }}</p>
               <p class="text-sm opacity-90 mt-2">Upcoming Exams</p>
           </div>
           <div class="dashboard-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
               <p class="text-4xl font-bold">{{ $recentGrading->count() }}</p>
               <p class="text-sm opacity-90 mt-2">Recent Grades</p>
           </div>
       </div>

       <!-- Quick Links -->
       <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
           <a href="{{ route('timetables.index') }}" class="dashboard-card p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all text-center group">
               <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110">
                   <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
               </div>
               <p class="font-semibold text-gray-900 dark:text-white">My Timetable</p>
           </a>
           <a href="{{ route('exams.index') }}" class="dashboard-card p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all text-center group">
               <div class="w-12 h-12 bg-secondary-100 dark:bg-secondary-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110">
                   <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
               </div>
               <p class="font-semibold text-gray-900 dark:text-white">Manage Exams</p>
           </a>
           <a href="{{ route('exam-records.index') }}" class="dashboard-card p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all text-center group">
               <div class="w-12 h-12 bg-accent-100 dark:bg-accent-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110">
                   <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
               </div>
               <p class="font-semibold text-gray-900 dark:text-white">Enter Grades</p>
           </a>
           <a href="{{ route('sms.index') }}" class="dashboard-card p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all text-center group">
               <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110">
                   <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
               </div>
               <p class="font-semibold text-gray-900 dark:text-white">Send SMS</p>
           </a>
       </div>
   @endif

   <!-- Timetable Tab -->
   @if($activeTab === 'timetable')
       <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
           <h3 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">Today's Schedule</h3>
           @if($todayTimetable->count())
               <div class="space-y-4">
                   @foreach($todayTimetable as $slot)
                       <div class="p-4 bg-primary-50 dark:bg-primary-900/20 border-l-4 border-primary-500 rounded-xl flex justify-between items-center">
                           <div>
                               <p class="font-bold text-gray-900 dark:text-white">{{ $slot->subject->name ?? 'Unknown' }}</p>
                               <p class="text-sm text-gray-600 dark:text-gray-400">
                                   {{ $slot->myClass->name ?? '' }} {{ $slot->section->name ?? '' }}
                                   • {{ $slot->timeSlot->start_time?->format('h:i A') ?? '' }}
                               </p>
                           </div>
                           <span class="px-3 py-1 bg-primary-100 dark:bg-primary-900/40 text-primary-700 dark:text-primary-300 rounded-full text-sm">
                               {{ $slot->timeSlot->start_time?->format('h:i A') ?? '' }} - {{ $slot->timeSlot->end_time?->format('h:i A') ?? '' }}
                           </span>
                       </div>
                   @endforeach
               </div>
           @else
               <p class="text-center text-gray-500 py-12">No classes scheduled for today.</p>
           @endif
       </div>
   @endif

   <!-- Subjects / Classes Tab -->
   @if($activeTab === 'subjects')
       <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
           <h3 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">My Classes & Subjects</h3>
           <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
               @foreach($assignedSubjects as $subject)
                   <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600">
                       <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $subject->name }}</h4>
                       <p class="text-gray-600 dark:text-gray-400 mb-4">
                           {{ $subject->myClass->name ?? 'N/A' }} {{ $subject->section->name ?? '' }}
                       </p>
                       <div class="flex items-center space-x-3">
                           <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                               {{ strtoupper(substr($subject->teachers->first()->user->name ?? 'T', 0, 1)) }}
                           </div>
                           <div>
                               <p class="text-sm font-medium text-gray-900 dark:text-white">
                                   {{ $subject->teachers->first()->user->name ?? 'Not assigned' }}
                               </p>
                               <p class="text-xs text-gray-500">Teacher</p>
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>
       </div>
   @endif

   <!-- Grading Tab -->
   @if($activeTab === 'grading')
       <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
           <div class="p-6 border-b border-gray-200 dark:border-gray-700">
               <h3 class="text-2xl font-bold font-serif-heading text-gray-900 dark:text-white">Recent Grading Activity</h3>
           </div>
           <div class="overflow-x-auto">
               <table class="w-full">
                   <thead class="bg-gray-50 dark:bg-gray-700">
                       <tr>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900">Student</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900">Exam</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900">Subject</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900">Score</th>
                           <th class="px-6 py-4 text-sm font-semibold text-gray-900">Date</th>
                       </tr>
                   </thead>
                   <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                       @forelse($recentGrading as $record)
                           <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                               <td class="px-6 py-4">
                                   <div class="flex items-center space-x-3">
                                       <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center text-primary-600 dark:text-primary-400 font-medium text-xs">
                                           {{ strtoupper(substr($record->student->user?->name ?? 'S', 0, 1)) }}
                                       </div>
                                       <span class="text-gray-900 dark:text-white">{{ $record->student->user?->name ?? 'Unknown' }}</span>
                                   </div>
                               </td>
                               <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $record->exam->title ?? 'N/A' }}</td>
                               <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $record->exam->subject->name ?? 'General' }}</td>
                               <td class="px-6 py-4">
                                   <span class="text-lg font-bold {{ $record->score >= 50 ? 'text-green-600' : 'text-red-600' }}">
                                       {{ $record->score }}%
                                   </span>
                               </td>
                               <td class="px-6 py-4 text-gray-500 text-sm">{{ $record->created_at->format('d M') }}</td>
                           </tr>
                       @empty
                           <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No grading activity yet.</td></tr>
                       @endforelse
                   </tbody>
               </table>
           </div>
       </div>
   @endif
</div>
