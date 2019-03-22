<?
		$imgPage = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

		$text_membership_prefix = "Working Group";
    $nav_pill['platform'] = "<a href='#heading_platform' class='badge badge-pill badge-info p-2 mr-2'>Data Platform Roadmap <i class='fas fa-arrow-circle-down'></i></a>";
    $nav_pill['overview'] = "<a href='#heading_overview' class='badge badge-pill badge-info p-2 mr-2'>Call Times <i class='fas fa-arrow-circle-down'></i></a>";

		include("App/Views/Partials/render_group_members.php");
		include("App/Views/Partials/render_wg_documents_list.php");
		include("App/Views/Partials/render_wg_tools_list.php");
    
    
		foreach ($nav_pill as $key => $value) {
			$render_nav_pill .= $value;
		}
?>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="">
	  	<div class="content col-sm-9 pr-md-5 pt-md-4 pb-md-3">
		    <h1><?=$page->title ?></h1>
				<div class="section-heading-content"  edit="body_1"><?=$page->body_1 ?></div>
				<?=$render_nav_pill ?>
		  </div>
		  <div class="col-sm-3 ">
		  	<img src="<?=$imgPage?>" class="img-fluid rounded-circle img-thumbnail">
		  </div>
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row">
    <div class="col-12">
      <div class="row">
			        <div class="col-12">
                <div class="row">
                  <div class="col-12 pb-3">
			            <h3 class="pull-left" style="padding:0px; margin:0px" id='heading_platform'>Data Platform Roadmap</h3>
			          <div class="form-inline pull-right">
			            <div class="form-group">
			              <div class="checkbox" style="padding-top: 3px;">
			                Key &amp; Controls:
			              </div>
			              <div class="checkbox" style="padding-right: 10px;">
			                <label class="label label-unc-input">
			                  <input type="checkbox" checked class="input-unc" > UNC
			                </label>
			              </div>
			              <div class="checkbox" style="padding-right: 10px;">
			                <label class="label label-baylor-input">
			                  <input type="checkbox" checked class="input-baylor" > Baylor
			                </label>
			              </div>
			              <div class="checkbox" style="padding-right: 10px;">
			                <label class="label label-stanford-input">
			                  <input type="checkbox" checked class="input-stanford" > Stanford
			                </label>
			              </div>
			              <div class="checkbox" style="padding-right: 10px;">
			                <label class="label label-u41-input">
			                  <input type="checkbox" checked class="input-u41" > Broad/Geisinger
			                </label>
			              </div>
			              <div class="checkbox" style="padding-right: 10px;">
			                <label class="label label-external-input">
			                  <input type="checkbox" checked class="input-external" > 
			                  3rd Party
			                </label>
			              </div>
			              
			              <!--<div class="checkbox" style="padding-right: 10px;">
			                <label class="label label-icon-input">
			                  <input type="checkbox" checked class="input-major" > Unassigned</label>
			              </div>-->
			            </div>
			          </div>
                  </div>
      </div>
			          <table id="dataplatform" class="table table-striped table-hover">
			      <thead>
			        <tr>
			          <th></th>
			          <th colspan="3"style="background-color:#fff; border-top:none" class="border-left-bold text-muted">Area</th>
			          <th colspan="2" class="border-left-bold text-muted" style="background-color:#fff; border-top:none"><span data-toggle="tooltip" data-placement="top"  title="Curation & Open Access tools rely on Infrastructure Tools & Standards">Infrastructure</span></th>
			          <th style="background-color:#fff; border-top:none" colspan="2" class="border-left-bold text-muted"><span data-toggle="tooltip" data-placement="top"  title="All UI Apps">Curations</span></th>
			          <th style="background-color:#fff; border-top:none" colspan="2" class="border-left-bold text-muted"><span data-toggle="tooltip" data-placement="top"  title="How information is accessed by all">Open Access</span></th>
			          </tr>
			      </thead>
			      <tbody>
			        <tr>
			          <td class="rotate">Workstreams</td>
			          <td class="rotate border-left-bold area-g" style="width: 1%" ><span data-toggle="tooltip" data-placement="top"  title="Gene Area">G</span></td>
			          <td class="rotate area-v" style="width: 1%" ><span  data-toggle="tooltip" data-placement="top"  title="Variant Area">V</span></td>
			          <td class="rotate area-d" style="width: 1%" ><span  data-toggle="tooltip" data-placement="top"  title="Disease Area">D</span></td>
			          <td style="width: 12%" class="rotate"><span data-toggle="tooltip" data-placement="top"  title="API microservices and message streams">Current</span></td>
			          <td style="width: 12%" class="rotate"><span data-toggle="tooltip" data-placement="top"  title="Requests for material resources not yet started">Proposed/Pending</span></td>
			          <td style="width: 12%" class="rotate border-left-bold"><span data-toggle="tooltip" data-placement="top"  title="mgmt, data entry, assessment & publish">Current</span></td>
			          <td style="width: 12%" class="rotate"><span data-toggle="tooltip" data-placement="top"  title="Requests for material resources not yet started">Proposed/Pending</span></td>
			          <td style="width: 12%" class="rotate border-left-bold"><span data-toggle="tooltip" data-placement="top"  title="UIs, API services, Message streams, Files">Current</span></td>
			          <td style="width: 12%" class="rotate"><span data-toggle="tooltip" data-placement="top"  title="Requests for material resources not yet started">Proposed/Pending</span></td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Produce & share data that represents the strength of an association between a gene and a particular disease.">Gene Disease Validity Assertions</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Gene Curation</div>          </td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active">&nbsp;</td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td><div class="label label-stanford"> GCI Publish (Stream)            </div>
			            <div class="label label-baylor"> Allele Registry (Service)            </div>
			            <div class="label label-u41">Gene Validity (Model)</div></td>
			          <td class="pending-effort">
			            <div class="label label-stanford">GCI Gene Tracker (Stream)</div>

			              <div class="label label-stanford">Gene Validity (Service)</div>
			              <div class="label label-u41"><i class="pull-right glyphicon glyphicon-flash"></i>Gene Validity SEPIO (Model)</div>
			          </td>
			          <td class="border-left-bold">
			            <div class="label label-stanford">GCI (UI)</div>
			              <div class="label label-unc">Gene Tracker (UI)</div>
			           </td>
			          <td class=" pending-effort">
			            <div class="label label-unc">Gene Tracker Integration (Ext)</div>
			              <div class="label label-stanford">Definitive gene curation workflow (Ext)</div>
			            </td>
			          <td class="border-left-bold">
			            <div class="label label-u41">Website (UI)</div>
			        </td>
			          <td class=" pending-effort">
			            <div class="label label-stanford">Gene Validity (Service)</div>
			            <div class="label label-u41"><i class="pull-right glyphicon glyphicon-flash"></i>Website-Gene/Dis (Ext)</div>
			          </td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Produce & share evidence-based reports and semi-quantitative metric scores using a standardized method for nominated gene disease pairs.">Gene-Disease Actionability Evaluations</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Actionability</div>          </td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active">&nbsp;</td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td><div>
			            <div class="label label-baylor">ACI Publish (Stream)</div>
			            </div>
			            <div>
			              <div class="label label-baylor">ACI (Service)</div>
			              </div>
			            <div>
			              <div class="label label-u41">Actionability (Model)</div>
		              </div></td>
			          <td class="pending-effort"><div class="label label-u41"><i class="pull-right glyphicon glyphicon-flash"></i>Actionability SEPIO (Model)</div></td>
			          <td class="border-left-bold">
			            <div class="label label-baylor">ACI (UI)</div>
			            </td>
			          <td class=" pending-effort">&nbsp;</td>
			          <td class="border-left-bold"><div class="label label-u41">Website (UI)</div>            <div class="label label-baylor">ACI (UI,Service)</div>
			            </td>
			          <td class=" pending-effort">
			            <div class="label label-u41"><i class="pull-right glyphicon glyphicon-flash"></i>Website-Gene/Dis (Ext)</div>
			            </td>
			        </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Produce & share evidence-based sequence variant disease pathogenicity assertions using expert panel refinements of the ACMG/AMP Interpreting Sequence Variant Guidelines.">Seq Variant Disease Pathogenicity Assertions</span><div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Genomic Variant / SVI</div>
			          </td>
			          <td class="border-left-bold area-g  area-g-active">&nbsp;</td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td><div>
			            <div class="label label-baylor">Allele Registry (Service)</div>
			            </div>
			            <div>
			              <div class="label label-baylor">Pathogenicity Calculator (Service)</div>
			              </div>
			            <div>
			              <div class="label label-baylor">ERepo-VCI Publish (Service)</div>
			              </div>
			            <div>
			              <div class="label label-baylor">LD Hub-VPT (Service)</div>
			              </div>
			            <div>
			              <div class="label label-stanford">VCI Publish (Stream)</div>
			              </div>
			            <div>
			              <div class="label label-baylor">ClinVar Subm Generator (Service)</div>
			              <div>
			                <div class="label label-u41">SeqVar Path SEPIO (Model)</div>
		                </div>
		              </div></td>
			          <td class="pending-effort"><div>
			            <div class="label label-baylor">Allele Registry-CNV (Ext)</div>
			          </div></td>
			          <td class="border-left-bold"><div>
			            <div class="label label-stanford">VCI (UI)</div>
			            </div>
			            <div>
			              <div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VCI-Publishing to ERepo">VCI-ERepo (Ext)</span></div>
			              </div>
			            <div>
			              <div class="label label-stanford">VPT (UI)</div>
			              </div>
			            <div>
			              <div class="label label-baylor">Pathogenicity Calculator (UI)</div>
			            </div></td>
			          <td class=" pending-effort"><div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VCI-ClinVar Subm Portal">VCI-ClinVar (Ext)</span></div>
			            <div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VCI-Gene Attributes Capture">VCI-Gene (Ext)</span></div>
			            <div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VCI-Path Calc Integration">VCI-VCEP Rules (Ext)</span></div>
			            <div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VPT-VCI Bulk Upload">VPT-VCI Upload (Ext)</span></div></td>
			          <td class="border-left-bold">
			            <div class="label label-baylor">ERepo (UI,Service)</div>
			            <div class="label label-baylor">Allele Registy (UI,Service)</div>
			            <div class="label label-external">ClinVar (UI)</div>
			          </td>
			          <td class=" pending-effort"><div class="label label-u41">Website-ClinVar (Ext)</div>            </td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Produce & share evaluations supporting or refuting the dosage sensitivity of individual genes or genomic regions.">Dosage Sensitivity Assertions</span>
			            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Dosage Sensitivity Curation</div></td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td><div class="label label-u41">DSI Publish (Stream)</div>
			            <div>
			              <div class="label label-u41">Dosage Sensitivity SEPIO (Model)</div>
	              </div></td>
			          <td class="pending-effort"><div class="label label-u41">DSI (Service)</div></td>
			          <td class="border-left-bold"><div class="label label-external">NCBI DSI (UI)</div></td>
			          <td class=" pending-effort"><div class="label label-u41"><i class="pull-right glyphicon glyphicon-flash"></i>DSI (UI)</div></td>
			          <td class="border-left-bold"><div class="label label-u41">Website (UI)</div>
			            <div class="label label-external">NCBI DSI (UI)</div></td>
			          <td class=" pending-effort"><div class="label label-u41">DSI (Service)</div>
			            <div class="label label-u41"><i class="pull-right glyphicon glyphicon-flash"></i>Website-Gene/Dis (Ext)</div></td>
			        </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Produce & share the clinical interpretation of cytogenomic copy number variants.">CNV Disease Pathogenicity Assertions</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> CNV Interpretation</div>          </td>
			          <td class="border-left-bold area-g  area-g-active">&nbsp;</td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td>&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-baylor">Allele Registry-CNV (Ext)</div>
			            <div class="label label-u41">CNV Path (Model)</div>
			            <div class="label label-baylor">CNV Path Publish (Stream)</div></td>
			          <td class="border-left-bold"><div class="label label-baylor">CNV Calculator (UI)</div></td>
			          <td class=" pending-effort"><div class="label label-baylor">CNV Curation Interface  (UI)</div></td>
			          <td class="border-left-bold"><div class="label label-external">ClinVar (UI)</div></td>
			          <td class=" pending-effort"><div class="label label-u41">Website-ClinVar (Ext)</div>
			            <div class="label label-baylor">ERepo-CNV Path (Ext)</div>
			            <div class="label label-baylor">Allele Registry-CNV (Ext)</div></td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Produce & share data interpretation of somatic changes and their clinical actionability.">Somatic Variant Assertions</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Somatic Cancer</div>          </td>
			          <td class="border-left-bold area-g  area-g-active">&nbsp;</td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td>&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">Somatic MVLD (Model)</div>
			            <div class="label label-u41">Complex Variation (Model)</div>
			            </td>
			          <td class="border-left-bold"><div class="label label-external">CIViC (UI)</div></td>
			          <td class=" pending-effort">&nbsp;</td>
			          <td class="border-left-bold"><div class="label label-external">CIViC (UI)</div></td>
			          <td class=" pending-effort"><div class="label label-baylor">ERepo-Somatic (Ext)</div></td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Providing scalable source of case-level data from heterogeneous sources for capture and use as evidence in gene and variant knowledge production.">Case Level Data Evidence Collection</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Genomic Variant / SVI</div>          </td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active">&nbsp;</td>
			          <td>&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">Case Level (Model)</div>
			            <div class="label label-stanford">LD Hub-Case Data (Ext)</div>
			            <div class="label label-stanford">Case Registry (Service)</div></td>
			          <td class="border-left-bold"><div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VCI-Case Seg Capture">VCI-Case Seg (Ext)</span></div></td>
			          <td class=" pending-effort"><div class="label label-stanford">Case Registry (UI)</div></td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort">&nbsp;</td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Providing a source of functional / experimental data items to for capture and use as evidence in gene and variant knowledge production.">Functional Data Evidence Collection</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Stanford/Baylor Grant UNC Grant</div>          </td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active">&nbsp;</td>
			          <td><div class="label label-stanford">Func Data Repo (Service)</div>
			            <div class="label label-stanford">LD Hub-Func Data (Service)</div>
			            <div class="label label-stanford">Allele Func Impact (Model)</div></td>
			          <td class=" pending-effort">&nbsp;</td>
			          <td class="border-left-bold"><div class="label label-stanford"><span data-toggle="tooltip" data-placement="top"  title="VCI-Func Data Capture">VCI-Func Data (Ext)</span></div>
			            <div class="label label-stanford">Func Data Pipeline (UI)</div></td>
			          <td class=" pending-effort">&nbsp;</td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort">&nbsp;</td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Provides systems for tracking and capturing the community curation volunteer efforts for the purpose of using the results as evidence in gene and variant knowledge production.">Community Literature Curation</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Community Curation Cmte (C3)</div>          </td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td><div class="label label-external">hypothes.is (Service)</div></td>
			          <td class=" pending-effort"><div class="label label-unc">LD Hub-Lit Anno (Ext)</div></td>
			          <td class="border-left-bold"><div class="label label-unc">hypothes.is templates  (UI)</div></td>
			          <td class=" pending-effort"><div class="label label-unc">Community Curation Tracker (UI)</div></td>
			          <td class="border-left-bold"><div class="label label-external">hypothes.is (UI,API)</div></td>
			          <td class=" pending-effort">&nbsp;</td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Streamlining the consistency and interoperability of ClinVar data to the community in order to scale the adoption and use of ClinVar's data in clinical and various other use cases.">ClinVar Data Integration</span>            <div class="small text-muted">Broad/Geisinger Grant</div>          </td>
			          <td class="border-left-bold area-g  area-g-active">&nbsp;</td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td>&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">ClinVar Data (Stream)</div>
			            <div class="label label-u41">ClinVar Variant Interp (Model)</div>
			            <div class="label label-u41">ClinVar Data Repo (Service)</div></td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">ClinVar Data Producer (Service)</div></td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">Website-ClinVar (Ext)</div></td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Compare, reassess, share, identify and update classifications of CNV or Seq Var pathogenicity assertions.">Variant Path Discrepancy Resolution</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Seq/CNV Variant Discrepancy Resolution</div>          </td>
			          <td class="border-left-bold area-g  area-g-active">&nbsp;</td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td>&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">ClinVar Data (Stream)</div></td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">Discrepancy Resolution Tool (UI)</div>
			            <div class="label label-baylor">Allele Registry-CNV  (Ext)</div></td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-u41">Website-ClinVar (Ext)</div></td>
			          </tr>
			        <tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Oversight of procedures, guidelines, naming and authorization of affiliations and expert panels, their artifacts and processes for use across ClinGen's curation processes.">Expert Panel &amp; Affiliation Adminstration</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> CDWG Oversight Cmte</div>            </td>
			          <td class="border-left-bold area-g  area-g-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Gene Area"></i></td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Disease Area"></i></td>
			          <td><div class="label label-stanford">VCI-GCI Affiliation (File)</div></td>
			          <td class=" pending-effort"><div class="label label-baylor">Affiliation EP (Model)</div>
			            <div class="label label-stanford">Affiliation Mgmt (Service)</div>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-stanford">Affiliation Mgmt (Ext)</div></td>
			          <td class="border-left-bold">&nbsp;</td>
			          <td class=" pending-effort"><div class="label label-stanford">Affiliation Mgmt (UI,Service)</div></td>
			          </tr>
			        <!--<tr>
			          <td scope="row"><span data-toggle="tooltip" data-placement="top"  title="Working to provide greater standardization and interoperability of all forms of variation to enable better interoperability across knowledge, evidence and patient level data.">Variant Registration &amp; Identification</span>            <div class="small text-muted"><i class="glyphicon glyphicon-user"></i> Global Community</div>            </td>
			          <td class="border-left-bold area-g  area-g-active">&nbsp;</td>
			          <td class="area-v  area-v-active"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top"  title="Variant Area"></i></td>
			          <td class="area-d  area-d-active">&nbsp;</td>
			          <td class="border-left-bold"><div class="label label-u41">Allele (Model)</div></td>
			          <td><div class="label label-baylor">Allele Registry (Service)</div></td>
			          <td class=" pending-effort"><div class="label label-u41">Allele VMC (Model)</div>
			            <div class="label label-u41">CNV (Model)</div>
			            <div class="label label-u41">Complex Variation (Model)</div>
			            <div class="label label-u41">Variant - GA4GH (Model)</div>
			            <div class="label label-u41">ClinVar Data (Stream)</div></td>
			          <td class="border-left-bold"><div class="label label-baylor">Allele Registry</div></td>
			          <td class=" pending-effort"><div class="label label-baylor">Allele Registry-CNV</div></td>
			          <td class="border-left-bold"><div class="label label-baylor">Allele Registry (UI,Service)</div></td>
			          <td class=" pending-effort"><div class="label label-baylor">Allele Registry-CNV (UI,Service)</div></td>
			        </tr>-->
			      </tbody>
			    </table>
			          <hr />
			          </div>
			      </div>
      </div>
		<div class="col-sm-9" id='heading_overview'>
      
      
			<?=$page->body_2 ?>
			<?=$render_documents ?>
			<?=$render_annoucements ?>
			<?=$render_tools ?>
			<?=$render_membership ?>
		</div>
		<div class="col-sm-3">
			<div class="border-left-1 pl-3">
				<?=$render_membership_nav ?>
			</div>
		</div>
	</div>
</div>

<?
  $footer_js .= "
  <script src='{$config->urls->templates}assets/js/list.min.js'></script>
  <script>
		var options = {
		  valueNames: [ 
		  	'col-cdwg', 
		  	'col-wg', 
		  	{ name: 'col-status', attr: 'data-status' },
		  ]
		};
		var userList = new List('tableCurationGroups', options);
	</script>
	<script>
		$(function () {
		  $(\"[data-toggle='tooltip']\").tooltip()
		})
	</script>



	<script type=\"text/javascript\">

	    $(function () {
	  $('table#dataplatform [data-toggle=\"popover\"]').popover(
	    {
	      trigger: 'hover',
	      html: true
	    }
	  )
	})
	    
	$('.input-unc').click(function() {
	  if ($(this).is(':checked')) {

	    $('.label-unc').show();
	  } else {
	    $('.label-unc').hide();
	  }
	});
	    
	$('.input-baylor').click(function() {
	  if ($(this).is(':checked')) {

	    $('.label-baylor').show();
	  } else {
	    $('.label-baylor').hide();
	  }
	});
	    
	    
	$('.input-stanford').click(function() {
	  if ($(this).is(':checked')) {

	    $('.label-stanford').show();
	  } else {
	    $('.label-stanford').hide();
	  }
	});
	    
	$('.input-u41').click(function() {
	  if ($(this).is(':checked')) {

	    $('.label-u41').show();
	  } else {
	    $('.label-u41').hide();
	  }
	});

	    
	    
	$('.input-major').click(function() {
	  if ($(this).is(':checked')) {

	    $('.label-major').show();
	  } else {
	    $('.label-major').hide();
	  }
	});
	    
	$('.input-external').click(function() {
	  if ($(this).is(':checked')) {

	    $('.label-external').show();
	  } else {
	    $('.label-external').hide();
	  }
	});
	</script>

";
          ?>