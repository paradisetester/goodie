<?php

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Countries;
use App\Cities;
use App\States;
use App\Reservation;
use App\Restraunt;

function siteUrl()
{
    //return 'http://192.168.1.209:8080';
    return url('/');
}
function appName()
{
    return config('app.name');
}
function adminPublicPath()
{
    return asset('/public/admin');
}
function publicPath()
{
    return asset('/public');
}
function publicbasePath()
{
    return 'public/';
}
function pagination()
{
    return 8;
}
function adminBasePath()
{
    return 'admin';
}
function adminEmail()
{
    $admin_settings = getThemeOptions('admin_settings');
    return (isset($admin_settings['admin_email'])?$admin_settings['admin_email']:'paradisetester@gmail.com');
}

function admin_id()
{
       return DB::table('users')->where('role', 'Admin')->select('user_id')->get()->first();

}
function CleanHtml($html = null)
{
    return preg_replace(
        array(
            '/ {2,}/',
            '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
        ),
        array(
            ' ',
            ''
        ),
        $html
    );
}

function SendSMS($mobileNumber, $message)
{
    return;
}

function maybe_decode( $original ) {
    if ( is_serialized( $original ) )
        return @unserialize( $original );
    return $original;
}
function is_serialized( $data, $strict = true ) {
    if ( ! is_string( $data ) ) {
        return false;
    }
    $data = trim( $data );
    if ( 'N;' == $data ) {
        return true;
    }
    if ( strlen( $data ) < 4 ) {
        return false;
    }
    if ( ':' !== $data[1] ) {
        return false;
    }
    if ( $strict ) {
        $lastc = substr( $data, -1 );
        if ( ';' !== $lastc && '}' !== $lastc ) {
            return false;
        }
    }
    else
    {
        $semicolon = strpos( $data, ';' );
        $brace     = strpos( $data, '}' );
        if ( false === $semicolon && false === $brace )
            return false;
        if ( false !== $semicolon && $semicolon < 3 )
            return false;
        if ( false !== $brace && $brace < 4 )
            return false;
    }
    $token = $data[0];
    switch ( $token ) {
        case 's' :
            if ( $strict ) {
                if ( '"' !== substr( $data, -2, 1 ) ) {
                    return false;
                }
            }
            elseif ( false === strpos( $data, '"' ) ) {
                return false;
            }
        case 'a' :
        case 'O' :
            return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
        case 'b' :
        case 'i' :
        case 'd' :
            $end = $strict ? '$' : '';
            return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
    }
    return false;
}

function maybe_encode( $data ) {
    if ( is_array( $data ) || is_object( $data ) )
         return serialize( $data );
    if ( is_serialized( $data, false ) )
        return serialize( $data );
    return $data;
}

function fileuploadmultiple($request)
{
    $files = $request->file('attachments');
    $uploaded_file = [];
    foreach($files as $file) {
        $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
        $filename = str_replace(array(' ','-','`',','),'_',time().'_'.$file->getClientOriginalName());
        $upload_success = $file->move($destinationPath, $filename);
        $uploaded_file[] = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
    }
    return $uploaded_file;
}


function fileupload($request){
    $file = $request->file('image');
    $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
    $filename = time().'_'.$file->getClientOriginalName();
    $upload_success = $file->move($destinationPath, $filename);
    $uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
    return $uploaded_file;
}
function fileuploadproduct($request){
    $file = $request->file('productimage');
    $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
    $filename = time().'_'.$file->getClientOriginalName();
    $upload_success = $file->move($destinationPath, $filename);
    $uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
    return $uploaded_file;
}
function fileuploadExtra($request, $key){
    $file = $request->file($key);
    $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
    $filename = time().'_'.$file->getClientOriginalName();
    $filename = str_replace(['-','"',"'",' '], '_', $filename);
    $upload_success = $file->move($destinationPath, $filename);
    $uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
    return $uploaded_file;
}
function fileuploadArray($file){
    $destinationPath = publicbasePath().'/images/uploads/'.date('Y').'/'.date('M');
    $filename = time().'_'.$file->getClientOriginalName();
    $upload_success = $file->move($destinationPath, $filename);
    $uploaded_file = 'images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
    return $uploaded_file;
}
function randomPassword() {
    return mt_rand(100000, 999999);
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function getApiCurrentUser()
{
    if (empty(Request()->header('Authorization'))) {
        return new \App\User();
    }
    return JWTAuth::parseToken()->authenticate();
}

function getCurrentUser()
{
    $user = Auth::user();
    if (!$user) {
        $user = new \App\User();
    }
    return $user;
}

function getCurrentUserID()
{
    $user = getCurrentUser();
    return ($user->user_id?$user->user_id:0);
}

function getCurrentUserRole()
{
    $user = getCurrentUser();
    return $user->role;
}
function getCurrentUserByKey($key)
{
    $user = getCurrentUser();
    if (!empty($key)) {
        return isset($user->$key)?$user->$key:0;
    }
    return $user;
}
function getUser($user_id)
{
    return DB::table('users')->where('user_id', $user_id)->select('*')->get()->first();
}

function getCompany()
{
	$user_id = getCurrentUserID();	
    return getCompanyByUserID($user_id);
}

function getCompanyByUserID($user_id = 0)
{
    $company_id = DB::table('company_staff')->where('user_id', $user_id)->select('company_id')->get()->pluck('company_id')->first();
    $company = DB::table('companies')->leftjoin('company_staff as cs','cs.company_id','=','companies.id')->leftjoin('users','users.user_id','=','cs.user_id')->where('companies.id', $company_id)->where('users.role', 'Director')->select('companies.*','users.user_id')->get()->first();
    if (!$company) {
        $company = new \App\Companies();
    }   
    return $company;
}

function currentUserAcountBalance()
{
	 $user_id = getCurrentUserID();	
     $companyCredit = DB::table('wallet_credit')->where('user_id',$user_id)->get()->first();
	 $companyCreditPoints = $companyCredit->points;
    return $companyCreditPoints;
}

function acountBalance($user_id)
{	
    $companyCredit = DB::table('wallet_credit')->where('user_id',$user_id)->get()->first();
	$companyCreditPoints = $companyCredit->points;
    return $companyCreditPoints;
}
function getProductCategory($product_id)
{
    // echo $product_id;
    $data = DB::table('product_categories')
    ->leftjoin('categories as cs','cs.id','=','product_categories.category_id')
    ->where('product_id', $product_id)->pluck('cs.Name','cs.id');
return $data->all();
}
function get_Category_by_restid($catid)
{
    // echo $catid;
    $data =DB::table('restaurent_menus')->leftjoin('categories as cs','cs.id','=','restaurent_menus.category_id')->where('restaurant_id',$catid)->pluck('cs.Name','cs.id');
return $data->all();
}


function getProductCategoryname($product_id)
{
    // echo $product_id;
    $data = DB::table('product_categories')
    ->leftjoin('categories as cs','cs.id','=','product_categories.category_id')
    ->where('Name', $product_id)->pluck('cs.id','cs.name');
return $data->all();
}

function createUuid($name = 'vendorP')
{
    return Uuid::generate(5, $name, Uuid::NS_DNS);
}
function getCountry($country_name = null)
{
    if (!empty($country_name)) {
        return Countries::where('name',$country_name)->get()->pluck('name')->first();
    }
    return Countries::get();
}
function getState($country_name = null, $state_id = null)
{

    if (!empty($state_id)) {
        return States::where('id', $state_id)->get()->pluck('name')->first();
    }
    return States::where('country_id', Countries::where('name',$country_name)->get()->pluck('id')->first())->get();
}

function getStateCity($state_name = null, $city_id = null)
{
    if (!empty($city_id)) {
        return Cities::where('id', $city_id)->get()->pluck('name')->first();
    }
    return Cities::where('state_id', States::where('name', $state_name)->get()->pluck('id')->first())->get();
}
function getPercantageAmount($amount, $percent)
{
    return $amount/100*$percent;
}
function getDuration($date)
{
  $time = '';
  $t1 = \Carbon\Carbon::parse($date);
  $t2 = \Carbon\Carbon::parse();
  $diff = $t1->diff($t2);
  if ($diff->format('%y')!=0) {
    $time .= $diff->format('%y')." Year ";
  }
  if ($diff->format('%m')!=0) {
    $time .= $diff->format('%m')." Month ";
  }
  if ($diff->format('%d') && $diff->format('%m')==0) {
    $time .= $diff->format('%d')." Days ";
  }
  if ($diff->format('%h')!=0 && $diff->format('%m')==0) {
    $time .= $diff->format('%h')." Hours ";
  }
  if ($diff->format('%i')!=0 && $diff->format('%d')==0) {
    $time .= $diff->format('%i')." Minutes ";
  }
  if ($diff->format('%s')!=0 && $diff->format('%h')==0) {
    $time .= $diff->format('%s')." Seconds ";
  }
  return $time;
}
function getDays($date)
{
    $time = '';
    $t1 = \Carbon\Carbon::parse($date);
    $t2 = \Carbon\Carbon::parse();
    $diff = $t1->diff($t2);
    $months = $diff->format('%m');
    $monthDays = $months * 30;
    if ($date < date('Y-m-d')) {
        return '-'.$diff->format('%d')+1+$monthDays;
    }
    return $diff->format('%d')+1+$monthDays;
}
function weekOfMonth($currentMonth)
{
    $stdate = $currentMonth.'-01';
    $enddate = $currentMonth.'-31'; //get end date of month
    $begin = new \DateTime('first day of ' . $stdate);
    $end = new \DateTime('last day of ' . $enddate);
    $interval = new \DateInterval('P1W');
    $daterange = new \DatePeriod($begin, $interval, $end);

    $dates = array();
    foreach($daterange as $key => $date) {
        $check = ($date->format('W') != $end->modify('last day of this month')->format('W')) ? '+6 days' : 'last day of this week';
        $dates[$key+1] = array(
            'start' => $date->format('Y-m-d'),
            'end' => ($date->modify($check)->format('Y-m-d')),
        );
        if ($dates[$key+1]['end']>date('Y-m-d', strtotime($enddate))) {
              $dates[$key+1]['end'] = date('Y-m-d', strtotime($enddate));
        }
    }
    return $dates;
}

function getLatLong($address = null)
{
    $latLong = [];
    $latLong['lattitude'] = '';
    $latLong['longitude'] = '';
    if (!empty($address)) {
        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyCjEHaWgv-lmblYJ-m0fp3lwfrWrgzQEPE&address=".urlencode($address)."&sensor=false");
        $json = json_decode($json);
        if ($json->status == 'OK') {
            $latLong['lattitude'] = $json->results[0]->geometry->location->lat;
            $latLong['longitude'] = $json->results[0]->geometry->location->lng;
        }
    }
    return $latLong;
}
function address($user)
{
    $address = [];
    if (isset($user->address) && !empty($user->address)) {
        $address[] = $user->address;
    }
    if (isset($user->city) && !empty($user->city)) {
        $address[] = $user->city;
    }
    if (isset($user->state) && !empty($user->state)) {
        $address[] = $user->state;
    }
    if (isset($user->country) && !empty($user->country)) {
        $address[] = $user->country;
    }
    return implode(',', $address);
}
function bindAddress($user)
{
    $address = [];
    if (isset($user->address) && !empty($user->address)) {
        $address[] = $user->address;
    }
    if (isset($user->city) && !empty($user->city)) {
        $address[] = $user->city;
    }
    if (isset($user->state) && !empty($user->state)) {
        $address[] = $user->state;
    }
    if (isset($user->country) && !empty($user->country)) {
        $address[] = $user->country;
    }
    $address = implode(' ', $address);
    echo str_replace(" ", "+", $address);
}
function ip_info($purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    $ip = $_SERVER['REMOTE_ADDR'];
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
function phoneOtpSendVarification($email ='', $phone='')
{
    if (empty($phone)) {
        echo 'empty';
        die;
    }
    PhoneOtpVerification::where('phone', $phone)->where('otp_for', 'phone_number')->where('otp_status', 'sent')->delete();
    $otp_code = rand(1, 1000000);
    PhoneOtpVerification::insertGetId([
        'phone' => $phone,
        'otp_code' => $otp_code,
        'time' => date('H:i:s'),
        'otp_for' => 'phone_number',
        'otp_status' => 'sent',
        'created_at' => new DateTime,
        'updated_at' => new DateTime
    ]);
    $message = 'Your Otp for phone verification code is '.$otp_code;
    if (!empty($email)) {
        SendEmail($email,'Phone Otp DR Help Desk',$message,'');
    }
    SendSMS($phone, $message);
    return $otp_code;
}

function getSettings()
{
    $settingQs = \App\Settings::select('key','value')->get();
    $settings = [];
    foreach ($settingQs as $setting) {
        $settings[$setting->key] = maybe_decode($setting->value);
    }
    global $settings;
}

//getSettings();

function calculateDaysAccTime($days,$start_time,$end_time)
{
    $start_time_h = strtotime($start_time);
    $end_time_h = strtotime($end_time);
    if($end_time_h < $start_time_h) {
        $end_time_h += 24 * 60 * 60;
    }
    $total_min = ($end_time_h - $start_time_h) / 60;
    if($total_min < 300)
    {
        $days = $days/2;
    }
    return $days;
}

function timeSlots(){
    return [
        '06:00 AM To 08:00 AM','08:00 AM To 10:00 AM','10:00 AM To 12:00 PM','12:00 PM To 02:00 PM','02:00 PM To 04:00 PM','04:00 PM To 06:00 PM','06:00 PM To 08:00 PM'
    ];

}
function userRoles()
{
    return [
        'Admin','Director','Staff'
    ];
}
function adminSideBarMenus(){
    $roles = userRoles();
    return [
        $roles[0]=>[
            'title' => 'Dashboard',
            'route' => route($roles[0].'.dashboard'),
            'icon' => 'ti-home',
            'roles' => [$roles[0]],
            'child' => []
        ],
        $roles[1]=>[
            'title' => 'Dashboard',
            'route' => route($roles[1].'.dashboard'),
            'icon' => 'ti-home',
            'roles' => [$roles[1]],
            'child' => []
        ],
        $roles[2]=>[
            'title' => 'Dashboard',
            'route' => route($roles[2].'.dashboard'),
            'icon' => 'ti-home',
            'roles' => [$roles[2]],
            'child' => []
        ],
        /*'media'=>[
            'title' => 'Media',
            'route' => route('media.index'),
            'icon' => 'ti-layout-media-center',
            'roles' => $roles,
            'child' => []
        ],*/
        // 'users'=>[
        //     'title' => 'Users',
        //     'route' => 'javascript:void(0)',
        //     'roles' => [$roles[0]],
        //     'icon' => 'ti-user',
        //     'child' => [
        //         [
        //             'title' => 'View',
        //             'route' => route('users.index'),
        //             'icon' => 'ti-angle-right',
        //         ],
        //         [
        //             'title' => 'Create',
        //             'route' => route('users.create'),
        //             'icon' => 'ti-angle-right',
        //         ]
        //     ]
        // ],      
        'companies'=>[
            'title' => 'Company',
            'route' => 'javascript:void(0)',
            'roles' => [$roles[0]],
            'icon' => 'ti-user',
            'child' => [
                [
                    'title' => 'Company ReNew Requests',
                    'route' => route('companies.renew.requests'),
                    'icon' => 'ti-angle-right',
                ],
                [
                    'title' => 'Company List',
                    'route' => route('companies.index'),
                    'icon' => 'ti-angle-right',
                ],
                [
                    'title' => 'Add New Company',
                    'route' => route('companies.create'),
                    'icon' => 'ti-angle-right',
                ]              
            ]
        ],        
        'room'=>[
            'title' => 'Room',
            'route' => 'javascript:void(0)',
            'roles' => [$roles[0]],
            'icon' => 'ti-user',
            'child' => [
                [
                    'title' => 'Room List',
                    'route' => route('room.index'),
                    'icon' => 'ti-angle-right',
                ],              
                [
                    'title' => 'Add New Room',
                    'route' => route('room.create'),
                    'icon' => 'ti-angle-right',
                ],
                [
                    'title' => 'Equipment List',
                    'route' => route('equipments.index'),
                    'icon' => 'ti-angle-right',
                ],              
                [
                    'title' => 'Add New Equipment',
                    'route' => route('equipments.create'),
                    'icon' => 'ti-angle-right',
                ]           
            ]
        ],
        'themes'=>[
            'title' => 'Admin Settings',
            'route' => 'javascript:void(0)',
            'icon' => 'ti-palette',
            'roles' => [$roles[0]],
            'child' => [
                [
                    'title' => 'Settings',
                    'route' => route('themes.index'),
                    'icon' => 'ti-angle-right',
                ]
            ]
        ],
		
        
		
        'company'=>[
            'title' => 'Company',
            'route' => 'javascript:void(0)',
            'roles' => [$roles[1]],
            'icon' => 'ti-user',
            'child' => [               
                [
                    'title' => 'Staff List',
                    'route' => route('staff.index'),
                    'icon' => 'ti-angle-right',
                ],              
                [
                    'title' => 'Add New Staff',
                    'route' => route('staff.create'),
                    'icon' => 'ti-angle-right',
                ]			
            ]
        ],
		'schedule'=>[
            'title' => 'Schedule',
            'route' => 'javascript:void(0)',
            'icon' => 'ti-calendar',
            'roles' => $roles,
            'child' => [
                [
                    'title' => 'Bookings',
                    'route' => route('schedule.booking'),
                    'icon' => 'ti-angle-right',
                ],
               [
                    'title' => 'My Calendar',
                    'route' => route('schedule.mycalendar'),
                    'icon' => 'ti-angle-right',
                ],
                [
                    'title' => 'Resource Calendar',
                    'route' => route('schedule.resources'),
                    'icon' => 'ti-angle-right',
                ],
				[
                    'title' => 'Reservation',
                    'route' => route('reservation.index'),
                    'icon' => 'ti-angle-right',
                ] 				
            ]
        ],
		'credit'=>[
            'title' => 'Credit',
            'route' => 'javascript:void(0)',
            'icon' => 'ti-palette',
            'roles' => [$roles[0]],
            'child' => [
                [
                    'title' => 'Credit',
                    'route' => route('credit.index'),
                    'icon' => 'ti-angle-right',
                ],
                [
                    'title' => 'User Credit History',
                    'route' => route('credit.userCreditHistory'),
                    'icon' => 'ti-angle-right',
                ]
            ]
        ],
        'request'=>[
            'title' => 'Request Credit',
            'route' => 'javascript:void(0)',
            'icon' => 'ti-palette',
            'roles' => $roles,
            'child' => [
                [
                    'title' => 'Credit List',
                    'route' => route('request.creditList'),
                    'icon' => 'ti-angle-right',
                ],
                /*[
                    'title' => 'Request Credit',
                    'route' => route('request.credit'),
                    'icon' => 'ti-angle-right',
                ],*/
                [
                    'title' => 'Credit History',
                    'route' => route('request.creditHistory'),
                    'icon' => 'ti-angle-right',
                ]
            ]
        ],
        'reservation' => [
            'roles' => $roles,
        ],
        'reservationstaff' => [
            'roles' => [$roles[2]],
        ],
        'staff'=>[
            'roles' => [$roles[1]],
        ],		
        'equipments'=>[
            'roles' => [$roles[0]],
        ],
    ];
}
function dateFormat($date)
{
    if (!$date) {
        return ;
    }
    return date('Y-m-d', strtotime($date));
}
function priceFormat($number){
    if (!$number) {
        $number = 0;
    }
    return '$ '.number_format($number, 2);
}
function userStatus()
{
    return [
        '0' => 'Inactive',
        '1' => 'Active',
        '-1' => 'Suspended',
    ];
}
function compStatus()
{
    return ['Pending', 'Approved', 'Canceled'];
}
/***** User Meta********/
function getUserMeta($user_id = null, $meta_key = null){
    if (empty($user_id)) {
        return;
    }
    if ($meta_key) {
        return maybe_decode(\App\UserMetas::where('user_id', $user_id)->where('meta_key', $meta_key)->pluck('meta_value')->first());
    } else {
        $userMetas = \App\UserMetas::where('user_id', $user_id)->select('meta_key', 'meta_value')->get()->toArray();
        $userMetasData = [];
        foreach ($userMetas as &$userMeta) {
            $userMetasData[$userMeta['meta_key']] = maybe_decode($userMeta['meta_value']);
            unset($userMeta['meta_key']);
            unset($userMeta['meta_value']);
        }
        return $userMetasData;
    }
}

function updateUserMeta($user_id = null, $meta_key = null, $meta_value = null){
    if (empty($user_id) && empty($meta_key)) {
        return;
    }
    if ($userMeta = \App\UserMetas::where('user_id', $user_id)->where('meta_key', $meta_key)->get()->first()) {
        $userMeta->meta_value = maybe_encode($meta_value);
        $userMeta->updated_at = new DateTime;
        $userMeta->save();
    } else {
        $userMeta = new \App\UserMetas;
        $userMeta->user_id = $user_id;
        $userMeta->meta_key = $meta_key;
        $userMeta->meta_value = maybe_encode($meta_value);
        $userMeta->created_at = new DateTime;
        $userMeta->updated_at = new DateTime;
        $userMeta->save();
    }
    return $user_id;
}

function createUpdateSiteMapXML($postUrl){
    return
    $hasUrl = false;
    $sitemapPath = base_path('sitemap.xml');
    $sitemapPath = str_replace('backend/', '', $sitemapPath);
    $xmlObjects = simplexml_load_file($sitemapPath);

    $xmlRow = '';
    $existRow = false;
    if (!empty($xmlObjects->url)) {
        foreach($xmlObjects->url as $xmlObject){
            if ($xmlObject->loc == $postUrl) {
                $existRow = true;
                $xmlRow .= '<url>
                        <loc>'.$xmlObject->loc.'</loc>
                      <lastmod>'.date('c',time()).'</lastmod>
                      <priority>'.$xmlObject->priority.'</priority>
                   </url>';
            } else {
                $xmlRow .= '<url>
                      <loc>'.$xmlObject->loc.'</loc>
                      <lastmod>'.$xmlObject->lastmod.'</lastmod>
                      <priority>'.$xmlObject->priority.'</priority>
                   </url>';
            }
        }
    }
    if ($existRow == false) {
        $xmlRow .= '<url>
                      <loc>'.$postUrl.'</loc>
                      <lastmod>'.date('c',time()).'</lastmod>
                      <priority>0.5</priority>
                   </url>';
    }

    $xmlContent = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
              xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
        <!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->
           '.$xmlRow.'
        </urlset>';

    $dom = new \DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xmlContent);
    $dom->save($sitemapPath);
}
function deleteSiteMapXML($postUrl){
    return;
    $hasUrl = false;
    $sitemapPath = base_path('sitemap.xml');
    $sitemapPath = str_replace('backend/', '', $sitemapPath);
    $xmlObjects = simplexml_load_file($sitemapPath);

    $xmlRow = '';
    if (!empty($xmlObjects->url)) {
        foreach($xmlObjects->url as $xmlObject){
            if ($xmlObject->loc != $postUrl) {
                $xmlRow .= '<url>
                        <loc>'.$xmlObject->loc.'</loc>
                      <lastmod>'.$xmlObject->lastmod.'</lastmod>
                      <priority>'.$xmlObject->priority.'</priority>
                   </url>';
            }
        }
    }

    $xmlContent = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
              xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
        <!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->
           '.$xmlRow.'
        </urlset>';

    $dom = new \DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xmlContent);
    $dom->save($sitemapPath);
}
function uploadFile($thumbnail = null, $key = 'image')
{
    ob_start();
    ?>
    <div class="row">
       <div class="col-md-12 imageUploadGroup">
          <?php 
          if ($thumbnail) {
             ?>
             <img src="<?php echo publicPath().'/'.$thumbnail ?>" id="<?php echo $key; ?>-img" style="display:block;width: 100%;height: 200px;">
             <button type="button" data-eid="<?php echo $key; ?>" style="display:none;" class="btn btn-success setFeaturedImage">Select image</button>
             <button type="button" data-eid="<?php echo $key; ?>" style="display:block;" class="btn btn-warning removeFeaturedImage">Remove image</button>
             <?php
          }else{
             ?>
             <img src="" id="<?php echo $key; ?>-img" style="width: 100%;height: 200px; display: none;">
             <button type="button" data-eid="<?php echo $key; ?>" class="btn btn-success setFeaturedImage">Select image</button>
             <button type="button" data-eid="<?php echo $key; ?>" class="btn btn-warning removeFeaturedImage">Remove  image</button>
             <?php
          }
          ?>                        
          <input type="hidden" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $thumbnail; ?>">
       </div>
    </div>
    <?php
    return ob_get_clean();
}

function insertUser($request)
{
    $activation_key = sha1(mt_rand(10000,99999).time().$request->input('email'));
    $password = $request->input('password');
    $email = $request->input('email');
    $user = new \app\User();
    $user->name = $request->input('name');
    $user->user_nicename = $request->input('name');
    $user->email = $request->input('email');
    $user->email_verified_at = new DateTime; 
    $user->password = bcrypt($password);
    $user->user_login = $request->input('email');
    $user->phone = $request->input('phone');
    $user->role = $request->input('role');
    $user->user_status = $request->input('user_status');
    $user->store_id = 0;
    $user->created_at = new DateTime;
    $user->updated_at = new DateTime;
    $user->user_activation_key = $activation_key;
    $user->save();

    $link = url('varify/email/link/'.$activation_key);
    $name = $request->input('fname');
    $emailTo = $request->input('email');
    $emailSubject = 'Activation At '.appName();
    $emailBody = view('Email.RegisterVerifyEmailLink', compact('name', 'link', 'password', 'email'));
    SendEmail($emailTo, $emailSubject, $emailBody, [], '', '', '', '');
    return $user->user_id;
}

function updateUser($id, $request){
    $user = \app\User::find($id);
    $user->name = $request->input('name');
    $user->user_nicename = $request->input('name');
    $user->email = $request->input('email');
    if ($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
    }        
    $user->user_login = $request->input('email');
    $user->role = $request->input('role');
    $user->phone = $request->input('phone');
    $user->user_status = $request->input('user_status');
    $user->updated_at = new DateTime;
    $user->save();
    return $user->user_id;
}

function x_week_range($date) {
    $ts = strtotime($date);
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    $start_date = date('Y-m-d', $start);
    $end_date   = date('Y-m-d', strtotime('next saturday', $start));
    $days = array();
    while (strtotime($start_date) <= strtotime($end_date)) {
        $timestamp = strtotime($start_date);
        $day = date('D', $timestamp);
        $days[$day] = array($start_date);
       $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    }
    return $days;
}

function time_range($format,$duration=''){
    $credit_points = getThemeOptions('credit_points');
    $starttime = (($credit_points['booking_hours_from'])?$credit_points['booking_hours_from']:'9:00');
    $endtime = (($credit_points['booking_hours_to'])?$credit_points['booking_hours_to']:'21:00');
    
    
    $array_of_time = array ();
    $start_time    = strtotime ($starttime); 
    $end_time      = strtotime ($endtime); 
    
    if(empty($duration)){
        $duration = (($credit_points['max_company_booking_minutes'])?$credit_points['max_company_booking_minutes']:30);     
    }
    
    $add_mins  = $duration * 60;
    while ($start_time <= $end_time) // loop between time
    {
        $array_of_time[] = array(
            'start_time'=>date ($format, $start_time),
            'end_time'=>date ($format, $start_time+$add_mins)
        );
        $start_time += $add_mins; // to check endtime
    }
    return $array_of_time;
}

function updateAccount($user_id, $from_user_id = 0, $amount, $type = 'credits', $for = 'Post Coin', $order_id = 0, $field = 'credits')
{
    if(!$walletCredit = \App\WalletCredit::where('user_id',$user_id )->get()->first())
    {
        $walletCredit = new \App\WalletCredit();
        $walletCredit->user_id = $user_id;
        $walletCredit->credits = 0;
        $walletCredit->points = 0;
        $walletCredit->created_at = date('Y-m-d H:i:s');
        $walletCredit->updated_at = date('Y-m-d H:i:s');
        $walletCredit->save();
    }

    $transaction_before = (isset($walletCredit->$field)?$walletCredit->$field:0);
    $insert_transaction = [];
    
    $walletTransaction = new \App\WalletTransactions();

    if ($type == 'debits') {
       $transaction_after = $transaction_before-$amount;
       $walletTransaction->transaction_debit   = $amount;
    } else {
        $transaction_after = $transaction_before+$amount;
        $walletTransaction->transaction_credit   = $amount;
    }
    $walletTransaction->user_id = $user_id;
    $walletTransaction->from_user_id = $from_user_id;
    $walletTransaction->credit_id = $walletCredit->credit_id;
    $walletTransaction->order_id = $order_id;
    $walletTransaction->transaction_before = $transaction_before;
    $walletTransaction->transaction_after = $transaction_after;
    $walletTransaction->transaction_type = $type;
    $walletTransaction->transaction_for = $for;
    $walletTransaction->transaction_amount = $amount;
    $walletTransaction->transaction_date = date('Y-m-d');
    $walletTransaction->transaction_time = date('H:i:s');
    $walletTransaction->created_at = date('Y-m-d H:i:s');
    $walletTransaction->updated_at = date('Y-m-d H:i:s');
    $walletTransaction->save();

    $walletCredit->$field = $transaction_after;
    $walletCredit->updated_at = date('Y-m-d H:i:s');
    $walletCredit->save();
}


function timeDuration($start_times,$end_times){
	
$date1 = strtotime($start_times);  
$date2 = strtotime($end_times);  
  
// Formulate the Difference between two dates 
$diff = abs($date2 - $date1);  
  
  
// To get the year divide the resultant date into 
// total seconds in a year (365*60*60*24) 
$years = floor($diff / (365*60*60*24));  
  
  
// To get the month, subtract it with years and 
// divide the resultant date into 
// total seconds in a month (30*60*60*24) 
$months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));  
  
  
// To get the day, subtract it with years and  
// months and divide the resultant date into 
// total seconds in a days (60*60*24) 
$days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24)); 
  
  
// To get the hour, subtract it with years,  
// months & seconds and divide the resultant 
// date into total seconds in a hours (60*60) 
$hours = floor(($diff - $years * 365*60*60*24  
       - $months*30*60*60*24 - $days*60*60*24) 
                                   / (60*60));  
  
  
// To get the minutes, subtract it with years, 
// months, seconds and hours and divide the  
// resultant date into total seconds i.e. 60 
$minutes = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24  
                          - $hours*60*60)/ 60);  
  
  
// To get the minutes, subtract it with years, 
// months, seconds, hours and minutes  
$seconds = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24 
                - $hours*60*60 - $minutes*60));  
  
return $array = array(
		'years'=>$years,
		'days'=>$days,
		'hours'=>$hours,
		'minutes'=>$minutes,
		'seconds'=>$seconds,
	);

}