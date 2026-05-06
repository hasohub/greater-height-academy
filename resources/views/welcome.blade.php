@extends('layouts.guest')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-50 via-white to-secondary-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800">
   <!-- Animated background orbs -->
   <div class="absolute top-20 left-10 w-72 h-72 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
   <div class="absolute top-20 right-10 w-72 h-72 bg-secondary-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
   <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-accent-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

   <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
     <!-- Logo & Brand -->
     <div class="mb-8 fade-in-scroll">
       <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 shadow-lg shadow-primary-500/30 mb-6">
         <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
         </svg>
       </div>
       <h1 class="text-5xl md:text-7xl font-serif font-bold bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 bg-clip-text text-transparent mb-4">
         Greater Height Academy
       </h1>
       <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
         Empowering the next generation through <span class="text-primary-600 dark:text-primary-400 font-semibold">excellence</span>,
         <span class="text-secondary-600 dark:text-secondary-400 font-semibold">innovation</span>, and
         <span class="text-accent-600 dark:text-accent-400 font-semibold">character</span>.
       </p>
     </div>

     <!-- CTA Buttons -->
     <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10 fade-in-scroll">
       <a href="{{ route('login') }}"
          class="group relative px-8 py-4 bg-primary-600 text-white rounded-full font-semibold text-lg shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:scale-105 transition-all duration-300 overflow-hidden">
         <span class="relative z-10">Access Portal</span>
         <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-600 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300"></div>
       </a>
       <a href="#features"
          class="px-8 py-4 border-2 border-primary-600 text-primary-600 dark:text-primary-400 rounded-full font-semibold text-lg hover:bg-primary-50 dark:hover:bg-gray-800 transition-all duration-300">
         Explore Features
       </a>
     </div>

     <!-- Stats -->
     <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto fade-in-scroll">
       <div class="text-center">
         <div class="text-4xl md:text-5xl font-bold text-primary-600 dark:text-primary-400 counter" data-count="500">0</div>
         <p class="text-gray-600 dark:text-gray-400 mt-2">Students Enrolled</p>
       </div>
       <div class="text-center">
         <div class="text-4xl md:text-5xl font-bold text-secondary-600 dark:text-secondary-400 counter" data-count="45">0</div>
         <p class="text-gray-600 dark:text-gray-400 mt-2">Expert Teachers</p>
       </div>
       <div class="text-center">
         <div class="text-4xl md:text-5xl font-bold text-accent-600 dark:text-accent-400 counter" data-count="98">0</div>
         <p class="text-gray-600 dark:text-gray-400 mt-2">% Pass Rate</p>
       </div>
       <div class="text-center">
         <div class="text-4xl md:text-5xl font-bold text-primary-600 dark:text-primary-400 counter" data-count="15">0</div>
         <p class="text-gray-600 dark:text-gray-400 mt-2">Years of Excellence</p>
       </div>
     </div>
   </div>

   <!-- Scroll indicator -->
   <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
     <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
     </svg>
   </div>
</section>

<!-- Features Section -->
<section id="features" class="py-24 bg-white dark:bg-gray-800">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
     <div class="text-center mb-16 fade-in-scroll">
       <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 dark:text-white mb-4">
         Why Choose Greater Height Academy?
       </h2>
       <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
         A world-class education management platform designed for tomorrow's leaders.
       </p>
     </div>

     <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
       <!-- Feature 1 -->
       <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:shadow-2xl hover:shadow-primary-500/10 transition-all duration-300 hover:-translate-y-2 fade-in-scroll">
         <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
           <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
           </svg>
         </div>
         <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Comprehensive Curriculum</h3>
         <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
           Holistic education covering academics, arts, sports, and character development for well-rounded growth.
         </p>
       </div>

       <!-- Feature 2 -->
       <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:shadow-2xl hover:shadow-secondary-500/10 transition-all duration-300 hover:-translate-y-2 fade-in-scroll">
         <div class="w-14 h-14 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
           <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
           </svg>
         </div>
         <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Expert Educators</h3>
         <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
           Passionate teachers with advanced qualifications and a track record of excellence.
         </p>
       </div>

       <!-- Feature 3 -->
       <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:shadow-2xl hover:shadow-accent-500/10 transition-all duration-300 hover:-translate-y-2 fade-in-scroll">
         <div class="w-14 h-14 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
           <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
           </svg>
         </div>
         <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Modern Technology</h3>
         <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
           State-of-the-art facilities with smart classrooms and cutting-edge digital learning tools.
         </p>
       </div>

       <!-- Feature 4 -->
       <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:shadow-2xl hover:shadow-primary-500/10 transition-all duration-300 hover:-translate-y-2 fade-in-scroll">
         <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
           <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
           </svg>
         </div>
         <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Safe Environment</h3>
         <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
           Secure campus with 24/7 monitoring and caring staff dedicated to student wellbeing.
         </p>
       </div>

       <!-- Feature 5 -->
       <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:shadow-2xl hover:shadow-secondary-500/10 transition-all duration-300 hover:-translate-y-2 fade-in-scroll">
         <div class="w-14 h-14 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
           <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
           </svg>
         </div>
         <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Instant Communication</h3>
         <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
           Real-time updates for parents via SMS and our integrated parent-teacher communication portal.
         </p>
       </div>

       <!-- Feature 6 -->
       <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:shadow-2xl hover:shadow-accent-500/10 transition-all duration-300 hover:-translate-y-2 fade-in-scroll">
         <div class="w-14 h-14 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
           <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
           </svg>
         </div>
         <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Performance Tracking</h3>
         <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
           Detailed analytics and progress reports for every student, accessible to parents anytime.
         </p>
       </div>
     </div>
   </div>
</section>

<!-- About Section -->
<section class="py-24 bg-gray-50 dark:bg-gray-900">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
     <div class="grid lg:grid-cols-2 gap-16 items-center">
       <div class="fade-in-scroll">
         <img src="{{ asset('img/logo/logo-placeholder.png') }}"
              alt="Greater Height Academy Campus"
              class="rounded-2xl shadow-2xl w-full object-cover">
       </div>
       <div class="fade-in-scroll">
         <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 dark:text-white mb-6">
           About Greater Height Academy
         </h2>
         <p class="text-lg text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
           Founded with a vision to redefine education, Greater Height Academy stands as a beacon of academic
           excellence and character formation. We believe every child has unique potential waiting to be unlocked.
         </p>
         <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
           Our integrated digital portal brings parents, teachers, and students together in a seamless
           ecosystem of learning and growth. Track progress, communicate instantly, and stay connected
           with your child's educational journey.
         </p>
         <a href="{{ route('login') }}"
            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-full font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
           Get Started Today
           <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
           </svg>
         </a>
       </div>
     </div>
   </div>
</section>

<!-- Call to Action -->
<section class="py-24 bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-600 text-white relative overflow-hidden">
   <div class="absolute inset-0 opacity-10">
     <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%221%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E')]"></div>
   </div>

   <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
     <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">
       Ready to Join Greater Height Academy?
     </h2>
     <p class="text-xl text-primary-100 mb-10 max-w-2xl mx-auto">
       Take the first step towards a world-class education. Access the portal to begin your journey.
     </p>
     <div class="flex flex-col sm:flex-row gap-4 justify-center">
       <a href="{{ route('register') }}"
          class="px-10 py-4 bg-white text-primary-700 rounded-full font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
         Apply Now
       </a>
       <a href="{{ route('login') }}"
          class="px-10 py-4 border-2 border-white/50 text-white rounded-full font-semibold text-lg hover:bg-white/10 backdrop-blur-sm transition-all duration-300">
         Student / Parent Login
       </a>
     </div>
   </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-16">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
     <div class="grid md:grid-cols-4 gap-12">
       <div>
         <div class="flex items-center space-x-3 mb-6">
           <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
             <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
             </svg>
           </div>
           <span class="text-2xl font-bold text-white">GHA</span>
         </div>
         <p class="text-gray-400 leading-relaxed">
           Empowering the next generation through excellence, innovation, and character.
         </p>
       </div>

       <div>
         <h4 class="text-lg font-bold text-white mb-6">Quick Links</h4>
         <ul class="space-y-3">
           <li><a href="#" class="hover:text-primary-400 transition-colors">About Us</a></li>
           <li><a href="#" class="hover:text-primary-400 transition-colors">Admissions</a></li>
           <li><a href="#" class="hover:text-primary-400 transition-colors">Academics</a></li>
           <li><a href="#" class="hover:text-primary-400 transition-colors">Contact</a></li>
         </ul>
       </div>

       <div>
         <h4 class="text-lg font-bold text-white mb-6">Student Portal</h4>
         <ul class="space-y-3">
           <li><a href="{{ route('login') }}" class="hover:text-primary-400 transition-colors">Login</a></li>
           <li><a href="{{ route('register') }}" class="hover:text-primary-400 transition-colors">Apply</a></li>
           <li><a href="#" class="hover:text-primary-400 transition-colors">Parent Access</a></li>
         </ul>
       </div>

       <div>
         <h4 class="text-lg font-bold text-white mb-6">Contact</h4>
         <ul class="space-y-3 text-gray-400">
           <li class="flex items-center space-x-3">
             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
             <span>Harare, Zimbabwe</span>
           </li>
           <li class="flex items-center space-x-3">
             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
             <span>info@greaterheight.academy</span>
           </li>
           <li class="flex items-center space-x-3">
             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
             <span>+263 242 123 456</span>
           </li>
         </ul>
       </div>
     </div>

     <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
       <p>&copy; {{ date('Y') }} Greater Height Academy. All rights reserved. Built with ❤️ in Zimbabwe.</p>
     </div>
   </div>
</footer>
@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
