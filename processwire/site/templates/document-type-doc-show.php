<?
if(!$page->body_1) {
	if($page->files_1->count() == 1) {
		$session->redirect($page->files_1->first->url);
	} else if($page->url_general) {
		$session->redirect($page->url_general);
	}
}

include("App/Helpers/functions.php");
include("App/Views/Partials/render_documents_side_nav.php");

if($related_groups = $page->relate_groups) {
	foreach($related_groups as $related_group) {
		$render_group .= "
		<li class='mb-1 small'>
		<a href='{$related_group->httpUrl}'>{$related_group->title}</a>
		</li>
		";
	}
	$render_groups = "<ul class='list-unstyled'>{$render_group}</ul>";
	unset($render_group);
}

if($files_1 = $page->files_1) {
	foreach($files_1 as $support_file) {
		$support_file_name = ($support_file->description) ? $support_file->description : $support_file->name;
		$render_files .= "
		<tr>
		<td class='pr-2'>
		<i class='far fa-file text-muted'></i>
		</td>
		<td class='w-100 '>
		<a href='{$support_file->url}' class='small'>{$support_file_name}</a>
		</td>
		<td class='pl-3'>
		<a href='{$support_file->url}' class='btn btn-outline-primary'><i class='fas fa-external-link-alt'></i> VIEW</a>
		</td>
		</tr>

		";
	}
}

?>


<div pw-replace="section_heading">
	<div  class="container">
		<div class="content pb-2">
			<h1 class="m-0 p-0"><?=$page->parent->title ?></h1>
		</div>
	</div>
</div>


<div pw-append="section_content">
	<div class="row">
		<div class="col-sm-12 mb-4">
			<h2 class=""><?=$page->title?></h2>
		</div>
		<div class="col-sm-9">
			<span  edit="body_1">
				<?=$page->body_1?>
			</span>
			<div class="list-group">
				<? if($render_files) { ?>
					<div class="list-group-item list-group-item-action bg-light">
						<div class="w-100">
							<h4 class="mb-1">Documents</h4>
							<table class="w-100">
								<?=$render_files?>
							</table>
						</div>
					</div>
				<? } ?>

				<? if($render_files) { ?>
					<div class="list-group-item list-group-item-action bg-light">
						<h4 class="mb-1">Links</h4>
						<table class="w-100">
							<tr>
								<td class="pr-2">
									<i class="fas fa-globe"></i>
								</td>
								<td class="w-100 bold">
									<a href='<?=$page->url_general ?>' class="">Website</a>
									<a href='<?=$page->url_general ?>' class="small"><?=$page->url_general ?></a>
								</td>
								<td class="pl-3">
									<a href='<?=$page->url_general ?>' class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Visit</a>
								</td>
							</tr>
						</table>
					</div>
				<? } ?>
			</div>
			<span  edit="body_2">
				<?=$page->body_2?>
			</span>
		</div>
		<div class="col-sm-3 border-left-1">
			<div class="line-height-normal mb-3">
				<cite class="clearfix small text-muted">Date</cite>
				<?=$page->document_date?>
			</div>
			<? if($render_groups) { ?>
				<div class="line-height-normal mb-3">
					<cite class="clearfix small text-muted">Related Group</cite>
					<?=$render_groups?>
				</div>
			<? } ?>
		</div>
	</div>
</div>