<?
$wgimg = ($page->image_icon_1->url) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

$text_membership_prefix = "Working Group";

include("App/Views/Partials/render_group_members.php");
include("App/Views/Partials/render_wg_documents_list.php");
include("App/Views/Partials/render_wg_tools_list.php");

foreach ($nav_pill as $key => $value) {
	$render_nav_pill .= $value;
}
?>

<div pw-replace="section_heading">
	<div  class="container">
		<div class="">
			<div class="content col-sm-10 pr-md-5 pt-md-4 pb-md-3">
				<div class="section-heading-content" edit='body_1'><?=$page->body_1 ?></div>
				<h5><a href='<?=$page->parent->httpUrl ?>' class=''><?=$page->parent->title ?> Subgroup</a></h5>
				<?=$render_nav_pill ?>
			</div>
			<div class="col-sm-2 mt-3">
				<a href='<?=$page->parent->httpUrl ?>' class='mt-4 btn btn-primary'><i class="fas fa-arrow-left"></i> Back</a>
			</div>
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row ">
		<? if($page->body_2) { ?>
			<div class="col-sm-9" edit='body_2'>
				<?=$page->body_2 ?>
			</div>
			<div class="col-sm-3 ">
				<div class="border-left-1 pl-3">
					<?=$render_membership_nav ?>
				</div>
			</div>
		<? } ?>

		<div class="col-sm-12">
			<?=$render_rich_media_3 ?>
			<?=$render_subgroups ?>
			<?=$render_documents ?>
			<?=$render_annoucements ?>
			<?=$render_tools ?>
			<?=$render_membership ?>
		</div>
	</div>
</div>