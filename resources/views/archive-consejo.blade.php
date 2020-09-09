@extends('layouts.app')

@section('content')
{!! App::cardbgPost('large','fondo-consejos') !!}
<div class="container">
  <div id="accordion" class="accordion rounded bg-light">
    @php global $first; /* $first=true; */ @endphp
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-collapse')
    @endwhile
  </div>
</div>
@endsection
