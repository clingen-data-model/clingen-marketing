<?
if(!$page->body_1) {
 $session->redirect($page->relate_page->url);
}
include("App/Helpers/functions.php");
include("App/Views/Partials/render_documents_side_nav.php");
?>


<div pw-replace="section_heading">
  <div  class="container">
    <div class="content pb-2">
      <h1 class="m-0 p-0"><?=$page->parent->title ?></h1>
    </div>
  </div>
</div>


<div pw-append="section_content">
  <div class="row">
    <div class="col-sm-9">
    	<h2><?=$page->title?></h2>
    	<span  edit="body_1">
       <?=$page->body_1?>
     </span>
   </div>
   
   <div class="col-sm-3">
    <?=$render_nav_documentation_types?>
  </div>
</div>
</div>