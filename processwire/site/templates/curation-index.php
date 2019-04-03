<?

/**
 * Child Pages
 */
if($page->children) {
  foreach ($page->children("template=curation-show") as $key => $value) {

    $img = ($value->image_icon_1) ? $value->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

    $urlChildren = $value->children;

    //$urlChildren = $value->children("template=curation-documents-index|redirect-curations|redirect-interface")->each(function($child) {
    $vkey = 0;
    $urlChildren = $value->children()->each(function($child) {
      
      if($child->template == "redirect-curations"){        
        
        return "<a href='{$child->url_curations}' class='btn btn-sm btn-link pl-1 pr-1'>$child->title <i class=\"fas fa-external-link-alt\"></i></a>";
      }
      
   });

    //$urlChildrenFirst = (count($urlChildren)) ? "<a href=\"{$urlChildren->httpUrl}\" class=\"btn btn-sm btn-link\">{$urlChildren->title}</a>" : "";

    $render_page_children_item .= "
    <div class='col-sm-6'>
      <div class=\"card mb-3\">
        <div class=\"row d-flex no-gutters\">
          <div class=\"col-md-3 hidden-sm hidden-xs  \">
          <a class='' href='{$value->httpUrl}'> <img src=\"{$img}\" class=\"card-img pl-3\" alt=\"{$value->title}\"></a>
          </div>
          <div class=\"col-md-9\">
            <div class=\"card-body\">
              <a class='' href='{$value->httpUrl}'><h5 class=\"card-title\">{$value->title}</h5></a>
              <p class=\"card-text\">{$value->summary}</p>
              <a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">Learn More</a>
              {$urlChildren}
            </div>
          </div>
        </div>
      </div>
    </div>
    ";
    unset($urlChildren);
  }
  $render_page_children = "<div class='row'>".$render_page_children_item."</div>";
  unset($render_page_children_item);
}

include("App/Views/Partials/render_search_bar.php"); 
?>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="">
      <div class="content ">
        <div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
      </div>
    </div>
  </div>
</div>

<div pw-append="section_content">
	<span edit="body_2"><?=$page->body_2?></span>

  <div class="row">
    <div class="col-md-6">
      <a href="http://search.clinicalgenome.org/kb/curations" class="btn btn-block btn-lg btn-outline-primary">Browse All ClinGen's Curated Genes</a>
    </div>
    <div class="col-md-6"> 
      <a href="https://erepo.clinicalgenome.org/evrepo/" class="btn btn-block btn-lg btn-outline-primary" target="erepo">Browse All ClinGen's Curated Variants</a>
    </div>
  </div>
  
  <table class="mb-4 mt-4">
    <tr>
      <td style="width: 50%">
        <hr />
      </td>
      <td nowrap>
        <div class="pl-3 pr-3 h4 text-muted-more">Learn about Activities</div>
      </td>
      <td style="width: 50%">
        <hr />
      </td>
    </tr>
  </table>
  <?=$render_page_children?>
  <span edit="body_3"><?=$page->body_3?></span>

</div>

