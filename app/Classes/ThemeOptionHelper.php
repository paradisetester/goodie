<?php

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Option;


function getThemeOptions($optionName){
    $options = Option::where('option_name',$optionName)->pluck('option_value')->first();
    return $optionData = maybe_decode($options);
    
}

function getProjectSection($mainArray,$appendArray){
    if (empty($mainArray)) {
        return $appendArray;
    }
    foreach ($mainArray as $key => $value) {
        if($key=='experince'):
           $appendArray[$key]= (!empty($value)) ? $value : '' ;
        elseif($key=='projectsFinished'):
           $appendArray[$key]= (!empty($value)) ? $value : '' ;
        elseif($key=='clients'):
           $appendArray['clientsCount']= (!empty($value)) ? $value : '' ;
        endif;      
     }
    return $appendArray;
}

function updateOption($optionKey = null, $optionValue = null){
    if ($option = Option::where('option_name', $optionKey)->get()->first()) {
        $option->option_value = maybe_encode($optionValue);
        $option->updated_at = new DateTime;
        $option->save();
    }else{
        $option = new Option;
        $option->option_name = $optionKey;
        $option->option_value = maybe_encode($optionValue);
        $option->created_at = new DateTime;
        $option->updated_at = new DateTime;
        $option->save();
    }
}

function themeFieldArray()
{
    return [
        [
            'key' => 'admin_settings',
            'title' => 'Admin Settings',
            'icon' => '<i class="fa fa-cog" aria-hidden="true"></i></span>',
            'fields' => 
            [
                [
                    'title' =>'Admin E-Mail',
                    'id' => 'admin_email',
                    'type' => 'text',
                    'placeholder' =>'Admin E-Mail',
                    'default' => '',
                ],
                [
                    'title' =>'Site Logo',
                    'id' => 'site_logo',
                    'type' => 'FilesUpload',
                    'placeholder' =>'Site Logo',
                    'default' => '',
                ],
				[
                    'title' =>'Staff Cost',
                    'id' => 'per_seat_cost',
                    'type' => 'number',
                    'placeholder' =>'Per Staff Cost',
                    'default' => '10',
                ],
				[
                    'title' =>'Max Company Booking Hours',
                    'id' => 'max_company_booking_hours',
                    'type' => 'number',
                    'placeholder' =>'Max Company Booking Hours',
                    'default' => '30min',
                ],
				[
                    'title' =>'Booking start Time',
                    'id' => 'booking_hours_from',
                    'type' => 'date',
                    'placeholder' =>'Booking start Time',
                    'default' => '9:00',
                ],				
				[
                    'title' =>'Booking end Time',
                    'id' => 'booking_hours_to',
                    'type' => 'date',
                    'placeholder' =>'Booking end Time',
                    'default' => '18:00',
                ],
				[
                    'title' =>'Each Booking price',
                    'id' => 'booking_price',
                    'type' => 'number',
                    'placeholder' =>'Each Staff Booking price',
                    'default' => '1',
                ],
                [
                    'title' =>'Default credit point to Company',
                    'id' => 'company_credit_point',
                    'type' => 'number',
                    'placeholder' =>'Default credit point in monthly membership',
                    'default' => '10',
                ],
                [
                    'title' =>'Default credit point to Staff',
                    'id' => 'staff_credit_point',
                    'type' => 'number',
                    'placeholder' =>'Default credit point in monthly membership',
                    'default' => '10',
                ],
                [
                    'title' =>'Background Image for Booking Page',
                    'id' => 'booking_background',
                    'type' => 'FilesUpload',
                    'placeholder' =>'Background Image for Booking Page',
                    'default' => '10',
                ],
                       
            ]
        ],
        [
            'key' => 'credit_points',
            'title' => 'Credit Points',
            'icon' => '<i class="fa fa-cog" aria-hidden="true"></i></span>',
            'fields' => 
            [
                [
                    'title' =>'Credit Point Per Head Count',
                    'id' => 'credit_point_per_head_count',
                    'type' => 'text',
                    'placeholder' =>'Credit Point Per Head Count',
                    'default' => '10',
                ],
                [
                    'title' =>'Per Seat Cost',
                    'id' => 'per_seat_cost',
                    'type' => 'text',
                    'placeholder' =>'Per Seat Cost',
                    'default' => '300',
                ],
                [
                    'title' =>'Refund Before Minutes',
                    'id' => 'refund_before_minutes',
                    'type' => 'text',
                    'placeholder' =>'Refund Before Minutes',
                    'default' => '24',
                ],
                [
                    'title' =>'Booking Hours From',
                    'id' => 'booking_hours_from',
                    'type' => 'text',
                    'placeholder' =>'Booking Hours From',
                    'default' => '9:00',
                ],
                [
                    'title' =>'Booking Hours To',
                    'id' => 'booking_hours_to',
                    'type' => 'text',
                    'placeholder' =>'Booking Hours To',
                    'default' => '18:00',
                ],
                [
                    'title' =>'Max Company Booking Minutes',
                    'id' => 'max_company_booking_minutes',
                    'type' => 'text',
                    'placeholder' =>'Max Company Booking Minutes',
                    'default' => '30 min',
                ],
                       
            ]
        ]
    ];
}

function FilesUpload($slug,$id,$placeholder,$title,$default,$old){

    return '<div class="col-md-12 imageUploadGroup">
            <label class="col-form-label" for="'.$title.'">'.$title.'</label><br>
            <img src="'.publicPath().'/'.$old.'" class="file-upload" id="'.$slug.'-img" style="width: 100px; height: 100px;">
            <button type="button" data-eid="'.$slug.'" class="btn btn-success setFeaturedImage">Select image</button>
            <button type="button" data-eid="'.$slug.'"  class="btn btn-warning removeFeaturedImage">Remove image</button>
            <input type="hidden" name="'.$id.'" id="'.$slug.'" value="'.$old.'">
        </div>';
}

function number($id,$placeholder,$title,$default,$old){
    return  '<div class="input-group row">
                <label class="col-form-label" for="'.$title.'">'.$title.'</label><br>
                    <input type="number" name="'.$id.'" required="" id="'.$id.'" class="form-control form-control-lg" placeholder="'.$placeholder.'" value="'.$old.'">
                    <span class="md-line"></span>
            </div>';
}

function text($id,$placeholder,$title,$default,$old){
    return  '<div class="input-group row">
                <label class="col-form-label" for="'.$title.'">'.$title.'</label><br>
                    <input type="text" name="'.$id.'" required="" id="'.$id.'" class="form-control form-control-lg" placeholder="'.$placeholder.'" value="'.$old.'">
                    <span class="md-line"></span>
            </div>';
}
function email($id,$placeholder,$title,$old){
    return '<div class="input-group row">
                <label class="col-form-labemailel" for="'.$id.'">'.$title.'</label><br>
                    <input type="email" name="'.$id.'" required="" id="'.$id.'" class="form-control form-control-lg" placeholder="'.$placeholder.'" value="'.$old.'">
                    <span class="md-line"></span>
            </div>';

}

function checkbox($id,$placeholder,$title, $options,$old){
    $checkBox = '<div class="input-group row">
    <label class="col-form-label col-md-12" style="padding-left:0px;" for="">'.$title.'</label><br>';
    $count = 0;
    foreach($options as $key => $value){
        $checkBox .='
            <label for="'.str_slug($id, '-').'-'.$count.'" class="col-form-label col-md-1 " style="padding-left:0px;">'.$value.'&nbsp;<input '.(is_array($old) && in_array($value, $old)?'checked':'').' type="checkbox" name="'.$id.'[]" style="width:auto;float:right; margin-top: 6px;" required="" id="'.str_slug($id, '-').'-'.$count.'" class="form-control form-control-lg" value="'.$value.'"></label>';
            $count++;
    }
    $checkBox .= '<span class="md-line"></span> </div>';
    return  $checkBox;
}
function radio($id,$placeholder,$title, $options,$old){
    $radioButtonArrayData='';
    foreach($options as $key=>$value){
        $count= $key+1;
        $radioButtonArrayData.='<div class="input-group row">
                                    <label class="col-form-label" for="'.$value["id"].'">'.$value["title"].'</label><br>
                                    <input type="radio" name="'.$value["id"].'[]" required="" id="'.$value["id"].'_'.$count.'" class="form-control form-control-lg" value="">
                                    <span class="md-line"></span>
                                </div>';
    }
    return  $radioButtonArrayData;
}
function select($id,$placeholder,$title, $selectOptions,$old){
    $options='';
    foreach($selectOptions as $key=>$value){
        $options.='<option value="'.$key.'" '.($old == $key?'selected':'').'>'.$value.'</option>';
    }

    return '<div class="input-group row">
                 <label class="col-form-label" for="'.str_slug($id, '-').'">'.$title.'</label><br>
                    <select required="" id="'.str_slug($id, '-').'" class="form-control form-control-lg" name="'.$id.'">
                    <option value="">Select</option>
                    '.$options.'
                    </select>
                    <span class="md-line"></span>
            </div>';

}
function textarea($id,$placeholder,$title,$old){
    return '<div class="input-group row">
                <label class="col-form-label" for="'.$id.'">'.$title.'</label><br>
                <textarea name="'.$id.'" required="" id="'.$id.'" class="form-control form-control-lg" placeholder="'.$placeholder.'" rows="5">'.$old.'</textarea>
                <span class="md-line"></span>
            </div>';
}
function textareaBig($id,$placeholder,$title,$old){
    return '<div class="input-group row">
                <label class="col-form-label" for="'.$id.'">'.$title.'</label><br>
                <textarea name="'.$id.'" rows="60" required="" id="'.$id.'" class="form-control form-control-lg" placeholder="'.$placeholder.'" rows="5">'.$old.'</textarea>
                <span class="md-line"></span>
            </div>';
}

function ThemeSidebarOptions(){
    $tabs = themeFieldArray();
	$activeTab = 'active';
	$activeTabContent = 'in active';
	$sidebarTabList = '';
	$sidebarTabContent = '';
	foreach ($tabs as $row) {
        $sidebarTabList .= '<li class="'.$activeTab.'">
                                <a class="input-group" data-toggle="pill" href="#'.$row['key'].'">
                                    <span class="input-group-addon">'.$row['icon'].'</span>
                                    <span>'.$row['title'].'</span>
                                </a>
                            </li>';

        $sidebarTabContent .= '<div id="'.$row['key'].'" class="tab-pane getActive '.$activeTabContent.'">
                                
                                <h3>'.$row['title'].'</h3>';
                                foreach($row['fields'] as $key => $value)
                                {
                                    $oldData = getThemeOptions($row['key']);
                                    $id = $value['id'];
                                    $passingOldData = (isset($oldData[$id])?$oldData[$id]:'');
                                    $sidebarTabContent .=inputFields($row['key'],$value['type'],$value,$passingOldData);
                                }   
                                 
        $sidebarTabContent.='</div>';

		$activeTab = '';
		$activeTabContent = '';
    }
    return '<div class="theme_sidebar">
                <ul class="nav nav-pills" role="tablist">'.$sidebarTabList.'</ul>
            </div>
            <div class="tab-content theme_sidebar_content">  
                '.$sidebarTabContent.'
            </div>';

}

function inputFields($key,$field,$fieldOptions,$oldData){
    $inputName=$key.'['.$fieldOptions['id'].']';
    $inputSlug=$fieldOptions['id'];
    switch($field){
        case 'text':
            return text($inputName,$fieldOptions['placeholder'],$fieldOptions['title'],$fieldOptions['default'],$oldData);
            break;
        
        case 'email':
            return email($inputName,$fieldOptions['placeholder'],$fieldOptions['title'],$fieldOptions['default'],$oldData);
            break;
        
        case 'textarea':
            return textarea($inputName,$fieldOptions['placeholder'],$fieldOptions['title'],$oldData);    
            break; 

        case 'textareaBig':
            return textareaBig($inputName,$fieldOptions['placeholder'],$fieldOptions['title'],$oldData);    
            break; 

        case 'FilesUpload':
            return FilesUpload($inputSlug,$inputName,$fieldOptions['placeholder'],$fieldOptions['title'],$fieldOptions['default'],$oldData);
            break;
        case 'number':
            return number($inputName,$fieldOptions['placeholder'],$fieldOptions['title'],$fieldOptions['default'],$oldData);
            break;
        case 'checkbox':
            return checkbox($inputName,$fieldOptions['placeholder'],$fieldOptions['title'], $fieldOptions['options'],$oldData);    
            break;

        case 'select':
            return select($inputName,$fieldOptions['placeholder'],$fieldOptions['title'], $fieldOptions['options'],$oldData);  
        case 'radio':
                        return;
        default:
                return;                
    }
}
