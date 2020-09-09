@extends('layouts.app')

@section('content')
  {!! App::headerpagCorto('large') !!}
  <div class="container">
    @php $args = array('post_type'=>'pais','post__not_in' => array(1931,1932,1933),'orderby'=>'name','order'=>'ASC'); $the_query = new WP_Query( $args ); @endphp
    <div id="accordion" class="accordion mb-5">
      @php global $first; /* $first=true; */ @endphp
      @while($the_query->have_posts()) @php $the_query->the_post() @endphp
        @include('partials.content-collapse-representantes')
      @endwhile
      @php wp_reset_postdata() @endphp
    </div>
  </div>
@endsection
