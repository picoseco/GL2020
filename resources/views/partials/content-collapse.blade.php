@php global $first;
global $post;
$show="show";
$button="";
if ($first==false) {
  $button="collapsed";
  $show="";
}
$first=false;
@endphp
<div class="card0 text-center">

  <div class="card-header" id="heading-{{ $post->post_name }}">
    <a class="h4 {{ $button }}" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $post->post_name }}" aria-expanded="true" aria-controls="collapse-{{ $post->post_name }}">
      {{ get_the_title() }}
    </a>
  </div>

  <div id="collapse-{{ $post->post_name }}" class="collapse {{ $show }}" aria-labelledby="heading-{{ $post->post_name }}" data-parent="#accordion">
    <div class="card-body">
      @php the_content() @endphp
    </div>
  </div>

</div>
