@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 via-white to-secondary-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8 overflow-hidden relative">
   <!-- Animated background elements -->
   <div class="absolute top-10 left-10 w-64 h-64 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
   <div class="absolute bottom-10 right-10 w-64 h-64 bg-secondary-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

   <div class="max-w-md w-full relative z-10 fade-in-scroll">
     <!-- Logo -->
     <div class="text-center mb-8">
       <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 shadow-lg shadow-primary-500/30 mb-4">
         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
         </svg>
       </div>
       <h2 class="text-3xl font-serif font-bold text-gray-900 dark:text-white">Welcome Back</h2>
       <p class="text-gray-600 dark:text-gray-400 mt-2">Sign in to your Greater Height Academy portal</p>
     </div>

     <!-- Error Display -->
     <x-authentication-card>
       <x-slot name="logo">
         <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mx-auto mb-4">
           <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
           </svg>
         </div>
       </x-slot>

       <!-- Session Status -->
       <div class="mb-6">
         <x-authentication-card-status :class="$status ?? 'mb-4'" />
       </div>

       <form method="POST" action="{{ route('login') }}">
         @csrf

         <!-- Email -->
         <div class="mb-6">
           <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
           <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-primary-500 focus:ring-primary-500 transition-colors"
                         type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
           <x-input-error :messages="$errors->get('email')" class="mt-2" />
         </div>

         <!-- Password -->
         <div class="mb-6">
           <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
           <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-primary-500 focus:ring-primary-500 transition-colors"
                         type="password" name="password" required autocomplete="current-password" />
           <x-input-error :messages="$errors->get('password')" class="mt-2" />
         </div>

         <!-- Remember Me -->
         <div class="block mb-6">
           <label for="remember_me" class="inline-flex items-center">
             <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700" name="remember">
             <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
           </label>
         </div>

         <!-- Submit Button -->
         <div class="mb-6">
           <x-primary-button class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] py-3 text-lg font-semibold rounded-xl">
             Sign In
           </x-primary-button>
         </div>

         <!-- Forgot Password -->
         <div class="text-center">
           @if (Route::has('password.request'))
             <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors" href="{{ route('password.request') }}">
             Forgot your password?
             </a>
           @endif
         </div>
       </form>

       <!-- Register Link -->
       <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
         <p class="text-gray-600 dark:text-gray-400">
           Don't have an account?
           <a href="{{ route('register') }}" class="text-primary-600 dark:text-primary-400 font-semibold hover:underline">Create one</a>
         </p>
       </div>
     </x-authentication-card>
   </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
