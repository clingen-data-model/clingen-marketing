<? 
/**
 * Child Pages
 */

$cdwgs = $pages->find("template=working-group-type-cdwg-show");
if($cdwgs) { 
  foreach ($cdwgs as $key => $value) {

    if($value->id == $page->id) {
      $option['css'] = 'active';
    } else {
      $option['css'] = null;
    }

    $affiliates = $pages->find("template=affiliation-show, relate_cdwg=$value, sort=title");

    foreach ($affiliates as $keyA => $affiliate) {

      if($value->id == $page->id) {
        $option['css'] = 'active';
      } else {
        $option['css'] = null;
      }

      $first_row        = ($keyA == 0) ? "" : "";
      $not_first_row    = ($keyA == 0) ? "border-bottom-2 affilate-list-bottom" : "border-bottom-2";
      $first_item       = ($keyA == 0) ? "affiliate_first_true" : "affiliate_first_false";

      if($affiliate->affiliate_status_gene."" > 0) {
          switch ($affiliate->affiliate_status_gene."") {
            case 1:
              $status_value = "25";
              $status_step_name = "In Process - " . $affiliate->affiliate_status_gene->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 2:
              $status_value = "100";
              $status_step_name = $affiliate->affiliate_status_gene->title;
              $status_step = "";
              break;
        }
      } elseif($affiliate->affiliate_status_variant."" > 0) {
          switch ($affiliate->affiliate_status_variant."") {
            case 1:
              $status_value = "25";
              $status_step_name = "In Process - " . $affiliate->affiliate_status_variant->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 2:
              $status_value = "50";
              $status_step_name = "In Process - " . $affiliate->affiliate_status_variant->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 3:
              $status_value = "75";
              $status_step_name = "In Process - " . $affiliate->affiliate_status_variant->title;
              $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
              break;
            case 4:
              $status_value = "100";
              $status_step_name = $affiliate->affiliate_status_variant->title;
              $status_step = "";
              break;
        }
      } else {
          $status_value = "0";
          $status_step = "<span class=\"badge badge-light badge-affiliate-status\">In Process</span>";
      }



      $render_affiliates .= "
      <div class=\"row  {$first_row } \" style='position: relative;'>
        <div class='col-sm-3 p-2 {$first_item } text-md-right'><a class='' title='{$value->title}' href='{$value->httpUrl}'><strong>{$value->title}</strong> <span class='sr-only'></span></a></div>
        <div class='col-sm-9 p-2 border-left-3 {$not_first_row}' style=''>
          <div class='row'>
            <div class='col-md-11 col-sm-10'>
              <a class='' title='{$affiliate->title}' href='{$affiliate->httpUrl}'>{$affiliate->title}</a>{$status_step}
            </div>
          <div class='col-md-1 col-sm-2 hidden-xs'>
            <div class=\"progress m-0\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"{$status_step_name}\" >
              <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: {$status_value}%\" aria-valuenow=\"{$status_value}\" aria-valuemin=\"0\" aria-valuemax=\"100\" ></div>
            </div></div>
          </div>
        </div>
      </div>
      ";
      unset($status_value);
    }

    $render_page_children_item .= "
      <li class='{$option['css']}  mb-4'>
        {$render_affiliates}
      </li>
    ";

    unset($render_affiliates);

  }
  $render_page_children = "<ul class='list-unstyled'>".$render_page_children_item."</ul>";
  unset($render_page_children_item);
}


echo $render_page_children;

unset($render_page_children);
unset($cdwgs);