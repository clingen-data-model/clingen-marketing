<? 
/**
 * Fetch Documents
 */
$fetch = $pages->find("template=document-type-publication-show");
if($fetch) {

  // use this to capture the documentation types and count.
  $render_documentation_types = array();

  foreach ($fetch as $key => $value) {

  	if($value->relate_groups->first){
      $render_relate_groups = "<div class='small'><i class=\"fas fa-users\"></i> {$value->relate_groups->first->title}</div>";
    }

    $render_item .= "
    <li class=' list-group-item '>
      <div class='mr-auto d-flex col-10'>
        <div class='mr-auto pr-3'>
          <i class='far fa-file'></i>
        </div>
        <div class='mr-auto  flex-grow-1'>
          <a class='title' href='{$value->httpUrl}'>{$value->title}</a>
        <div class='small text-muted'>{$value->summary}</div>
        {$render_relate_groups}
        </div>
      </div>
      <div class='ml-auto col-1'>
        {$value->documentation_date}
      </div>
    </li>
    ";
    unset($render_relate_groups);
  }
  $render_documentation_items = "<ul class='list-group list-group-flush list'>".$render_item."</ul>";
  unset($render_item);
}

$document_count = $pages->find("template=announcement-type-event-show|announcement-type-post-show|announcement-type-poster-show|announcement-type-presentation-show|document-type-publication-show|announcement-type-pubmention-show")->count();
// // extract required fields into plain array
// $data = $fetch->explode(['title', 'relate_groups.title', 'relate_groups.created']);
unset($fetch);


/**
 * Fetch Documents Types
 */
$fetch = $pages->get(1021)->children();
if($fetch) {
  $render_item .= "
  <a href='{$page->parent->url}' class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">All Announcements<span class=\"badge badge-pill badge-secondary\">{$document_count}</span></a>
  ";
  foreach ($fetch as $key => $value) {
    $count = $value->children()->count();
    if($count){
      $render_item .= "
      <a href='{$value->url}' class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">{$value->title} <span class=\"badge badge-pill badge-secondary\">{$count}</span></a>
      ";
    }
  }
  $render_documentation_types = "<ul class=\"list-group list-group-flush\">".$render_item."</ul>";
  unset($render_item);
  unset($count);
}

// // extract required fields into plain array
// $data = $fetch->explode(['title', 'relate_groups.title', 'relate_groups.created']);
unset($fetch);

?>


<div pw-append="section_content">
  <div class="row">
    <div class="col-sm-3">
      <?=$render_documentation_types?>
    </div>
    <div class="col-sm-9">
    	<div class="card" id="list_documentation_table">
        <div class="card-header input-group mb-1">
          <input type="text" class="form-control search" placeholder="Filter list..." aria-label="Filter list">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by...</button>
            <div class="dropdown-menu dropdown-menu-right">
              <button class="dropdown-item btn btn-link sort" data-sort="title" type="button">Title</button>
              <button class="dropdown-item btn btn-link sort" data-sort="title" type="button">Date</button>
              <button class="dropdown-item btn btn-link sort" data-sort="title" type="button">Group</button>
              <button class="dropdown-item btn btn-link sort" data-sort="title" type="button">Type</button>
            </div>
          </div>
        </div>
        <?=$render_documentation_items ?>
      </div>
    </div>
  </div>
</div>