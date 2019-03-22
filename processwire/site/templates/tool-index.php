<?

/**
 * Child Pages
 */
$fetch = $page->repeater_tool_organize;
if($fetch) {

  foreach ($fetch as $key => $category) {

    foreach ($category->relate_tools as $vkey => $value) {

      if($value->id == $page->id) {
        $option['css'] = 'active';
      } else {
        $option['css'] = null;
      }


      $img = ($value->image_icon_1->url) ? $value->image_icon_1->size(600,600)->url : $config->imgSquareStandard;
      if($value->body_1){
        $url_about = "<a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">About</a>";
      } else { unset($url_interface);}
      if($value->url_interface){
        $url_interface = "<a href=\"{$value->url_interface}\" target='_blank' class=\"btn btn-sm btn-outline-primary\">Interface <i class=\"fas fa-external-link-alt\"></i></a>";
      } else { unset($url_interface);}
      if($value->url_curations){
        $url_curations = "<a href=\"{$value->url_curations}\" class=\"btn btn-sm btn-outline-primary\">Curations <i class=\"fas fa-external-link-alt\"></i></a>";
      } else { unset($url_curations);}
      if($value->url_general){
        $url_general = "<a href=\"{$value->url_general}\" class=\"btn btn-sm btn-outline-primary\">Website <i class=\"fas fa-external-link-alt\"></i></a>";
      } else { unset($url_general);}


      $render_page_children_item .= "
      <div class='col-sm-6 '>
        <div class=\"card mb-3  \">
          <div class=\"row no-gutters bg-light \">
            <div class=\"col-md-3 hidden-sm hidden-xs  \">
            <a class='' href='{$value->httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->title}\"></a>
            </div>
            <div class=\"col-md-9 bg-white\">
              <div class=\"card-body\">
                <a class='' href='{$value->httpUrl}'>
                  <h5 class=\"card-title\">{$value->title}</h5>
                </a>
                <p class=\"small\">{$value->summary}</p>
                {$url_about}
                {$url_curations}
                {$url_interface}
                {$url_gitrepository}
                {$url_general}
              </div>
            </div>
          </div>
        </div>
      </div>
      ";
      
    // This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
    // but offers more possibilities
      if(($vkey + 1) == count($category->relate_tools) ){
        $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
        unset($render_page_children_item);
      } else if(($vkey + 1)%2 == 0) {
        $render_page_children_items .=  "<div class='wrap-row row'>{$render_page_children_item}</div>"; 
        unset($render_page_children_item);
      }  
      unset($url_about);
      unset($url_general);
      unset($url_curations);
      unset($url_interface);
      unset($url_gitrepository);
    }

    $render_nav_tools .= "<a href='#heading_{$key}' class='btn btn-xs btn-outline-primary'>{$category->label_1}</a>";
    $render_tools .= "<h2 class='text-center mb-3' id='heading_{$key}'>{$category->label_1}</h2><div class='row'>".$render_page_children_items."</div><div class='p-4'><hr /></div>";
    unset($render_page_children_item);
    unset($render_page_children_items);
  }
}


$img = ($page->image_1) ? $page->image_1->width(800)->url : $config->imgSquareStandard;

?>

<div pw-remove="section_heading"></div>

<div pw-before="section_content" class="">
  <div  class="container">
    <div class="row ">
      <div class="content col-sm-6 ">
        <div class="mt-xl-5 pt-lg-5 pt-sm-3" edit="body_1">
         <?=$page->body_1?>
       </div>
     </div>
     <div class="col-sm-6 hidden-xs ">
      <img src="<?=$img?>" class="img-fluid">
    </div>
  </div>
</div>
</div>

<div pw-prepend="section_content">
  <div class="text-center mb-4">
    <div class="btn-group" role="group" aria-label="First group">
      <?=$render_nav_tools ?>
    </div>
  </div>
  <?= $render_tools ?>
</div>
