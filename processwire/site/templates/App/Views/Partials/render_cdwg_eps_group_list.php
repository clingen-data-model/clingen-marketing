<? 
/**
 * Child Pages
 */

$cdwgs = $pages->find("template=affiliation-show, relate_cdwg=$page, sort=title");
if($cdwgs) { 
  foreach ($cdwgs as $key => $value) {

    if($value->id == $page->id) {
      $option['css'] = 'active';
    } else {
      $option['css'] = null;
    }


      $first_item = ($keyA == 0) ? "affiliate_first_true  border-bottom-2" : "affiliate_first_false";

      if($value->affiliate_status_gene."" > 0) {
          switch ($value->affiliate_status_gene."") {
            case 1:
              $status_value = "25";
              $status_step_name = "In Process - " . $value->affiliate_status_gene->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 2:
              $status_value = "100";
              $status_step_name = $value->affiliate_status_gene->title;
              $status_step = "";
              break;
        }
      } elseif($value->affiliate_status_variant."" > 0) {
          switch ($value->affiliate_status_variant."") {
            case 1:
              $status_value = "25";
              $status_step_name = "In Process - " . $value->affiliate_status_variant->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 2:
              $status_value = "50";
              $status_step_name = "In Process - " . $value->affiliate_status_variant->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 3:
              $status_value = "75";
              $status_step_name = "In Process - " . $value->affiliate_status_variant->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 4:
              $status_value = "100";
              $status_step_name = $value->affiliate_status_variant->title;
              $status_step = "";
              break;
        }
      } else {
          $status_value = "0";
      }



      $render_affiliates .= "
      <div class=\"row border-bottom-1 \">
        <div class='col-sm-11 p-2'>
          <a class='' title='{$value->title}' href='{$value->httpUrl}'>{$value->title}</a>{$status_step}
        </div>
        <div class='col-sm-1 p-2'>
          <div class=\"progress mb-0 mt-1\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"{$status_step_name}\" >
            <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: {$status_value}%\" aria-valuenow=\"{$status_value}\" aria-valuemin=\"0\" aria-valuemax=\"100\" ></div>
          </div>
        </div>
      </div>
      ";
      unset($status_value);



  }
  
  $nav_pill['expert_panels'] = "<a href='#heading_expert_panels' class='badge badge-pill badge-info p-2 mr-2'>Expert Panels <i class='fas fa-arrow-circle-down'></i></a>";
  $render_eps = "<h3 id='heading_expert_panels' class=' mt-5'>Expert Panels</h3><div class='col-sm-12'>".$render_affiliates."</div>";
  unset($render_page_children_item);
}


//echo $render_eps;

unset($render_page_children);
unset($cdwgs);