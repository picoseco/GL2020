{{--
  Template Name: Página y subpáginas
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    @include('partials.content-subpage')
  @endwhile
@endsection
