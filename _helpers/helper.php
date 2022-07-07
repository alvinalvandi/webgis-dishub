<?php
function base_url($a=''){
    $getbase_url=$GLOBALS['setUri']['base'];
    return $getbase_url.$a;
}

function assets($a=''){
    $getbase_assets=$GLOBALS['setUri']['assets'];
    return base_url($getbase_assets.$a);
}

function url($a='',$b=''){
    return base_url($b.'?halaman='.$a);
}

function export($a='',$b=''){
  
  return base_url($b.$a);
}

function redirect($a=''){
  header("location: ".$a);
  exit;
}

function templates($a=''){
    return assets($GLOBALS['template'].$a);
}


function content_open($title=''){
	return '
        <h2>'.$title.'</h2>
  
    
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
   
<!-- /page content -->';
}
function content_close(){
	return '
  
              
  </div>
  
  </div>';

}