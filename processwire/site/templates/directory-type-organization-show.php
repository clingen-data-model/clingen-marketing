<?

  $members = $pages->find("template=user, relate_institutions=$page, sort=title, user_hide!=2|3");
    if(count($members)) {
      $members_list = "<hr /><h4>ClinGen Members</h4>";
	  $pagehttpUrl = $pages->get(2124)->httpUrl;
      foreach ($members as $key => $value) {

		$img = ($value->user_photo) ? $value->user_photo->size(100,100)->url : "/site/templates/resources/img/defaults/user_square.png";
		if($value->user_name_full) {
			$members_list .= "
			<li class='col-xl-6 col-lg-6 mb-2'>
				<a class=\"card border-0\" href='{$pagehttpUrl}{$sanitizer->pageName($value->user_name_last)}-{$value->id}'>
          <table>
            <tr>
              <td><img src=\"{$img} \" class=\"img-thumbnail user_display_md\"></td>
              <td><div class='pl-2 title'>{$value->user_name_full}</div></td>
            </tr>
          </table>
			  </a>
			</li>
			      ";
			}
		}
      
      $render_members_list = "<ul class='list-unstyled'>{$members_list}</ul>";
    }

if(count($members)) {
  $workgroups = $pages->find("template=working-group-type-cdwg-index|working-group-type-cdwg-show|working-group-type-dpwg-index|working-group-type-dpwg-show|working-group-type-standard-index|working-group-type-standard-show, (relate_user_committee=$members), (relate_user_coordinators=$members), (relate_user_curators=$members), (relate_user_leaderships=$members), (relate_user_members=$members), (relate_user_members_past=$members), sort=title");

	if($workgroups->count()) {
		foreach ($workgroups as $key => $value) {

			$render_wg_item .= "
			<li class=''>
			<a class='' href='{$value->httpUrl}'>{$value->title} <span class='sr-only'></span></a>
			</li>
			";
		}
		$render_wg_list = "<hr /><h4>Working Groups</h4><ul class='list-unstyled'>".$render_wg_item."</ul>";
		unset($render_wg_item);
	}

	$expertpanels = $pages->find("template=affiliation-show, (relate_user_committee=$members), (relate_user_coordinators=$members), (relate_user_curators=$members), (relate_user_leaderships=$members), (relate_user_members=$members), (relate_user_members_past=$members), sort=title");

	if($expertpanels->count() != $expertpanels_count) {
		foreach ($expertpanels as $key => $value) {

			$render_ep_item .= "
			<li class=''>
			<a class='' href='{$value->httpUrl}'>{$value->title} <span class='sr-only'></span></a>
			</li>
			";
		}
		$render_ep_list = "<hr /><h4>Expert Panels</h4><ul class='list-unstyled'>".$render_ep_item."</ul>";
		unset($render_ep_item);
	}
}
$website = ($page->url_general) ? "<div><a href=\"$page->url_general\" target='_blank' class='title' >Website</a></div>" : "";

foreach ($page->relate_countries as $key_1 => $country) {
      $countries .= $country->title."</br>";
    }

?>

<div pw-replace="section_heading">
	<div  class="container">
		<div class="content">
			<h1>ClinGen Organization Profile</h1>
		</div>
	</div>
</div>


<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<h2><?=$page->title?></h2>
			<?=$website?>
			<?=$countries?>
			<div class="row">
				<div class="col-12">
					<?=$render_members_list ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?=$render_wg_list ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?=$render_ep_list ?>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>