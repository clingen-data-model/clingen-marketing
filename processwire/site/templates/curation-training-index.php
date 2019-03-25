<?
$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

include("App/Views/Partials/render_curation_tabs.php"); 



if($repeater_callout_recommended_training = $page->repeater_callout_recommended_training) {
  foreach($repeater_callout_recommended_training as $key => $value){
    $count = $key + 1;
    $action = ($value->label_3) ? $value->label_3 : "Start";
    $note = ($value->label_2) ? "<span class='badge badge-info p-1 mb-1'>{$value->label_2}</span>" : "";
    
//    if($value->relate_pages->count == 1) {
//      $render_relate_page = "<a href='{$value->relate_pages->first->httpUrl}' class='btn btn-primary text-white float-right ml-4'>{$action} <i class='fas fa-arrow-right'></i></a>";
//    } else {
    foreach($value->relate_pages as $keyA => $relate_page){
      $render_relate_pages .= "<div class=' pb-1 clearfix'>
      <a href='{$relate_page->httpUrl}' class='btn btn-primary p-1 text-white float-right ml-4'>{$action} <i class='fas fa-arrow-right'></i></a>
      <a href='{$relate_page->httpUrl}' class=''><i class='fas fa-arrow-right'></i> {$relate_page->title}</a>
      </div>";
//      }
    }
    
    $render_recommended_training_docs .= "
    <div class='timeline-item'>
      <div class='timeline-icon'>
        {$count}
      </div>
      <div class='timeline-content'>
        {$note}
      <h4 class='m-0'>{$value->label_1}</h4>
        <p>{$value->summary}</p>
        {$render_relate_pages}
      </div>
    </div>
    ";
    unset($render_relate_page);
    unset($render_relate_pages);
  }
}
// 
$relate_curation_docs = $pages->get(1019)->children("relate_curation_activity={$page->parent->id}, (template=document-type-doc-show, relate_type_document=2122|2121|3268|2117|2116), (template=document-type-criteria-show), sort=-document_date");
if($relate_curation_docs){
  foreach($relate_curation_docs as $key => $value){
    $count = $key + 1;
    
    
    
    if($value->relate_type_document->title) {
      $type = $value->relate_type_document->title;
      $css_highlight = "";
    } else if($value->template->name == "document-type-criteria-show") {
      $type = "Curation Activity Procedures";
      $css_highlight = "bg-info";
    } else {
      $type = "Publications";
      $css_highlight = "";
    }
    
    
    $css_archived = ($value->document_archived) ? "text-muted" : "";
    $render_archived_message = ($value->document_archived) ? " <span class='p-1 label label-warning'>Archived Document</span>" : "";
    
    if($value->summary){
      $render_summary = "<strong>-</strong> {$value->summary}";
    } else {
      $render_summary = "";
    }
    
    $render_curation_docs .= "
    <div class='col-sm-12 mb-3 pb-3 border-bottom-1'>
      <div class=''>
        <h4 class='m-0 h5'>
          <a href='{$value->httpUrl}' class='btn btn-primary text-white float-right ml-4'>View<i class='fas fa-arrow-right'></i></a><a href='{$value->httpUrl}' class='{$css_archived}'>{$value->title}</a>
        </h4>
      <div class='small text-muted'>
        <strong><i class='far fa-file'></i> {$type}  - </strong> {$value->document_date} {$render_summary}{$render_archived_message}</div>
      </div>
    </div>
    ";
  }
}

?>

<div pw-replace="section_heading" class="pb-0">
  <div  class="container">
  	<div class="row">
      <div class="content col-12">
        <div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
      </div>

    </div>
    <ul class="nav-tabs-affiliates nav nav-tabs">
      <?=$pageTabs ?>
    </ul>
  </div>
</div>


<div pw-append="section_content">

	<div class="" edit="body_2">
    <?=$page->body_2 ?>
  </div>
  
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-pills nav-url-state nav-justified" role="tablist">
      <li role="presentation" class="active"><a href="#home" class="border-1" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-check-circle"></i> <?=($page->label_1) ? $page->label_1 : "Training Modules"?></a></li>
      <li role="presentation"><a href="#Documentation" class="border-1" aria-controls="Documentation" role="tab" data-toggle="tab"><i class="far fa-file"></i> <?=($page->label_2) ? $page->label_2 : "Additional Supporting Materials" ?></a></li>
      <!--    <li role="presentation"><a href="#Training" class="border-1" aria-controls="Training" role="tab" data-toggle="tab"><i class="fas fa-graduation-cap"></i> <?=($page->label_3) ? $page->label_3 : "All Training Materials" ?></a></li>-->
    </ul>
    <!-- Tab panes -->
    <div class="tab-content mt-3">
      <div role="tabpanel" class="tab-pane active" id="home">
        <div class="mt-4 mb-4" edit="body_3">
          <?=$page->body_3 ?>
        </div>
        <hr class="mb-0" />
        <div id="timeline" class="" >
         <div class="timeline-list"  edit="repeater_callout_recommended_training">

          <?=$render_recommended_training_docs ?>
        </div>
      </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="Documentation">

      <div class="mt-4 mb-4" edit="body_4">
        <?=$page->body_4 ?>
      </div>
      <hr />
      <?=$render_curation_docs ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="Training">

      <div class="mt-4 mb-4" edit="body_5">
        <?=$page->body_5 ?>
      </div>
      <hr />
      <?=$render_training_docs ?>

    </div>
  </div>

  </div>

  <hr class="mb-0" />

</div>