<?


$seg_1         = $sanitizer->name($input->urlSegment1);
$seg_2         = $sanitizer->name($input->urlSegment2);
$seg_3         = $sanitizer->name($input->urlSegment3);

if($seg_1 == 'docs'){
  if($seg_2 == 'assertion-criteria'){
    $findit = $pages->find("relate_groups={$page->id}, template=document-type-criteria-show, sort=-document_criteria_version")->first();
//        echo $findit;
//        die();
    $session->redirect($findit->file_1->url);
  }
  $session->redirect($page->httpUrl."#heading_documents");
}





  ///docs/assertion-criteria


$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;
$text_membership_prefix = "Expert Panel ";

$fetch = $page->repeater_callout_rich_media_3;
include("App/Views/Partials/render_repeater_callout_rich_media_3_default.php");

include("App/Views/Partials/render_group_members.php");
include("App/Views/Partials/render_wg_documents_list.php");
include("App/Views/Partials/render_wg_tools_list.php");

foreach ($nav_pill as $key => $value) {
 $render_nav_pill .= $value;
}



if($page->expert_panel_type."" == 1) {
  switch ($page->affiliate_status_gene."") {
    case 1:
    $status_value = "50";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-complete";
    $ep_step_1_text = "Complete";
    $ep_step_1_date = "".date("M. Y", $page->affiliate_status_gene_date_step_1)."";
    $ep_step_2 = "progress-bar-incomplete";
    $ep_step_2_text = "In progress";
    $ep_step_2_date = "";
    $ep_step_hint = "<i class='text-muted'> -  In progress</i>";
    break;
    case "2":
    $status_value = "50";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-complete";
    $ep_step_1_text = "Complete";
    $ep_step_1_date = "".date("M. Y", $page->affiliate_status_gene_date_step_1)."";
    $ep_step_2 = "progress-bar-complete";
    $ep_step_2_text = "Completed";
    $ep_step_2_date = "".date("M. Y", $page->affiliate_status_gene_date_step_2)."";
    $ep_step_hint = "<i class='text-muted'> - Approved Expert Panel</i>";
    break;
    default:
    $status_value = "50";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-incomplete";
    $ep_step_1_text = "In progress";
    $ep_step_1_date = "";
    $ep_step_2 = "progress-bar-incomplete";
    $ep_step_2_text = "";
    $ep_step_2_date = "";
    $ep_step_hint = "<i class='text-muted'> -  In progress</i>";
    break;
  }

  $render_status_gcep .= " 
  <h4 class='mb-2 pt-2'>Expert Panel Status <small>{$ep_step_hint}</small></h4>
  <div class='pt-0 pb-2'>
    <div class='progress-wg-expert-panel padding-bottom-lg'>
      <div class='progress' edit='affiliate_status_gene'>
        <div class='progress-bar {$ep_step_1}' style='width: {$status_value}%'>Step 1</div>
        <div class='progress-bar {$ep_step_2} progress-bar-border' style='width: {$status_value}%'>Step 2</div>
      </div>
      <div class='progress-bar-subheading'>
        <div class='' style='width: 50%' edit='affiliate_status_gene_date_step_1'>Define Group <br/><i class='text-muted text-sm'>{$ep_step_1_text} {$ep_step_1_date}</i></div>
        <div class='' style='width: 50%' edit='affiliate_status_gene_date_step_2'>Expert Panel Approval <br/><i class='text-muted text-sm'>{$ep_step_2_text} {$ep_step_2_date}</i></div>
      </div>
    </div>
  </div>
  ";

} 


if($page->expert_panel_type."" == 2) {
  switch ($page->affiliate_status_variant."") {
    case "1":
    $status_value = "25";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-current";
    $ep_step_1_text = "In progress";
    $ep_step_1_date = "";
    $ep_step_2 = "progress-bar-incomplete";
    $ep_step_2_text = "";
    $ep_step_2_date = "";
    $ep_step_3 = "progress-bar-incomplete";
    $ep_step_3_text = "";
    $ep_step_3_date = "";
    $ep_step_4 = "progress-bar-incomplete";
    $ep_step_4_text = "";
    $ep_step_4_date = "";
    $ep_step_hint = "<i class='text-muted'> -  In progress</i>";
    break;
    case "2":
    $status_value = "25";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-complete";
    $ep_step_1_text = "Completed";
    $ep_step_1_date = "".date("M. Y", $page->affiliate_status_variant_date_step_1)."";
    $ep_step_2 = "progress-bar-current";
    $ep_step_2_date = "";
    $ep_step_3 = "progress-bar-incomplete";
    $ep_step_3_text = "";
    $ep_step_3_date = "";
    $ep_step_4 = "progress-bar-incomplete";
    $ep_step_4_text = "";
    $ep_step_4_date = "";
    $ep_step_hint = "<i class='text-muted'> -  In progress</i>";
    break;
    case "3":
    $status_value = "25";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-complete";
    $ep_step_1_text = "Completed";
    $ep_step_1_date = "".date("M. Y", $page->affiliate_status_variant_date_step_1)."";
    $ep_step_2 = "progress-bar-complete";
    $ep_step_2_text = "Completed";
    $ep_step_2_date = "".date("M. Y", $page->affiliate_status_variant_date_step_2)."";
    $ep_step_3 = "progress-bar-current";
    $ep_step_3_text = "In progress";
    $ep_step_3_date = "";
    $ep_step_4 = "progress-bar-incomplete";
    $ep_step_4_text = "";
    $ep_step_4_date = "";
    $ep_step_hint = "<i class='text-muted'> -  In progress</i>";
    break;
    case "4":
    $status_value = "25";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-complete";
    $ep_step_1_text = "Completed";
    $ep_step_1_date = "".date("M. Y", $page->affiliate_status_variant_date_step_1)."";
    $ep_step_2 = "progress-bar-complete";
    $ep_step_2_text = "Completed";
    $ep_step_2_date = "".date("M. Y", $page->affiliate_status_variant_date_step_2)."";
    $ep_step_3 = "progress-bar-complete";
    $ep_step_3_text = "Completed";
    $ep_step_3_date = "".date("M. Y", $page->affiliate_status_variant_date_step_3)."";
    $ep_step_4 = "progress-bar-complete";
    $ep_step_4_text = "Completed";
    $ep_step_4_date = "".date("M. Y", $page->affiliate_status_variant_date_step_4)."";
    $ep_step_hint = "<i class='text-muted'> - Approved Expert Panel</i>";
    break;
    default:
    $status_value = "25";
    $ep_step_display = true;
    $ep_step_1 = "progress-bar-current";
    $ep_step_1_text = "In progress";
    $ep_step_1_date = "";
    $ep_step_2 = "progress-bar-incomplete";
    $ep_step_2_text = "";
    $ep_step_2_date = "";
    $ep_step_3 = "progress-bar-incomplete";
    $ep_step_3_text = "";
    $ep_step_3_date = "";
    $ep_step_4 = "progress-bar-incomplete";
    $ep_step_4_text = "";
    $ep_step_4_date = "";
    $ep_step_hint = "<i class='text-muted'> -  In progress</i>";
    break;
  }
  $render_status_vcep .= "
  <h4 class='mb-0 pt-2'>Expert Panel Status</h4>
  <div class='pt-0 pb-2'>
    <div class='progress-wg-expert-panel padding-bottom-lg'>
      <div class='progress' edit='affiliate_status_variant'>
        <div class='progress-bar {$ep_step_1}' style='width: {$status_value}%'>Step 1</div>
        <div class='progress-bar {$ep_step_2} progress-bar-border' style='width: {$status_value}%'>Step 2</div>
        <div class='progress-bar {$ep_step_3} progress-bar-border' style='width: {$status_value}%'>Step 3</div>
        <div class='progress-bar {$ep_step_4} progress-bar-border' style='width: {$status_value}%'>Step 4</div>
      </div>
      <div class='progress-bar-subheading small'>
        <div class='' style='width: 25%' edit='affiliate_status_variant_date_step_1'>Define Group <br/><i class='text-muted text-sm'>{$ep_step_1_text} {$ep_step_1_date}</i></div>
        <div class='' style='width: 25%' edit='affiliate_status_variant_date_step_2'>Develop Classification Rules <br/><i class='text-muted text-sm'>{$ep_step_2_text} {$ep_step_2_date}</i></div>
        <div class='' style='width: 25%' edit='affiliate_status_variant_date_step_3'>Pilot Rules <br/><i class='text-muted text-sm'>{$ep_step_3_text} {$ep_step_3_date}</i></div>
        <div class='' style='width: 25%' edit='affiliate_status_variant_date_step_4'>Expert Panel Approval<br/><i class='text-muted text-sm'>{$ep_step_4_text} {$ep_step_4_date}</i></div>
      </div>
    </div>
  </div>
  ";
}

if($page->url_clinvar) {
$render_clinvar_url .= "
  <div class='pt-2 pb-0' edit='url_clinvar'>
    <div class='padding-bottom-lg'>
      <div class='line-height-normal mb-0'>
          <a class='' target='_clinvar' href='{$page->url_clinvar}'>ClinVar submitter page for ClinGen {$page->title} <i class='fas fa-external-link-alt'></i></a>
        </div>
    </div>
  </div>
  ";
}
?>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="">
      <div class="content">
        <h1><?=$pages->get("template=working-group-type-cdwg-index")->title ?></h1>
      </div>
    </div>
  </div>
</div>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="row">
      <div class="content col-sm-10">
        <h1><?=$pages->get("template=working-group-type-cdwg-index")->title ?></h1>
      </div>
      <div class="col-sm-2 mt-3">
       <a href='<?=$page->relate_cdwg->httpUrl ?>' class='btn btn-primary'><i class="fas fa-arrow-left"></i> Back</a>
     </div>
   </div>
 </div>
</div>



<div pw-prepend="section_content">
	<div class="row ">
  		<div class="col-sm-9">
        <h2 class="mb-0"><?=$page->title ?></h2>
        <? if($page->relate_cdwg->httpUrl) { ?>
        <div class="mb-3 small"><a href='<?=$page->relate_cdwg->httpUrl ?>' class='text-muted'>Affiliated to <?=$page->relate_cdwg->title ?></a></div>
        <? } else { 
          echo "<div class='mb-3'></div>";
        } ?>
        <?=$render_nav_pill ?>
        <hr />
        <span edit='body_1'>
         <?=$page->body_1 ?>
         <?=$render_clinvar_url ?>
			   <?=$render_rich_media_3 ?>
       </span>
       <?=$render_status_vcep ?>
       <?=$render_status_gcep ?>
     </div>
     <div class="col-sm-3 ">
       <div class="border-left-1 pl-3">
        <?=$render_membership_nav ?>
      </div>
    </div>

    <div class="col-sm-12">
     <?=$render_documents ?>
     <?=$render_annoucements ?>
     <?=$render_tools ?>
     <?=$render_membership ?>
    </div>
  </div>
</div>