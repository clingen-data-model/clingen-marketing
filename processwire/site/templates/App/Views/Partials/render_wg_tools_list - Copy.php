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

    $img = ($value->image_icon_1) ? $value->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

    $url_interface = ($value->url_interface) ? "<a href=\"{$value->url_interface}\" class=\"btn btn-sm btn-link\">Interface <i class=\"fas fa-external-link-alt\"></i></a>" : "";


    // if($value->url_gitrepository){
    //   $url_gitrepository = "<a href=\"{$value->url_gitrepository}\" class=\"btn btn-sm btn-outline-primary\">GIT <i class=\"fas fa-external-link-alt\"></i></a>";
    // }
    if($value->url_curations){
      $url_curations = "<a href=\"{$value->url_curations}\" class=\"btn btn-sm btn-link\">Curations <i class=\"fas fa-external-link-alt\"></i></a>";
    }
    if($value->url_general){
      $url_general = "<a href=\"{$value->url_general}\" class=\"btn btn-sm btn-link\">Website <i class=\"fas fa-external-link-alt\"></i></a>";
    }

    $render_page_children_item .= "
      <div class='col-md-6 '>
        <div class=\"card mb-3  \">
           <div class=\"row no-gutters bg-light \">
            <div class=\"col-md-3  \">
             <a class='' href='{$value->httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->title}\"></a>
            </div>
            <div class=\"col-md-9 bg-white\">
              <div class=\"card-body\">
                <a class='' href='{$value->httpUrl}'><h5 class=\"card-title\">{$value->title}</h5></a>
                <p class=\"small\">{$value->summary}</p>
                <a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">About</a>
                {$url_curations}
                {$url_interface}
                {$url_gitrepository}
                {$url_general}
                {$config->helpers->img->square->standard}
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    
  // This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
    // but offers more possibilities
    if(($key + 1) == count($fetch) ){
      $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
      unset($render_page_children_item);
    } else if(($key + 1)%2 == 0) {
      $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
      unset($render_page_children_item);
    } 
    
  unset($url_curations);
  unset($url_interface);
  unset($url_gitrepository);
  }

  $nav_pill['tools'] = "<a href='#heading_tools' class='badge badge-pill badge-info p-2 mr-2'>Tools</a>";

  $render_tools = "<h3 class='mt-5' id='heading_tools'>Tools &amp; Resources</h3><div class='row'>".$render_page_children_items."</div>";
  unset($render_page_children_item);
}

?>