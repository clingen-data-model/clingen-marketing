<?

$member_url = wire('pages')->get("id=2124")->httpUrl;

/**
 * [render_member displays a grid of members that have been passed in from the query array]
 * @param  [type] $members              [description]
 * @param  string $defaultImgUserSquare [description]
 * @return [type]                       [description]
 */
function render_member_grid($members, $defaultImgUserSquare = "" , $member_url = ""){
  	 
  $sanitizer = wire('sanitizer');
  
	if(!$member_url){
		$member_url = wire('pages')->get("id=2124")->httpUrl;
	}
	foreach ($members as $key => $value) {

		$img = ($value->user_photo) ? $value->user_photo->size(600,600)->url : "/site/templates/resources/img/defaults/user_square.png";


		$render .= "
		<div class=\"col-md-2 member-section \">
		<a class='member-section-interior' href=\" {$member_url}{$sanitizer->pageName($value->user_name_last)}-{$value->id} \">
		          <div class=\" profile-header\"></div>
		          <div class=\" user-detail\">
		                  <img src=\"{$img} \" class=\"img-thumbnail\">
		                  <strong>{$value->user_name_full}</strong>


		          </div>
		      </a>
		      </div>
		      ";
	
  
  
  
  // This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
  // but offers more possibilities
  if(($key + 1) == count($members) ){
    $render_item .=  "<div class='wrap-row row'>{$render}</div>"; 
    unset($render);
  } else if(($key + 1)%5 == 0) {
    $render_item .=  "<div class='wrap-row row'>{$render}</div>"; 
    unset($render);
  } 
  }
  $render_items = "<div class='col-sm-12'>".$render_item."</div>";
  unset($render_item);
  unset($render);
  
	$return = "<div class=''><div class=''>{$render_items}</div></div>";
	return $return;
}

/**
 * [render_member displays a list of members that have been passed in from the query array]
 * @param  [type] $members              [description]
 * @param  string $defaultImgUserSquare [description]
 * @return [type]                       [description]
 */
//function render_member_list($members, $defaultImgUserSquare = ""){
//	foreach ($members as $key => $value) {
//
//		$img = ($value->user_photo) ? $value->user_photo->size(100,100)->url : "/site/templates/resources/img/defaults/user_square.png";
//
//		if($value->user_name_full) {
//			$render_item .= "
//			      <li class='user_display_list list-group-item '>
//			          <div class='mr-auto d-flex col-10 '>
//			            <div class='mr-auto pr-3'>
//			              <img src=\"{$img} \" class=\"img-thumbnail\">
//			            </div>
//			            <div class='mr-auto  flex-grow-1 '>
//			              <a class='title' href='{$value->httpUrl}'>{$value->user_name_full}</a>
//			          </div>
//			          <div class='ml-auto col-1 '>
//			            <a class='btn-sm btn-primary' href='{$value->httpUrl}'>Profile</a>
//			          </div>
//			      </li>
//			    ";
//			  }
//			}
//	$return = "<ul class='list-group list-group-flush list'>".$render_item."</ul>";
//	return $return;
//}

/**
 * [render_member displays a list of members that have been passed in from the query array]
 * @param  [type] $members              [description]
 * @param  string $defaultImgUserSquare [description]
 * @return [type]                       [description]
 */
function render_member_card($members, $page){
  
  $sanitizer = wire('sanitizer');
	$pagehttpUrl = $page->children("include=hidden")->first->httpUrl;

	foreach ($members as $key => $value) {

		$img = ($value->user_photo) ? $value->user_photo->size(100,100)->url : "/site/templates/resources/img/defaults/user_square.png";
		if($value->user_name_full) {
			$render .= "
			<div class='col-xl-6 col-lg-6 mb-2'>
				<a class=\"card border-0\" href='{$pagehttpUrl}{$sanitizer->pageName($value->user_name_last)}-{$value->id}'>
          <table>
            <tr>
              <td><img src=\"{$img} \" class=\"img-thumbnail user_display_md\"></td>
              <td><div class='pl-2 title'>{$value->user_name_full}</div></td>
            </tr>
          </table>
			  </a>
			</div>
			      ";
			}
		}
	$return = "<div class='row list'>{$render}</div>";
	return $return;
}

function print_icon($value = "", $options = "") {	
	switch ($value) {
    case "announcement-type-event-show":
    	$icon = "fas fa-calendar-alt";
      break;
    case "announcement-type-post-show":
    	$icon = "fas fa-bell";
      break;
    case "announcement-type-poster-show":
    	$icon = "far fa-image";
      break;
    case "announcement-type-presentation-show":
    	$icon = "far fa-file";
      break;
    case "document-type-publication-show":
    	$icon = "fas fa-book";
      break;
    case "announcement-type-pubmention-show":
    	$icon = "fas fa-book";
      break;
    default:
    	$icon = "far fa-file";
      break;
	}
		$return = "<i class=\"{$icon}\"></i>";
		return $return;
}

