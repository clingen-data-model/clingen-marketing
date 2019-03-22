<?
include("App/Helpers/functions.php");


if($page->image_1) {
  $imgHowClinGenWorks = $page->image_1->width(1000)->url;
  $imgHowClinGenWorks = "<img src=\"{$imgHowClinGenWorks} \" class=\"img-fluid\">";
}

$fetch = $page->find('template=curation-show');
if($fetch) {
  foreach ($fetch as $key => $value) {

    $img = ($value->image_icon_1->url) ? $value->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

    $urlChildren = $value->children("template=redirect-curations")->each(function($child) {
      if($child->url_general){
        return "<a href='$child->url_general' class='btn btn-sm btn-link pl-1 pr-1'>$child->title <i class=\"fas fa-external-link-alt\"></i></a>";
      } else if($child->url_curations){
        return "<a href='$child->url_curations' class='btn btn-sm btn-link pl-1 pr-1'>$child->title <i class=\"fas fa-external-link-alt\"></i></a>";
      } else if($child->url_interface){
        return "<a href='$child->url_interface' class='btn btn-sm btn-link pl-1 pr-1'>$child->title <i class=\"fas fa-external-link-alt\"></i></a>";
      } else {
        return "<a href='$child->url' class='btn btn-sm btn-link pl-1 pr-1'>$child->title</a>";
      }
    });

    $render_page_children_item .= "
      <div class='col-md-6 '>
        <div class=\"card mb-3  \">
           <div class=\"row no-gutters bg-light \">
            <div class=\"col-md-3  \">
             <a class='' href='{$value->httpUrl}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->title}\"></a>
            </div>
            <div class=\"col-md-9 bg-white\">
              <div class=\"card-body\">
                <a class='' href='{$value->httpUrl}'><h5 class=\"card-title mb-1\">{$value->title}</h5></a>
                <p class=\"small mb-1\">{$value->summary}</p>
                <a href=\"{$value->httpUrl}\" class=\"btn btn-sm btn-primary\">Learn More</a>
                {$urlChildren}
              </div>
            </div>
          </div>
        </div>
      </div>
    ";

  }
  $curation_activities = "<ul class='list-unstyled row'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}

$fetch = $pages->get("template=document-index")->children("limit=8, sort=-document_date");
if($fetch) {
  foreach ($fetch as $key => $value) {

    $icon = print_icon($value->template);



    $render_page_children_item .= "
      <li class='{$option['css']} col-md-6 mt-1 mb-3'>
        <div class='d-flex '>
          <div class='col-sm-2 align-self-start col-xs-1 padding-right-none'>
            <a class='icon-lg text-muted' href='{$value->httpUrl}'>
              {$icon}
            </a>
          </div>
          <div class=' padding-right-none align-self-start'>
            <a class='small text-muted strong' href='{$value->httpUrl}'>{$value->document_date}</a>
            <a class='' href='{$value->httpUrl}'><h5 class='m-0 p-0'>{$value->title}</h5></a>
            <div class='text-muted small'>{$value->summary}</div>
          </div>
        </div>
      </li>
    ";
  }
  $render_recent_news = "<ul class='list-unstyled row'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}

$fetch = $page->repeater_callout_text_summary;
if($fetch) {
  foreach ($fetch as $key => $value) {

    $icon = "<i class=\"{$value->label_2}\"></i>";

    $render_page_children_item .= "
      <li class='{$option['css']} col-md-4 mt-1 mb-3 '>
        <div class='card flex-fill text-center'>
        <a href='{$value->url_general}' class='card-body p-1'>
          <div class=' padding-right-none align-self-start pt-1 pb-2'>
              <div class='m-0 p-0 display-3 text-primary'>{$value->label_2}</div>
              <h6 class='m-0 p-0 text-muted'>{$value->label_1}</h6>
          </div>
        </a>
        </div>
      </li>
    ";
  }
  $render_stats = "<ul class='list-unstyled row'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}

// $fetch = $page->repeater_callout_text_icon_1;
// if($fetch) {
//   foreach ($fetch as $key => $value) {

//     $icon = "<i class=\"{$value->label_2}\"></i>";

//     $render_page_children_item .= "
//       <li class='{$option['css']} col-md-6 mt-1 mb-3'>
//         <div class='card'>
//         <div class='card-body d-flex '>
//           <div class=' padding-right-none align-self-start pt-2 pl-3 pt-2 pr-3'>
//             <h4 class='m-0 p-0'>{$icon} {$value->label_1}</h4>
//             <div class='text-muted small'>{$value->body_1}</div>
//           </div>
//         </div>
//         </div>
//       </li>
//     ";
//   }
//   $render_benefits = "<ul class='list-unstyled row'>".$render_page_children_item."</ul>";
//   unset($render_page_children_item);
// }

$fetch = $page->repeater_callout_rich_media_1;
if($fetch) {
  foreach ($fetch as $key => $value) {

    if($value->image_1) {
      $image_icon_path = $value->image_1->size(600,400)->httpUrl;
    }
    if($key == 0){
      $render_primary_item = "
        <div class=\"col-lg-6 col-md-6 \">
          <div class=\"card\">
            <a href=\"{$value->relate_page}\" class=\"hidden-md hidden-sm hidden-xs\">
              <img src=\"{$image_icon_path}\" class=\"card-img-top\" alt=\"{$value->label_1}\">
            </a>
            <div class=\"card-body pt-3 pl-3 pr-3 pb-3\">
              <a href=\"{$value->relate_page}\" class=\"\"><h5 class=\"card-title  p-0 m-0\">{$value->label_1}</h5></a>
              <p class=\"card-text small\">{$value->summary}</p>
            </div>
          </div>
        </div>
      ";
    } else if($key == 1){
      $render_secondary_item = "
        <div class=\"col-lg-12 mt-lg-2 \">
          <div class=\"card \">
            <div class=\"row no-gutters \">
              <div class=\"col-md-4 hidden-md hidden-sm hidden-xs \">
                <a href=\"{$value->relate_page}\" class=\"\">
                  <img src=\"{$image_icon_path}\" class=\"card-img-top\" alt=\"{$value->label_1}\">
                </a>
              </div>
              <div class=\"col-md-8 \">
                <div class=\"card-body p-2\">
                  <a href=\"{$value->relate_page}\" class=\"\"><h5 class=\"card-title h5 p-0 m-0\">{$value->label_1}</h5></a>
                  <p class=\"card-text small pb-0\">{$value->summary}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      ";
    } else {
      $render_other_items .= "
        <div class=\"col-lg-6 col-md-3 \">
          <div class=\"card  align-self-stretch\">
            <a href=\"{$value->relate_page}\" class=\"hidden-md hidden-sm hidden-xs \">
              <img src=\"{$image_icon_path}\" class=\"card-img-top\" alt=\"{$value->label_1}\">
            </a>
            <div class=\"card-body pt-3 pl-3 pr-3 pb-3\">
              <a href=\"{$value->relate_page}\" class=\"\"><h5 class=\"card-title p-0 m-0 h6 \">{$value->label_1}</h5></a>
              <p class=\"card-text small\">{$value->summary}</p>
            </div>
          </div>
        </div>
      ";
    }
  } 
  $render_rich_media_1 = "
    <div edit='repeater_callout_rich_media_1' class='list-unstyled d-flex row  pt-2 pb-4'>
      {$render_primary_item}
      <div class='col-lg-6 d-flex'>
        <div class='row  '>
          <div class='col-12 align-self-start'><div class='row'>{$render_other_items}</div></div>
          <div class='align-self-stretch'>
            {$render_secondary_item}
          </div>
        </div>
      </div>
    </div>";
  unset($render_page_children_item);
}

$getstarted = $pages->get("template=get-started-index");
if($getstarted) {
  foreach ($getstarted->repeater_callout_rich_media_2 as $key => $value) {
    $render_get_started_links .= "<li class=\"list-inline-item\"><a class='badge badge-pill badge-info p-2' href='{$getstarted->httpUrl}#loc_{$value->name}'>{$value->label_1}</a></li>";
  }
}

include("App/Views/Partials/render_search_bar.php"); 

?>

<remove pw-remove="section_heading"></remove>

<section pw-before="section_main" class="">
        
  <div class="container mt-4 mb-3 p-4">
    <div class="row">
      <div class="offset-sm-12">
        <span  edit='body_1'><?=$page->body_1?></span>
          <?=$search_main ?>
      </div>
    </div>
  </div>
</section>
 
<div pw-before="section_content">
  <div class="section-hero-gradient-standard pt-3 pb-1">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-12">
        	<div class="content-white" edit='body_2'><?=$page->body_2?></div>
          <?=$render_rich_media_1 ?>
          
      </div>
    </div>
  </div>
</div>
<div pw-before="section_content">
  <div class="bg-white pt-3 pb-1">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-12">
        <div class="" edit='body_3'><?=$page->body_3?></div>
          <ul class='list-inline d-flex justify-content-start'>
            <?=$render_get_started_links ?>
<!--
            <li class="list-inline-item">
              <a class='badge badge-pill badge-info p-2' href='<?=$getstarted->httpUrl ?>#loc_who'>Who We Are</a>
            </li>
            <li class="list-inline-item">
              <a class='badge badge-pill badge-info p-2' href='<?=$getstarted->httpUrl ?>#loc_involved'>Get Involved</a>
            </li>
-->
          </ul>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div pw-before="section_content">
  <div class="section-hero-gradient-standard  pt-2 pb-1">
    <div class="container pt-4 pb-2">
      <div class="row">
        <div class="offset-sm-12">
          <h3 class="text-white">Curation Activities</h3>
            <?=$curation_activities ?>
        </div>
      </div>
    </div>
  </div>
</div>


<div pw-before="section_content">
  <div class="section-hero-bg-white pt-3 pb-3">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-12">
          <h3>Recent Updates</h3>
            <?=$render_recent_news ?>
            <div class="text-center">
              <a class="btn btn-lg btn-outline-primary" href="/docs">More Recent Updates &amp; Documents</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div pw-before="section_content">
  <div class="section-hero-bg-light">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="col-12">
          <?=$page->body_4?>
          <?=$render_stats ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div pw-before="section_content">
  <div class="section-hero-bg-white">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-1 col-sm-10">
            <?=$imgHowClinGenWorks ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div pw-before="section_content">
  <div class="section-hero-gradient-standard  pt-4 pb-4">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-1 col-sm-10">
          <div class="content-white pb-4"><?=$page->body_5?></div>
          <?=$render_benefits ?>
        </div>
      </div>
    </div>
  </div>
</div> -->
