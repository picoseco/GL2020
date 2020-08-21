{{--
  Template Name: Full width Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    {{-- @include('partials.page-header') --}}
    @include('partials.content-page-full-width')
  @endwhile
@endsection
