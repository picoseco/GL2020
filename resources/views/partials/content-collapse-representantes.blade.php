@php global $first;
$show = "show"; $button = "";
if ($first == false) { $button = "collapsed"; $show = ""; }
$first = false;

$pais_id = get_the_ID();
$child_args = array(
  'post_type' => 'representante',
  'meta_query' => array(
    array(
      'key' => 'pais',
      'value' => $pais_id,
      'compare' => 'LIKE'
    )
  )
);
$representantes = get_posts( $child_args );
@endphp

<div class="card coloreame">

  <div class="card-header" id="heading-{{ $pais_id }}">
    <a class="h3 {{ $button }}" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $pais_id }}" aria-expanded="true" aria-controls="collapse-{{ $pais_id }}">
      {{ get_the_title() }}
    </a>
  </div>
{{-- {{ var_dump($representantes) }} --}}
  <div id="collapse-{{ $pais_id }}" class="collapse {{ $show }}" aria-labelledby="heading-{{ $pais_id }}" data-parent="#accordion">
    @foreach ($representantes as $child_post)
      {!! App::dataRepresentante($child_post) !!}
    @endforeach
  </div>

</div>
