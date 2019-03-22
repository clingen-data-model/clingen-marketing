<? 
/**
 * Child Pages
 */
if($page->children) {
  foreach ($page->children as $key => $value) {

    $img = ($value->image_icon_1) ? $value->image_icon_1->size(600,600)->url : "/site/templates/resources/img/defaults/groups-default_group_square_color.png";


    if($value->url_curations){
      $url_curations = "<a href=\"{$value->url_curations}\" class=\"btn btn-sm btn-outline-primary\">Curations <i class=\"fas fa-external-link-alt\"></i></a>";
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
                <a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">Learn More</a>
                <a href=\"{$value->httpUrl}#heading_documents\" class=\"btn btn-sm btn-link\">Documents</a>
                <a href=\"{$value->httpUrl}#heading_membership\" class=\"btn btn-sm btn-link\">Membership</a>
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
    
  }
  $render_page_children = "<div class='row'>".$render_page_children_items."</div>";
  unset($render_page_children_item);
}


echo $render_page_children;

unset($render_page_children);