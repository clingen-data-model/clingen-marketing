<? 
if(!$page->body_1) {
	if($page->url_curations) {
		$session->redirect($page->url_curations);
	}
	if($page->url_general) {
		$session->redirect($page->url_general);
	}
}

/**
 * Child Pages
 */
$fetch = $page->repeater_callout_rich_media_1;
include("App/Views/Partials/render_repeater_callout_rich_media_1_default.php"); 


$fetch = $page->repeater_callout_rich_media_4;
include("App/Views/Partials/render_repeater_callout_rich_media_4_default.php"); 

?>

<?
$img_icon = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;
$img_1 = ($page->image_1) ? "<img src=".$page->image_1->width(600)->url." class='img-fluid float-right w-50'>" : "";
?>

<div pw-replace="section_heading" class="">
	<div  class="container">
		<div class="">
			<div class="content col-sm-9 pr-md-5 pt-md-4 pb-md-3">
				<div class="section-heading-content"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
			<div class="col-sm-2 ">
				<img src="<?=$img_icon?>" class="img-fluid img-thumbnail">
			</div>
		</div>
	</div>
</div>


<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<?=$img_1 ?>
			<span edit='body_2'>
				<?=$page->body_2 ?>
			</span>
			<?=$render_rich_media_4_anchors ?>
			<?=$render_rich_media_1 ?>
			<?=$render_rich_media_4 ?>
			<span edit='body_3'>
				<?=$page->body_3 ?>
			</span>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_tool_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>