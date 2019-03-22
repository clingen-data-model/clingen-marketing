<?
	$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

	 include("App/Views/Partials/render_curation_tabs.php"); 


/**
 * Child Pages
 */
$documentation_items = $pages->get("template=document-index")->children("relate_curation_activity=$section->id, sort=-document_date");

if($documentation_items) {

  $render_documents_array = array();

  //$render_documents_array["types"]['all']["count"] = $documentation_items->count();
  //$render_documents_array["types"]['all']["title"] = "All Documents";

  foreach ($documentation_items as $key => $value) {
    //$render_array["{$value->template->name}"] = "{$value->template->title}";


    if($value->relate_groups->first){
      $render_relate_groups = "<div class='small'><a href='{$value->relate_groups->first->httpUrl}' class='text-muted'><i class=\"fas fa-users\"></i> {$value->relate_groups->first->title}</a></div>";
    } else {
      $render_relate_groups = "";
    }
    if($value->summary){
      $render_summary = "<strong>-</strong> {$value->summary}";
    } else {
      $render_summary = "";
    }
    
    
    //$count = $count + 1;
      
    if($value->relate_type_document->title) {
      $type = $value->relate_type_document->title;
      $type_ref = $value->relate_type_document->name;
      $css_highlight = "";
      
      $render_documents_array["types"]["{$value->relate_type_document->name}"]["title"] = 
      "{$value->relate_type_document->title}";
      $count = $count + 1;
      $count = $render_documents_array["types"]["{$value->relate_type_document->name}"]["count"];
      $render_documents_array["types"]["{$value->relate_type_document->name}"]["count"] = $count + 1;
      
    } else if($value->template->name == "document-type-criteria-show") {
      $type = "Curation Activity Procedures";
      $type_ref = "procedures";
      $css_highlight = "bg-info";
      
      $render_documents_array["types"]["procedures"]["title"] = 
      "Curation Activity Procedures";
      $count = $render_documents_array["types"]["procedures"]["count"];
      $render_documents_array["types"]["procedures"]["count"] = $count + 1;
      
    } else {
      $type = "publications";
      $type_ref = "publications";
      $css_highlight = "";
      
      $render_documents_array["types"]["publications"]["title"] = 
      "Publications";
      $count = $render_documents_array["types"]["publications"]["count"];
      $render_documents_array["types"]["publications"]["count"] = $count + 1;
    }
    
    
    //$render_documents_array["types"]["{$value->relate_type_document->name}"]["count"] = $count;
    
    
    $css_archived = ($value->document_archived) ? "text-muted" : "";
    $render_archived_message = ($value->document_archived) ? " <span class='p-1 label label-warning'>Archived Document</span>" : "";
    
    if($value->summary){
      $render_summary = "<strong>-</strong> {$value->summary}";
    } else {
      $render_summary = "";
    }

    $render_documents .= "
      <li class=' list-group-item'  data-type='ref_{$type_ref}' data-group='ref_{$type_ref}'>
          <div class='col-10'>
            <div class='mr-auto pr-3'>
            </div>
            <div class='mr-auto  flex-grow-1'>
              <a class='title' href='{$value->httpUrl}'><strong>{$value->title}</strong></a>
              <div class='small text-muted'><strong><i class='far fa-file'></i> {$type}  - </strong> {$value->document_date} {$render_summary}{$render_archived_message}</div>
              {$render_relate_groups}
              
            </div>
          </div>
          <div class='ml-auto col-1'>
            {$value->documentation_date}
          </div>
      </li>
    ";
    }
    foreach ($render_documents_array["types"] as $key => $value) {
      $render_documents_nav .= "
        <li><label class='text-normal text-nowrap pr-3 btn btn-primary'><input type='checkbox' name='type' value='ref_{$key}' id='ref_{$key}' /><span class=''> {$value['title']} <span class=\"badge badge-sm badge-pill badge-secondary small\">{$value['count']}</span></span></label></li>
      ";
//      $render_documents_nav .= "
//        <a href='#{$key}' class='small list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
//            {$value['title']} <span class=\"badge badge-pill badge-secondary\">{$value['count']}</span>
//        </a>
//      ";
    }
  }


if($documentation_items->count()) {
  // <div class='card-header w-100 input-group mb-1'><input type='text' class='form-control search' placeholder='Filter list... 'aria-label='Filter list'></div>
  $render_documents = "
    <div class='row no-gutters'>
      <div class='col-md-12'>
      <ul class='list-inline' id='filter_list'>
            {$render_documents_nav}
          </ul>
        <div class='card' id='list_documentation_table'>
        
            {$render_documents}
          </ul>
        </div>
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

	<span edit='body_2'>
	<?=$page->body_2 ?>
    </span>


	<?=$render_documents?>
  <span edit='body_3'>
	<?=$page->body_3 ?>
    </span>

</div>