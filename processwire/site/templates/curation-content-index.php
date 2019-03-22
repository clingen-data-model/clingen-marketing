<?
	$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

	 include("App/Views/Partials/render_curation_tabs.php"); 


/**
 * Child Pages
 */
$documentation_items = $pages->get("template=document-index")->children("relate_curation_activity=$section->id");


$fetch = $page->repeater_callout_rich_media_1;
include("App/Views/Partials/render_repeater_callout_rich_media_1_default.php"); 


if($documentation_items) {

  $render_documents_array = array();

  $render_documents_array["types"]['all']["count"] = $documentation_items->count();
  $render_documents_array["types"]['all']["title"] = "All Documents";

  foreach ($documentation_items as $key => $value) {
    //$render_array["{$value->template->name}"] = "{$value->template->title}";

    $render_documents_array["types"]["{$value->relate_type_document->name}"]["title"] = 
      "{$value->relate_type_document->title}";

    $count = $render_documents_array["types"]["{$value->relate_type_document->name}"]["count"];
    $count = $count + 1;
    $render_documents_array["types"]["{$value->relate_type_document->name}"]["count"] = $count;


    if($value->relate_type_document->title){
      $relate_type_document = "<div class='small'><i class=\"fas fa-angle-right\"></i> {$value->relate_type_document->title}</div>";
    } else {
      $relate_type_document = "";
    }

    $render_documents .= "
      <li class=' list-group-item '>
          <div class='mr-auto d-flex col-12'>
            <div class='mr-auto pr-3'>
              <i class='far fa-file'></i>
            </div>
            <div class='mr-auto  flex-grow-1'>
              <a class='title' href='{$value->httpUrl}'>{$value->title}</a>
              <div class='small text-muted'>{$value->summary}</div>
              {$relate_type_document}
            </div>
          </div>
      </li>
    ";

    }
    foreach ($render_documents_array["types"] as $key => $value) {
      $render_documents_nav .= "
        <a href='#{$key}' class='small list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
            {$value['title']} <span class=\"badge badge-pill badge-secondary\">{$value['count']}</span>
        </a>
      ";
    }
  }


if($documentation_items->count()) {

  $render_documents = "
    <div class='row no-gutters'>
      <div class='col-md-9'>
        <div class='card mb-3 card-radius-l'>
          <div class='card-header input-group mb-1 card-radius-tl '>
            <input type='text' class='form-control search' placeholder='Filter list...' aria-label='Filter list' />
            <div class='input-group-append'>
              <button class='btn btn-outline-secondary dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Sort by...</button>
              <div class='dropdown-menu dropdown-menu-right'>
                <button class='dropdown-item btn btn-link sort' data-sort='title' type='button'>Title</button>
                <button class='dropdown-item btn btn-link sort' data-sort='title' type='button'>Date</button>
                <button class='dropdown-item btn btn-link sort' data-sort='title' type='button'>Group</button>
                <button class='dropdown-item btn btn-link sort' data-sort='title' type='button'>Type</button>
              </div>
            </div>
          </div>
          <ul class='list-group list-group-flush'>
            {$render_documents}
          </ul>
        </div>
      </div>
      <div class='col-md-3'>
        <ul class='list-group list-group-flush border-bottom-1'>
            {$render_documents_nav}
          </ul>
      </div>
    </div>

  ";

  unset($render_documents_nav);
}
?>

<div pw-replace="section_heading" class="pb-0">
  <div  class="container">
  	<div class="">
	  	<div class="content">
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
		  </div>
		  
		</div>
		    <ul class="nav-tabs-affiliates nav nav-tabs">
		      <?=$pageTabs ?>
		    </ul>
	</div>
</div>


<div pw-append="section_content">

	<span edit="body_2">
	<?=$page->body_2 ?>
    </span>
  
	<?=$render_rich_media_1 ?>

<span edit="body_3">
	<?=$page->body_3 ?>
    </span>
</div>