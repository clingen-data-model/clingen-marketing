<?

$fetch = $page->repeater_external_genomic_resources('sort=label_1');
if($fetch) {
  foreach ($fetch as $key => $value) {


    $img = ($value->image_1->url) ? $value->image_1->size(600,600)->url : $config->imgSquareStandard;

    $render_item .= "
    <div class='col-md-12 '>
      <div class=\"card mb-2  \">
        <div class=\"row no-gutters bg-light \">
          <div class=\"col-md-1 hidden-sm hidden-xs align-self-top \">
            <a class='' target='resource' href='{$value->url_general}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>
          </div>
          <div class=\"col-md-11 bg-white\">
            <div class=\"card-body\">
              <a class='' target='resource' href='{$value->url_general}'><h5 class=\"card-title\">{$value->label_1} <i class=\"fas fa-external-link-alt\"></i></h5></a>
              <p class=\"small\">{$value->summary}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    ";
    
     // This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
    // but offers more possibilities 
    if(($key + 1) == count($fetch) ){
      $render_items .=  "<div class='wrap-row row'>{$render_item}</div>"; 
      unset($render_item);
    } else if(($key + 1)%2 == 0) {
      $render_items .=  "<div class='wrap-row row'>{$render_item}</div>"; 
      unset($render_item);
    } 
  }
  $render_items = "<div class='row pt-3'>".$render_items."</div>";
  unset($render_item);
}

$img = ($page->image_1) ? $page->image_1->width(800)->url : $config->imgSquareStandard;

?>

<div pw-replace="section_heading" class="">
  <div  class="container">
  	<div class="">
      <div class="content">
        <div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
      </div>
    </div>
  </div>
</div>

<div pw-prepend="section_content">
  <div edit="body_2"><img src="/site/assets/files/1020/tool-image.800x0.jpg" class="pull-right" style="width:400px;"><?=$page->body_2 ?></div>
  <hr />
  <h2>List of Genomic Resources</h2>
  Navigate each genomic resources below and query each resource individually. 
  <?=$render_items ?>
</div>
