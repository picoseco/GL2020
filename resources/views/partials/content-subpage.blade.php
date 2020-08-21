<div class="container">
  @php
  $page_id = get_the_ID();
  $args = array('post_type' => 'page','post_parent' => $page_id,'order'=>'ASC','orderby'=>'menu_order');
  $the_query = new WP_Query( $args );
  @endphp

  @while($the_query->have_posts()) @php $the_query->the_post() @endphp
    @include('partials.content-cajas-sistema')
  @endwhile

  @php wp_reset_postdata() @endphp
</div>
