@php
// Start XML file, create parent node
$doc = domxml_new_doc("1.0");
$node = $doc->create_element("markers");
$parnode = $doc->append_child($node);

$args = array('post_type'=>'pais','orderby'=>'name','order'=>'ASC');
$the_query = new WP_Query( $args );

header("Content-type: text/xml");
@endphp

@while($the_query->have_posts()) @php $the_query->the_post() @endphp
  $node = $doc->create_element("marker");
  $newnode = $parnode->append_child($node);

  $newnode->set_attribute("id", $row['id']);
  $newnode->set_attribute("name", $row['name']);
  $newnode->set_attribute("address", $row['address']);
  $newnode->set_attribute("lat", $row['lat']);
  $newnode->set_attribute("lng", $row['lng']);
  $newnode->set_attribute("type", $row['type']);
@endwhile


@php
$xmlfile = $doc->dump_mem();
echo $xmlfile;

@endphp
