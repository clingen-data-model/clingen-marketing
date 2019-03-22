<? 
/**
 * Child Pages
 */




$fetch = $page->children();
if($fetch->count()) {
  foreach ($fetch as $key => $value) {

    if($value->id == $page->id) {
      $option['css'] = 'active';
    } else {
      $option['css'] = null;
    }


    $render_page_children_item .= "
    <li class=' list-group-item'>
        <a class='' href='{$value->httpUrl}'><h5 class=\"pt-2 m-0\">{$value->title}</h5></a>
        <p class=\"small\">{$value->summary}</p>
        <a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">About this group</a>
      </li>
    ";
    
  // This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
    // but offers more possibilities
//    if(($key + 1) == count($fetch) ){
//      $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
//      unset($render_page_children_item);
//    } else if(($key + 1)%2 == 0) {
//      $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
//      unset($render_page_children_item);
//    } 
    
  }
  
  

  $nav_pill['subgroups'] = "<a href='#heading_subgroups' class='badge badge-pill badge-info p-2 mr-2'>Subgroups  <i class='fas fa-arrow-circle-down'></i></a>";
  //$render_tools = "<h3 class='mt-5' id='heading_tools'>Tools &amp; Resources</h3><div class=''>{$render_page_children_item}</div>";

  $render_subgroups = "<h3 class='mt-5' id='heading_subgroups'>Subgroups</h3>
    <div class='row'>
      <div class='col-md-9'>
        <div class='card mb-3 ' id=''>
            <ul class='list-group list-group-flush list'>
                {$render_page_children_item}
                </ul>
        </div>
      </div>
    </div>
  ";
  unset($render_page_children_item);
}

?>