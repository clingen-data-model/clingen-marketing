<?
$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

include("App/Views/Partials/render_curation_tabs.php"); 



$fetch = $page->repeater_callout_rich_media_1;
if(count($fetch)) {
  foreach ($fetch as $key => $value) {
    $img = ($value->image_1) ? $value->image_1->size(600,600)->url : $config->imgSquareStandard;
      $httpUrl = ($value->relate_page->httpUrl) ? $value->relate_page->httpUrl : $value->url_general;
    if($httpUrl) {
      $action = ($value->label_2) ? $value->label_2 : "Learn More";
      $httpUrlButton = "<a href=\"{$httpUrl}\" class=\"btn btn-block btn-sm btn-primary\">{$action}</a>";
      $httpUrlTitle = "<a class='' href='{$httpUrl}'><h5 class=\"card-title\">{$value->label_1}</h5></a>";
      $httpUrlImage = "<a class='' href='{$httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>";
    } else {
      $httpUrlTitle = "<h5 class=\"card-title\">{$value->label_1}</h5>";
      $httpUrlImage = "<img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\">";
    }
      $render_page_children_items .= "
        <div class='col-md-12 '>
          <div class=\"card mb-1  \">
             <div class=\"row no-gutters bg-light \">
              <div class=\"col-md-1 col-sm-2 hidden-xs  \">
               {$httpUrlImage}
              </div>
              <div class=\"col-md-11 col-sm-10 bg-white\">
                <div class=\"card-body\">
                  <div class='row'>
                    <div class='col-md-12'>
                      {$httpUrlTitle}
                    </div>
                    <div class='col-md-9'>
                      <p class=\"small\">{$value->summary}</p>
                    </div>
                    <div class='col-md-3'>
                      {$httpUrlButton}
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      ";
  }
  $render_rich_media_1 = "<div class='row' edit='repeater_callout_rich_media_1'>{$render_page_children_items}</div>";
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