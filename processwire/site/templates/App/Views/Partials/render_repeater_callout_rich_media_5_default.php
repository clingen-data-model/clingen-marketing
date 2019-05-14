<?

// Iterate through repeater_callout_rich_media_1
// This include should be passed into the page with the data as $fetch

if($fetch->count()) {
  foreach ($fetch as $key => $value) {
    unset($httpUrlButton);
    $img = ($value->image_1) ? $value->image_1->size(600,600)->url : $config->imgSquareStandard;
      $httpUrl = ($value->relate_page->httpUrl) ? $value->relate_page->httpUrl : $value->url_general;
    if($httpUrl) {
      $action = ($value->label_2) ? $value->label_2 : "Learn More";
      $httpUrlButton = "<a href=\"{$httpUrl}\" class=\"btn btn-sm btn-primary\">{$action}</a>";
      $httpUrlTitle = "<a class='' href='{$httpUrl}'><h5 class=\"card-title\">{$value->label_1}</h5></a>";
      $httpUrlImage = "<a class='' href='{$httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>";
    } else {
      $httpUrlTitle = "<h5 class=\"card-title\">{$value->label_1}</h5>";
      $httpUrlImage = "<img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\">";
    }
    $render_page_children_item .= "
      <div class='col-md-6 '>
        <div class=\"card mb-3  \">
           <div class=\"row no-gutters bg-light \">
            <div class=\"col-md-3  \">
             {$httpUrlImage}
            </div>
            <div class=\"col-md-9 bg-white\">
              <div class=\"card-body\">
                {$httpUrlTitle}
                <p class=\"small\">{$value->summary_rich_1}</p>
                {$httpUrlButton}
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
  $render_rich_media_5 = "<div class='row' edit='repeater_callout_rich_media_5'>{$render_page_children_items}</div>";
  unset($render_page_children_items);
  unset($render_page_children_item);
}
