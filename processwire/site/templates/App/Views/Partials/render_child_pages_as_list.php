<? 
/**
 * Child Pages
 */
if($page->children) {
  foreach ($page->children as $key => $value) {

    if($value->id == $page->id) {
      $option['css'] = 'active';
    } else {
      $option['css'] = null;
    }

    $render_page_children_item .= "
      <li class='{$option['css']}'>
        <a class='' href='{$value->httpUrl}'>{$value->title} <span class='sr-only'></span></a>
      </li>
    ";
  }
  $render_page_children = "<ul class='list-unstyled'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}


echo $render_page_children;

unset($render_page_children);