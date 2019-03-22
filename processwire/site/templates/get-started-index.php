<?
include("App/Helpers/functions.php");


$fetch = $page->repeater_callout_text_icon_1;
if($fetch) {
  foreach ($fetch as $key => $value) {

    $icon = "<i class=\"{$value->label_2}\"></i>";

    $render_page_children_item .= "
      <li class='{$option['css']} col-md-4 mt-1 mb-3 '>
        <div class='card'>
        <div class='card-body '>
          <div class=' padding-right-none pt-2 pl-3 pt-2 pr-3'>
            <h4 class='m-0 p-0'>{$icon} {$value->label_1}</h4>
            <div class='text-muted small'>{$value->body_1}</div>
          </div>
        </div>
        </div>
      </li>
    ";
  }
  $render_who = "<ul class='list-unstyled d-flex row' edit='repeater_callout_text_icon_1' >".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}

$fetch = $page->repeater_callout_text_icon_2;
if($fetch) {
  foreach ($fetch as $key => $value) {

    $icon = "<i class=\"{$value->label_2}\"></i>";

    $render_page_children_item .= "
      <li class='{$option['css']} col-md-6 mt-1 mb-3 align-self-stretch  d-flex '>
        <div class='card align-self-stretch d-flex flex-fill'>
        <div class='card-body  align-self-stretch'>
          <div class=' padding-right-none pt-2 pl-3 pt-2 pr-3'>
            <h4 class='m-0 p-0'>{$icon} {$value->label_1}</h4>
            <div class='text-muted small'>{$value->body_1}</div>
          </div>
        </div>
        </div>
      </li>
    ";
  }
  $render_involved = "<ul class='list-unstyled d-flex row' edit='repeater_callout_text_icon_2'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}

$fetch = $page->repeater_callout_rich_media_2;
if($fetch) {
  foreach ($fetch as $key => $value) {

    $icon = "<i class=\"{$value->label_2}\"></i>";
    if($value->images_1) {
      $img_src = ($value->images_1->first) ? $value->images_1->first->width(800)->url : $config->imgSquareStandard;
      $img = "<img src='{$img_src}' class='img-fluid' />";
    }

    $render_page_children_item .= "
    <div class='{$option['css']}'  id='loc_{$value->name}'>
      <div class=\" pt-2 pb-5\">
        <div class=\"container pb-4\">
          <div class=\"row\">
            <div class=\"col-sm-6\">
					      <div class=' col-md-12 mt-1 mb-3'>
					            <div class='text-muted small'>{$value->body_1}</div>
					      </div>
              </div>
            <div class=\"col-sm-6\">
					      <div class=' col-md-12 mt-1 mb-3'>
					            {$img}
					      </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    ";

    $render_page_children_item_nav .= "<li class=\"list-inline-item\"><a class='badge badge-pill badge-info p-2' href='#loc_{$value->name}'>{$value->label_1}  <i class='fas fa-arrow-circle-down'></i></a></li>";
  }
  $render_get_started = "<div>{$render_page_children_item}</div>";
  unset($render_page_children_item);
}
?>
<remove pw-remove="section_heading"></remove>
<section pw-before="section_main" class="section-hero-gradient-standard">
  <div class="container mb-3 p-4">
    <div class="row">
      <div class="offset-sm-12">
        <div class="content-white"><div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div></div>
        <hr />
        <ul class='list-inline'>
        	<?=$render_page_children_item_nav ?>
<!--
	        <li class="list-inline-item">
	        	<a class='badge badge-pill badge-info p-2' href='#loc_who'>Who We Are  <i class='fas fa-arrow-circle-down'></i></a>
	        </li>
	        <li class="list-inline-item">
	        	<a class='badge badge-pill badge-info p-2' href='#loc_involved'>Get Involved  <i class='fas fa-arrow-circle-down'></i></a>
	        </li>
-->
	      </ul>
      </div>
    </div>
  </div>
</section>

<div pw-before="section_content" edit='repeater_callout_rich_media_2'>
<?=$render_get_started ?>
</div>



        
<!--

<div pw-before="section_content">
  <div class="section-hero-bg-white  pt-4 pb-4">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-12">
          <div class="pb-4"><?=$page->body_2?></div>
          <?=$render_who ?>
        </div>
      </div>
    </div>
  </div>
</div>


<div pw-before="section_content">
  <div class="section-hero-bg-light  pt-4 pb-4">
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="offset-sm-12">
          <div class="pb-4"><?=$page->body_3?></div>
          <?=$render_involved ?>
        </div>
      </div>
    </div>
  </div>
</div>-->
