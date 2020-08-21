@extends('layouts.app')

@section('content')
{!! App::card_bg_post('large','fondo-consejos') !!}
<div class="container">
  <div id="accordion" class="accordion">
    @php global $first; /* $first=true; */ @endphp
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-collapse')
    @endwhile
  </div>
</div>
@endsection
