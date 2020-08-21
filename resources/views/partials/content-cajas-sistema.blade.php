@php $image = get_field('foto'); $size = 'full'; @endphp
<div id="seccion-{!! $post->post_name !!}" class="w-100 py-4">
		 @if (get_field("video"))
		 <div class="row">
			 <div class="col-lg-6">
			 	{!! App::video() !!}
		 	</div>
			 <div class="col-lg-6 align-self-center">
		     @if (get_field("icono")) @php echo "<i class='fa fa-3x text-info fa-".get_field('icono')."'></i>" @endphp @endif
				 <h3>{!! App::title() !!}</h3>
		     @php the_content() @endphp
			 </div>
		 </div>
	 @elseif ($image)
    <div class="row">
       <div class="col-lg-6">
         @php echo wp_get_attachment_image( $image, $size, false, array( "class" => "img-fluid mb-3" ) ) @endphp
        {{-- {{ the_post_thumbnail('large', array( 'class' => 'img-fluid' )) }} --}}
       </div>
       <div class="col-lg-6 align-self-center">
         @if (get_field("icono")) @php echo "<i class='fa fa-3x text-info fa-".get_field('icono')."'></i>" @endphp @endif
           <h3>{!! App::title() !!}</h3>
           @php the_content() @endphp
      </div>
    </div>
	@else
		@if (get_field("icono")) @php echo "<i class='fa fa-3x text-info fa-".get_field('icono')."'></i>" @endphp @endif
		<h3>{!! App::title() !!}</h3>
		@php the_content() @endphp
	@endif
</div>
