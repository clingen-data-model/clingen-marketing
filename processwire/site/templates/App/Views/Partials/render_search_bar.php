<?

$url_to_activities = $pages->get(1018)->url_curations;
$url_to_curations = $pages->get(2234)->url_curations;
$typeahead_url    = $pages->get(3530)->url_general; 
$search_main = "
  <div class='row search_bar' id=''>
      <div class='col-md-9'>
        <table class='w-100'>
          <tr>
            <td style='width:1%'>
        <div class='input-group'>
          <div class='input-group-btn p-0 m-0'>
            <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Search: <span class='typeQueryLabel'>Gene</span></button>
            <ul class='dropdown-menu'>
              <li class='typeQueryGene'><span class='a-link'>Gene</span></li>
              <li class='typeQueryDisease'><span class='a-link'>Disease</span></li>
              <li><a class='' target='allele_reg' href='http://reg.clinicalgenome.org'><i class='fas fa-external-link-alt float-right mt-1 text-muted'></i> Variant</a></li>
              <li role='separator' class='dropdown-divider'></li>
              <li><a class='' href='/search/'><i class='fas fa-external-link-alt float-right mt-1 text-muted'></i>Website Search</a></li>
            </ul>
          </div>
        </div>
        </td>
        <td>
          <form id='' class='inputQueryGene pb-0 mb-0' action='{$typeahead_url}/home' accept-charset='UTF-8' method='get'>
          <input name='utf8' type='hidden' value='✓'>
            <table>
              <tr>
                <td>
                  <input type='text' class='form-control border-radius-none w-100 queryGene' aria-label='' name='term' id='' placeholder='Gene...'>
                </td>
                <td style='width:1%'>
                  <span class='input-group-btn'>
                    <button class='btn btn-default' type='submit'>Go!</button>
                  </span>
                </td>
              </tr>
            </table>
          </form>
          <form id='' class='inputQueryDisease pb-0 mb-0' action='{$typeahead_url}/home' accept-charset='UTF-8' method='get' style='display:none'>
          <input name='utf8' type='hidden' value='✓'>
            <table>
              <tr>
                <td>
                  <input type='text' class='form-control border-radius-none w-100 queryDisease' aria-label='' name='term' id='' placeholder='Disease...'>
                </td>
                <td style='width:1%'>
                  <span class='input-group-btn'>
                    <button class='btn btn-default' type='submit'>Go!</button>
                  </span>
                </td>
              </tr>
            </table>
          </form>
        </td>
        </table>
      </div> 
      <div class='col-md-3'>
        <div class='dropdown'>
          <a class='btn btn-block btn-outline-light bg-primary text-white strong dropdown-toggle' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Browse Curations
          </a>
          <div class='dropdown-menu border-radius-sm  dropdown-menu-right' aria-labelledby='dropdownMenuButton'>
            <li><a class='dropdown-item' href='https://www.clinicalgenome.org//curation-activities/'>About ClinGen's Curation Activities</a></li>
            <li class='dropdown-divider'></li>
            <li><a class='dropdown-item' href='https://search.clinicalgenome.org/kb/curations/'><span class='text-muted'>Browse</span> All Curated Genes</a></li>
            <li><a class='dropdown-item' href='https://search.clinicalgenome.org/kb/gene-validity/'><span class='text-muted'>Browse</span> Gene-Disease Validity</a></li>
            <li><a class='dropdown-item' href='https://search.clinicalgenome.org/kb/gene-dosage/'><span class='text-muted'>Browse</span> Dosage Sensitivity</a></li>
            <li><a class='dropdown-item' href='https://search.clinicalgenome.org/kb/actionability/'><span class='text-muted'>Browse</span> Clinical Actionability</a></li>
            <li><a class='dropdown-item' href='https://erepo.clinicalgenome.org/evrepo/'><span class='text-muted'>Browse</span> Variant Pathogenicity</a></li>
            
          </div>
        </div>
      </div>
    </div>
  ";

//<li class='dropdown-divider'></li> <li><a class='dropdown-item' href='#'><span class=''>Options to download data</a></li>

?>