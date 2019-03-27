<? 
/**
 * Child Pages
 */




$fetch = $pages->get("template=tool-index")->children("relate_groups=$page");
if($fetch->count()) {
  foreach ($fetch as $key => $value) {

    if($value->id == $page->id) {
      $option['css'] = 'active';
    } else {
      $option['css'] = null;
    }

    $img = ($value->image_icon_1) ? $value->image_icon_1->size(50,50)->url : $config->imgSquareStandard;

    $url_interface = ($value->url_interface) ? "<a href=\"{$value->url_interface}\" class=\"btn btn-sm btn-link\">Interface <i class=\"fas fa-external-link-alt\"></i></a>" : "";


    if($value->body_1){
      $url_about = "<a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">About</a>";
    } else { unset($url_interface);}
    if($value->url_interface){
      $url_interface = "<a href=\"{$value->url_interface}\" target='_blank' class=\"btn btn-sm btn-outline-primary\">Interface <i class=\"fas fa-external-link-alt\"></i></a>";
    } else { unset($url_interface);}
    if($value->url_curations){
      $url_curations = "<a href=\"{$value->url_curations}\" class=\"btn btn-sm btn-outline-primary\">Curations <i class=\"fas fa-external-link-alt\"></i></a>";
    } else { unset($url_curations);}
    if($value->url_general){
      $url_general = "<a href=\"{$value->url_general}\"  target='_blank' class=\"btn btn-sm btn-outline-primary\">Website <i class=\"fas fa-external-link-alt\"></i></a>";
    } else { unset($url_general);}

    $render_page_children_item .= "
    <li class=' list-group-item'>
      <table class='w-100 mb-3'>
        <tr>
          <td width='80'>
             <a class='' href='{$value->httpUrl}'> <img src=\"{$img}\" height='50' width='50' class=\"\" alt=\"{$value->title}\"></a>
          </td>
          <td>
                <a class='' href='{$value->httpUrl}'><h5 class=\"pt-2 m-0\">{$value->title}</h5></a>
                <p class=\"small\">{$value->summary}</p>
                {$url_about}
                {$url_curations}
                {$url_interface}
                {$url_gitrepository}
                {$url_general}
                {$config->helpers->img->square->standard}
          </td>
        </tr>
      </table>
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
    
  unset($url_curations);
  unset($url_interface);
  unset($url_gitrepository);
  }
  
  

  $nav_pill['tools'] = "<a href='#heading_tools' class='badge badge-pill badge-info p-2 mr-2'>Tools  <i class='fas fa-arrow-circle-down'></i></a>";
  //$render_tools = "<h3 class='mt-5' id='heading_tools'>Tools &amp; Resources</h3><div class=''>{$render_page_children_item}</div>";

  $render_tools = "<h3 class='mt-5 heading-border' id='heading_tools'>Tools &amp; Resources</h3>
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