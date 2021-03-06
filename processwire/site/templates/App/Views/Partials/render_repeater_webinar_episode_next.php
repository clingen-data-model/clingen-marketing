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
	  $renderWatchLive = "";
    } else {
      $httpUrlImage = "<a class='' href='{$httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>";
      $httpUrlButton = "<a href=\"{$httpUrl}\" class=\"btn btn-sm btn-outline-link pl-0 text-muted \"><i class='glyphicon glyphicon-calendar'></i> {$value->event_date}</a>";
	  $httpColor = " bg-secondary";
	  $renderWatchLive = "
		<div class=' ml-3 mr-3'>
			<a href='{$httpUrl}' class='btn btn-primary btn-block' style='border-radius: 0 0 10px  10px;'>Watch the training live</a>
		</div>";
    }
    $render_page_children_item .= "
      <div class='col-xs-12 '>
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
    $render_page_children_items .=  "<div class='row'>{$render_page_children_item}</div>"; 
    unset($render_page_children_item);
  }
  $render_webinar_episode_next = "<div class=''>{$render_page_children_items}</div>";
  unset($render_page_children_items);
  unset($render_page_children_item);
}
