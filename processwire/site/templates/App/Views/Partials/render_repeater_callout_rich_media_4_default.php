<?

// Iterate through repeater_callout_rich_media_1
// This include should be passed into the page with the data as $fetch

if(count($fetch)) {
  foreach ($fetch as $key => $value) {
    
    foreach ($value->relate_pages as $keyA => $relate_page) {
      $render_relate_page .= "<li><a href='{$relate_page->httpUrl}'>{$relate_page->title}</a></li>";
    }
    $render_relate_pages = ($render_relate_page) ? "<ul class='list-untyled'>{$render_relate_page}</ul>" : "";
    $render_relate_page_img = ($value->image_1) ? "<img src='".$value->image_1->size(600,600)->url."' class='img-fluid col-sm-4' />" : "";
    $render_page_children_item .= "
      <div class='col-md-12 table-spacing table-align-top ' id='rich_media_{$key}'>
        {$render_relate_page_img}
        {$value->body_1}
        {$render_relate_pages}
      </div> 
    ";
    $render_page_children_anchor .= "<a href='#rich_media_{$key}' class='btn btn-outline-primary'>{$value->label_1}</a>";
    unset($render_relate_pages);
    unset($render_relate_page_img);
  }
  
  $render_rich_media_4_anchors = "<div class=' text-center pt-5 pb-5'><span class='btn-group' role='group'>{$render_page_children_anchor}</span></div>";
  $render_rich_media_4 = "<div class='row' edit='repeater_callout_rich_media_4'>{$render_page_children_item}</div>";
  unset($render_page_children_items);
  unset($render_page_children_item);
}
