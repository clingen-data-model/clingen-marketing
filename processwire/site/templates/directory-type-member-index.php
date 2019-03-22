<?

include("App/Helpers/functions.php");
//echo $defaultImgUserSquare;

?>

<div pw-prepend="section_content">

	<?=$defaultImgUserSquare?>
	<span  edit="body_1">
		<?=$page->body_1?>
	</span>

</div>

<div pw-prepend="section_content">

	

</div>


<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<div id="list_documentation_table" >
				<div class="card mb-3 bg-white">
					<div class="card-header input-group w-100">
						<input type="text" class="form-control search" placeholder="Filter list..." aria-label="Filter list">
					</div>
				</div>
				<?=render_member_card($pages->find("template=user, sort=user_name_last, user_hide!=2|3"), $page)?>
			</div>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>
