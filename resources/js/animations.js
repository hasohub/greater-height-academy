/**
 * Greater Height Academy - Custom Animations & Utilities
 * Built with GSAP for smooth, professional animations
 */

// Smooth scroll
 document.querySelectorAll('a[href^="#"]').forEach(anchor => {
   anchor.addEventListener('click', function (e) {
     e.preventDefault()
     document.querySelector(this.getAttribute('href')).scrollIntoView({
       behavior: 'smooth'
     })
   })
 })

// Fade in on scroll
const observerOptions = {
   root: null,
   rootMargin: '0px',
   threshold: 0.1
 }

const fadeInOnScroll = new IntersectionObserver((entries) => {
   entries.forEach(entry => {
     if (entry.isIntersecting) {
       entry.target.classList.add('opacity-100', 'translate-y-0')
       entry.target.classList.remove('opacity-0', 'translate-y-8')
     }
   })
 }, observerOptions)

// Observe all elements with .fade-in-scroll
document.querySelectorAll('.fade-in-scroll').forEach(el => {
   el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700')
   fadeInOnScroll.observe(el)
 })

// Counter animation for stats
function animateCounter(el, target, duration = 2000) {
   let start = 0
   const increment = target / (duration / 16)
   const timer = setInterval(() => {
     start += increment
     if (start >= target) {
       el.textContent = target
       clearInterval(timer)
     } else {
       el.textContent = Math.floor(start)
     }
   }, 16)
 }

// Initialize counters when visible
const counterObserver = new IntersectionObserver((entries) => {
   entries.forEach(entry => {
     if (entry.isIntersecting) {
       const target = parseInt(entry.target.getAttribute('data-count'))
       animateCounter(entry.target, target)
       counterObserver.unobserve(entry.target)
     }
   })
 }, { threshold: 0.5 })

document.querySelectorAll('.counter').forEach(counter => {
   counterObserver.observe(counter)
 })

// Alert auto-dismiss
document.querySelectorAll('.alert-auto-dismiss').forEach(alert => {
   setTimeout(() => {
     alert.classList.add('opacity-0', '-translate-y-2')
     setTimeout(() => alert.remove(), 300)
   }, 4000)
 })

// Mobile menu toggle
document.querySelector('#mobile-menu-btn')?.addEventListener('click', () => {
   document.querySelector('#mobile-menu').classList.toggle('hidden')
 })

// Loading skeleton simulation
window.addEventListener('load', () => {
   document.querySelectorAll('.skeleton').forEach(el => {
     el.classList.add('hidden')
   })
 })
