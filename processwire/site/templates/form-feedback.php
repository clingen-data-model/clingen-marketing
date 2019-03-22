<?

$body = $page->body_1;  

$body = str_replace("<ul>", "<ul class='list-unstyled pl-3'>", $body);
$body = str_replace("<li>", "<li><i class='fas fa-exclamation-triangle'></i> ", $body);

$input_page       = rawurldecode($input->get->page); 
$input_page       = $sanitizer->url($input_page);
$input_title      = $sanitizer->text($input->get->title);
$input_ref        = $sanitizer->name($input->get->ref);
$input_tool       = parse_url($feedback_url , PHP_URL_HOST);

if($sanitizer->url($input->post->input_page)){
 if($session->CSRF->hasValidToken()) {
  
  $input_page               = $sanitizer->url($input->post->input_page);
  $input_title              = $sanitizer->text($input->post->input_title);
  $input_tool               = $sanitizer->text($input->post->input_tool);
  $input_ref                = $sanitizer->text($input->post->input_ref);
  $input_name               = $sanitizer->name($input->post->input_name);
  $input_email              = $sanitizer->email($input->post->input_email);
  $input_institution        = $sanitizer->text($input->post->input_institution);
  $input_position           = $sanitizer->text($input->post->input_position);
  $input_feedbackType       = $sanitizer->array($input->post->input_feedbackType);
  $input_curationType       = $sanitizer->array($input->post->input_curationType);
  $input_comments           = $sanitizer->textarea($input->post->input_comments);

  $message .= "It happen";
} else {
  $message .= "Error happen";
}
}

?>

<div pw-prepend="section_content"> 
  <div class="row">
    <div class="lead" edit="body_1">
     <?=$body ?></div>
     <?=$message ?>
     <div class="col-md-12 mt-3 collapseFormFeedbackItems text-center" id="">
      <button class="btn btn-outline-secondary" id="collapseFormFeedback2" type="button" data-toggle="collapse" data-target=".collapseFormFeedback" aria-expanded="false" aria-controls="collapseExample"><?=$page->label_1 ?></button>
    </div>
  </div>
  <form class="needs-validation collapse collapseFormFeedback" id="" action="<?=$page->httpUrl?>">
    <input type="hidden" name='input_page' value="<?= $input_page?>" >
    <input type="hidden" name='input_title' value="<?= $input_title?>" >
    <input type="hidden" name='input_tool' value="<?= $input_tool?>" >
    <input type="hidden" name='input_ref' value="<?= $input_ref?>" >
    <?= $session->CSRF->renderInput(); ?>
    <hr class="mb-4">
    <div class="row">
     <div class="col-md-12">
       <h3 class="mb-3">Your Information</h3>
       <div class="row">
         <div class="col-md-6 mb-3">
           <label for="input_name">Full Name <span class="text-muted">(Required)</span></label>
           <input type="text" required class="form-control" id="input_name" name="input_name" placeholder="" value="<?= $input_name?>" >
         </div>
         <div class="col-md-6 mb-3">
           <label for="input_email">Email <span class="text-muted">(Required)</span></label>
           <input type="email" required class="form-control" id="input_email" name="input_email" placeholder="you@example.com" value="<?= $input_email?>">
         </div>
         <div class="col-md-6 mb-3">
           <label for="input_institution">Institution/Affilitation <span class="text-muted">(Required)</span></label>
           <input type="text" required class="form-control" id="input_institution" name="input_institution" placeholder="" value="<?= $input_institution?>" >
         </div>
         <div class="col-md-6 mb-3">
           <label for="input_position">Position <span class="text-muted">(Required)</span></label>
           <input type="text" required class="form-control" id="input_position" name="input_position" placeholder="" value="<?= $input_position?>" >
         </div>
       </div>
     </div>
   </div>
   <div class="row">

    <div class="col-md-12 mb-3">
      <h3 class="">Feedback Information</h3>

      <div class="alert alert-dark" role="alert">
        <i class="fas fa-info-circle"></i> <?=$page->label_2 ?>
      </div>
      <?=$page->body_2 ?>
    </div>
    <div class="col-md-8 order-md-2">

      <h5 class="mb-0">Type of feedback</h5>

      <div class="d-block">
        <div class="custom-control">
          <input id="credit" name="input_feedbackType" type="checkbox" class="custom-control-input"  value="General Feedback" <?= ($input_feedbackType == "General Feedback") ? "checked" : ""; ?>>
          <label class="custom-control-label" for="credit">General Feedback</label>
        </div>
        <div class="custom-control">
          <input id="curation" name="input_feedbackType" type="checkbox" class="custom-control-input"   value="Feedback about curation" <?= (in_array("Feedback about curation", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="curation">Feedback about curation</label>
        </div>
        <div class="custom-control ml-4">
          <input id="GeneDisease" name="input_curationType" type="checkbox" class="custom-control-input"  value="Variant Pathogenicity" <?= (in_array("Variant Pathogenicity", $input_curationType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="GeneDisease">Gene-Disease Validity</label>
        </div>
        <div class="custom-control ml-4">
          <input id="Variant" name="input_curationType" type="checkbox" class="custom-control-input"  value="Variant Pathogenicity" <?= (in_array("Variant Pathogenicity", $input_curationType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="Variant">Variant Pathogenicity</label>
        </div>
        <div class="custom-control ml-4">
          <input id="Actionability" name="input_curationType" type="checkbox" class="custom-control-input"  value="Clinical Actionability" <?= (in_array("Clinical Actionability", $input_curationType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="Actionability">Clinical Actionability</label>
        </div>
        <div class="custom-control ml-4">
          <input id="Dosage" name="input_curationType" type="checkbox" class="custom-control-input"  value="Dosage Sensitivity" <?= (in_array("Dosage Sensitivity", $input_curationType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="Dosage">Dosage Sensitivity</label>
        </div>
        <div class="custom-control ml-4">
          <input id="Othertool" name="input_curationType" type="checkbox" class="custom-control-input"  value="Other Tool/Resource" <?= (in_array("Other Tool/Resource", $input_curationType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="Othertool">Other Tool/Resource</label>
        </div>
        <div class="custom-control">
          <input id="publication" name="input_feedbackType" type="checkbox" class="custom-control-input"   value="Share recent publication relevant to curation" <?= (in_array("Share recent publication relevant to curation", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="publication">Share recent publication relevant to curation</label>
        </div>
        <div class="custom-control">
          <input id="problem" name="input_feedbackType" type="checkbox" class="custom-control-input"   value="Report problem or broken feature<" <?= (in_array("Report problem or broken feature", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label" for="problem">Report problem or broken feature</label>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-12">
          <h5 class="mb-0">Your Feedback/Comments (required)</h5>
          <textarea class="form-control" id="cc-name" name="input_comments" placeholder="Comments" rows="10" required> </textarea>
        </div>
      </div>

<!--
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">I would like to receive emails regarding ClinGen announcements and recent events.</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">I am interested in learning how to participate in ClinGen's curation efforts.</label>
            </div>
          -->

          <button class="btn btn-primary btn-lg btn-block" type="submit">Submit Feedback</button>
        </div>
        <div class="col-md-4 order-md-2 mb-4">
          <ul class="list-group mb-3">
          	<li class="list-group-item list-group-item-light">Feedback Regarding Page</li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?= $input_title?></h6>
                <small class="text-muted">Page Subject Matter</small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?= $input_tool?></h6>
                <small class="text-muted">Website/Tool</small>
              </div>
            </li>        
            <li class="list-group-item bg-light">
              <div class="">
               <div class="input-group input-group-sm">
                 <input type="text" class="form-control" disabled="disabled" value="<?= $input_page?>" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                 <div class="input-group-append">
                   <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-external-link-alt"></i></button>
                 </div>
               </div>
               <small>Complete Web Address</small>
             </div>
           </li>
         </ul>

       </div>
     </div>
   </form>
 </div>
</div>