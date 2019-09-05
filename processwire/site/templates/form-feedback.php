<?


$captcha = $modules->get("MarkupGoogleRecaptcha");
$footer_js .= $captcha->getScript();



$body = $page->body_1;  

$body = str_replace("<ul>", "<ul class='list-unstyled pl-3'>", $body);
$body = str_replace("<li>", "<li><i class='fas fa-exclamation-triangle'></i> ", $body);

  $input_page       = rawurldecode($input->get->page); 
  $input_page       = $sanitizer->url($input_page);
  $input_page       = ($input_page) ? $input_page : $page->httpUrl;
  $input_title      = $sanitizer->text($input->get->title);
  $input_title      = ($input_title) ? $input_title : $page->title;
  $input_ref        = $sanitizer->name($input->get->ref);
  $input_ref        = ($input_ref) ? $input_ref : "edwg";
  //$input_tool       = parse_url($feedback_url , PHP_URL_HOST);

   if(!$sanitizer->name($input->post->input_feedback)) {
     if($session->CSRF->hasValidToken()) {
       
       
      $submit_page               = $sanitizer->url($input->post->input_page);
      $submit_page               = ($submit_page) ? $submit_page : $page->httpUrl;
      $submit_title              = $sanitizer->text($input->post->input_title);
      $submit_ref                = $sanitizer->name($input->post->input_ref);
      $submit_ref                = ($submit_ref) ? $submit_ref : "edwg";
      $submit_name               = $sanitizer->text($input->post->input_name);
      $submit_email              = $sanitizer->email($input->post->input_email);
      $submit_institution        = $sanitizer->text($input->post->input_institution);
      $submit_position           = $sanitizer->text($input->post->input_position);
      $submit_feedbackType       = $sanitizer->array($input->post->input_feedbackType);
      //$submit_curationType       = $sanitizer->array($input->post->input_curationType);
      $submit_comments           = $sanitizer->purify($sanitizer->textarea($input->post->input_comments));
       

       
      if(!$submit_name) {
        $error .= "Missing your name...<br />";
      }
      if(!$submit_email) {
        $error .= "Missing your email...<br />";
      }
      if(!$submit_institution) {
        $error .= "Missing your instiution...<br />";
      }
      if(!$submit_position) {
        $error .= "Missing your position...<br />";
      }
      if(!$submit_feedbackType) {
        $error .= "Missing at least one feedback type...<br />";
      }

      if ($captcha->verifyResponse() === true) {
      } else {
        $error .= "ReCaptcha didn't work... try again<br />";
      }

      if($error) {
        // Drop the errors into a message
        $message .= "<h4>Error</h4>";
        $message .= $error;
        $message_css .= "alert-warning";
      } else {
        
        // Go do the work to send now.
        
        foreach($submit_feedbackType as $item) {
          $feedbackType .= $item . " \r\n ";
        }
        foreach($submit_curationType as $item) {
          $curationType .= $item . " \r\n ";
        }
        
        //Email to 
        $subject = "ClinGen Website Feedback Form";
        $bodyHTML .= "The following person has requested a page in the website to be reviewed.\r\n";
        $bodyHTML .= "\r\n Name:\r\n    ". $submit_name;
        $bodyHTML .= "\r\n\r\n Email:\r\n    ". $submit_email;
        $bodyHTML .= "\r\n\r\n Institution:\r\n    ". $submit_institution;
        $bodyHTML .= "\r\n\r\n Position:\r\n    ". $submit_position;
        $bodyHTML .= "\r\n\r\n Comments/Message:\r\n    ". $submit_comments;
        $bodyHTML .= "\r\n\r\n Page URL:\r\n    ". $submit_page;
        $bodyHTML .= "\r\n\r\n Page Title:\r\n    ". $submit_title;
        //$bodyHTML .= "\r\n\r\n Curation Type:\r\n    ". $curationType;
        $bodyHTML .= "\r\n\r\n Feedback Type:\r\n    ". $feedbackType;
        $logthis = "CONTACT REQUEST - Name: ". $submit_name ." ||| Email: ". $submit_email ." ||| Institution: ". $submit_institution. " ||| Position: ". $submit_position. " ||| Comments: ". $submit_comments. " ||| Page URL: ". $submit_page. " ||| Page Title: ". $submit_title. " ||| Curation Type: ". $curationType. " |||  Feedback Type: ". $feedbackType;
        
        $send_email_to = "scottg@creationproject.com";
        $mailto = "{$send_email_to}"; 
        $info = "From: {$send_email_to}" . "\r\n" . "Do Not Reply."; //Header information.
        if(mail($mailto, $subject, $bodyHTML, $info)){ //If e-Mail was sent 
          //$log->save('emailtracker', "email success");
        } else {
          //$log->save('emailtracker', "email failed");  
        }
        unset($bodyHTML);
        $log->save('clingen-feedback-form', $logthis);
        
        
        
        
        
        
        $message .= $page->body_3;
        $message_css .= "alert-success";
      }

    }
   } else {
      // This is the honeypot message... just make it look like it worked.
      $message .= "Thanks";
      $message_css .= "alert-success";
   }

    if($message) {
      $render_message = "
        <div class='alert {$message_css}' role='alert'>{$message}</div>
      ";
    }


?>

<div pw-prepend="section_content"> 
  <div class="row">
    <div class="" edit="body_1">
     <?=$body ?></div>
     <?=$render_message ?>
     <div class="col-md-12 mt-3 collapseFormFeedbackItems text-center" id="">
      <button class="btn btn-outline-secondary" id="collapseFormFeedback2" type="button" data-toggle="collapse" data-target=".collapseFormFeedback" aria-expanded="false" aria-controls="collapseExample"><?=$page->label_1 ?></button>
    </div>
  </div>
  <form class="needs-validation collapse collapseFormFeedback" name="form_feedback" id="form_feedback" method="post" action="<?=$page->httpUrl?>">
    <input type="hidden" name='input_page' value="<?= $input_page?>" >
    <input type="hidden" name='input_title' value="<?= $input_title?>" >
    <input type="hidden" name='input_tool' value="<?= $input_tool?>" >
    <input type="hidden" name='input_ref' value="<?= $input_ref?>" >
    
    <? 
      // NOTE this inout a honey pot so don't remove.
      // The input will be pulled off the screen.
      // If provided by a bot then the submission will die
    ?>
    <input type="text" class="form-control" id="input_feedback" name="input_feedback" placeholder="Provide Feedback" value="" >
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

      <h5 class="mb-0">Type of feedback (Required)</h5>

      <div class="d-block">
        <div class="custom-control">
          <input id="credit" name="input_feedbackType" type="checkbox" class="custom-control-input" value="General Feedback" <?= ($input_feedbackType == "General Feedback") ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="credit">General Feedback</label>
        </div>
<!--
        <div class="custom-control ml-4">
          <label class="custom-control-label text-normal" for="curation">Feedback about curations or curation activity</label>
        </div>
-->
        <div class="custom-control">
          <input id="GeneDisease" name="input_feedbackType" type="checkbox" class="custom-control-input"  value="Variant Pathogenicity" <?= (in_array("Variant Pathogenicity", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="GeneDisease">Gene-Disease Validity Curation Activity</label>
        </div>
        <div class="custom-control">
          <input id="Variant" name="input_feedbackType" type="checkbox" class="custom-control-input"  value="Variant Pathogenicity" <?= (in_array("Variant Pathogenicity", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="Variant">Variant Pathogenicity Curation Activity</label>
        </div>
        <div class="custom-control">
          <input id="Actionability" name="input_feedbackType" type="checkbox" class="custom-control-input"  value="Clinical Actionability" <?= (in_array("Clinical Actionability", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="Actionability">Clinical Actionability Curation Activity</label>
        </div>
        <div class="custom-control">
          <input id="Dosage" name="input_feedbackType" type="checkbox" class="custom-control-input"  value="Dosage Sensitivity" <?= (in_array("Dosage Sensitivity", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="Dosage">Dosage Sensitivity Curation Activity</label>
        </div>
        <div class="custom-control">
          <input id="Othertool" name="input_feedbackType" type="checkbox" class="custom-control-input"input_feedbackType  value="Other Tool/Resource" <?= (in_array("Other Tool/Resource", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="Othertool">Other Tool/Resource</label>
        </div>
        <div class="custom-control">
          <input id="publication" name="input_feedbackType" type="checkbox" class="custom-control-input"   value="Share recent publication relevant to curation" <?= (in_array("Share recent publication relevant to curation", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="publication">Share recent publication relevant to curation</label>
        </div>
        <div class="custom-control">
          <input id="problem" name="input_feedbackType" type="checkbox" class="custom-control-input"   value="Report problem or broken feature<" <?= (in_array("Report problem or broken feature", $input_feedbackType)) ? "checked" : ""; ?>>
          <label class="custom-control-label text-normal" for="problem">Report problem or broken feature</label>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-12">
          <h5 class="mb-0">Your Feedback/Comments (required)</h5>
          <textarea class="form-control" id="cc-name" name="input_comments" placeholder="Comments" rows="10" required><?=$input_comments ?> </textarea>
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
      <div class="p-3 text-center">
          <?=$captcha->render() ?>
        </div>
          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit Feedback" >
        
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
            <li class="list-group-item bg-light">
              <div class=" w-100">
               <div class="input-group w-100 input-group-sm">
                 <input type="text" class="form-control w-100" disabled="disabled" value="<?= $input_page?>" placeholder="Page Subject Matter" aria-label="Page Subject Matter" aria-describedby="button-addon2">
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
