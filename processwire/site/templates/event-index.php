<?
$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

$fetch = $page->children("event_date>today, sort=event_date");
if($fetch->count()) {
 foreach ($fetch as $key => $value) {
    //$render_array["{$value->template->name}"] = "{$value->template->title}";

  $render_event .= "
  <tr class=''>
  <td class='text-small text-muted pr-4' no-wrap>
  {$value->event_date}
  </td>
  <td>
  <a class='title' href='{$value->httpUrl}'><strong>{$value->title}</strong></a>
  <div class='small text-muted'>{$value->summary}</div>
  </td>
  </tr>
  ";

}

$render_events = "<table class='table'>{$render_event}</table>";
unset($render_event);
}

$fetch = $page->children("event_date<today, sort=event_date");
if($fetch->count()) {
 foreach ($fetch as $key => $value) {
    //$render_array["{$value->template->name}"] = "{$value->template->title}";

  $render_event .= "
  <tr class=''>
  <td class='text-small text-muted pr-4' no-wrap>
  {$value->event_date}
  </td>
  <td>
  <a class='title' href='{$value->httpUrl}'><strong>{$value->title}</strong></a>
  <div class='small text-muted'>{$value->summary}</div>
  </td>
  </tr>
  ";

}

$render_events_past = "<div class='pt-3 pb-3'><hr /></div><h5>Past {$page->title}</h5><table class='table'>{$render_event}</table>";
unset($render_event);

}

?>

<div pw-replace="section_heading">
  <div  class="container">
    <div class="">
      <div class="content pr-md-5 ">
        <h1 class="section-heading-content"><?=$page->title ?></h1>
      </div>
    </div>
  </div>
</div>

<div pw-prepend="section_content">
  <div class="row">
    <div class="col-sm-9">
      <span  edit="body_1">
        <?=$page->body_1?>
      </span>
      <?= $render_events ?>
      
      <?= $render_events_past ?>
    </div>
    <div class="col-sm-3">
     <? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
   </div>
 </div>
</div>

