<? 
/**
 * Child Pages
 */
$fetch = $page->repeater_callout_rich_media_1;
include("App/Views/Partials/render_repeater_callout_rich_media_1_default.php"); 

?>

<?
$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

include("App/Views/Partials/render_sharedata_tabs.php"); 

?>

<div pw-replace="section_heading" class="pb-0">
	<div  class="container">
		<div class="row">
			<div class="content col-sm-9 pr-md-5 pt-md-4 pb-md-3">
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
			<div class="col-sm-2 ">
				<img src="<?=$img?>" class="img-fluid img-thumbnail">
			</div>
		</div>
		<ul class="nav-tabs-affiliates nav nav-tabs">
			<?=$pageTabs ?>
		</ul>
	</div>
</div>


<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<span edit='body_2'>
				<?=$page->body_2 ?>
			</span>
			<?=$render_rich_media_1 ?>
			<span edit='body_3'>
				<?=$page->body_3 ?>
			</span>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_sharedata_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>