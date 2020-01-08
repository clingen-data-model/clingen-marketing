<?  
/**
 * Child Pages
 */
$fetch = $page->parent->children("template=tool-webinar-series-show");
include("App/Views/Partials/render_repeater_webinar_episode_all.php"); 

?>

<?
$img = ($page->parent->image_icon_1) ? $page->parent->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

if($page->repeater_callout_rich_media_8->count()) {
	$render_material .= "<hr />";
	foreach ($page->repeater_callout_rich_media_8 as $key => $value) {
		$render_file_1 = ($value->file_1) ? "<div class='mb-2'><a href='{$value->file_1->httpUrl}' class='btn btn-primary' target='file'><i class='glyphicon glyphicon-download-alt'></i> View File</a></div>" : "";
		$render_img_1 = ($value->image_icon_1) ? $value->image_icon_1->size(800,500)->url : $config->imgSquareStandard;
		$render_material .= "
		<div class='row mb-2'>
			<div class='col-sm-3'>
				<img src='{$render_img_1}' class='img-fluid img-thumbnail' alt='{$value->label_1}'/>
			</div>
			<div class='col-sm-9'>
				<h4>{$value->label_1}</h4>
				<div>{$value->body_1}</div>
				{$render_file_1}
			</div>
		</div>
		";
		unset($render_img_1);
		unset($render_file_1);
	}
	$render_materials = "<div class=''>{$render_material}</div>";
}

include("App/Views/Partials/render_tools_webinar_tabs.php"); 

?>

<div pw-replace="section_heading" class="pb-0">
	<div  class="container">
		<div class="row">
			<div class="content col-sm-9 pr-md-5 pt-md-4 pb-md-3">
				<div class="section-heading-content"><?=($page->parent->body_1) ? $page->parent->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
			<div class="col-sm-2 hidden-xs ">
				<img src="<?=$img?>" class="img-fluid img-thumbnail" />
			</div>
		</div>
		<ul class="nav-tabs-affiliates nav nav-tabs">
			<?=$pageTabs ?>
		</ul>
	</div>
</div>


<div pw-append="section_content">

	<div class="row">
		<div class="col-sm-12">
			<span edit='body_2'>
				<?=$page->body_2 ?>
			</span>
			
			<?=$render_materials ?>
			
			<span edit='body_3'>
				<?=$page->body_3 ?>
			</span>
		</div>
		<div class="col-sm-12">
			<hr />
			<h3>Complete Series</h3>
			<?=$render_webinar_episode_all ?>
		</div>
	</div>
	
</div>