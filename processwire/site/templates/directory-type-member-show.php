<?

$nav_side_active_override = 1088;

$member = $sanitizer->name($input->urlSegment1);
$member = end(explode('-',$member));
$member = $pages->get("template=user, id=$member");
if(!$member->user_name_last) {
	$session->redirect($page->parent->url);
}
$img = ($member->user_photo) ? $member->user_photo->size(600,600)->url : $config->imgUserSquareStandard;

$groups = $pages->find("template=working-group-type-cdwg-index|working-group-type-cdwg-show|working-group-type-dpwg-index|working-group-type-dpwg-show|working-group-type-standard-index|working-group-type-standard-show|affiliation-show|affiliation-index, relate_user_members|relate_user_leaderships|relate_user_coordinators|relate_user_curators|relate_user_committee=$member, sort=title");

$pastgroups = $pages->find("template=working-group-type-cdwg-index|working-group-type-cdwg-show|working-group-type-dpwg-index|working-group-type-dpwg-show|working-group-type-standard-index|working-group-type-standard-show|affiliation-show|affiliation-index, relate_user_members_past=$member, sort=title");

if($member->relate_institutions->count()) {
	foreach ($member->relate_institutions as $key => $value) {

		$render_relate_institution .= "
		<li class=''>
		<a class='' href='{$value->httpUrl}'>{$value->title} <span class='sr-only'></span></a>
		</li>
		";
	}
	//$render_relate_institutions = "<hr /><h4 class='mt-4'>Affiliated Institution(s)</h4><ul class='list-unstyled'>".$render_relate_institution."</ul>";
	$render_relate_institutions = "<ul class='list-unstyled'>".$render_relate_institution."</ul>"; 
	unset($render_relate_institution);
}

if($groups->count()) {
	foreach ($groups as $key => $value) {

		$render_groups_item .= "
		<li class='{$option['css']}'>
		<a class='' href='{$value->httpUrl}'>{$value->title} <span class='sr-only'></span></a>
		</li>
		";
	}
	$render_groups = "<hr /><h4 class='mt-4'>Working Groups &amp; Expert Panels</h4><ul class='list-unstyled'>".$render_groups_item."</ul>";
	unset($render_groups_item);
}

if($pastgroups->count()) {
	foreach ($pastgroups as $key => $value) {

		$render_past_groups_item .= "
		<li class='{$option['css']}'>
		<a class='' href='{$value->httpUrl}'>{$value->title} <span class='sr-only'></span></a>
		</li>
		";
	}
	$render_past_groups = "<hr /><h4>Past Groups</h4><ul class='list-unstyled'>".$render_past_groups_item."</ul>";
	unset($render_past_groups_item);
}

?>

<div pw-replace="section_heading">
	<div  class="container">
		<div class="content">
			<h1>ClinGen Member Profile</h1>
		</div>
	</div>
</div>


<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-3" edit="<?=$member->id?>.user_photo" >
			<img src="<?=$img?>" class="img-thumbnail">
		</div>
		<div class="col-sm-6">
			<h2 edit="<?=$member->id?>.user_name_full"><?=$member->user_name_full?></h2>
			<?php if($user->isSuperuser() || $user->hasRole('coordinator')) { ?>
				<div edit="<?=$member->id?>.relate_institutions">
					<?=($render_relate_institutions ? $render_relate_institutions : '<div>EDIT: Connect member with an institution(s)</div>')?>
				</div>
				<div edit="<?=$member->id?>.user_bio">
					<?=($member->user_bio ? $member->user_bio : '<div>EDIT: Add a biography</div>')?>
				</div>
			<? } else { ?>
				<div>
					<?=$render_relate_institutions?>
				</div>
				<div>
					<?=$member->user_bio?>
				</div>
			<? }  ?>
			<?=$render_groups ?>
			<?=$render_past_groups ?>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>
