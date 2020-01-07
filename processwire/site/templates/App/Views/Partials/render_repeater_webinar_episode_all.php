<?

// Iterate through repeater_callout_rich_media_1 
// This include should be passed into the page with the data as $fetch

// event_date

if($fetch->count()) {
  foreach ($fetch as $key => $value) {
    unset($httpUrlButton);
    $img = ($value->image_icon_1) ? $value->image_icon_1->size(600,600)->url : $config->imgSquareStandard;
    $httpUrl = $value->httpUrl;
    if($value->url_youtube) {
      $httpUrlImage = "<a class='' href='{$httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>";
      $httpUrlButton = "<a href=\"{$httpUrl}\" class=\"btn btn-sm btn-outline-primary\">Watch Now</a>";
	  $httpColor = " bg-info";
    } else {
      $httpUrlImage = "<a class='' href='{$httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>";
      $httpUrlButton = "<a href=\"{$httpUrl}\" class=\"btn btn-sm btn-outline-link pl-0 text-muted \"><i class='glyphicon glyphicon-calendar'></i> {$value->event_date}</a>";
	  $httpColor = " bg-secondary";
    }
    $render_page_children_item .= "
      <div class='col-md-4 mb-4 '>
        <div class=\"card mb-0 border-primary {$httpColor} \">
           <div class=\"row no-gutters \">
            <div class=\"col-xs-4  col-xs-offset-4 col-sm-6  col-sm-offset-3   \">
             {$httpUrlImage}
            </div>
            <div class=\"col-xs-12 bg-white\">
              <div class=\"card-body py-2 \">
                <div class='mb-2'><a href='{$httpUrl}'>{$value->title}</a></div>
                <div class='row'>
					<div class='col-sm-6'>
						{$httpUrlButton}
					</div>
					<div class='col-sm-6 text-sm-right'>
						<a href='{$httpUrl}' class='btn btn-link text-muted'>Learn More</a>
					</div>
				</div>
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
  } else if(($key + 1)%3 == 0) {
    $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
    unset($render_page_children_item);
  } 
  }
  $render_webinar_episode_all = "<div class=''>{$render_page_children_items}</div>";
  unset($render_page_children_items);
  unset($render_page_children_item);
}
