<? 
/**
 * Child Pages
 */

$rootParent = $page->closest("template=tool-genomeconnect-category"); 
if($rootParent->count()) {

  if($rootParent->id == $page->id) {
    $option['css'] = 'active rounded'; 
  } else {
    $option['css'] = null;
  }

  $render_page_children_item .= "
    <a href='{$rootParent->httpUrl}' class='{$option['css']} list-group-item border-0'>
      {$rootParent->title}
    </a>
  ";

  foreach ($rootParent->children as $key => $value) {
    
    if($value->id == $page->id) {
      $option['css'] = 'active rounded';
    } elseif($value->id ==  $nav_side_active_override) {
      $option['css'] = 'active rounded';
    } else {
      $option['css'] = null;
    }

    $render_page_children_item .= "
      <a class='{$option['css']} list-group-item border-0' href='{$value->httpUrl}'>
        {$value->title}
      </a>
    ";
  }
  $render_page_children = "<ul class='list-group  list-group-flush border-0'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}


echo $render_page_children;

unset($render_page_children);