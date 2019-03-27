<?

// Iterate through repeater_callout_rich_media_1
// This include should be passed into the page with the data as $fetch

if($fetch->count()) {
  foreach ($fetch as $key => $value) {

    $img = ($value->image_1) ? $value->image_1->size(600,600)->url : $config->imgSquareStandard;
    $httpUrl = ($value->relate_page->httpUrl) ? $value->relate_page->httpUrl : $value->url_general;
    $action = ($value->label_2) ? $value->label_2 : "Learn More";
    
    foreach ($value->relate_pages as $ckey => $child) { 
      $child_page .="<li><a href='{$child->httpUrl}'><i class='fas fa-angle-right'></i> {$child->title}</a></li>";
    }
    
    if($child_page){
      $child_pages = "<ul class='list-unstyled'>{$child_page}</ul>";
    }
    unset($child_page);
    
    $render_page_children_item .= "
      <div class='col-md-6 '>
        <div class=\"card mb-3  \">
           <div class=\"row no-gutters bg-light  \">
            <div class=\"col-md-3 hidden-xs hidden-sm  \">
             <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\">
            </div>
            <div class=\"col-md-9 bg-white card-radius-r\">
              <div class=\"card-body\">
                <h5 class=\"card-title\">{$value->label_1}</h5>
                <p class=\"small\">{$value->summary}</p>
                {$child_pages}
              </div>
            </div>
          </div> 
        </div>
      </div>
    ";
  
  
//   This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
//   but offers more possibilities
  if(($key + 1) == count($fetch) ){
    $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
    unset($render_page_children_item);
  } else if(($key + 1)%2 == 0) {
    $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
    unset($render_page_children_item);
  } 
  }
  $render_rich_media_3 = "<div class='' edit='repeater_callout_rich_media_3'>{$render_page_children_items}</div>";
  unset($render_page_children_items);
  unset($render_page_children_item);
  unset($child_pages);
}
