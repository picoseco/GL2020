@extends('layouts.app')

@section('content')
{!! App::card_bg_post('large','fondo-galeria') !!}
<div class="container">
  <div class="row">
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile
  </div>
</div>
@endsection
