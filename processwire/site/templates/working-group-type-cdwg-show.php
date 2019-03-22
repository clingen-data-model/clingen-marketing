<?
		$imgPage = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;
		
		$text_membership_prefix = "CDWG";

		include("App/Views/Partials/render_cdwg_eps_group_list.php");
		include("App/Views/Partials/render_wg_documents_list.php");
		include("App/Views/Partials/render_wg_tools_list.php");
		include("App/Views/Partials/render_group_members.php");

		foreach ($nav_pill as $key => $value) {
			$render_nav_pill .= $value;
		}
?>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="">
	  	<div class="content">
		    <h1><?=$page->parent->title ?></h1>
		  </div>
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row ">
		<div class="col-sm-9">
		  <h2 class="mb-0"><?=$page->title ?></h2><div class="mb-3 small"><a href='<?=$page->parent->httpUrl ?>' class='text-muted'>Affiliated to <?=$page->parent->title ?></a></div>
		  
				<?=$render_nav_pill ?>
		  <hr />
			<span  edit="body_1">
        <?=$page->body_1?>
      </span>
			<?=$render_eps ?>
		</div>
		<div class="col-sm-3 ">
			<div class="border-left-1 pl-3">
				<?=$render_membership_nav ?>
			</div>
		</div>

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