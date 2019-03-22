<?
$text_membership_prefix = "";



foreach($page->relate_groups as $leadership_members_key => $leadership_members ) {
	include("App/Views/Partials/render_group_members.php");
	$render_membership_leaders .= $render_membership;
}

foreach ($nav_pill as $key => $value) {
	$render_nav_pill .= $value;
}

?>

<div pw-replace="section_heading">
	<div  class="container">
		<div class="">
			<div class="content col-12">
				<div class="section-heading-content" edit="body_1">
					<?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?>
					<?=$render_nav_pill ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9" edit="body_2">
			<?=$page->body_2?>
			<?= $render_membership_leaders ?>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>