<?

	if($leadership_members){
    if($leadership_members_key == 0) {
        include("App/Helpers/functions.php");
    }
    $data_chairs = $leadership_members->relate_user_leaderships("sort=user_name_last, user_hide!=2|3");
    $data_leadership = $leadership_members->relate_user_committee("sort=name_last, user_hide!=2|3");
    $data_curators = $leadership_members->relate_user_curators("sort=name_last, user_hide!=2|3");
    $data_coordinators = $leadership_members->relate_user_coordinators("sort=name_last, user_hide!=2|3");
    $data_members = $leadership_members->relate_user_members("sort=name_last, user_hide!=2|3");
    $data_past_members = $leadership_members->relate_user_members_past("sort=name_last, user_hide!=2|3");
    $text_membership_prefix .= $leadership_members->title;
	  $nav_pill["{$leadership_members->name}"] = "<a href='#heading_membership{$leadership_members->name}' class='badge badge-pill badge-info p-2 mr-2'>{$leadership_members->title} <i class='fas fa-arrow-circle-down'></i></a>";
  } else {
    include("App/Helpers/functions.php");
    $data_chairs = $page->relate_user_leaderships("sort=user_name_last, user_hide!=2|3");
    $data_leadership = $page->relate_user_committee("sort=name_last, user_hide!=2|3");
    $data_curators = $page->relate_user_curators("sort=name_last, user_hide!=2|3");
    $data_coordinators = $page->relate_user_coordinators("sort=name_last, user_hide!=2|3");
    $data_members = $page->relate_user_members("sort=name_last, user_hide!=2|3");
    $data_past_members = $page->relate_user_members_past("sort=name_last, user_hide!=2|3");
    $text_membership_prefix .= " Membership";
  }

	if($data_chairs->count()) { 
		$render_chairs_grid = "
			<div class='user_group_chairs' edit='relate_user_leaderships'>
				<h4>Chairs</h4>
				". render_member_grid($data_chairs, $defaultImgUserSquare) ."
			</div>";
		$render_chairs_list .= "";

		foreach ($data_chairs as $key => $value) {
			//$email = ($value->email) ? $value->email : "";
			$render_chairs_nav .= "
				<div class='strong mt-1'><a href='{$member_url}{$value->user_name_last}-{$value->id}' class='text-dark'>{$value->user_name_full}</a></div>
				{$email}
			";
		}
	}

	if($data_leadership->count()) {  
		$render_leadership_grid = "
			<div class='user_group_leadership' edit='relate_user_committee'>
				<h4>Leadership</h4>
			". render_member_grid($data_leadership, $defaultImgUserSquare) ."
			</div>";
		$render_leadership_list .= "";
	}

	if($data_coordinators->count()) { 
		$render_coordinators_grid = "
			<div class='user_group_coordinators' edit='relate_user_coordinators'>
			<h4>Coordinators</h4>
			". render_member_grid($data_coordinators, $defaultImgUserSquare) ."
			</div>";
		$render_coordinators_list .= "";
	
		foreach ($data_coordinators as $key => $value) {
			$email = ($value->email) ? "<a href='mailto:$value->email'>{$value->email}</a>" : "";
			$render_coordinators_nav .= "
				<div class='strong mt-1'><a href='{$member_url}{$value->user_name_last}-{$value->id}' class='text-dark'>{$value->user_name_full}</a></div>
				{$email}
			";
		}
	}

	if($data_curators->count()) { 
		$render_curators_grid = "
			<div id='group_curators' class='user_group_members'  edit='relate_user_curators'>
				<h4>Curators</h4>
			". render_member_grid($data_curators, $defaultImgUserSquare) ."
			</div>";
		$render_members_list .= "";
	}

	if($data_members->count()) { 
		$render_members_grid = "
			<div id='group_members' class='user_group_members'  edit='relate_user_members'>
				<h4>Members</h4>
			". render_member_grid($data_members, $defaultImgUserSquare) ."
			</div>";
		$render_members_list .= "";
	}
	
	if($data_past_members->count()) { 
		$render_past_members_grid = "
			<div class='user_group_past_members' edit='relate_user_members_past'>
				<h4>Past Members</h4>
			". render_member_grid($data_past_members, $defaultImgUserSquare) ."
			</div>";
		$render_past_members_grid .= "";
	}



$render_membership_grid = "
	{$render_chairs_grid}
	{$render_leadership_grid}
	{$render_coordinators_grid}
	{$render_curators_grid}
	{$render_members_grid}
	{$render_past_members_grid}
	";

//$render_membership_list = "
//		{$render_chairs_list}
//		{$render_leadership_list}
//		{$render_coordinators_list}
//		{$render_members_list}
//		{$render_past_members_list}
//		";

  if(!$leadership_members) {
	$nav_pill['member'] = "<a href='#heading_membership' class='badge badge-pill badge-info p-2 mr-2'>Membership <i class='fas fa-arrow-circle-down'></i></a>";
  }
$render_membership = "
		<h3 class='mt-5' id='heading_membership{$leadership_members->name}'>{$text_membership_prefix}</h3>
		<p>Membership spans many fields, including genetics, medical, academia, and industry.</p>
		{$render_membership_grid}
		<hr />
	";

$render_membership_nav .= "
		<h5 class='mt-2'>Chairs</h5>
		<div class='small'>{$render_chairs_nav}</div>
";
if($render_coordinators_nav) {
	$render_membership_nav .= "
			<hr />
			<h5>Coordinators</h5>
			<div class='small'>Please contact a coordinator if you have questions.</div>
			<div class='small'>{$render_coordinators_nav}</div>		
		";
}
// <h5>Membership</h5>
// 		<div class='small'>Membership in this committee spans many fields, including genetics, medical, academia, and industry. [<a href='#group_members'>View Members</a><br />
// 		For more information, please contact:
// 		{$render_coordinators_nav}</div>
// $render_membership_summary = "
// 		<div class='row'>
// 		<div class='col-sm-4'>
// 			<h5 class='mt-2'>Chairs</h5>
// 			<div class='small'>{$render_chairs_nav}</div>
// 		</div>
// 		<div class='col-sm-4'>
// 			<h5>Coordinators</h5>
// 			<div class='small'>Please contact a coordinator if you have questions.</div>
// 			<div class='small'>{$render_coordinators_nav}</div>
// 		</div>
// 		<div class='col-sm-4'>
// 			<h5>Membership</h5>
// 			<div class='small'>Membership in this committee spans many fields, including genetics, medical, academia, and industry. [<a href='#group_members'>View Members</a><br />
// 			For more information, please contact:
// 			{$render_coordinators_nav}</div>
// 		</div>
// 		</div>
// 	";




unset($data_chairs);
unset($data_leadership);
unset($data_coordinators);
unset($data_members);
unset($data_past_members);

unset($render_chairs_grid);
unset($render_leadership_grid);
unset($render_coordinators_grid);
unset($render_members_grid);
unset($render_past_members_grid);
unset($text_membership_prefix);

?>