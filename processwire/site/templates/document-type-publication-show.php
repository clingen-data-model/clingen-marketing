<?
include("App/Helpers/functions.php");

if(!$page->pub_abstract) {
  if($page->files_1->count() == 1) {
    $session->redirect($page->files_1->first->url);
  } else if($page->url_general) {
    $session->redirect($page->url_general);
  } 
}


if($related_groups = $page->relate_groups) {
	foreach($related_groups as $related_group) {
		$render_group .= "
    <li class='mb-1 small'>
    <a href='{$related_group->httpUrl}'>{$related_group->title}</a>
    </li>
    ";
  }
  $render_groups = "<ul class='list-unstyled'>{$render_group}</ul>";
  unset($render_group);
}


?>


<div pw-replace="section_heading">
  <div  class="container">
  	<div class="row">
      <div class="content col-sm-10">
        <h1><?=$page->parent->title ?></h1>
      </div>
      <div class="col-sm-2 mt-3">
       <a href='<?=$page->parent->httpUrl ?>' class='btn btn-primary'><i class="fas fa-arrow-left"></i> Back</a>
     </div>
   </div>
 </div>
</div>


<div pw-append="section_content">
  <div class="row">
    <div class="col-sm-9">
    	<h2><?=$page->title?></h2>
    	<div class="text-sm text-muted"><?=$page->pub_authors?></div>
    	<div class="mt-3"><?=$page->pub_abstract?></div>
    </div>
    <div class="col-sm-3 border-left-1">
      
      <? if($page->url_general) { ?>
        <div class="line-height-normal mb-3">
          <a class='btn btn-block btn-lg btn-success' target="_publication" href='<?=$page->url_general?>'>View Citation <i class="fas fa-external-link-alt"></i></a>
        </div>
      <? } ?>
      
      <div class="line-height-normal mb-3">
        <cite class="clearfix small text-muted">Date</cite>
        <?=$page->document_date?>
      </div>
      
      <? if($render_groups) { ?>
        <div class="line-height-normal mb-3">
          <cite class="clearfix small text-muted">Related Group</cite>
          <?=$render_groups?>
        </div>
      <? } ?>
    </div>
  </div>
</div>