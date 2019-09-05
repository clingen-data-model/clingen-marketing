<?

$fetch = $page->children;
if($fetch->count()) {
	foreach ($fetch as $key => $value) {

		$img = ($value->image_1) ? $value->image_1->width(100)->url : $config->imgSquareStandard;
		$website = ($value->url_general) ? "<a href=\"$value->url_general\" target='_blank' class=\"\">Website</a>" : "";

    
    foreach ($value->relate_countries as $key_1 => $country) {
      $countries .= $country."</br>";
    }
    
    $members = $pages->find("template=user, relate_institutions=$value, sort=title");
    
    foreach ($members as $key_2 => $member) {
      $members_list .= "<li>".$member->user_name_full."</li>";
    }
    
    if($members->count() != 0) {
		$render_page_children_item .= "
		<tr class='row'>
		  <td class='col-4'>
        <strong>{$value->title}</strong>
      </td>
      <td>
		    <div class=\"small\">{$value->label_1}</div>
		    <div class=\"small \">{$website}</div>
        <div class=\"small\">{$value->image_1}</div>
      </td>
      <td>
		    {$countries}
      </td>
      <td>
		    {$members->count()}
      </td>
      <td>
		    <ul class=\"small\">{$members_list}</ul>
      </td>
		</tr>
		";
    $render_children_count++;
      
    } else {
		$render_page_children_item_none .= "
		<tr class='row'>
		  <td class='col-4'>
        <strong>{$value->title}</strong>
      </td>
      <td>
		    <div class=\"small\">{$value->label_1}</div>
		    <div class=\"small \">{$website}</div>
        <div class=\"small\">{$value->image_1}</div>
      </td>
      <td>
		    {$countries}
      </td>
      <td>
		    {$members->count()}
      </td>
      <td>
		    <ul class=\"small\">{$members_list}</ul>
      </td>
		</tr>
		";
    $render_children_none_count++;
    }
    unset($members_list);
	}
	$render_children = "".$render_page_children_item."";
	$render_children_none = "".$render_page_children_item_none."";
	unset($render_page_children_item);
}
?>




<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-12">
			<span  edit="body_1">
				<?=$page->body_1?>
			</span>
      <div class="">Total Org. = <?=$fetch->count()?></div>
      <hr />
      <h2>With Members (<?=$render_children_count?>)</h2>
      <table class="table table-striped">
			  <?=$render_children ?>
      </table>
      <hr />
      <hr />
      <hr />
      <hr />
      <hr />
      <h2>No Members (<?=$render_children_none_count?>)</h2>
      <table class="table table-striped">
			  <?=$render_children_none ?>
      </table>
		</div>
<!--
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>
-->
	</div>
</div>