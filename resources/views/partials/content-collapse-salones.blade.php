@php
$pais_id = get_the_ID();
$child_args = array(
  'post_type' => 'salon',
  'posts_per_page' => -1,
  'order' => 'ASC',
	'orderby' => 'title',
  'meta_query' => array(
    array(
      'key' => 'pais',
      'value' => $pais_id,
      'compare' => 'LIKE'
    )
  )
);
$salones = get_posts( $child_args );
@endphp

<div class="card coloreame">

  <div class="card-header" id="heading-{{ $pais_id }}">
    <a class="collapsed" data-toggle="collapse" href="#collapse-{{ $pais_id }}" aria-expanded="true" aria-controls="collapse-{{ $pais_id }}">
      <h3 class="mb-0"><i class="fas fa-caret-right fa-fw"></i><i class="fas fa-caret-down fa-fw"></i>{{ get_the_title() }}</h5>
    </a>
  </div>

  <div id="collapse-{{ $pais_id }}" class="collapse" aria-labelledby="heading-{{ $pais_id }}">
    @foreach ($salones as $child_post)
      {!! App::dataRepresentante($child_post) !!}
    @endforeach
  </div>

</div>
