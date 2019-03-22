<? 

// Get the $doc_type from URL
$type_doc                 = $sanitizer->name($input->get['doc-type']);
$type_curation_procedure  = $sanitizer->name($input->get['curation-procedure']);


if($type_doc == "curation-activity-procedures") {
    if(!$type_curation_procedure){
      $segment = "template=document-type-criteria-show";
    }else {
      $segment = "template=document-type-criteria-show, relate_curation_activity={$type_curation_procedure}, sort=-document_criteria_version";
    }
} else if($type_doc == "publications") {
  $segment = "template=document-type-publication-show";
} else if($type_doc) {
  $segment = "relate_type_document={$type_doc}";
}

include("App/Helpers/functions.php");
 

/**
 * Fetch Documents
 */
$fetch = $pages->get("template=document-index")->children($segment);
if($fetch) {

  // use this to capture the documentation types and count.
  $render_documentation_types = array();

  foreach ($fetch as $key => $value) {

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
    
    if($value->relate_type_document->title) {
      $type = $value->relate_type_document->title;
    } else if($value->template->name == "document-type-criteria-show") {
      $type = "Curation Activity Procedures";
    } else {
      $type = "Publications";
    }
    $render_item .= "
      <li class=' list-group-item'>
            <div class='p-2'>
              <a class='title' href='{$value->httpUrl}'><strong>{$value->title}</strong></a>
              <div class='small text-muted'><strong><i class='far fa-file'></i> {$type}  - </strong> {$value->document_date} {$render_summary}</div>
              {$render_relate_groups}
            {$value->documentation_date}
          </div>
      </li>
    ";
  }
  $render_documentation_items = "<ul class='list-group list-group-flush list'>".$render_item."</ul>";
  unset($render_item);
}

// // extract required fields into plain array
// $data = $fetch->explode(['title', 'relate_groups.title', 'relate_groups.created']);
unset($fetch);

// Remove the type if a param wasn't set.
if(!$type_doc) {
  unset($type);
}


include("App/Views/Partials/render_documents_side_nav.php");


?>
<div pw-replace="section_heading">
  <div  class="container">
      <div class="content pb-2">
        <div class="section-heading-content" edit="body_1"><?=($type) ? "<h1>{$type}</h1>" : $page->body_1 ?></div>
    </div>
  </div>
</div>


<div pw-append="section_content">
  <div class="row">
    <div class="col-sm-9">
    	<div class="card" id="list_documentation_table">
<!--
        <div class="card-header w-100 input-group mb-1">
            <input type="text" class="form-control search" placeholder="Filter list..." aria-label="Filter list">
        </div>
-->
        <?=$render_documentation_items ?>
      </div>
    </div>
    
    <div class="col-sm-3">
      <?=$render_nav_documentation_types?>
    </div>
  </div>
</div>