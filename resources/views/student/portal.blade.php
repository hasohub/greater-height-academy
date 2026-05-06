@extends('layouts.app')

@section('title', 'Student Portal')
@section('page_heading', 'My Student Portal')

@section('content')
<div class="max-w-7xl mx-auto">
   @livewire('student-portal')
</div>
@endsection
