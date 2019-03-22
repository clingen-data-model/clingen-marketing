<div pw-replace="section_heading">
	<div  class="container">
		<div class="">
			<div class="content  flex-grow-1 pr-md-5">
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
		</div>
	</div>
</div>

<div pw-before="section_content">
	<?=$page->body_2 ?>
</div>
<div pw-prepend="section_content">
	<? include("App/Views/Partials/render_working_group_rich_list.php"); ?>
</div>