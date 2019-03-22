<?

/**
 * Fetch Documents Types
 */

$activities = $pages->get(1018)->children("template=curation-show");
$fetch = $pages->get(2113)->children("include=hidden");
$countAll = 0;
if($fetch) {
  foreach ($fetch as $key => $value) {
    
    $active = ($type == $value->title) ? "active" : "";
    
    $count = $pages->get("template=document-index")->children("relate_type_document=$value")->count();
    $countAll = $countAll + $count;
    if($value->track_featured == "2"){
      $render_item_nav .= "
        <a href='{$page->url}?doc-type={$value->name}' class=\"col-2 small text-center\">
          <div class='h1'>". print_icon($value->name) ."</div> {$value->title}
        </a>
      ";
    }
    // Curration Activity
    if($value->id == "3395"){
      $render_item .= "
      <a href='{$page->url}?doc-type={$value->name}' class=\"clearfix list-group-item list-group-item-action d-flex justify-content-between align-items-center text-left {$active} pl-1 pb-1 pr-1\"><table class=''><tr><td><img src=\"{$value->image_svg->url}\" class='svg-h-text' alt=\"{$value->title}\"></td><td style='width:100%'>{$value->title}</td></tr></table></a>
        ";
      foreach ($activities as $key => $activity) {
          $countA = $pages->get("template=document-index")->children("template=document-type-criteria-show, relate_curation_activity={$activity->id}")->count();
          if($countA) {
             $render_item .= "
              <a href='{$page->url}?doc-type={$value->name}&curation-procedure={$activity->name}' class=\"clearfix  border-top-0 list-group-item list-group-item-action d-flex justify-content-between align-items-center text-left {$active} pl-4 small pt-1 pb-1 pr-1\">
              <span class=\"badge badge-pill badge-secondary mt-1 pull-right\">{$countA}</span>{$activity->title}</a>
            ";
            }
        }
    }else if($value->id == "3394"){
    //Publiction
      
      $count = $pages->get("template=document-index")->children("template=document-type-publication-show")->count();
      $render_item .= "
        <a href='{$page->url}?doc-type={$value->name}' class=\"clearfix list-group-item list-group-item-action d-flex justify-content-between align-items-center text-left {$active} pl-1 pr-1\"><table class=''><tr><td><img src=\"{$value->image_svg->url}\" class='svg-h-text' alt=\"{$value->title}\"></td><td style='width:100%'><span class=\"badge badge-pill badge-secondary mt-1 pull-right\">{$count}</span>{$value->title}</td></tr></table></a>
      ";
    } else if($count){
      
      
      
      $render_item .= "
        <a href='{$page->url}?doc-type={$value->name}' class=\"clearfix list-group-item list-group-item-action d-flex justify-content-between align-items-center text-left {$active} pl-1 pr-1\"><table class=''><tr><td><img src=\"{$value->image_svg->url}\" class='svg-h-text' alt=\"{$value->title}\"></td><td style='width:100%'><span class=\"badge badge-pill badge-secondary mt-1 pull-right\">{$count}</span>{$value->title}</td></tr></table></a>
      ";
    }
  }
  
  $active = (!$type) ? "active" : "";

  $render_item_first = "
    <a href='{$page->url}' class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center strong  {$active} pl-2 pr-1\"><span class=\"badge badge-pill badge-secondary mt-1 pull-right\">{$countAll}</span> All Documents</a>
  ";
  
  $render_nav_documentation_types = "<ul class=\"list-group list-group-flush\">".$render_item_first."".$render_item."</ul>";
  unset($render_item);
  unset($count);
}

// // extract required fields into plain array
// $data = $fetch->explode(['title', 'relate_groups.title', 'relate_groups.created']);
unset($fetch);

