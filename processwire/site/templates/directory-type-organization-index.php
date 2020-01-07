<?

$fetch = $page->children("");
if($fetch->count()) {
	foreach ($fetch as $key => $value) {

		$img = ($value->image_1) ? $value->image_1->width(100)->url : $config->imgSquareStandard;
		//$title = ($value->url_general) ? "<a href=\"$value->url_general\" target='_blank' class='title'>{$value->title}</a>" : "<span class='title'>{$value->title}</span>";
		$title = "<a href=\"$value->httpUrl\" class='title'>{$value->title}</a>";

    
    foreach ($value->relate_countries as $key_1 => $country) {
      $countries .= $country->title."</br>";
    }
    
    $members = $pages->find("template=user, relate_institutions=$value, sort=title");
//    
//    foreach ($members as $key_2 => $member) {
//      $members_list .= "<li class='col-md-6'>".$member->user_name_full."</li>";
//    }
    
    if($members->count() != 0) {
		$render_page_children_item .= "
		<tr class='row '>
		  <td class=''>
        {$title}
      </td>
      <td nowrap class='country text-muted'>
		    {$countries}
      </td>
		</tr>
		";
	}
    //$render_children_count++;
//      
//    } else {
//		$render_page_children_item_none .= "
//		<tr class='row'>
//		  <td class='col-4'>
//        <strong>{$value->title}</strong>
//      </td>
//      <td>
//		    <div class=\"small\">{$value->label_1}</div>
//		    <div class=\"small \">{$website}</div>
//        <div class=\"small\">{$value->image_1}</div>
//      </td>
//      <td>
//		    {$countries}
//      </td>
//      <td>
//		    {$members->count()}
//      </td>
//      <td>
//		    <ul class=\"small\">{$members_list}</ul>
//      </td>
//		</tr>
//		";
//    $render_children_none_count++;
//    }
    unset($members_list);
    unset($countries);
	}
	$render_children = "".$render_page_children_item."";
	$render_children_none = "".$render_page_children_item_none."";
	unset($render_page_children_item);
}
?>




<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<span  edit="body_1">
				<?=$page->body_1?>
			</span>
      <div id="list_organization_table" >
				<div class="card mb-0 bg-white">
					<div class="card-header input-group w-100">
						<input type="text" class="form-control search" placeholder="Filter list..." aria-label="Filter list">
					</div>
				</div>
      <table class="table table-striped table-hover">
        <tbody class="list">
			    <?=$render_children ?>
        </tbody>
      </table>
        </div>
		</div>

		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>

	</div>
</div>