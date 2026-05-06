@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_heading', 'Dashboard')

@section('content')

@can('set school')
    @livewire('set-school')
@endcan

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="dashboard-card bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl p-6 text-white shadow-lg shadow-primary-500/25 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-primary-100 text-sm font-medium">Total Students</p>
                <p class="text-3xl font-bold mt-1">1,248</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-primary-100 mt-3">↑ 12% from last semester</p>
    </div>

    <div class="dashboard-card bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-2xl p-6 text-white shadow-lg shadow-secondary-500/25 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-secondary-100 text-sm font-medium">Teachers</p>
                <p class="text-3xl font-bold mt-1">42</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-secondary-100 mt-3">All departments active</p>
    </div>

    <div class="dashboard-card bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl p-6 text-white shadow-lg shadow-accent-500/25 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-accent-100 text-sm font-medium">Avg. Attendance</p>
                <p class="text-3xl font-bold mt-1">94.2%</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-accent-100 mt-3">↑ 2.1% this week</p>
    </div>

    <div class="dashboard-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg shadow-purple-500/25 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium">Pending Fees</p>
                <p class="text-3xl font-bold mt-1">$23,450</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-purple-100 mt-3">18 students pending</p>
    </div>
</div>

<!-- Quick Actions & Academic Year -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 fade-in-scroll">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
            <h2 class="text-xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">Academic Overview</h2>

            @livewire('set-academic-year')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="text-center p-4 bg-primary-50 dark:bg-primary-900/20 rounded-xl">
                    <p class="text-3xl font-bold text-primary-600 dark:text-primary-400">12</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Active Classes</p>
                </div>
                <div class="text-center p-4 bg-secondary-50 dark:bg-secondary-900/20 rounded-xl">
                    <p class="text-3xl font-bold text-secondary-600 dark:text-secondary-400">8</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Subjects</p>
                </div>
                <div class="text-center p-4 bg-accent-50 dark:bg-accent-900/20 rounded-xl">
                    <p class="text-3xl font-bold text-accent-600 dark:text-accent-400">3</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Upcoming Exams</p>
                </div>
            </div>
        </div>
    </div>

    <div class="fade-in-scroll">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 h-full">
            <h2 class="text-xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="{{ route('students.create') }}" class="flex items-center p-4 rounded-xl bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/30 transition-colors group">
                    <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Add Student</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Enroll a new student</p>
                    </div>
                </a>

                <a href="{{ route('teachers.create') }}" class="flex items-center p-4 rounded-xl bg-secondary-50 dark:bg-secondary-900/20 hover:bg-secondary-100 dark:hover:bg-secondary-900/30 transition-colors group">
                    <div class="w-10 h-10 bg-secondary-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Add Teacher</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Hire a new teacher</p>
                    </div>
                </a>

                <a href="{{ route('exams.index') }}" class="flex items-center p-4 rounded-xl bg-accent-50 dark:bg-accent-900/20 hover:bg-accent-100 dark:hover:bg-accent-900/30 transition-colors group">
                    <div class="w-10 h-10 bg-accent-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Manage Exams</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Create/edit exams</p>
                    </div>
                </a>

                <a href="{{ route('sms.dashboard') }}" class="flex items-center p-4 rounded-xl bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors group">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Send SMS</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Bulk messaging</p>
                    </div>
                </a>

                @role('student')
                <a href="{{ route('student.portal') }}" class="p-6 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all text-center group">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">My Student Portal</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View grades, timetable</p>
                    </div>
                </a>
                @endrole

                @role('teacher')
                <a href="{{ route('teacher.portal') }}" class="p-6 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all text-center group">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">My Teacher Portal</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Classes, grading, schedule</p>
                    </div>
                </a>
                @endrole

                @role('parent')
                <a href="{{ route('parent.portal') }}" class="p-6 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all text-center group">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">My Parent Portal</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Children overview</p>
                    </div>
                </a>
                @endrole

<!-- Recent Notices -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="fade-in-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold font-serif-heading text-gray-900 dark:text-white">Recent Notices</h2>
            <a href="{{ route('notices.index') }}" class="text-primary-600 dark:text-primary-400 text-sm font-medium hover:underline">View All</a>
        </div>
        <div class="space-y-4">
            @livewire('list-notices-table')
        </div>
    </div>

    <div class="fade-in-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
        <h2 class="text-xl font-bold font-serif-heading text-gray-900 dark:text-white mb-6">Pending Tasks</h2>
        <div class="space-y-3">
            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl">
                <div class="flex items-start">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full mt-2 mr-3"></span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Submit attendance for Class 10A</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Due in 2 hours</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                <div class="flex items-start">
                    <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3"></span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Grade Term 1 exams</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overdue by 2 days</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                <div class="flex items-start">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Staff meeting tomorrow</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">3:00 PM in Hall A</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Student Quick Links (for Student Role) -->
@if(auth()->user()->hasRole('student'))
<div class="fade-in-scroll bg-gradient-to-r from-primary-500 to-secondary-500 rounded-2xl p-8 text-white shadow-xl mb-8">
    <h2 class="text-2xl font-bold font-serif-heading mb-6">Your Academic Hub</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('students.print-profile', auth()->user()->id) }}" class="p-4 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all text-center">
            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            <p class="font-semibold">Download Profile</p>
        </a>
        <a href="{{ route('timetable.index') }}" class="p-4 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all text-center">
            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            <p class="font-semibold">My Timetable</p>
        </a>
        <a href="{{ route('exam-records.index') }}" class="p-4 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all text-center">
            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            <p class="font-semibold">Exam Results</p>
        </a>
        <a href="{{ route('fees.index') }}" class="p-4 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all text-center">
            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
            <p class="font-semibold">Fees & Payments</p>
        </a>
    </div>
</div>
@endif

@endsection
