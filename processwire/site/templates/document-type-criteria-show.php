<?
  if(!$page->body_1) {
    if(!count($page->files_1)) {
      $session->redirect($page->file_1->url);
    }
	}

	include("App/Helpers/functions.php");
	include("App/Views/Partials/render_documents_side_nav.php");

if($related_groups = $page->relate_groups) {
	foreach($related_groups as $related_group) {
		$render_group .= "
      <li class='mb-1 small'>
        <a href='{$related_group->httpUrl}'> {$related_group->title}</a>
      </li>
		  ";
	}
  $render_groups = "<ul class='list-unstyled'>{$render_group}</ul>";
  unset($render_group);
}
  

  if(count($page->files_1)) {
    foreach($page->files_1 as $support_file) {
      $support_file_name = ($support_file->description) ? $support_file->description : $support_file->name;
      $render_files .= "
            <tr>
              <td class='pr-2'>
                <i class='far fa-file text-muted'></i>
              </td>
              <td class='w-100 '>
                <a href='{$page->file_1->url}' class='small'>{$support_file_name}</a>
              </td>
              <td class='pl-3'>
                <a href='{$page->file_1->url}' class='btn btn-sm btn-outline-primary'><i class='fas fa-external-link-alt'></i> VIEW</a>
              </td>
            </tr>
      
      ";
    }
  }


$render_archived = ($page->document_archived) ? "<span class='p-1 label label-warning'>Attention: This is an archived document and available to reference. A more version document may be available.</span>" : "";


?>


<div pw-replace="section_heading">
  <div  class="container">
      <div class="content pb-2">
        <h1 class="m-0 p-0"><?=$page->parent->title ?></h1>
        <?=$render_archived?>
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
        <div class="list-group-item list-group-item-action bg-light">
            <h4 class="mb-1">Curation Activity Procedure</h4>
          <table class="w-100">
            <tr>
              <td class="pr-2">
                <i class="far fa-file h3"></i>
              </td>
              <td class="w-100 bold">
                <a href='<?=$page->file_1->url ?>' class=""><?=$page->title ?></a>
              </td>
              <td class="pl-3">
                <a href='<?=$page->file_1->url ?>' class="btn btn-primary"><i class="fas fa-external-link-alt"></i> VIEW</a>
              </td>
            </tr>
          </table>
        </div>
        <? if($render_files) { ?>
        <div class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Additional Supporting Materials</h5>
            <table class="w-100">
              <?=$render_files?>
            </table>
          </div>
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
            <cite class="clearfix small text-muted">Related Groups</cite>
            <?=$render_groups?>
          </div>
          <? } ?>
				</div>
			</div>
</div>