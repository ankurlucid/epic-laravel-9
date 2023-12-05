<?php
use Carbon\Carbon;
use App\StaffEventSingleService;
use App\StaffEventClass;
use App\Business;
use App\Clients;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;
// use PDF;
/**
 * Global helpers file with misc functions
 *
 */

 if(!function_exists("eligibleAccounts")){
    /**
     * Check if logged in user's account type is eligible to perform specific action. Basically used while checking permission(Account Type Only)
     *
     * @param array $types Account types that are eligible
     * @return boolean 
     */ 
    function eligibleAccounts($types){
        if(isSuperUser() || isUserType($types))
            return true;
        return false;
    }
}

if(!function_exists("hasPermission")){
    /**
     * Check if logged in user has given permission to perform specific action. Basically used while checking permission(Permission Only)
     *
     * @param string $perm Permission to check
     * @return boolean 
     */ 
    function hasPermission($perm){

        if(isSuperUser() || Auth::user()->hasPermission(Auth::user(), $perm))
            return true;
        return false;
    }
}

// Upload  Images
function uploadFile($r, $name, $uploadPath)
{

    $image = $r->$name;
    $name = time() . '' . $image->getClientOriginalName();

    $image->move($uploadPath, time() . '' . $image->getClientOriginalName());

    return $name;
}

// Upload And Download Server Url
function uploadAndDownloadUrl()
{
    return asset('');
}

// Upload and download path
function uploadAndDownloadPath()
{
    return public_path();
}

// Muscle image Upload path
function muscleImageUploadPath()
{
    return uploadAndDownloadPath() . '/uploads/muscles/';
}

// Muscle Image Upload url
function muscleImageUploadUrl()
{
    return uploadAndDownloadUrl() . '/uploads/muscles/';
}

function noImageUrl()
{
    return uploadAndDownloadUrl() . 'theme/img/placeholder.jpg';
}


if(! function_exists("clientStatuses")){
    function clientStatuses(){
//return array('active' => 'active', 'inactive' => 'inactive', 'pending' => 'pending'/*, 'lead' => 'Lead'*/, 'pre-consultation' => 'Pre-Consultation', 'pre-benchmarking' => 'Pre-Benchmarking', 'pre-training' => 'Pre-Training', 'on-hold' => 'On Hold', 'active-lead' => 'Active Lead', 'inactive-lead' => 'Inactive Lead', 'contra' => 'Contra');
        /*return array('pending' => 'Pending', 'active-lead' => 'Active Lead', 'inactive-lead' => 'Inactive Lead', 'pre-consultation' => 'Pre-Consultation', 'pre-benchmarking' => 'Pre-Benchmarking', 'pre-training' => 'Pre-Training', 'active' => 'Active', 'inactive' => 'Inactive', /*, 'lead' => 'Lead'*//* 'on-hold' => 'On Hold', 'contra' => 'Contra');*/
        // return array('active' => 'Active','active-lead' => 'Active Lead', 'pending' => 'Pending','contra' => 'Contra', 'inactive' => 'Inactive', 'inactive-lead' => 'Inactive Lead',/*'lead' => 'Lead',*/'on-hold' => 'On Hold', 'pre-consultation' => 'Pre-Consultation', 'pre-benchmarking' => 'Pre-Benchmarking', 'pre-training' => 'Pre-Training');
        return array('active' => 'Active','active-lead' => 'Active Lead', 'contra' => 'Contra','inactive' => 'Inactive', 'inactive-lead' => 'Inactive Lead',/*'lead' => 'Lead',*/'on-hold' => 'On Hold','pending' => 'Pending','pre-benchmarking' => 'Pre-Benchmarking','pre-consultation' => 'Pre-Consultation', 'pre-training' => 'Pre-Training');

    }
}

if(!function_exists("genPwd")){
    /**
     * Generate alphabetic, 10 characters string
     *
     * @return string 
     */ 
    function genPwd(){
        return Str::random(10);
    }
}


if (! function_exists("displayAlert")) {
    /**
     * Helper to show success/failure notification
     *
     * @return mixed
     */
    function displayAlert($sessionData = '', $clearSess = false){
      if (!$sessionData && Session::has('message'))
         $sessionData = Session::get('message');
     if($clearSess)
        Session::forget('message');
    if($sessionData){
     $content = explode('|', $sessionData);
     $class = getAlertsColor($content[0]);
     return '<div class="alert alert-'.$class.' alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$content[1].'</div>';
 }
 return '';
}
}

if (! function_exists("displayNonClosingAlert")) {
    /**
     * Helper to show success/failure alert
     *
     * @return mixed
     */
    function displayNonClosingAlert($type, $message){
        return '<div class="alert alert-'.getAlertsColor($type).'">'.$message.'</div>';
    }
}

if (! function_exists("getAlertsColor")) {
    /**
     * Determine alerts background color based on the type
     *
     * @return mixed
     */
    function getAlertsColor($type){
        if($type == 'error')
            return 'danger';
        if($type == 'success')
            return 'success';
        if($type == 'warning')
            return 'warning';
        if($type == 'info')
            return 'info';
        return '';
    }
}

if (! function_exists('javascript')) {
    /**
     * Access the javascript helper
     */
    function javascript()
    {
        return app('JavaScript');
    }
}
if (! function_exists("monthDdOptions")) {
    /**
     * Helper to generate month dropdown options
     *
     * @return mixed
     */
    function monthDdOptions($defaultMonth = ''){
      return '<option value="01" '.($defaultMonth == '01'?'selected':'').'>January</option>
      <option value="02" '.($defaultMonth == '02'?'selected':'').'>February</option>
      <option value="03" '.($defaultMonth == '03'?'selected':'').'>March</option>
      <option value="04" '.($defaultMonth == '04'?'selected':'').'>April</option>
      <option value="05" '.($defaultMonth == '05'?'selected':'').'>May</option>
      <option value="06" '.($defaultMonth == '06'?'selected':'').'>June</option>
      <option value="07" '.($defaultMonth == '07'?'selected':'').'>July</option>
      <option value="08" '.($defaultMonth == '08'?'selected':'').'>August</option>
      <option value="09" '.($defaultMonth == '09'?'selected':'').'>September</option>
      <option value="10" '.($defaultMonth == '10'?'selected':'').'>October</option>
      <option value="11" '.($defaultMonth == '11'?'selected':'').'>November</option>
      <option value="12" '.($defaultMonth == '12'?'selected':'').'>December</option>';
  }
}

if (! function_exists("yearDdOptions")) {
    /**
     * Helper to generate year dropdown options
     *
     * @return mixed
     */
    function yearDdOptions($defaultYear = '',$year = 1){
     
      $endYear = date("Y")-$year;
       $startYear = $endYear-100;
      $options = '';
      for(; $endYear>$startYear; $endYear--)
         $options .= '<option value="'.$endYear.'" '.($defaultYear == $endYear?'selected':'').'>'.$endYear.'</option>';
     return $options;
 }
}

 if(!function_exists("isUserEligible")){
    /**
     * Check if logged in user is eligible to perform specific action. Basically used while checking permission(Account Type + Permission)
     *
     * @param array $types Account types that are eligible
     * @param string $perm Permission required for the action
     * @return boolean 
     */ 
    function isUserEligible($types, $perm){
        // return false;
        if(eligibleAccounts($types) && hasPermission($perm))
            return true;
    }
}

 if(!function_exists("setPrevousUrl")){
    /**
     * Store previous url in session
     *
     * @return void 
     */ 
    function setPrevousUrl($url){
        Session::put('prvUrl', $url);
    }
}

if(!function_exists("getPrevousUrl")){
    /**
     * Store previous url in session
     *
     * @return url 
     */ 
    function getPrevousUrl(){
        if(Session::has('prvUrl') && Session::get('prvUrl') != '')
            return Session::get('prvUrl');
        else
            return '';
    }
}

if (! function_exists("app_name")) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config("app.name");
    }
}

if (! function_exists("access")) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}


if(!function_exists("isSuperUser")){
    /**
     * Check if logged in user is Super User
     *
     * @return boolean 
     */ 
    function isSuperUser(){
        return Session::get('isSuperUser');
    }
}

if(!function_exists("isUserType")){
    /**
     * Check if logged in user is any of the given account type.
     *
     * @param array $types Types to check against
     * @return boolean 
     */ 
    function isUserType($types){
        if(!Auth::user() || in_array(Auth::user()->account_type, $types)) //!Auth::user() || added for middleware cron
        return true;
        return false;
    }
}

if (! function_exists("createTimestamp")) {
    /**
     * Helper to generate timestamp generally used for 'created_at' fields in DB.
     *
     * @return mixed
     */
    function createTimestamp(){
        return date('Y-m-d H:i:s');
    }
}

if (! function_exists("dpSrc")) {
    /**
     * Helper to get profile picture source 
     *
     * @return mixed
     */
    function dpSrc($src = '', $gend = ''){
      if($src)
         return asset('uploads/thumb_'.$src);
     else if($gend)
         return asset('profiles/'.strtolower($gend).'.gif');
     else
         return asset('profiles/noimage.gif');
 }
}

class Currency {

    public static $currencies = array(
        'ALL' => '(ALL) Albania Lek',
        'AFN' => '(AFN) Afghanistan Afghani',
        'ARS' => '(ARS) Argentina Peso',
        'AWG' => '(AWG) Aruba Guilder',
        'AUD' => '(AUD) Australia Dollar',
        'AZN' => '(AZN) Azerbaijan New Manat',
        'BSD' => '(BSD) Bahamas Dollar',
        'BBD' => '(BBD) Barbados Dollar',
        'BDT' => '(BDT) Bangladeshi taka',
        'BYR' => '(BYR) Belarus Ruble',
        'BZD' => '(BZD) Belize Dollar',
        'BMD' => '(BMD) Bermuda Dollar',
        'BOB' => '(BOB) Bolivia Boliviano',
        'BAM' => '(BAM) Bosnia and Herzegovina Convertible Marka',
        'BWP' => '(BWP) Botswana Pula',
        'BGN' => '(BGN) Bulgaria Lev',
        'BRL' => '(BRL) Brazil Real',
        'BND' => '(BND) Brunei Darussalam Dollar',
        'KHR' => '(KHR) Cambodia Riel',
        'CAD' => '(CAD) Canada Dollar',
        'KYD' => '(KYD) Cayman Islands Dollar',
        'CLP' => '(CLP) Chile Peso',
        'CNY' => '(CNY) China Yuan Renminbi',
        'COP' => '(COP) Colombia Peso',
        'CRC' => '(CRC) Costa Rica Colon',
        'HRK' => '(HRK) Croatia Kuna',
        'CUP' => '(CUP) Cuba Peso',
        'CZK' => '(CZK) Czech Republic Koruna',
        'DKK' => '(DKK) Denmark Krone',
        'DOP' => '(DOP) Dominican Republic Peso',
        'XCD' => '(XCD) East Caribbean Dollar',
        'EGP' => '(EGP) Egypt Pound',
        'SVC' => '(SVC) El Salvador Colon',
        'EEK' => '(EEK) Estonia Kroon',
        'EUR' => '(EUR) Euro Member Countries',
        'FKP' => '(FKP) Falkland Islands (Malvinas) Pound',
        'FJD' => '(FJD) Fiji Dollar',
        'GHC' => '(GHC) Ghana Cedis',
        'GIP' => '(GIP) Gibraltar Pound',
        'GTQ' => '(GTQ) Guatemala Quetzal',
        'GGP' => '(GGP) Guernsey Pound',
        'GYD' => '(GYD) Guyana Dollar',
        'HNL' => '(HNL) Honduras Lempira',
        'HKD' => '(HKD) Hong Kong Dollar',
        'HUF' => '(HUF) Hungary Forint',
        'ISK' => '(ISK) Iceland Krona',
        'INR' => '(INR) India Rupee',
        'IDR' => '(IDR) Indonesia Rupiah',
        'IRR' => '(IRR) Iran Rial',
        'IMP' => '(IMP) Isle of Man Pound',
        'ILS' => '(ILS) Israel Shekel',
        'JMD' => '(JMD) Jamaica Dollar',
        'JPY' => '(JPY) Japan Yen',
        'JEP' => '(JEP) Jersey Pound',
        'KZT' => '(KZT) Kazakhstan Tenge',
        'KPW' => '(KPW) Korea (North) Won',
        'KRW' => '(KRW) Korea (South) Won',
        'KGS' => '(KGS) Kyrgyzstan Som',
        'LAK' => '(LAK) Laos Kip',
        'LVL' => '(LVL) Latvia Lat',
        'LBP' => '(LBP) Lebanon Pound',
        'LRD' => '(LRD) Liberia Dollar',
        'LTL' => '(LTL) Lithuania Litas',
        'MKD' => '(MKD) Macedonia Denar',
        'MYR' => '(MYR) Malaysia Ringgit',
        'MUR' => '(MUR) Mauritius Rupee',
        'MXN' => '(MXN) Mexico Peso',
        'MNT' => '(MNT) Mongolia Tughrik',
        'MZN' => '(MZN) Mozambique Metical',
        'NAD' => '(NAD) Namibia Dollar',
        'NPR' => '(NPR) Nepal Rupee',
        'ANG' => '(ANG) Netherlands Antilles Guilder',
        'NZD' => '(NZD) New Zealand Dollar',
        'NIO' => '(NIO) Nicaragua Cordoba',
        'NGN' => '(NGN) Nigeria Naira',
        'NOK' => '(NOK) Norway Krone',
        'OMR' => '(OMR) Oman Rial',
        'PKR' => '(PKR) Pakistan Rupee',
        'PAB' => '(PAB) Panama Balboa',
        'PYG' => '(PYG) Paraguay Guarani',
        'PEN' => '(PEN) Peru Nuevo Sol',
        'PHP' => '(PHP) Philippines Peso',
        'PLN' => '(PLN) Poland Zloty',
        'QAR' => '(QAR) Qatar Riyal',
        'RON' => '(RON) Romania New Leu',
        'RUB' => '(RUB) Russia Ruble',
        'SHP' => '(SHP) Saint Helena Pound',
        'SAR' => '(SAR) Saudi Arabia Riyal',
        'RSD' => '(RSD) Serbia Dinar',
        'SCR' => '(SCR) Seychelles Rupee',
        'SGD' => '(SGD) Singapore Dollar',
        'SBD' => '(SBD) Solomon Islands Dollar',
        'SOS' => '(SOS) Somalia Shilling',
        'ZAR' => '(ZAR) South Africa Rand',
        'LKR' => '(LKR) Sri Lanka Rupee',
        'SEK' => '(SEK) Sweden Krona',
        'CHF' => '(CHF) Switzerland Franc',
        'SRD' => '(SRD) Suriname Dollar',
        'SYP' => '(SYP) Syria Pound',
        'TWD' => '(TWD) Taiwan New Dollar',
        'THB' => '(THB) Thailand Baht',
        'TTD' => '(TTD) Trinidad and Tobago Dollar',
        'TRY' => '(TRY) Turkey Lira',
        'TRL' => '(TRL) Turkey Lira',
        'TVD' => '(TVD) Tuvalu Dollar',
        'UAH' => '(UAH) Ukraine Hryvna',
        'GBP' => '(GBP) United Kingdom Pound',
        'UGX' => '(UGX) Uganda Shilling',
        'USD' => '(USD) United States Dollar',
        'UYU' => '(UYU) Uruguay Peso',
        'UZS' => '(UZS) Uzbekistan Som',
        'VEF' => '(VEF) Venezuela Bolivar',
        'VND' => '(VND) Viet Nam Dong',
        'YER' => '(YER) Yemen Rial',
        'ZWD' => '(ZWD) Zimbabwe Dollar'

    );


    /**
     * @param string $code
     * @return array
     */
    public static function getCodeName($code = "USD") {
        $currencies = [];
        foreach( self::$currencies as $key => $value ) {
            $currencies[$key] =  self::$currencies[$key]['name'];
        }
        return $currencies;

    }

}

class Country {

    private static $countries = array
    (
        'AI' => array( 'name' => 'Anguilla', 'states' => array(
            'BP' => 'Blowing Point', 'EE' => 'East End', 'GH' => 'Geroge Hill', 'IH' => 'Island Harbour', 'NH' => 'North Hill', 'NS' => 'North Side', 'SG' => 'Sandy Ground', 'SO' => 'South Hill', 'ST' => 'Stoney Ground',
            'TF' => 'The Farrington', 'TQ' => 'The Quarter', 'TV' => 'The Valley', 'WE' => 'West End')
    ),

        'AR' => array( 'name' => 'Argentina', 'states' => array(
            "B" => 'Buenos Aires', "K" => 'Catamarca', "H" => 'Chaco', "U" => 'Chubut',
            "C" => 'Ciudad Autónoma de Buenos Aires', "X" => 'Córdoba', "W" => 'Corrientes', "E" => 'Entre Ríos',
            "P" => 'Formosa', "Y" => 'Jujuy', "L" => 'La Pampa', "F" => 'La Rioja', "M" => 'Mendoza',
            "N" => 'Misiones', "Q" => 'Neuquén', "R" => 'Río Negr', "A" => 'Salta', "J" => 'San Juan',
            "D" => 'San Luis', "Z" => 'Santa Cruz', "S" => 'Santa Fe', "G" => 'Santiago del Estero', "V" => 'Tierra del Fuego', "T" => 'Tucumán' )
    ),

        'AU' => array( 'name' => 'Australia', 'states' => array(
            "NSW"=>"New South Wales","VIC"=>"Victoria","QLD"=>"Queensland","TAS"=>"Tasmania","SA"=>"South Australia","WA"=>"Western Australia","NT"=>"Northern Territory","ACT"=>"Australian Capital Terrirory", "1" => "Burgenland", "2" => "Kärnten", "3" => "Niederösterreich", "4" => "Oberösterreich", "5" => "Salzburg", "6" => "Steiermark", "7" => "Tirol", "8" => "Vorarlberg", "9" => "Wien" )
    ),

        'BS' => array( 'name' => 'Bahamas', 'states' => array(
            "AK" => "Acklins Islands", "BY" => "Berry Islands", "BI" => "Bimini and Cat Cay","BP" => "Black Point","CI" => "Cat Island", "CO" => "Central Abaco", "CS" => "Central Andros","CE" => "Central Eleuthera", "FP" => "City of Freeport", "CK" => "Crooked Island and Long Cay","HI" => "Harbour Island", "HT" => "Hope Town", "IN" => "Inagua", "LI" => "Long Island", "MC" => "Mangrove Cay", "MG" => "Mayaguana",
            "EG" => "East Grand Bahama", "EX" => "Exuma", "GC" => "Grand Cay", "GT" => "Green Turtle Cay","MI" => "Moore’s Island", "NO" => "North Abaco", "NS" => "North Andros", "NE" => "North Eleuthera","RI" => "Ragged Island", "RC" => "Rum Cay", "SS" => "San Salvador", "SO" => "South Abaco", "SA" => "South Andros","SE" => "South Eleuthera", "SW" => "Spanish Wells", "WG" => "West Grand Bahama" )
    ),
        'BH' => array(
            'name' => 'Bahrain', 'states' => array( "14" => "Al Janubiyah", "13" => "Al Manamah", "15" => "Al Muharraq", "16" => "Al Wustá", "17" => "Ash Shamaliyah" )
        ),

        'BB' => array( 'name' => 'Barbados', 'states' => array(
            "01" => "Christ Church", "02" => "Saint Andrew", "03" => "Saint George", "04" => "Saint James", "05" => "Saint John", "06" => "Saint Joseph", "07" => "Saint Lucy", "08" => "Saint Michael", "09" => "Saint Peter", "10" => "Saint Philip", "11" => "Saint Thomas" )
    ),

        'BE' => array( 'name' => 'Belgium', 'states' => array(
            "VAN" => "Antwerpen", "WBR" => "Brabant Wallon", "BRU" => "Brussels", "VLG" => "Flemish Region", "WHT" => "Hainaut", "WLG" => "Liège", "VLI" => "Limburg", "WLX" => "Luxembourg", "WNA" => "Namur", "VOV" => "Oost-Vlaanderen", "VBR" => "Vlaams Brabant", "WAL" => "Wallonia", "VWV" => "West-Vlaanderen" )
    ),

        'BM' => array( 'name' => 'Bermuda', 'states' => array(
            "DEV" => "Devonshire", "HAM" => "Hamilton", "HA" => "Hamilton municipality", "PAG" => "Paget", "PEM" => "Pembroke", "SGE" => "Saint George", "SG" => "Saint George municipality", "SAN" => "Sandys", "SMI" => "Smiths", "SOU" => "Southampton", "WAR" => "Warwick" )
    ),
        'BT' => array( 'name' => 'Bhutan', 'states' => array(
            "33" => "Bumthang", "12" => "Chhukha", "22" => "Dagana", "GA" => "Gasa", "13" => "Ha", "44" => "Lhuentse", "42" => "Monggar", "11" => "Paro", "43" => "Pemagatshel", "23" => "Punakha", "45" => "Samdrup Jongkha", "14" => "Samtse", "31" => "Sarpang", "15" => "Thimphu", "TY" => "Trashi Yangtse", "41" => "Trashigang", "32" => "Trongsa", "21" => "Tsirang", "24" => "Wangdue Phodrang", "34" => "Zhemgang" )
    ),
        'BO' => array( 'name' => 'Bolivia', 'states' => array(
            "H" => "Chuquisaca", "C" => "Cochabamba", "B" => "El Beni", "L" => "La Paz", "O" => "Oruro", "N" => "Pando", "P" => "Potosí", "S" => "Santa Cruz", "T" => "Tarija" )
    ),

        'BR' => array( 'name' => 'Brazil', 'states' => array(
            "CE" => "Ceará", "DF" => "Distrito Federal", "ES" => "Espírito Santo", "GO" => "Goiás", "MA" =>"Maranhão", "AC" => "Acre", "AL" => "Alagoas", "AP" => "Amapá", "AM" => "Amazonas", "BA" =>"Bahia", "MT" => "Mato Grosso", "MS" => "Mato Grosso do Sul", "MG" => "Minas Gerais", "PA" => "Pará", "PB" =>"Paraíba", "PR" => "Paraná", "PE" => "Pernambuco", "PI" =>"Piauí", "RJ" => "Rio de Janeiro", "RN" => "Rio Grande do Norte", "RS" =>"Rio Grande do Sul", "RO" => "Rondônia", "RR" => "Roraima", "SC" =>"Santa Catarina", "SP" => "São Paulo", "SE" => "Sergipe", "TO" =>"Tocantins" )
    ),

        'BN' => array( 'name' => 'Brunei Darussalam', 'states' => array(
            "BE" => "Belait", "BM" => "Brunei-Muara", "TE" => "Temburong", "TU" => "Tutong" )
    ),
        'BG' => array( 'name' => 'Bulgaria', 'states' => array(
            "01" => "Blagoevgrad", "02" => "Burgas", "08" =>"Dobrich", "07" => "Gabrovo", "26" => "Haskovo", "09" =>"Kardzhali", "10" => "Kjustendil", "11" => "Lovech", "12" =>"Montana", "13" => "Pazardzhik", "14" => "Pernik", "15" =>"Pleven", "16" => "Plovdiv", "17" => "Razgrad", "18" =>"Ruse", "19" => "Silistra", "20" => "Sliven", "21" =>"Smolyan", "23" => "Sofia", "22" => "Sofia-Grad", "24" =>"Stara Zagora", "27" => "Šumen", "25" => "Targovishte", "03" =>"Varna", "04" => "Veliko Tarnovo", "05" => "Vidin", "06" =>"Vratsa", "28" => "Yambol" )
    ),

        'KH' => array( 'name' => 'Cambodia', 'states' => array(
            "2" => "Baat Dambang [Batdâmbâng]", "1" => "Banteay Mean Chey [Bântéay Méanchey]", "3" => "Kampong Chaam [Kâmpóng Cham]", "4" => "Kampong Chhnang [Kâmpóng Chhnang]", "5" => "Kampong Spueu [Kâmpóng Spœ]", "6" => "Kampong Thum [Kâmpóng Thum]", "7" => "Kampot [Kâmpôt]", "8" => "Kandaal [Kândal]", "9" => "Kaoh Kong [Kaôh Kong]", "10" => "Kracheh [Krâchéh]", "23" => "Krong Kaeb [Krong Kêb]", "24" => "Krong Pailin [Krong Pailin]", "18" => "Krong Preah Sihanouk [Krong Preah Sihanouk]", "11" => "Mondol Kiri [Môndól Kiri]", "22" => "Otdar Mean Chey [Otdâr Méanchey]", "12" => "Phnom Penh [Phnum Pénh]", "15" => "Pousaat [Pouthisat]", "13" => "Preah Vihear [Preah Vihéar]", "14" => "Prey Veaeng [Prey Vêng]", "16" => "Rotanak Kiri [Rôtânôkiri]", "17" => "Siem Reab [Siemréab]", "19" => "Stueng Traeng [Stœ?ng Trêng]", "20" => "Svaay Rieng [Svay Rieng]", "21" => "Taakaev [Takêv]" )
    ),

        'CA' => array( 'name' => 'Canada', 'states' => array( "YT"=> "Yukon Territory","SK" => "Saskatchewan", "QC" => "Quebec", "PE" => "Prince Edward Island", "ON"=> "Ontario","NU"=> "Nunavut", "NS" => "Nova Scotia", "NT" => "Northwest Territories", "NL"=> "Newfoundland and Labrador","NB"=> "New Brunswick", "MB" => "Manitoba", "BC" => "British Columbia", "AB"=> "Alberta" )),

        'KY' => array( 'name' => 'Cayman Islands', 'states' => array(
            "01~" => "Bodden Town", "02~" => "Cayman Brac", "03~" => "East End", "04~" => "George Town", "05~" => "Little Cayman", "06~" => "North Side","07~" => "West Bay" )
    ),

        'CL' => array( 'name' => 'Chile', 'states' => array( "AI" => "Aisén del General Carlos Ibáñez del Campo", "AN" => "Antofagasta", "AR" => "Araucanía", "AP" => "Arica y Parinacota", "AT" => "Atacama", "BI" => "Bío-Bío", "CO" => "Coquimbo", "LI" => "Libertador General Bernardo O'Higgins", "LL" => "Los Lagos", "LR" => "Los Ríos", "MA" => "Magallanes", "ML" => "Maule", "RM" => "Región Metropolitana de Santiago", "TA" => "Tarapacá", "VS" => "Valparaíso" )),
        'CN' => array( 'name' => 'China', 'states' => array(
            "53" => "Yunnan", "33" => "Zhejiang", "34" => "Anhui", "92" => "Aomen", "11" => "Beijing", "50" => "Chongqing", "35" => "Fujian", "62" => "Gansu", "44" => "Guangdong", "54" => "Xizang", "45" => "Guangxi", "52" => "Guizhou", "46" => "Hainan", "13" => "Hebei", "23" => "Heilongjiang", "41" => "Henan", "42" => "Hubei", "43" => "Hunan", "32" => "Jiangsu", "36" => "Jiangxi", "22" => "Jilin", "21" => "Liaoning", "15" => "Nei Mongol", "64" => "Ningxia", "63" => "Qinghai", "61" => "Shaanxi", "37" => "Shandong", "31" => "Shanghai", "14" => "Shanxi", "51" => "Sichuan", "71" => "Taiwan *","12" => "Tianjin", "91" => "Xianggang", "65" => "Xinjiang" )
    ),

        'CO' => array( 'name' => 'Colombia', 'states' => array(
            "AMA" => "Amazonas","ANT" => "Antioquia", "ARA" => "Arauca", "ATL" => "Atlántico","BOL" => "Bolívar","BOY" => "Boyacá", "CAL" => "Caldas", "CAQ" => "Caquetá","CAS" => "Casanare","CAU" => "Cauca", "CES" => "Cesar", "CHO" => "Chocó", "COR" => "Córdoba", "CUN" => "Cundinamarca", "DC" => "Distrito Capital de Bogotá", "GUA" => "", "" => "Guainía", "GUV" => "Guaviare", "HUI" => "Huila", "LAG" => "La Guajira", "MAG" => "Magdalena", "MET" => "Meta", "NAR" => "Nariño", "NSA" => "Norte de Santander", "PUT" => "Putumayo", "QUI" => "Quindío", "RIS" => "Risaralda", "SAP" => "San Andrés, Providencia y Santa Catalina", "SAN" => "Santander", "SUC" => "Sucre", "TOL" => "Tolima", "VAC" => "Valle del Cauca", "VAU" => "Vaupés", "VID" => "Vichada" )
    ),

        'CR' => array( 'name' => 'Costa Rica', 'states' => array(
            "A" => "Alajuela", "C" => "Cartago", "G" => "Guanacaste", "H" => "Heredia", "L" => "Limón", "P" => "Puntarenas", "SJ" => "San José" )
    ),

        'HR' => array( 'name' => 'Croatia', 'states' => array( "07" => "Bjelovarsko-bilogorska županija", "12" => "Brodsko-posavska županija", "19" => "Dubrovacko-neretvanska županija", "21" => "Grad Zagreb","18" => "Istarska županija", "04" => "Karlovacka županija", "06" => "Koprivnicko-križevacka županija", "02" => "Krapinsko-zagorska županija", "09" => "Licko-senjska županija", "14" => "Osjecko-baranjska županija", "11" => "Požeško-slavonska županija", "08" => "Primorsko-goranska županija", "15" => "Šibensko-kninska županija", "03" => "Sisacko-moslavacka županija", "17" => "Splitsko-dalmatinska županija", "05" => "Varaždinska županija", "10" => "Viroviticko-podravska županija", "16" => "Vukovarsko-srijemska županija", "13" => "Zadarska županija", "20" => "Medimurska županija", "01" => "Zagrebacka županija" )),
        'CU' => array( 'name' => 'Cuba', 'states' => array(
            "09" => "Camagüey", "08" => "Ciego de Ávila", "06" => "Cienfuegos", "03" => "Ciudad de La Habana", "12" => "Granma", "14" => "Guantánamo", "11" => "Holguín", "99" => "Isla de la Juventud", "02" => "La Habana", "10" => "Las Tunas", "04" => "Matanzas", "01" => "Pinar del Río", "07" => "Sancti Spíritus", "13" => "Santiago de Cuba", "05" => "Villa Clara" )
    ),
        'CY' => array( 'name' => 'Cyprus', 'states' => array( "04" => "Ammochostos", "06" => "Keryneia", "03" => "Larnaka", "01" => "Lefkosia","02" => "Lemesos", "05" => "Pafos" )),
        'CZ' => array( 'name' => 'Czech Republic', 'states' => array(
            '201' => 'Benešov', '202' => 'Beroun', '621' => 'Blansko', '624' => 'Břeclav', '622' => 'Brno-město', '623' => 'Brno-venkov', '801' => 'Bruntál', '511' => 'Česká Lípa', '311' => 'České Budějovice', '312' => 'Český Krumlov', '411' => 'Cheb','422' => 'Chomutov', '531' => 'Chrudim', '421' => 'Děčín', '321' => 'Domažlice', '802' => 'Frýdek Místek', '611' => 'Havlíčkův Brod', '625' => 'Hodonín', '521' => 'Hradec Králové', '512' => 'Jablonec nad Nisou', '711' => 'Jeseník', '522' => 'Jičín', '612' => 'Jihlava', 'JC' => 'Jihoceský kraj','JM' => 'Jihomoravský kraj', '313' => 'Jindřichův Hradec', 'KA' => 'Karlovarský kraj', '412' => 'Karlovy Vary', '803' => 'Karviná', '203' => 'Kladno', '322' => 'Klatovy', '204' => 'Kolín','KR' => 'Královéhradecký kraj', '721' => 'Kromĕříž', '205' => 'Kutná Hora', '513' => 'Liberec', 'LI' => 'Liberecký kraj', '423' => 'Litoměřice', '424' => 'Louny', '206' => 'Mělník',	'207' => 'Mladá Boleslav', 'MO' => 'Moravskoslezský kraj','425' => 'Most', '523' => 'Náchod', '804' => 'Nový Jičín', '208' => 'Nymburk', '712' => 'Olomouc', 'OL' => 'Olomoucký kraj', '805' => 'Opava', '806' => 'Ostrava město', '532' => 'Pardubice', 'PA' => 'Pardubický kraj', '613' => 'Pelhřimov', '314' => 'Písek', '324' => 'Plzeň jih', '323' => 'Plzeň město', '325' => 'Plzeň sever', 'PL' => 'Plzenský kraj','315' => 'Prachatice', '101' => 'Praha 1', '10A' => 'Praha 10', '10B' => 'Praha 11', '10C' => 'Praha 12', '10D' => 'Praha 13', '10E' => 'Praha 14', '10F' => 'Praha 15', '102' => 'Praha 2', '103' => 'Praha 3', '104' => 'Praha 4', '105' => 'Praha 5', '106' => 'Praha 6', '107' => 'Praha 7', '108' => 'Praha 8', '109' => 'Praha 9', '209' => 'Praha východ', '20A' => 'Praha západ', 'PR' => 'Praha, hlavní mesto', '714' => 'Přerov', '20B' => 'Příbram', '713' => 'Prostĕjov', '20C' => 'Rakovník', '326' => 'Rokycany', '524' => 'Rychnov nad Kněžnou', '514' => 'Semily', '413' => 'Sokolov', '316' => 'Strakonice', 'ST' => 'Stredoceský kraj', '715' => 'Šumperk', '533' => 'Svitavy', '317' => 'Tábor', '327' => 'Tachov', '426' => 'Teplice', '614' => 'Třebíč', '525' => 'Trutnov',	 '722' => 'Uherské Hradištĕ', 'US' => 'Ústecký kraj', '427' => 'Ústí nad Labem', '534' => 'Ústí nad Orlicí', '723' => 'Vsetín', '626' => 'Vyškov', 'VY' => 'Vysocina', '615' => 'Žd’ár nad Sázavou', '724' => 'Zlín', 'ZL' => 'Zlínský kraj', '627' => 'Znojmo' )
    ),
        'DK' => array( 'name' => 'Denmark', 'states' => array(
            "84" => "Capital", "82" => "Central Jutland", "81" => "North Jutland","83" => "South Denmark", "85" => "Zeeland" )
    ),

        'DO' => array( 'name' => 'Dominican Republic', 'states' => array(
            "02" => "Azua", "03" => "Bahoruco" , "04" => "Barahona", "05" => "Dajabón", "01" => "Distrito Nacional" , "06" => "Duarte", "08" => "El Seybo [El Seibo]", "09" => "Espaillat" , "30" => "Hato Mayor", "10" => "Independencia", "11" => "La Altagracia" , "07" => "La Estrelleta [Elías Piña]", "12" => "La Romana", "13" => "La Vega" , "14" => "María Trinidad Sánchez", "28" => "Monseñor Nouel", "15" => "Monte Cristi" , "29" => "Monte Plata", "16" => "Pedernales", "17" => "Peravia" , "18" => "Puerto Plata", "19" => "Salcedo", "20" => "Samaná" , "21" => "San Cristóbal", "31" => "San Jose de Ocoa", "22" => "San Juan" , "23" => "San Pedro de Macorís", "24" => "Sánchez Ramírez", "25" => "Santiago" , "26" => "Santiago Rodríguez", "32" => "Santo Domingo", "27" => "Valverde" )
    ),

        'EG' => array( 'name' => 'Egypt', 'states' => array(
            "DK" => "Ad Daqahliyah", "BA" => "Al Bahr al Ahmar", "BH" => "Al Buhayrah", "FYM" => "Al Fayyum", "GH" => "Al Gharbiyah", "ALX" => "Al Iskandariyah", "IS" => "Al Ismā`īlīyah", "GZ" => "Al Jizah", "MNF" => "Al Minufiyah","MN" => "Al Minya", "C" => "Al Qahirah", "KB" => "Al Qalyubiyah", "WAD" => "Al Wadi al Jadid", "LX" => "al-Uqsur", "SU" => "As Sādis min Uktūbar", "SUZ" => "As Suways", "SHR" => "Ash Sharqiyah", "ASN" => "Aswan", "AST" => "Asyut", "BNS" => "Bani Suwayf", "PTS" => "Būr Sa`īd", "DT" => "Dumyat", "HU" => "Ḩulwān", "JS" => "Janub Sina'", "KFS" => "Kafr ash Shaykh", "MT" => "Matrūh", "KN" => "Qina", "SIN" => "Shamal Sina", "SHG" => "Suhaj" )
    ),

        'EE' => array( 'name' => 'Estonia', 'states' => array( "37" => "Harjumaa", "39" => "Hiiumaa", "44" => "Ida-Virumaa", "51" => "Järvamaa", "49" => "Jõgevamaa", "57" => "Läänemaa", "59" => "Lääne-Virumaa", "67" => "Pärnumaa", "65" => "Põlvamaa", "70" => "Raplamaa", "74" => "Saaremaa", "78" => "Tartumaa","82" => "Valgamaa", "84" => "Viljandimaa", "86" => "Võrumaa" )
    ),

        'FI' => array( 'name' => 'Finland', 'states' => array(
            "01"   => "Ahvenanmaan maakunta",
            "02"   => "Etelä-Karjala",
            "03"   => "Etelä-Pohjanmaa",
            "04"   => "Etelä-Savo",
            "05"   => "Kainuu",
            "06"   => "Kanta-Häme",
            "07"   => "Keski-Pohjanmaa",
            "08"   => "Keski-Suomi",
            "09"   => "Kymenlaakso",
            "10"   => "Lappi",
            "11"   => "Pirkanmaa",
            "12"   => "Pohjanmaa",
            "13"   => "Pohjois-Karjala",
            "14"   => "Pohjois-Pohjanmaa",
            "15"   => "Pohjois-Savo",
            "16"   => "Satakunta",
            "17"   => "Uusimaa",
            "18"   => "Päijät-Häme",
            "19"   => "Varsinais-Suomi" )
    ),
        'FR' => array( 'name' => 'France', 'states' => array(
            '01'   => 'Ain',
            '02'   => 'Aisne',
            '03'   => 'Allier',
            '04'   => 'Alpes-de-Haute-Provence',
            '05'   => 'Hautes-Alpes',
            '06'   => 'Alpes-Maritimes',
            '07'   => 'Ardèche',
            '08'   => 'Ardennes',
            '09'   => 'Ariège',
            '10'   => 'Aube',
            '11'   => 'Aude',
            '12'   => 'Aveyron',
            '13'   => 'Bouches-du-Rhône',
            '14'   => 'Calvados',
            '15'   => 'Cantal',
            '16'   => 'Charente',
            '17'   => 'Charente-Maritime',
            '18'   => 'Cher',
            '19'   => 'Corrèze',
            '20'   => 'Côte-d\'Or',
            '21'   => 'Côtes-d\'Armor',
            '22'   => 'Creuse',
            '23'   => 'Deux-Sèvres',
            '24'   => 'Dordogne',
            '25'   => 'Doubs',
            '26'   => 'Drôme',
            '27'   => 'Essonne',
            '28'   => 'Eure',
            '29'   => 'Finistère',
            '30'   => 'Franche-Comté',
            '31'   => 'Gard',
            '32'   => 'Gers',
            '33'   => 'Gironde',
            '34'   => 'Guadeloupe',
            '35'   => 'Guyane',
            '36'   => 'Haute-Corse',
            '37'   => 'Haute-Garonne',
            '38'   => 'Haute-Loire',
            '40'   => 'Haute-Marne',
            '41'   => 'Haute-Normandie',
            '42'   => 'Haute-Saône',
            '43'   => 'Haute-Savoie',
            '44'   => 'Hautes-Pyrénées',
            '45'   => 'Haute-Vienne',
            '46'   => 'Haut-Rhin',
            '47'   => 'Hauts-de-Seine',
            '48'   => 'Hérault',
            '49'   => 'Ille-et-Vilaine',
            '50'   => 'Indre',
            '51'   => 'Indre-et-Loire',
            '52'   => 'Isère',
            '53'   => 'Jura',
            '54'   => 'La Réunion',
            '55'   => 'Landes',
            '56'   => 'Languedoc-Roussillon',
            '57'   => 'Limousin',
            '58'   => 'Loire',
            '59'   => 'Loire-Atlantique',
            '60'   => 'Loiret',
            '61'   => 'Loir-et-Cher',
            '62'   => 'Lorraine',
            '63'   => 'Lot',
            '64'   => 'Lot-et-Garonne',
            '65'   => 'Lozère',
            '66'   => 'Maine-et-Loire',
            '67'   => 'Manche',
            '68'   => 'Marne',
            '69'   => 'Mayenne',
            '70'   => 'Mayotte',
            '71'   => 'Meurthe-et-Moselle',
            '72'   => 'Meuse',
            '73'   => 'Midi-Pyrénées',
            '74'   => 'Morbihan',
            '75'   => 'Moselle',
            '76'   => 'Nièvre',
            '77'   => 'Nord',
            '78'   => 'Nord-Pas-de-Calais',
            '79'   => 'Nouvelle-Calédonie',
            '80'   => 'Oise',
            '81'   => 'Orne',
            '82'   => 'Paris',
            '83'   => 'Pas-de-Calais',
            '84'   => 'Pays-de-la-Loire',
            '85'   => 'Picardie',
            '86'   => 'Poitou-Charentes',
            '87'   => 'Polynésie française',
            '88'   => 'Provence-Alpes-Côte-d\'Azur',
            '89'   => 'Puy-de-Dôme',
            '90'   => 'Pyrénées-Atlantiques',
            '91'   => 'Pyrénées-Orientales',
            '92'   => 'Rhône',
            '93'   => 'Rhône-Alpes',
            '94'   => 'Saint-Barthélemy',
            '95'   => 'Saint-Martin',
            '96'   => 'Saint-Pierre-et-Miquelon',
            '97'   => 'Saône-et-Loire',
            '98'   => 'Sarthe',
            '99'   => 'Savoie',
            '100'  => 'Seine-et-Marne',
            '101'  => 'Seine-Maritime',
            '102'  => 'Seine-Saint-Denis',
            '103'  => 'Somme',
            '104'  => 'Tarn',
            '105'  => 'Tarn-et-Garonne',
            '106'  => 'Terres Australes Françaises',
            '107'  => 'Territoire de Belfort',
            '108'  => 'Val-de-Marne',
            '109'  => 'Val-d\'Oise',
            '110'  => 'Var',
            '111'  => 'Vaucluse',
            '112'  => 'Vendée',
            '113'  => 'Vienne',
            '114'  => 'Vosges',
            '115'  => 'Wallis et Futuna',
            '116'  => 'Yonne',
            'A'    => 'Alsace',
            'B'    => 'Aquitaine',
            'C'    => 'Auvergne',
            'D'    => 'Bourgogne',
            'E'    => 'Bretagne',
            'F'    => 'Centre',
            'G'    => 'Champagne-Ardenne',
            'H'    => 'Corse',
            'I'    => 'Yvelines',
            'p'    => 'Basse-Normandie',
            'CP'   => 'Clipperton',
            '2A'   => 'Corse-du-Sud'
        )),

'DE' => array( 'name' => 'Germany', 'states' => array(
    'BW' => 'Baden-Württemberg',
    'BY' => 'Bayern',
    'BE' => 'Berlin',
    'BB' => 'Brandenburg',
    'HB' => 'Bremen',
    'HH' => 'Hamburg',
    'HE' => 'Hessen',
    'MV' => 'Mecklenburg-Vorpommern',
    'NI' => 'Niedersachsen',
    'NW' => 'Nordrhein-Westfalen',
    'RP' => 'Rheinland-Pfalz',
    'SL' => 'Saarland',
    'SN' => 'Sachsen',
    'ST' => 'Sachsen-Anhalt',
    'SH' => 'Schleswig-Holstein',
    'TH' => 'Thüringen'
)),

'GR' => array( 'name' => 'Greece', 'states' => array(
    "13" => "Achaïa",
    "69" => "Agio Oros",
    "01" => "Aitolia kai Akarnani",
    "A"  =>"Anatoliki Makedonia kai Thraki",
    "11" => "Argolida",
    "12" => "Arkadia",
    "31" => "Argolida",
    "12" => "Arkadia",
    "31" => "Arta",
    "A1" => "Attiki",
    "I"  => "Attiki",
    "64" => "Chalkidiki",
    "94" => "Chania",
    "85" => "Chios",
    "81" => "Dodekanisos",
    "52" => "Drama",
    "G"  => "Dytiki Ellada",
    "C"  => "Dytiki Makedonia",
    "71" => "Evros",
    "05" => "Evrytania",
    "04" => "Evvoia",
    "63" => "Florina",
    "07" => "Fokida",
    "06" => "Fthiotida",
    "51" => "Grevena",
    "14" => "Ileia",
    "53" => "Imathia",
    "33" => "Ioannina",
    "F"  => "Ionia Nisia",
    "D"  => "Ipeiros",
    "91" => "Irakleio",
    "41" => "Karditsa",
    "56" => "Kastoria",
    "55" => "Kavala",
    "23" => "Kefallonia",
    "B"  => "Kentriki Makedonia",
    "22" => "Kerkyra",
    "57" => "Kilkis",
    "15" => "Korinthia",
    "58" => "Kozani",
    "M"  => "Kriti",
    "82" => "Kyklades",
    "16" => "Lakonia",
    "42" => "Larisa",
    "92" => "Lasithi",
    "24" => "Lefkada",
    "83" => "Lesvos",
    "43" => "Magnisia",
    "17" => "Messinia",
    "L"  => "Notio Aigaio",
    "59" =>"Pella",
    "J"  =>"Peloponnisos",
    "61" => "Pieria",
    "34" => "Preveza",
    "93" => "Rethymno",
    "73" => "Rodopi",
    "84" => "Samos",
    "62" => "Serres",
    "H"  => "Sterea Ellada",
    "32" => "Thesprotia",
    "E"  => "Thessalia",
    "54" => "Thessaloniki",
    "44" => "Trikala",
    "03" => "Voiotia",
    "K"  => "Voreio Aigaio",
    "72" => "Xanthi",
    "21" => "Zakynthos"
)),
'GL' => array( 'name' => 'Greenland', 'states' => array(
    "KU" => "Kommune Kujalleq",
    "SM" => "Kommuneqarfik Sermersooq",
    "QA" => "Qaasuitsup Kommunia",
    "QE" => "Qeqqata Kommunia"
)),

'GT' => array( 'name' => 'Guatemala', 'states' => array(
    "AV" => "Alta Verapaz",
    "BV" => "Baja Verapaz",
    "CM" => "Chimaltenango",
    "CQ" => "Chiquimula",
    "PR" => "El Progreso",
    "ES" => "Escuintla",
    "GU" => "Guatemala",
    "HU" => "Huehuetenango",
    "IZ" => "Izabal",
    "JA" => "Jalapa",
    "JU" => "Jutiapa",
    "PE" => "Petén",
    "QZ" => "Quetzaltenango",
    "QC" => "Quiché",
    "RE" => "Retalhuleu",
    "SA" => "Sacatepéquez",
    "SM" => "San Marcos",
    "SR" => "Santa Rosa",
    "SO" => "Sololá",
    "SU" => "Suchitepéquez",
    "TO" => "Totonicapán",
    "ZA" => "Zacapa"
)),

'HN' => array( 'name' => 'Honduras', 'states' => array(
    "AT" => "Atlántida",
    "CH" => "Choluteca",
    "CL" => "Colón",
    "CM" => "Comayagua",
    "CP" => "Copán",
    "CR" => "Cortés",
    "EP" => "El Paraíso",
    "FM" => "Francisco Morazán",
    "GD" => "Gracias a Dios",
    "IN" => "Intibucá",
    "IB" => "Islas de la Bahía",
    "LP" => "La Paz",
    "LE" => "Lempira",
    "OC" => "Ocotepeque",
    "OL" => "Olancho",
    "SB" => "Santa Bárbara",
    "VA" => "Valle",
    "YO" => "Yoro"
)),
'HK' => array( 'name' => 'Hong Kong', 'states' => array(
    'honkong' => '$honkong'
)),
'HU' => array( 'name' => 'Hungary', 'states' => array(
    "BK" => "Bács-Kiskun",
    "BA" => "Baranya",
    "BE" => "Békés",
    "BC" => "Békéscsaba",
    "BZ" => "Borsod-Abaúj-Zemplén",
    "BU" => "Budapest",
    "CS" => "Csongrád",
    "DE" => "Debrecen",
    "DU" => "Dunaújváros",
    "EG" => "Eger",
    "ER" => "Erd",
    "FE" => "Fejér",
    "GY" => "Gyor",
    "GS" => "Gyor-Moson-Sopron",
    "HB" => "Hajdú-Bihar",
    "HE" => "Heves",
    "HV" => "Hódmezovásárhely",
    "JN" => "Jász-Nagykun-Szolnok",
    "KV" => "Kaposvár",
    "KM" => "Kecskemét",
    "KE" => "Komárom-Esztergom",
    "MI" => "Miskolc",
    "NK" => "Nagykanizsa",
    "NO" => "Nógrád",
    "NY" => "Nyíregyháza",
    "PS" => "Pécs",
    "PE" => "Pest",
    "ST" => "Salgótarján",
    "SO" => "Somogy",
    "SN" => "Sopron",
    "SZ" => "Szabolcs-Szatmár-Bereg",
    "SD" => "Szeged",
    "SF" => "Székesfehérvár",
    "SS" => "Szekszárd",
    "SK" => "Szolnok",
    "SH" => "Szombathely",
    "TB" => "Tatabánya",
    "TO" => "Tolna",
    "VA" => "Vas",
    "VE" => "Veszprém",
    "VM" => "Veszprém City",
    "ZA" => "Zala",
    "ZE" => "Zalaegerszeg"
)),
'IS' => array( 'name' => 'Iceland', 'states' => array(
    "7" => "Austurland",
    "1" => "Höfuðborgarsvæði utan Reykjavíkur",
    "6" => "Norðurland eystra",
    "5" => "Norðurland vestra",
    "0" => "Reykjavík",
    "8" => "Suðurland",
    "2" => "Suðurnes",
    "4" => "Vestfirðir",
    "3" => "Vesturland"
)),
'IN' => array( 'name' => 'India', 'states' => array(
    "AN" => "Andaman and Nicobar Islands",
    "AP" => "Andhra Pradesh",
    "AR" => "Arunachal Pradesh",
    "AS" => "Assam",
    "BR" => "Bihar",
    "CH" => "Chandigarh",
    "CT" => "Chhattisgarh",
    "DN" => "Dadra and Nagar Haveli",
    "DD" => "Daman and Diu",
    "DL" => "Delhi",
    "GA" => "Goa",
    "GJ" => "Gujarat",
    "HR" => "Haryana",
    "HP" => "Himachal Pradesh",
    "JK" => "Jammu and Kashmir",
    "JH" => "Jharkhand",
    "KA" => "Karnataka",
    "KL" => "Kerala",
    "LD" => "Lakshadweep",
    "MP" => "Madhya Pradesh",
    "MH" => "Maharashtra",
    "MN" => "Manipur",
    "ML" => "Meghalaya",
    "MZ" => "Mizoram",
    "NL" => "Nagaland",
    "OR" => "Orissa",
    "PY" => "Pondicherry",
    "PB" => "Punjab",
    "RJ" => "Rajasthan",
    "SK" => "Sikkim",
    "TN" => "Tamil Nadu",
    "TR" => "Tripura",
    "UP" => "Uttar Pradesh",
    "UT" => "Uttaranchal",
    "WB" => "West Bengal"
)),
'ID' => array( 'name' => 'Indonesia', 'states' => array(
    "AC" => "Aceh",
    "BA" => "Bali",
    "BB" => "Bangka Belitung",
    "BT" => "Banten",
    "BE" => "Bengkulu",
    "GO" => "Gorontalo",
    "JK" => "Jakarta Raya",
    "JA" => "Jambi",
    "JW" => "Jawa",
    "JB" => "Jawa Barat",
    "JT" => "Jawa Tengah",
    "JI" => "Jawa Timur",
    "KA" => "Kalimantan",
    "KB" => "Kalimantan Barat",
    "KS" => "Kalimantan Selatan",
    "KT" => "Kalimantan Tengah",
    "KI" => "Kalimantan Timur",
    "KR" => "Kepulauan Riau",
    "LA" => "Lampung",
    "MA" => "Maluku",
    "ML" => "Maluku",
    "MU" => "Maluku Utara",
    "NU" => "Nusa Tenggara",
    "NB" => "Nusa Tenggara Barat",
    "NT" => "Nusa Tenggara Timur",
    "IJ" => "Papua",
    "PA" => "Papua",
    "PB" => "Papua Barat",
    "RI" => "Riau",
    "SL" => "Sulawesi",
    "SR" => "Sulawesi Barat",
    "SN" => "Sulawesi Selatan",
    "ST" => "Sulawesi Tengah",
    "SG" => "Sulawesi Tenggara",
    "SA" => "Sulawesi Utara",
    "SM" => "Sumatera",
    "SB" => "Sumatera Barat",
    "SS" => "Sumatera Selatan",
    "SU" => "Sumatera Utara",
    "YO" => "Yogyakarta"
)),

'IE' => array( 'name' => 'Ireland', 'states' => array(
    "CW" => "Carlow",
    "CN" => "Cavan",
    "CE" => "Clare",
    "C"  => "Connaught",
    "CO" => "Cork",
    "DL" => "Donegal",
    "D"  =>  "Dublin",
    "G"  => "Galway",
    "KY" => "Kerry",
    "KE" => "Kildare",
    "KK" => "Kilkenny",
    "LS" => "Laois",
    "L"  => "Leinster",
    "LM" => "Leitrim",
    "LK" => "Limerick",
    "LD" => "Longford",
    "LH" => "Louth",
    "MO" => "Mayo",
    "MH" => "Meath",
    "MN" => "Monaghan",
    "M"  => "Munster",
    "OY" => "Offaly",
    "RN" => "Roscommon",
    "SO" => "Sligo",
    "TA" => "Tipperary",
    "U"  => "Ulster",
    "WD" => "Waterford",
    "WH" => "Westmeath",
    "WX" => "Wexford",
    "WW" => "Wicklow"
)),

'IT' => array( 'name' => 'Italy', 'states' => array(
    "65" => "Abruzzo",
    "AG" => "Agrigento",
    "AL" => "Alessandria",
    "AN" => "Ancona",
    "AO" => "Aosta",
    "AR" => "Arezzo",
    "AP" => "Ascoli Piceno",
    "AT" => "Asti",
    "AV" => "Avellino",
    "BA" => "Bari",
    "BT" => "Barletta-Andria-Trani",
    "77" => "Basilicata",
    "BL" => "Belluno",
    "BN" => "Benevento",
    "BG" => "Bergamo",
    "BI" => "Biella",
    "BO" => "Bologna",
    "BZ" => "Bolzano",
    "BS" => "Brescia",
    "BR" => "Brindisi",
    "CA" => "Cagliari",
    "78" => "Calabria",
    "CL" => "Caltanissetta",
    "72" => "Campania",
    "CB" => "Campobasso",
    "CI" => "Carbonia-Iglesias",
    "CE" => "Caserta",
    "CT" => "Catania",
    "CZ" => "Catanzaro",
    "CH" => "Chieti",
    "CO" => "Como",
    "CS" => "Cosenza",
    "CR" => "Cremona",
    "KR" => "Crotone",
    "CN" => "Cuneo",
    "45" => "Emilia-Romagna",
    "EN" => "Enna",
    "FM" => "Fermo",
    "FE" => "Ferrara",
    "FI" => "Firenze",
    "FG" => "Foggia",
    "FC" => "Forli-Cesena",
    "36" => "Friuli-Venezia Giulia",
    "FR" => "Frosinone",
    "GE" => "Genova",
    "GO" => "Gorizia",
    "GR" => "Grosseto",
    "IM" => "Imperia",
    "IS" => "Isernia",
    "SP" => "La Spezia",
    "AQ" => "L'Aquila",
    "LT" => "Latina",
    "62" => "Lazio",
    "LE" => "Lecce",
    "LC" => "Lecco",
    "42" => "Liguria",
    "LI" => "Livorno",
    "LO" => "Lodi",
    "25" => "Lombardia",
    "LU" => "Lucca",
    "MC" => "Macerata",
    "MN" => "Mantova",
    "57" => "Marche",
    "MS" => "Massa-Carrara",
    "MT" => "Matera",
    "VS" => "Medio Campidano",
    "ME" => "Messina",
    "MI" => "Milano",
    "MO" => "Modena",
    "67" => "Molise",
    "MB" => "Monza e Brianza",
    "NA" => "Napoli",
    "NO" => "Novara",
    "NU" => "Nuoro",
    "OG" => "Ogliastra",
    "OT" => "Olbia-Tempio",
    "OR" => "Oristano",
    "PD" => "Padova",
    "PA" => "Palermo",
    "PR" => "Parma",
    "PV" => "Pavia",
    "PG" => "Perugia",
    "PU" => "Pesaro e Urbino",
    "PE" => "Pescara",
    "PC" => "Piacenza",
    "21" => "Piemonte",
    "PI" => "Pisa",
    "PT" => "Pistoia",
    "PN" => "Pordenone",
    "PZ" => "Potenza",
    "PO" => "Prato",
    "75" => "Puglia",
    "RG" => "Ragusa",
    "RA" => "Ravenna",
    "RC" => "Reggio Calabria",
    "RE" => "Reggio Emilia",
    "RI" => "Rieti",
    "RN" => "Rimini",
    "RM" => "Roma",
    "RO" => "Rovigo",
    "SA" => "Salerno",
    "88" => "Sardegna",
    "SS" => "Sassari",
    "SV" => "Savona",
    "82" => "Sicilia",
    "SI" => "Siena",
    "SR" => "Siracusa",
    "SO" => "Sondrio",
    "TA" => "Taranto",
    "TE" => "Teramo",
    "TR" => "Terni",
    "TO" => "Torino",
    "52" => "Toscana",
    "TP" => "Trapani",
    "32" => "Trentino-Alto Adige",
    "TN" => "Trento",
    "TV" => "Treviso",
    "TS" => "Trieste",
    "UD" => "Udine",
    "55" => "Umbria",
    "23" => "Valle d'Aosta",
    "VA" => "Varese",
    "34" => "Veneto",
    "VE" => "Venezia",
    "VB" => "Verbano-Cusio-Ossola",
    "VC" => "Vercelli",
    "VR" => "Verona",
    "VV" => "Vibo Valentia",
    "VI" => "Vicenza",
    "VT" => "Viterbo"
)),
'JM' => array( 'name' => 'Jamaica', 'states' => array(
    "13" => "Clarendon",
    "09" => "Hanover",
    "01" => "Kingston",
    "12" => "Manchester",
    "04" => "Portland",
    "02" => "Saint Andrew",
    "06" => "Saint Ann",
    "14" => "Saint Catherine",
    "11" => "Saint Elizabeth",
    "08" => "Saint James",
    "05" => "Saint Mary",
    "03" => "Saint Thomas",
    "07" => "Trelawny",
    "10" => "Westmoreland"
)),
'JP' => array( 'name' => 'Japan', 'states' => array(
    "23" => "Aiti [Aichi]",
    "05" => "Akita",
    "02" => "Aomori",
    "38" => "Ehime",
    "21" => "Gihu [Gifu]",
    "10" => "Gunma",
    "34" => "Hirosima [Hiroshima]",
    "01" => "Hokkaidô [Hokkaido]",
    "18" => "Hukui [Fukui]",
    "40" => "Hukuoka [Fukuoka]",
    "07" => "Hukusima [Fukushima]",
    "28" => "Hyôgo [Hyogo]",
    "08" => "Ibaraki",
    "17" => "Isikawa [Ishikawa]",
    "03" => "Iwate",
    "37" => "Kagawa",
    "46" => "Kagosima [Kagoshima]",
    "14" => "Kanagawa",
    "39" => "Kôti [Kochi]",
    "43" => "Kumamoto",
    "26" => "Kyôto [Kyoto]",
    "24" => "Mie",
    "04" => "Miyagi",
    "45" => "Miyazaki",
    "20" => "Nagano",
    "42" => "Nagasaki",
    "29" => "Nara",
    "15" => "Niigata",
    "44" => "Ôita [Oita]",
    "33" => "Okayama",
    "47" => "Okinawa",
    "27" => "Ôsaka [Osaka]",
    "41" => "Saga",
    "11" => "Saitama",
    "25" => "Siga [Shiga]",
    "32" => "Simane [Shimane]",
    "22" => "Sizuoka [Shizuoka]",
    "12" => "Tiba [Chiba]",
    "36" => "Tokusima [Tokushima]",
    "13" => "Tôkyô [Tokyo]",
    "09" => "Totigi [Tochigi]",
    "31" => "Tottori",
    "16" => "Toyama",
    "30" => "Wakayama",
    "06" => "Yamagata",
    "35" => "Yamaguti [Yamaguchi]",
    "19" => "Yamanasi [Yamanashi]"
)),

'KZ' => array( 'name' => 'Kazakhstan', 'states' => array(
    'ALA' => 'Almaty', 'ALM' => 'Almaty oblysy', 'AKM' => 'Aqmola oblysy', 'AKT' => 'Aqtöbe oblysy', 'AST' => 'Astana', 'ATY' => 'Atyrau oblysy', 'ZAP' => 'Batys Qazaqstan oblysy', 'BAY' => 'Bayqongyr', 'MAN' => 'Mangghystau oblysy', 'YUZ' => 'Ongtüstik Qazaqstan oblysy', 'PAV' => 'Pavlodar oblysy', 'KAR' => 'Qaraghandy oblysy', 'KUS' => 'Qostanay oblysy', 'KZY' => 'Qyzylorda oblysy', 'VOS' => 'Shyghys Qazaqstan oblysy', 'SEV' => 'Soltüstik Qazaqstan oblysy', 'ZHA' => 'Zhambyl oblysy'
)),
'KE' => array( 'name' => 'Kenya', 'states' => array(
    "200" => "Central", "300" => "Coast", "400" => "Eastern", "110" => "Nairobi", "500" => "North-Eastern", "600" => "Nyanza", "700" => "Rift Valley", "800" => "Western"
)),

'KR' => array( 'name' => 'Korea', 'states' => array(
    "26" => "Busan Gwang'yeogsi [Pusan-Kwangyokshi]", "43" => "Chungcheongbugdo [Ch'ungch'ongbuk-do]", "44" => "Chungcheongnamdo [Ch'ungch'ongnam-do]", "27" => "Daegu Gwang'yeogsi [Taegu-Kwangyokshi]", "30" => "Daejeon Gwang'yeogsi [Taejon-Kwangyokshi]", "42" => "Gang'weondo [Kang-won-do]", "29" => "Gwangju Gwang'yeogsi [Kwangju-Kwangyokshi]", "41" => "Gyeonggido [Kyonggi-do]", "47" => "Gyeongsangbugdo [Kyongsangbuk-do]", "48" => "Gyeongsangnamdo [Kyongsangnam-do]", "28" => "Incheon Gwang'yeogsi [Inch'n-Kwangyokshi]", "49" => "Jejudo [Cheju-do]", "45" => "Jeonrabugdo[Chollabuk-do]", "46" => "Jeonranamdo [Chollanam-do]", "11" => "Seoul Teugbyeolsi [Seoul-T'ukpyolshi]", "31" => "Ulsan Gwang'yeogsi [Ulsan-Kwangyokshi]"
)),
'KW' => array( 'name' => 'Kuwait', 'states' => array(
    "AH" => "Al Ahmadi", "FA" => "Al Farwaniyah", "JA" => "Al Jahrah","KU" => "Al Kuwayt", "HA" => "Hawalli", "MU" => "Mubarak al-Kabir"
)),
'KG' => array( 'name' => 'Kyrgyzstan', 'states' => array(
    "B" => "Batken", "GB" => "Bishkek", "C" => "Chü", "J" => "Jalal-Abad", "N" => "Naryn", "O" => "Osh", "T" => "Talas", "Y" => "Ysyk-Köl"
)),

'LV' => array( 'name' => 'Latvia', 'states' => array(
    "011" => "Ādažu novads", "001" => "Aglonas novads", "002" =>"Aizkraukles novads", "003" => "Aizputes novads", "004" => "Aknīstes novads", "005" =>"Alojas novads", "006" => "Alsungas novads", "007" => "Alūksnes novads", "008" =>"Amatas novads", "009" => "Apes novads", "010" => "Auces novads", "012" =>"Babītes novads", "013" => "Baldones novads", "014" => "Baltinavas novads", "015" =>"Balvu novads", "016" => "Bauskas novads", "017" => "Beverīnas novads", "018" =>"Brocēnu novads", "019" => "Burtnieku novads", "020" => "Carnikavas novads", "022" =>"Cēsu novads", "021" => "Cesvaines novads", "023" => "Ciblas novads", "024" =>"Dagdas novads", "DGV" =>"Daugavpils", "025" => "Daugavpils novads", "026" => "Dobeles novads", "027" =>"Dundagas novads", "028" => "Durbes novads", "029" => "Engures novads", "030" =>"Ērgļu novads", "031" =>"Garkalnes novads", "032" => "Grobiņas novads", "033" => "Gulbenes novads", "034" =>"Iecavas novads", "035" => "Ikšķiles novads", "036" => "Ilūkstes novads", "037" =>"Inčukalna novads", "038" =>"Jaunjelgavas novads", "039" => "Jaunpiebalgas novads", "040" => "Jaunpils novads", "JKB" =>"Jēkabpils", "042" => "Jēkabpils novads", "JEL" => "Jelgava", "041" =>"Jelgavas novads","JUR" => "Jurmala", "043" =>"Kandavas novads", "044" => "Kārsavas novads", "051" => "Ķeguma novads", "052" =>"Ķekavas novads", "045" => "Kocēnu novads", "046" =>"Kokneses novads", "047" => "Krāslavas novads", "048" => "Krimuldas novads", "049" =>"Krustpils novads", "050" => "Kuldīgas novads", "053" =>"Lielvārdes novads", "LPX" => "Liepaja", "055" => "Līgatnes novads", "054" =>"Limbažu novads", "056" => "Līvānu novads", "057" =>"Lubānas novads", "058" => "Ludzas novads", "059" => "Madonas novads", "061" =>"Mālpils novads", "062" => "Mārupes novads","060" => "Mazsalacas novads", "063" => "Mērsraga novads", "064" => "Naukšēnu novads", "065" => "Neretas novads", "066" => "Nīcas novads", "067" => "Ogres novads", "068" => "Olaines novads", "069" => "Ozolnieku novads", "070" => "Pārgaujas novads", "071" => "Pāvilostas novads", "072" => "Pļaviņu novads", "073" => "Preiļu novads", "074" => "Priekules novads", "075" => "Priekuļu novads","076" => "Raunas novads", "REZ" => "Rezekne", "077" => "Rēzeknes novads", "078" => "Riebiņu novads", "RIX" => "Riga","079" => "Rojas novads", "080" => "Ropažu novads", "081" => "Rucavas novads", "082" => "Rugāju novads", "084" => "Rūjienas novads", "083" => "Rundāles novads", "086" => "Salacgrīvas novads", "085" => "Salas novads", "087" => "Salaspils novads", "088" => "Saldus novads", "089" => "Saulkrastu novads", "090" => "Sējas novads", "091" => "Siguldas novads", "092" => "Skrīveru novads", "093" => "Skrundas novads", "094" => "Smiltenes novads", "095" => "Stopiņu novads", "096" => "Strenču novads", "097" => "Talsu novads", "098" => "Tērvetes novads", "099" => "Tukuma novads", "100" =>"Vaiņodes novads", "101" => "Valkas novads", "VMR" => "Valmiera", "102" => "Varakļānu novads", "103" => "Vārkavas novads", "104" => "Vecpiebalgas novads", "105" => "Vecumnieku novads", "VEN" => "Ventspils", "106" => "Ventspils novads", "107" => "Viesītes novads", "108" => "Viļakas novads", "109" => "Viļānu novads", "110" => "Zilupes novads"
)),

'LT' => array( 'name' => 'Lithuania', 'states' => array(
    "AL" => "Alytaus Apskritis", "KU" => "Kauno Apskritis", "KL" => "Klaipedos Apskritis", "MR" => "Marijampoles Apskritis", "PN" => "Panevežio Apskritis", "SA" => "Šiauliu Apskritis", "TA" => "Taurages Apskritis", "TE" => "Telšiu Apskritis", "UT" => "Utenos Apskritis", "VL" => "Vilniaus Apskritis"
)),
'LU' => array( 'name' => 'Luxembourg', 'states' => array(
    "D" => "Diekirch", "G" => "Grevenmacher", "L" => "Luxembourg"
)),

'MK' => array( 'name' => 'Macedonia', 'states' => array(
    "01" => "Aerodrom", "02" => "Aračinovo", "03" => "Berovo", "04" => "Bitola", "05" => "Bogdanci","06" => "Bogovinje", "07" => "Bosilovo", "08" => "Brvenica", "09" => "Butel", "79" => "Čair", "80" => "Čaška", "77" => "Centar", "78" => "Centar Župa", "81" => "Češinovo-Obleševo", "82" => "Čučer Sandevo", "21" => "Debar", "22" => "Debarca", "23" => "Delčevo", "25" => "Demir Hisar", "24" => "Demir Kapija", "26" => "Dojran", "27" => "Dolneni", "28" => "Drugovo", "17" => "Gazi Baba", "18" => "Gevgelija", "29" => "Gjorče Petrov", "19" => "Gostivar", "20" => "Gradsko", "34" => "Ilinden", "35" => "Jegunovce", "37" => "Karbinci", "38" => "Karpoš", "36" => "Kavadarci", "40" => "Kičevo", "39" => "Kisela Voda", "42" => "Kočani", "41" => "Konče", "43" => "Kratovo", "44" => "Kriva Palanka", "45" => "Krivogaštani", "46" => "Kruševo", "47" => "Kumanovo", "48" => "Lipkovo", "49" => "Lozovo", "51" => "Makedonska Kamenica", "52" => "Makedonski Brod", "50" => "Mavrovo i Rostuša", "53" => "Mogila", "54" => "Negotino", "55" => "Novaci", "56" => "Novo Selo", "58" => "Ohrid", "57" => "Oslomej", "60" =>
    "Pehčevo", "59" => "Petrovec", "61" => "Plasnica", "62" => "Prilep", "63" => "Probištip", "64" => "Radoviš", "65" => "Rankovce", "66" => "Resen", "67" => "Rosoman", "68" => "Saraj", "70" => "Sopište","71" => "Staro Nagoričane", "83" => "Štip", "72" => "Struga", "73" => "Strumica", "74" => "Studeničani",  "84" => "Šuto Orizari", "69" => "Sveti Nikole","75"	=> "Tearce",
    "76"	=> "Tetovo",
    "10"	=> "Valandovo",
    "11"	=> "Vasilevo",
    "13"	=> "Veles",
    "12"	=> "Vevčani",
    "14"	=> "Vinica",
    "15"	=> "Vraneštica",
    "16"	=> "Vrapčište",
    "31"	=> "Zajas",
    "32"	=> "Zelenikovo",
    "30"	=> "Želino",
    "33"	=> "Zrnovci"
)),

'MY' => array( 'name' => 'Malaysia', 'states' => array(
    "01" =>"Johor",
    "02" =>"Kedah",
    "03" =>"Kelantan",
    "04" =>"Melaka",
    "05" =>"Negeri Sembilan",
    "06" =>"Pahang",
    "08" =>"Perak",
    "09" =>"Perlis",
    "07" =>"Pulau Pinang",
    "12" =>"Sabah",
    "13" =>"Sarawak",
    "10" =>"Selangor",
    "11" =>"Terengganu",
    "14" =>"Wilayah Persekutuan Kuala Lumpur",
    "15" =>"Wilayah Persekutuan Labuan",
    "16" =>"Wilayah Persekutuan Putrajaya"
)),

'MT' => array( 'name' => 'Malta', 'states' => array(
    "01" => "Attard",
    "02" => "Balzan",
    "03" => "Birgu",
    "04" => "Birkirkara",
    "05" => "Birżebbuġa",
    "06" => "Bormla",
    "07" => "Dingli",
    "08" => "Fgura",
    "09" => "Floriana",
    "10" => "Fontana",
    "13" => "Għajnsielem",
    "14" => "Għarb",
    "15" => "Għargħur",
    "16" => "Għasri",
    "17" => "Għaxaq",
    "11" => "Gudja",
    "12" => "Gżira",
    "18" => "Ħamrun",
    "19" => "Iklin",
    "20" => "Isla",
    "21" => "Kalkara",
    "22" => "Kerċem",
    "23" => "Kirkop",
    "24" => "Lija",
    "25" => "Luqa",
    "26" => "Marsa",
    "27" => "Marsaskala",
    "28" => "Marsaxlokk",
    "29" => "Mdina",
    "30" => "Mellieħa",
    "31" => "Mġarr",
    "32" => "Mosta",
    "33" => "Mqabba",
    "34" => "Msida",
    "35" => "Mtarfa",
    "36" => "Munxar",
    "37" => "Nadur",
    "38" => "Naxxar",
    "39" => "Paola",
    "40" => "Pembroke",
    "41" => "Pietà",
    "42" => "Qala",
    "43" => "Qormi",
    "44" => "Qrendi",
    "45" => "Rabat Għawdex",
    "46" => "Rabat Malta",
    "47" => "Safi",
    "48" => "San Ġiljan",
    "49" => "San Ġwann",
    "50" => "San Lawrenz",
    "51" => "San Pawl il-Baħar",
    "52" => "Sannat",
    "53" => "Santa Luċija",
    "54" => "Santa Venera",
    "55" => "Siġġiewi",
    "56" => "Sliema",
    "57" => "Swieqi",
    "58" => "Ta’ Xbiex",
    "59" => "Tarxien",
    "60" => "Valletta",
    "61" => "Xagħra",
    "62" => "Xewkija",
    "63" => "Xgħajra",
    "64" => "Żabbar",
    "65" => "Żebbuġ Għawdex",
    "66" => "Żebbuġ Malta",
    "67" => "Żejtun",
    "68" => "Żurrieq"
)),


'MX' => array( 'name' => 'Mexico', 'states' => array(
    "AGU" =>"Aguascalientes",
    "BCN" =>"Baja California",
    "BCS" =>"Baja California Sur",
    "CAM" =>"Campeche",
    "CHP" =>"Chiapas",
    "CHH" =>"Chihuahua",
    "COA" =>"Coahuila",
    "COL" =>"Colima",
    "DIF" =>"Distrito Federal",
    "DUR" =>"Durango",
    "GUA" =>"Guanajuato",
    "GRO" =>"Guerrero",
    "HID" =>"Hidalgo",
    "JAL" =>"Jalisco",
    "MEX" =>"México",
    "MIC" =>"Michoacán",
    "MOR" =>"Morelos",
    "NAY" =>"Nayarit",
    "NLE" =>"Nuevo León",
    "OAX" =>"Oaxaca",
    "PUE" =>"Puebla",
    "QUE" =>"Querétaro",
    "ROO" =>"Quintana Roo",
    "SLP" =>"San Luis Potosí",
    "SIN" =>"Sinaloa",
    "SON" =>"Sonora",
    "TAB" =>"Tabasco",
    "TAM" =>"Tamaulipas",
    "TLA" =>"Tlaxcala",
    "VER" =>"Veracruz",
    "YUC" =>"Yucatán",
    "ZAC" =>"Zacatecas"
)),

'NL' => array( 'name' => 'Netherlands', 'states' => array( "AW" => "Aruba",
    "BQ1" => ">Bonaire",
    "CW" => "Curaçao",
    "DR" => "Drenthe",
    "FL" => "Flevoland",
    "FR" => "Friesland",
    "GE" => "Gelderland",
    "GR" => "Groningen",
    "LI" => "Limburg",
    "NB" => "Noord-Brabant",
    "NH" => "Noord-Holland",
    "OV" => "Overijssel",
    "BQ2"=> ">Saba",
    "BQ3" =>  ">Sint Eustatius",
    "SX" => "Sint Maarten",
    "UT" => "Utrecht",
    "ZE" => "Zeeland",
    "ZH" => "Zuid-Holland")),

'NZ' => array( 'name' => 'New Zealand', 'states' => array(
    "AUK" => "Auckland",
    "BOP" => "Bay of Plenty",
    "CAN" => "Canterbury",
    "CIT" => "Chatham Islands Territory",
    "CK" => "Cook Islands",
    "GIS" => "Gisborne District",
    "HKB" => "Hawkes's Bay",
    "MWT" => "Manawatu-Wanganui",
    "MBH" => "Marlborough District",
    "NSN" => "Nelson City",
    "N"   => "North Island",
    "NTL" => "Northland",
    "OTA" => "Otago",
    "S"   => "uth Island",
    "STL" => "Southland",
    "TKI" => "Taranaki",
    "TAS" => "Tasman District",
    "WKO" => "Waikato",
    "WGN" => "Wellington",
    "WTC" => "West Coast"
)),

'NG' => array( 'name' => 'Nigeria', 'states' => array(
    "AB" => "Abia",
    "FC" => "Abuja Federal Capital Territory",
    "AD" => "Adamawa",
    "AK" => "Akwa Ibom",
    "AN" => "Anambra",
    "BA" => "Bauchi",
    "BY" => "Bayelsa",
    "BE" => "Benue",
    "BO" => "Borno",
    "CR" => "Cross River",
    "DE" => "Delta",
    "EB" => "Ebonyi",
    "ED" => "Edo",
    "EK" => "Ekiti",
    "EN" => "Enugu",
    "GO" => "Gombe",
    "IM" => "Imo",
    "JI" => "Jigawa",
    "KD" => "Kaduna",
    "KN" => "Kano",
    "KT" => "Katsina",
    "KE" => "Kebbi",
    "KO" => "Kogi",
    "KW" => "Kwara",
    "LA" => "Lagos",
    "NA" => "Nassarawa",
    "NI" => "Niger",
    "OG" => "Ogun",
    "ON" => "Ondo",
    "OS" => "Osun",
    "OY" => "Oyo",
    "PL" => "Plateau",
    "RI" => "Rivers",
    "SO" => "Sokoto",
    "TA" => "Taraba",
    "YO" => "Yobe",
    "ZA" => "Zamfara"
)),

'NO' => array( 'name' => 'Norway', 'states' => array(
    "02" => "Akershus",
    "09" => "Aust-Agder",
    "06" => "Buskerud",
    "20" => "Finnmark",
    "04" => "Hedmark",
    "12" => "Hordaland",
    "22" => "Jan Mayen",
    "15" => "Møre og Romsdal",
    "18" => "Nordland",
    "17" => "Nord-Trøndelag",
    "05" => "Oppland",
    "03" => "Oslo",
    "01" => "Østfold",
    "11" => "Rogaland",
    "14" => "Sogn og Fjordane",
    "16" => "Sør-Trøndelag",
    "21" => "Svalbard",
    "08" => "Telemark",
    "19" => "Troms",
    "10" => "Vest-Agder",
    "07" => "Vestfold"
)),

'PA' => array( 'name' => 'Panama', 'states' => array(
    "1" =>"Bocas del Toro",
    "4" =>"Chiriquí",
    "2" =>"Coclé",
    "3" =>"Colón",
    "5" =>"Darién",
    "EM" => "Emberá",
    "6" =>"Herrera",
    "KY" =>">Kuna Yala",
    "7" =>"Los Santos",
    "NB" =>"Ngöbe-Buglé",
    "8" =>"Panamá",
    "9" =>"Veraguas"
)),

'PH' => array( 'name' => 'Philippines', 'states' => array(
    "ABR" =>"Abra",
    "AGN" =>"Agusan del Norte",
    "AGS" =>"Agusan del Sur",
    "AKL" =>"Aklan",
    "ALB" =>"Albay",
    "ANT" =>"Antique",
    "APA" =>"Apayao",
    "AUR" =>"Aurora",
    "14"  => "Autonomous Region in Muslim Mindanao",
    "BAS" =>"Basilan",
    "BAN" =>"Bataan",
    "BTN" =>"Batanes",
    "BTG" =>"Batangas",
    "BEN" =>"Benguet",
    "05"  => "Bicol",
    "BIL" =>"Biliran",
    "BOH" =>"Bohol",
    "BUK" =>"Bukidnon",
    "BUL" =>"Bulacan",
    "CAG" =>"Cagayan",
    "02"  => "Cagayan Valley",
    "40"  => "CALABARZON",
    "CAN" =>"Camarines Norte",
    "CAS" =>"Camarines Sur",
    "CAM" =>"Camiguin",
    "CAP" =>"Capiz",
    "13"  => "Caraga",
    "CAT" =>"Catanduanes",
    "CAV" =>"Cavite",
    "CEB" =>"Cebu",
    "03"  => "Central Luzon",
    "07"  =>"Central Visayas",
    "COM" =>"Compostela Valley",
    "15"  => "Cordillera Administrative Region",
    "NCO" =>"Cotabato",
    "11"  => "Davao",
    "DAV" =>"Davao del Norte",
    "DAS" =>"Davao del Sur",
    "DAO" =>"Davao Oriental",
    "DIN" =>"Dinagat Islands",
    "EAS" =>"Eastern Samar",
    "08"  => "Eastern Visayas",
    "GUI" =>"Guimaras",
    "IFU" =>"Ifugao",
    "01"  => "Ilocos",
    "ILN" =>"Ilocos Norte",
    "ILS" =>"Ilocos Sur",
    "ILI" =>"Iloilo",
    "ISA" =>"Isabela",
    "KAL" =>"Kalinga",
    "LUN" =>"La Union",
    "LAG" =>"Laguna",
    "LAN" =>"Lanao del Norte",
    "LAS" =>"Lanao del Sur",
    "LEY" =>"Leyte",
    "MAG" =>"Maguindanao",
    "MAD" =>"Marinduque",
    "MAS" =>"Masbate",
    "41"  =>"MIMAROPA",
    "MDC" =>"Mindoro Occidental",
    "MDR" =>"Mindoro Oriental",
    "MSC" =>"Misamis Occidental",
    "MSR" =>"Misamis Oriental",
    "MOU" =>"Mountain Province",
    "00"  => "National Capital Region",
    "NEC" =>"Negros Occidental",
    "NER" =>"Negros Oriental",
    "10"  => "Northern Mindanao",
    "NSA" =>"Northern Samar",
    "NUE" =>"Nueva Ecija",
    "NUV" =>"Nueva Vizcaya",
    "PLW" =>"Palawan",
    "PAM" =>"Pampanga",
    "PAN" =>"Pangasinan",
    "QUE" =>"Quezon",
    "QUI" =>"Quirino",
    "RIZ" =>"Rizal",
    "ROM" =>"Romblon",
    "SAR" =>"Sarangani",
    "X2~" =>"Shariff Kabunsuan",
    "SIG" =>"Siquijor",
    "12"  =>"Soccsksargen",
    "SOR" =>"Sorsogon",
    "SCO" =>"South Cotabato",
    "SLE" =>"Southern Leyte",
    "SUK" =>"Sultan Kudarat",
    "SLU" =>"Sulu",
    "SUN" =>"Surigao del Norte",
    "SUR" =>"Surigao del Sur",
    "TAR" =>"Tarlac",
    "TAW" =>"Tawi-Tawi",
    "WSA" =>"Western Samar",
    "06"  =>"Western Visayas",
    "ZMB" =>"Zambales",
    "ZAN" =>"Zamboanga del Norte",
    "ZAS" =>"Zamboanga del Sur",
    "09"  =>"Zamboanga Peninsula",
    "ZSI" =>"Zamboanga Sibuguey [Zamboanga Sibugay]"
)),

'PL' => array( 'name' => 'Poland', 'states' => array(
    "DS" => "Dolnoslaskie",
    "KP" => "Kujawsko-pomorskie",
    "LD" => "Lódzkie",
    "LU" => "Lubelskie",
    "LB" => "Lubuskie",
    "MA" => "Malopolskie",
    "MZ" => "Mazowieckie",
    "OP" => "Opolskie",
    "PK" => "Podkarpackie",
    "PD" => "Podlaskie",
    "PM" => "Pomorskie",
    "SL" => "Slaskie",
    "SK" => "Swietokrzyskie",
    "WN" => "Warminsko-mazurskie",
    "WP" => "Wielkopolskie",
    "ZP" => "Zachodniopomorskie"
)),
'PT' => array( 'name' => 'Portugal', 'states' => array(
    "01" =>"Aveiro",
    "02" =>"Beja",
    "03" =>"Braga",
    "04" =>"Bragança",
    "05" =>"Castelo Branco",
    "06" =>"Coimbra",
    "07" =>"Évora",
    "08" =>"Faro",
    "09" =>"Guarda",
    "10" =>"Leiria",
    "11" =>"Lisboa",
    "12" =>"Portalegre",
    "13" =>"Porto",
    "30" =>"Região Autónoma da Madeira",
    "20" =>"Região Autónoma dos Açores",
    "14" =>"Santarém",
    "15" =>"Setúbal",
    "16" =>"Viana do Castelo",
    "17" =>"Vila Real",
    "18" =>"Viseu"
)),

'QA' => array( 'name' => 'Qatar', 'states' => array(
    "DA"=> "Ad Dawhah",
    "KH"=> "Al Khawr wa adh Dhakhīrah",
    "WA"=> "Al Wakrah",
    "RA"=> "Ar Rayyan",
    "ZA"=> "Az̧ Z̧a‘āyin",
    "MS"=> "Madinat ash Shamal",
    "X1~" =>">Umm Sa'id",
    "US"=> "Umm Salal"
)),

'RO' => array( 'name' => 'Romania', 'states' => array(
    "AB"=> "Alba",
    "AR"=> "Arad",
    "AG"=> "Arges",
    "BC"=> "Bacau",
    "BH"=> "Bihor",
    "BN"=> "Bistrita-Nasaud",
    "BT"=> "Botosani",
    "BR"=> "Braila",
    "BV"=> "Brasov",
    "B"=> "Bucuresti",
    "BZ"=> "Buzau",
    "CL"=> "Calarasi",
    "CS"=> "Caras-Severin",
    "CJ"=> "Cluj",
    "CT"=> "Constanta",
    "CV"=> "Covasna",
    "DB"=> "Dâmbovita",
    "DJ"=> "Dolj",
    "GL"=> "Galati",
    "GR"=> "Giurgiu",
    "GJ"=> "Gorj",
    "HR"=> "Harghita",
    "HD"=> "Hunedoara",
    "IL"=> "Ialomita",
    "IS"=> "Iasi",
    "IF"=> "Ilfov",
    "MM"=> "Maramures",
    "MH"=> "Mehedinti",
    "MS"=> "Mures",
    "NT"=> "Neamt",
    "OT"=> "Olt",
    "PH"=> "Prahova",
    "SJ"=> "Salaj",
    "SM"=> "Satu Mare",
    "SB"=> "Sibiu",
    "SV"=> "Suceava",
    "TR"=> "Teleorman",
    "TM"=> "Timis",
    "TL"=> "Tulcea",
    "VL"=> "Vâlcea",
    "VS"=> "Vaslui",
    "VN"=> "Vrancea"
)),
'RU' => array( 'name' => 'Russian Federation', 'states' => array(
    "AD" => "Adygeya, Respublika",
    "AL" => "Altay, Respublika",
    "ALT" => "Altayskiy kray",
    "AMU" => "Amurskaya oblast'",
    "ARK" => "Arkhangel'skaya oblast'",
    "AST" => "Astrakhanskaya oblast'",
    "BA" => "Bashkortostan, Respublika",
    "BEL" => "Belgorodskaya oblast'",
    "BRY" => "Bryanskaya oblast'",
    "BU" => "Buryatiya, Respublika",
    "CE" => "Chechenskaya Respublika",
    "CHE" => "Chelyabinskaya oblast'",
    "CHU" => "Chukotskiy avtonomnyy okrug",
    "CU" => "Chuvashskaya Respublika",
    "DA" => "Dagestan, Respublika",
    "IN" => "Ingushskaya Respublika [Respublika Ingushetiya]",
    "IRK" => "Irkutskaya oblast'",
    "IVA" => "Ivanovskaya oblast'",
    "KB" => "Kabardino-Balkarskaya Respublika",
    "KGD" => "Kaliningradskaya oblast'",
    "KL" => "Kalmykiya, Respublika",
    "KLU" => "Kaluzhskaya oblast'",
    "KAM" => "Kamchatskaya oblast'",
    "KC" => "Karachayevo-Cherkesskaya Respublika",
    "KR" => "Kareliya, Respublika",
    "KEM" => "Kemerovskaya oblast'",
    "KHA" => "Khabarovskiy kray",
    "KK" => "Khakasiya, Respublika",
    "KHM" => "Khanty-Mansiyskiy avtonomnyy okrug [Yugra]",
    "KIR" => "Kirovskaya oblast'",
    "KO" => "Komi, Respublika",
    "X1~" => "Komi-Permyak",
    "KOS" => "Kostromskaya oblast'",
    "KDA" => "Krasnodarskiy kray",
    "KYA" => "Krasnoyarskiy kray",
    "KGN" => "Kurganskaya oblast'",
    "KRS" => "Kurskaya oblast'",
    "LEN" => "Leningradskaya oblast'",
    "LIP" => "Lipetskaya oblast'",
    "MAG" => "Magadanskaya oblast'",
    "ME" => "Mariy El, Respublika",
    "MO" => "Mordoviya, Respublika",
    "MOS" => "Moskovskaya oblast'",
    "MOW" => "Moskva",
    "MUR" => "Murmanskaya oblast'",
    "NEN" => "Nenetskiy avtonomnyy okrug",
    "NIZ" => "Nizhegorodskaya oblast'",
    "NGR" => "Novgorodskaya oblast'",
    "NVS" => "Novosibirskaya oblast'",
    "OMS" => "Omskaya oblast'",
    "ORE" => "Orenburgskaya oblast'",
    "ORL" => "Orlovskaya oblast'",
    "PNZ" => "Penzenskaya oblast'",
    "PER" => "Perm",
    "PRI" => "Primorskiy kray",
    "PSK" => "Pskovskaya oblast'",
    "ROS" => "Rostovskaya oblast'",
    "RYA" => "Ryazanskaya oblast'",
    "SAS" => "akha, Respublika [Yakutiya]",
    "SAK" => "Sakhalinskaya oblast'",
    "SAM" => "Samarskaya oblast'",
    "SPE" => "Sankt-Peterburg",
    "SAR" => "Saratovskaya oblast'",
    "SES" => "evernaya Osetiya, Respublika [Alaniya] [Respublika Severnaya Osetiya-Alaniya]",
    "SMO" => "Smolenskaya oblast'",
    "STA" => "Stavropol'skiy kray",
    "SVE" => "Sverdlovskaya oblast'",
    "TAM" => "Tambovskaya oblast'",
    "TA" => "Tatarstan, Respublika",
    "TOM" => "Tomskaya oblast'",
    "TUL" => "Tul'skaya oblast'",
    "TVE" => "Tverskaya oblast'",
    "TYU" => "Tyumenskaya oblast'",
    "TY"  => "Tyva, Respublika [Tuva]",
    "UD"  => "Udmurtskaya Respublika",
    "ULY" => "Ul'yanovskaya oblast'",
    "VLA" => "Vladimirskaya oblast'",
    "VGG" => "Volgogradskaya oblast'",
    "VLG" => "Vologodskaya oblast'",
    "VOR" => "Voronezhskaya oblast'",
    "YAN" => "Yamalo-Nenetskiy avtonomnyy okrug",
    "YAR" => "Yaroslavskaya oblast'",
    "YEV" => "Yevreyskaya avtonomnaya oblast'",
    "ZAB" => "Zabajkal'skij kraj"
)),

'MF' => array( 'name' => 'Saint Martin', 'states' => array(
    "SX" => "Sint Maarten"
)),
'SA' => array( 'name' => 'Saudi Arabia', 'states' => array(
    "06" =>"?a'il",
    "14" =>"?Asir",
    "11" =>"Al Bāḩah",
    "08" =>"Al Ḩudūd ash Shamālīyah",
    "12" =>"Al Jawf",
    "03" =>"Al Madinah",
    "05" =>"Al Qasim",
    "01" =>"Ar Riyāḑ",
    "04" =>"Ash Sharqiyah",
    "09" =>"Jizan",
    "02" =>"Makkah",
    "10" =>"Najran",
    "07" =>"Tabuk"
)),

'SG' => array( 'name' => 'Singapore', 'states' => array(
    "01" => "Central Singapore",
    "02" => "North East",
    "03" => "North West",
    "X1~" => "Singapore - No State",
    "04" => "South East",
    "05" => "South West"
)),
'SK' => array( 'name' => 'Slovakia', 'states' => array(
    "BC" => "Banskobystrický kraj",
    "BL" => "Bratislavský kraj",
    "KI" => "Košický kraj",
    "NI" => "Nitriansky kraj",
    "PV" => "Prešovský kraj",
    "TC" => "Trenciansky kraj",
    "TA" => "Trnavský kraj",
    "ZI" => "Žilinský kraj"
)),
'SI' => array( 'name' => 'Slovenia', 'states' => array(
    "001" => "Ajdovšcina",
    "195" => "Apače",
    "002" => "Beltinci",
    "148" => "Benedikt",
    "149" => "Bistrica ob Sotli",
    "003" => "Bled",
    "150" => "Bloke",
    "004" => "Bohinj",
    "005" => "Borovnica",
    "006" => "Bovec",
    "151" => "Braslovce",
    "007" => "Brda",
    "009" => "Brežice",
    "008" => "Brezovica",
    "152" => "Cankova",
    "011" => "Celje",
    "012" => "Cerklje na Gorenjskem",
    "013" => "Cerknica",
    "014" => "Cerkno",
    "153" => "Cerkvenjak",
    "197" => "Cirkulane",
    "015" => "Crenšovci",
    "016" => "Crna na Koroškem",
    "017" => "Crnomelj",
    "018" => "Destrnik",
    "019" => "Divaca",
    "154" => "Dobje",
    "020" => "Dobrepolje",
    "155" => "Dobrna",
    "021" => "Dobrova-Polhov Gradec",
    "156" => "Dobrovnik/Dobronak",
    "022" => "Dol pri Ljubljani",
    "157" => "Dolenjske Toplice",
    "023" => "Domžale",
    "024" => "Dornava",
    "025" => "Dravograd",
    "026" => "Duplek",
    "027" => "Gorenja vas-Poljane",
    "028" => "Gorišnica",
    "207" => "Gorje",
    "029" => "Gornja Radgona",
    "030" => "Gornji Grad",
    "031" => "Gornji Petrovci",
    "158" => "Grad",
    "032" => "Grosuplje",
    "159" => "Hajdina",
    "160" => "Hoce-Slivnica",
    "161" => "Hodoš/Hodos",
    "162" => "Horjul",
    "034" => "Hrastnik",
    "035" => "Hrpelje-Kozina",
    "036" => "Idrija",
    "037" => "Ig",
    "038" => "Ilirska Bistrica",
    "039" => "Ivancna Gorica",
    "040" => "Izola/Isola",
    "041" => "Jesenice",
    "163" => "Jezersko",
    "042" => "Juršinci",
    "043" => "Kamnik",
    "044" => "Kanal",
    "045" => "Kidricevo",
    "046" => "Kobarid",
    "047" => "Kobilje",
    "048" => "Kocevje",
    "049" => "Komen",
    "164" => "Komenda",
    "050" => "Koper/Capodistria",
    "196" => "Kosanjevica na Krki",
    "165" => "Kostel",
    "051" => "Kozje",
    "052" => "Kranj",
    "053" => "Kranjska Gora",
    "166" => "Križevci",
    "054" => "Krško",
    "055" => "Kungota",
    "056" => "Kuzma",
    "057" => "Laško",
    "058" => "Lenart",
    "059" => "Lendava/Lendva",
    "060" => "Litija",
    "061" => "Ljubljana",
    "062" => "Ljubno",
    "063" => "Ljutomer",
    "064" => "Logatec",
    "208" => "Log-Dragomer",
    "065" => "Loška dolina",
    "066" => "Loški Potok",
    "167" => "Lovrenc na Pohorju",
    "067" => "Luce",
    "068" => "Lukovica",
    "069" => "Majšperk",
    "198" => "Makole",
    "070" => "Maribor",
    "168" => "Markovci",
    "071" => "Medvode",
    "072" => "Mengeš",
    "073" => "Metlika",
    "074" => "Mežica",
    "169" => "Miklavž na Dravskem polju",
    "075" => "Miren-Kostanjevica",
    "170" => "Mirna Pec",
    "076" => "Mislinja",
    "199" => "Mokronog-Trebelno",
    "077" => "Moravce",
    "078" => "Moravske Toplice",
    "079" => "Mozirje",
    "080" => "Murska Sobota",
    "081" => "Muta",
    "082" => "Naklo",
    "083" => "Nazarje",
    "084" => "Nova Gorica",
    "085" => "Novo mesto",
    "086" => "Odranci",
    "171" => "Oplotnica",
    "087" => "Ormož",
    "088" => "Osilnica",
    "089" => "Pesnica",
    "090" => "Piran/Pirano",
    "091" => "Pivka",
    "092" => "Podcetrtek",
    "172" => "Podlehnik",
    "093" => "Podvelka",
    "200" => "Poljčane",
    "173" => "Polzela",
    "094" => "Postojna",
    "174" => "Prebold",
    "095" => "Preddvor",
    "175" => "Prevalje",
    "096" => "Ptuj",
    "097" => "Puconci",
    "098" => "Race-Fram",
    "099" => "Radece",
    "100" => "Radenci",
    "101" => "Radlje ob Dravi",
    "102" => "Radovljica",
    "103" => "Ravne na Koroškem",
    "176" => "Razkrižje",
    "209" => "Rečica ob Savinji",
    "201" => "Renče-Vogrsko",
    "104" => "Ribnica",
    "177" => "Ribnica na Pohorju",
    "106" => "Rogaška Slatina",
    "105" => "Rogašovci",
    "107" => "Rogatec",
    "108" => "Ruše",
    "033" => "Šalovci",
    "178" => "Selnica ob Dravi",
    "109" => "Semic",
    "183" => "Šempeter-Vrtojba",
    "117" => "Šencur",
    "118" => "Šentilj",
    "119" => "Šentjernej",
    "120" => "Šentjur pri Celju",
    "211" => "Šentrupert",
    "110" => "Sevnica",
    "111" => "Sežana",
    "121" => "Škocjan",
    "122" => "Škofja Loka",
    "123" => "Škofljica",
    "112" => "Slovenj Gradec",
    "113" => "Slovenska Bistrica",
    "114" => "Slovenske Konjice",
    "124" => "Šmarje pri Jelšah",
    "206" => "Šmarješke Toplice",
    "125" => "Šmartno ob Paki",
    "194" => "Šmartno pri Litiji",
    "179" => "Sodražica",
    "180" => "Solcava",
    "126" => "Šoštanj",
    "202" => "Središče ob Dravi",
    "115" => "Starše",
    "127" => "Štore",
    "203" => "Straža",
    "181" => "Sveta Ana",
    "204" => "Sveta Trojica v Slovenskih Goricah",
    "182" => "Sveti Andraž v Slovenskih goricah",
    "116" => "Sveti Jurij",
    "210" => "Sveti Jurij v Slovenskih Goricah",
    "205" => "Sveti Tomaž",
    "184" => "Tabor",
    "010" => "Tišina",
    "128" => "Tolmin",
    "129" => "Trbovlje",
    "130" => "Trebnje",
    "185" => "Trnovska vas",
    "131" => "Tržic",
    "186" => "Trzin",
    "132" => "Turnišce",
    "133" => "Velenje",
    "187" => "Velika Polana",
    "134" => "Velike Lašce",
    "188" => "Veržej",
    "135" => "Videm",
    "136" => "Vipava",
    "137" => "Vitanje",
    "138" => "Vodice",
    "139" => "Vojnik",
    "189" => "Vransko",
    "140" => "Vrhnika",
    "141" => "Vuzenica",
    "142" => "Zagorje ob Savi",
    "190" => "Žalec",
    "143" => "Zavrc",
    "146" => "Železniki",
    "191" => "Žetale",
    "147" => "Žiri",
    "192" => "Žirovnica",
    "144" => "Zrece",
    "193" => "Žužemberk"
)),

'ZA' => array( 'name' => 'South Africa', 'states' => array(
    "EC" =>"Eastern Cape",
    "FS" =>"Free State",
    "GT" =>"Gauteng",
    "NL" =>"Kwazulu-Natal",
    "LP" =>"Limpopo",
    "MP" =>"Mpumalanga",
    "NC" =>"Northern Cape",
    "NW" =>"North-West",
    "WC" =>"Western Cape"
)),

'ES' => array( 'name' => 'Spain', 'states' => array(
    "C" => " ACoruña",
    "VI" => "Álava",
    "AB" => "Albacete",
    "A" => "Alicante",
    "AL" => "Almería",
    "AN" => "Andalucía",
    "O" => "Asturias",
    "AS" => "Asturias, Principado de",
    "AV" => "Ávila",
    "BA" => "Badajoz",
    "PM" => "Baleares",
    "B" => "Barcelona",
    "BU" => "Burgos",
    "CC" => "Cáceres",
    "CA" => "Cádiz",
    "CN" => "Canarias",
    "S" => "Cantabria",
    "CB" => "Cantabria",
    "CS" => "Castellón",
    "CL" => "Castilla y León",
    "CM" => "Castilla-La Mancha",
    "CT" => "Catalunya",
    "CE" => "Ceuta",
    "CR" => "Ciudad Real",
    "CO" => "Córdoba",
    "CU" => "Cuenca",
    "EX" => "Extremadura",
    "GA" => "Galicia",
    "GI" => "Girona",
    "GR" => "Granada",
    "GU" => "Guadalajara",
    "SS" => "Guipúzcoa",
    "H" => "Huelva",
    "HU" => "Huesca",
    "IB" => "Illes Balears",
    "J" => "Jaén",
    "LO" => "La Rioja",
    "GC" => "Las Palmas",
    "LE" => "León",
    "L" => "Lleida",
    "LU" => "Lugo",
    "M" => "Madrid",
    "MD" => "Madrid, Comunidad de",
    "MA" => "Málaga",
    "ML" => "Melilla",
    "MU" => "Murcia",
    "MC" => "Murcia, Región de",
    "NA" => "Navarra",
    "NC" => "Navarra, Comunidad Foral de",
    "OR" => "Ourense",
    "PV" => "País Vasco",
    "P" => "Palencia",
    "PO" => "Pontevedra",
    "SA" => "Salamanca",
    "TF" => "Santa Cruz de Tenerife",
    "SG" => "Segovia",
    "SE" => "Sevilla",
    "SO" => "Soria",
    "T" => "Tarragona",
    "TE" => "Teruel",
    "TO" => "Toledo",
    "V" => "Valencia",
    "VC" => "Valenciana, Comunidad",
    "VA" => "Valladolid",
    "BI" => "Vizcaya",
    "ZA" => "Zamora",
    "Z" => "Zaragoza"
)),
'LK' => array( 'name' => 'Sri Lanka', 'states' => array(
    "52" => "Ampāra",
    "71" => "Anurādhapura",
    "81" => "Badulla",
    "1" => "Basnāhira paḷāta",
    "3" => "Dakuṇu paḷāta",
    "31" => "Gālla",
    "12" => "Gampaha",
    "33" => "Hambantŏṭa",
    "13" => "Kalutara",
    "92" => "Kegalla",
    "42" => "Kilinŏchchi",
    "11" => "Kŏḷamba",
    "61" => "Kuruṇægala",
    "51" => "Madakalapuva",
    "2" => "Madhyama paḷāta",
    "21" => "Mahanuvara",
    "43" => "Mannārama",
    "22" => "Mātale",
    "32" => "Mātara",
    "5" => "Mattiya mākāṇam",
    "82" => "Mŏṇarāgala",
    "45" => "Mulativ",
    "23" => "Nuvara Ĕliya",
    "72" => "Pŏḷŏnnaruva",
    "62" => "Puttalama",
    "91" => "Ratnapura",
    "9" => "Sabaragamuva paḷāta",
    "53" => "Trikuṇāmalaya",
    "4" => "Uturu paḷāta",
    "7" => "Uturumæ̆da paḷāta",
    "8" => "Ūva paḷāta",
    "44" => "Vavuniyāva",
    "6" => "Vayamba paḷāta",
    "41" => "Yāpanaya"
)),

'SE' => array( 'name' => 'Sweden', 'states' => array(
    "K" => "Blekinge län [SE-10]",
    "W" => "Dalarnas län [SE-20]",
    "X" => "Gävleborgs län [SE-21]",
    "I" => "Gotlands län [SE-09]",
    "N" => "Hallands län [SE-13]",
    "Z" => "Jämtlands län [SE-23]",
    "F" => "Jönköpings län [SE-06]",
    "H" => "Kalmar län [SE-08]",
    "G" => "Kronobergs län [SE-07]",
    "BD"=> "Norrbottens län [SE-25]",
    "T" => "Örebro län [SE-18]",
    "E" => "Östergötlands län [SE-05]",
    "M" => "Skåne län [SE-12]",
    "D" => "Södermanlands län [SE-04]",
    "AB"=> "Stockholms län [SE-01]",
    "C" => "Uppsala län [SE-03]",
    "S" => "Värmlands län [SE-17]",
    "AC"=> "Västerbottens län [SE-24]",
    "Y" => "Västernorrlands län [SE-22]",
    "U" => "Västmanlands län [SE-19]",
    "O" => "Västra Götalands län [SE-14]"
)),
'CH' => array( 'name' => 'Switzerland', 'states' => array(
    "AG" => "Aargau",
    "AR" => "Appenzell Ausserrhoden",
    "AI" => "Appenzell Innerrhoden",
    "BL" => "Basel-Landschaft",
    "BS" => "Basel-Stadt",
    "BE" => "Bern",
    "FR" => "Fribourg",
    "GE" => "Genève",
    "GL" => "Glarus",
    "GR" => "Graubünden",
    "JU" => "Jura",
    "LU" => "Luzern",
    "NE" => "Neuchâtel",
    "NW" => "Nidwalden",
    "OW" => "Obwalden",
    "SG" => "Sankt Gallen",
    "SH" => "Schaffhausen",
    "SZ" => "Schwyz",
    "SO" => "Solothurn",
    "TG" => "Thurgau",
    "TI" => "Ticino",
    "UR" => "Uri",
    "VS" => "Valais",
    "VD" => "Vaud",
    "ZG" => "Zug",
    "ZH" => "Zürich"
)),

'TJ' => array( 'name' => 'Tajikistan', 'states' => array(
    "GB" => "Gorno-Badakhshan",
    "KT" => "Khatlon",
    "SU" => "Sughd"
)),
'TH' => array( 'name' => 'Thailand', 'states' => array(
    "37" => "Amnat Charoen",
    "15" => "Ang Thong",
    "31" => "Buri Ram",
    "24" => "Chachoengsao",
    "18" => "Chai Nat",
    "36" => "Chaiyaphum",
    "22" => "Chanthaburi",
    "50" => "Chiang Mai",
    "57" => "Chiang Rai",
    "20" => "Chon Buri",
    "86" => "Chumphon",
    "46" => "Kalasin",
    "62" => "Kamphaeng Phet",
    "71" => "Kanchanaburi",
    "40" => "Khon Kaen",
    "81" => "Krabi",
    "10" => "Krung Thep Maha Nakhon [Bangkok]",
    "52" => "Lampang",
    "51" => "Lamphun",
    "42" => "Loei",
    "16" => "Lop Buri",
    "58" => "Mae Hong Son",
    "44" => "Maha Sarakham",
    "49" => "Mukdahan",
    "26" => "Nakhon Nayok",
    "73" => "Nakhon Pathom",
    "48" => "Nakhon Phanom",
    "30" => "Nakhon Ratchasima",
    "60" => "Nakhon Sawan",
    "80" => "Nakhon Si Thammarat",
    "55" => "Nan",
    "96" => "Narathiwat",
    "39" => "Nong Bua Lam Phu",
    "43" => "Nong Khai",
    "12" => "Nonthaburi",
    "13" => "Pathum Thani",
    "94" => "Pattani",
    "82" => "Phangnga",
    "93" => "Phatthalung",
    "S"  => "hatthaya",
    "56" => "Phayao",
    "67" => "Phetchabun",
    "76" => "Phetchaburi",
    "66" => "Phichit",
    "65" => "Phitsanulok",
    "14" => "Phra Nakhon Si Ayutthaya",
    "54" => "Phrae",
    "83" => "Phuket",
    "25" => "Prachin Buri",
    "77" => "Prachuap Khiri Khan",
    "85" => "Ranong",
    "70" => "Ratchaburi",
    "21" => "Rayong",
    "45" => "Roi Et",
    "27" => "Sa Kaeo",
    "47" => "Sakon Nakhon",
    "11" => "Samut Prakan",
    "74" => "Samut Sakhon",
    "75" => "Samut Songkhram",
    "19" => "Saraburi",
    "91" => "Satun",
    "33" => "Si Sa Ket",
    "17" => "Sing Buri",
    "90" => "Songkhla",
    "64" => "Sukhothai",
    "72" => "Suphan Buri",
    "84" => "Surat Thani",
    "32" => "Surin",
    "63" => "Tak",
    "92" => "Trang",
    "23" => "Trat",
    "34" => "Ubon Ratchathani",
    "41" => "Udon Thani",
    "61" => "Uthai Thani",
    "53" => "Uttaradit",
    "95" => "Yala",
    "35" => "Yasothon"
)),

'TT' => array( 'name' => 'Trinidad And Tobago', 'states' => array(
    "ARI" => "Arima",
    "CHA" => "Chaguanas",
    "CTT" => "Couva-Tabaquite-Talparo",
    "DMN" => "Diego Martin",
    "ETO" => "Eastern Tobago",
    "PED" => "Penal-Debe",
    "PTF" => "Point Fortin",
    "POS" => "Port of Spain",
    "PRT" => "Princes Town",
    "RCM" => "Rio Claro-Mayaro",
    "SFO" => "San Fernando",
    "SJL" => "San Juan-Laventille",
    "SGE" => "Sangre Grande",
    "SIP" => "Siparia",
    "TUP" => "Tunapuna-Piarco",
    "WTO" => "Western Tobago"
)),

'TR' => array( 'name' => 'Turkey', 'states' => array(
    "01" => "Adana",
    "02" => "Adiyaman",
    "03" => "Afyonkarahisar",
    "04" => "Agri",
    "68" => "Aksaray",
    "05" => "Amasya",
    "06" => "Ankara",
    "07" => "Antalya",
    "75" => "Ardahan",
    "08" => "Artvin",
    "09" => "Aydin",
    "10" => "Balikesir",
    "74" => "Bartin",
    "72" => "Batman",
    "69" => "Bayburt",
    "11" => "Bilecik",
    "12" => "Bingöl",
    "13" => "Bitlis",
    "14" => "Bolu",
    "15" => "Burdur",
    "16" => "Bursa",
    "17" => "Çanakkale",
    "18" => "Çankiri",
    "19" => "Çorum",
    "20" => "Denizli",
    "21" => "Diyarbakir",
    "81" => "Düzce",
    "22" => "Edirne",
    "23" => "Elazig",
    "24" => "Erzincan",
    "25" => "Erzurum",
    "26" => "Eskisehir",
    "27" => "Gaziantep",
    "28" => "Giresun",
    "29" => "Gümüshane",
    "30" => "Hakkâri",
    "31" => "Hatay",
    "76" => "Igdir",
    "32" => "Isparta",
    "34" => "Istanbul",
    "35" => "Izmir",
    "46" => "Kahramanmaras",
    "78" => "Karabük",
    "70" => "Karaman",
    "36" => "Kars",
    "37" => "Kastamonu",
    "38" => "Kayseri",
    "79" => "Kilis",
    "71" => "Kirikkale",
    "39" => "Kirklareli",
    "40" => "Kirsehir",
    "41" => "Kocaeli",
    "42" => "Konya",
    "43" => "Kütahya",
    "44" => "Malatya",
    "45" => "Manisa",
    "47" => "Mardin",
    "33" => "Mersin",
    "48" => "Mugla",
    "49" => "Mus",
    "50" => "Nevsehir",
    "51" => "Nigde",
    "52" => "Ordu",
    "80" => "Osmaniye",
    "53" => "Rize",
    "54" => "Sakarya",
    "55" => "Samsun",
    "63" => "Sanliurfa",
    "56" => "Siirt",
    "57" => "Sinop",
    "73" => "Sirnak",
    "58" => "Sivas",
    "59" => "Tekirdag",
    "60" => "Tokat",
    "61" => "Trabzon",
    "62" => "Tunceli",
    "64" => "Usak",
    "65" => "Van",
    "77" => "Yalova",
    "66" => "Yozgat",
    "67" => "Zonguldak"
)),

'UA' => array( 'name' => 'Ukraine', 'states' => array(
    "71" => "Cherkas'ka Oblast'",
    "74" => "Chernihivs'ka Oblast'",
    "77" => "Chernivets'ka Oblast'",
    "12" => "Dnipropetrovs'ka Oblast'",
    "14" => "Donets'ka Oblast'",
    "26" => "Ivano-Frankivs'ka Oblast'",
    "63" => "Kharkivs'ka Oblast'",
    "65" => "Khersons'ka Oblast'",
    "68" => "Khmel'nyts'ka Oblast'",
    "35" => "Kirovohrads'ka Oblast'",
    "30" => "Kyïv",
    "32" => "Kyïvs'ka Oblast'",
    "09" => "Luhans'ka Oblast'",
    "46" => "L'vivs'ka Oblast'",
    "48" => "Mykolaïvs'ka Oblast'",
    "51" => "Odes'ka Oblast'",
    "53" => "Poltavs'ka Oblast'",
    "43" => "Respublika Krym",
    "56" => "Rivnens'ka Oblast'",
    "40" => "Sevastopol'",
    "59" => "Sums'ka Oblast'",
    "61" => "Ternopil's'ka Oblast'",
    "05" => "Vinnyts'ka Oblast'",
    "07" => "Volyns'ka Oblast'",
    "21" => "Zakarpats'ka Oblast'",
    "23" => "Zaporiz'ka Oblast'",
    "18" => "Zhytomyrs'ka Oblast'"
)),
'AE' => array( 'name' => 'United Arab Emirates', 'states' => array(
    "AZ" => "Abu Z¸aby [Abu Dhabi]",
    "AJ" => "Ajman",
    "FU" => "Al Fujayrah",
    "SH" => "Ash Shariqah [Sharjah]",
    "DU" => "Dubayy [Dubai]",
    "RK" => "Ra’s al Khaymah",
    "UQ" => "Umm al Qaywayn"
)),
'GB' => array( 'name' => 'United Kingdom', 'states' => array(
    "ABE" => "Aberdeen City",
    "ABD" => "Aberdeenshire",
    "ANS" => "Angus",
    "ANT" => "Antrim",
    "ARD" => "Ards",
    "AGB" => "Argyll and Bute",
    "ARM" => "Armagh",
    "BLA" => "Ballymena",
    "BLY" => "Ballymoney",
    "BNB" => "Banbridge",
    "BDG" => "Barking and Dagenham",
    "BNE" => "Barnet",
    "BNS" => "Barnsley",
    "BAS" => "Bath and North East Somerset",
    "BDF" => "Bedfordshire",
    "BFS" => "Belfast",
    "BEX" => "Bexley",
    "BIR" => "Birmingham",
    "BBD" => "Blackburn with Darwen",
    "BPL" => "Blackpool",
    "BGW" => "Blaenau Gwent",
    "BOL" => "Bolton",
    "BMH" => "Bournemouth",
    "BRC" => "Bracknell Forest",
    "BRD" => "Bradford",
    "BEN" => "Brent",
    "BGE" => "Bridgend [Pen-y-bont ar Ogwr GB-POG]",
    "BNH" => "Brighton and Hove",
    "BST" => "Bristol, City of",
    "BRY" => "Bromley",
    "BKM" => "Buckinghamshire",
    "BUR" => "Bury",
    "CAY" => "Caerphilly [Caerffili GB-CAF]",
    "CLD" => "Calderdale",
    "CAM" => "Cambridgeshire",
    "CMD" => "Camden",
    "CRF" => "Cardiff [Caerdydd GB-CRD]",
    "CMN" => "Carmarthenshire [Sir Gaerfyrddin GB-GFY]",
    "CKF" => "Carrickfergus",
    "CSR" => "Castlereagh",
    "CGN" => "Ceredigion [Sir Ceredigion]",
    "CHS" => "Cheshire",
    "CLK" => "Clackmannanshire",
    "CLR" => "Coleraine",
    "CWY" => "Conwy",
    "CKT" => "Cookstown",
    "CON" => "Cornwall",
    "COV" => "Coventry",
    "CGV" => "Craigavon",
    "CRY" => "Croydon",
    "CMA" => "Cumbria",
    "DAL" => "Darlington",
    "DEN" => "Denbighshire [Sir Ddinbych GB-DDB]",
    "DER" => "Derby",
    "DBY" => "Derbyshire",
    "DRY" => "Derry",
    "DEV" => "Devon",
    "DNC" => "Doncaster",
    "DOR" => "Dorset",
    "DOW" => "Down",
    "DUD" => "Dudley",
    "DGY" => "Dumfries and Galloway",
    "DND" => "Dundee City",
    "DGN" => "Dungannon and South Tyrone",
    "DUR" => "Durham",
    "EAL" => "Ealing",
    "EAY" => "East Ayrshire",
    "EDU" => "East Dunbartonshire",
    "ELN" => "East Lothian",
    "ERW" => "East Renfrewshire",
    "ERY" => "East Riding of Yorkshire",
    "ESX" => "East Sussex",
    "EDH" => "Edinburgh, City of",
    "ELS" => "Eilean Siar",
    "ENF" => "Enfield",
    "ENG" => "England",
    "ESS" => "Essex",
    "FAL" => "Falkirk",
    "FER" => "Fermanagh",
    "FIF" => "Fife",
    "FLN" => "Flintshire [Sir y Fflint GB-FFL]",
    "GAT" => "Gateshead",
    "GLG" => "Glasgow City",
    "GLS" => "Gloucestershire",
    "GRE" => "Greenwich",
    "GWN" => "Gwynedd",
    "HCK" => "Hackney",
    "HAL" => "Halton",
    "HMF" => "Hammersmith and Fulham",
    "HAM" => "Hampshire",
    "HRY" => "Haringey",
    "HRW" => "Harrow",
    "HPL" => "Hartlepool",
    "HAV" => "Havering",
    "HEF" => "Herefordshire, County of",
    "HRT" => "Hertfordshire",
    "HLD" => "Highland",
    "HIL" => "Hillingdon",
    "HNS" => "Hounslow",
    "IVC" => "Inverclyde",
    "AGY" => "Isle of Anglesey [Sir Ynys Môn GB-YNM]",
    "IOW" => "Isle of Wight",
    "IOS" => "Isles of Scilly",
    "ISL" => "Islington",
    "KEC" => "Kensington and Chelsea",
    "KEN" => "Kent",
    "KHL" => "Kingston upon Hull, City of",
    "KTT" => "Kingston upon Thames",
    "KIR" => "Kirklees",
    "KWL" => "Knowsley",
    "LBH" => "Lambeth",
    "LAN" => "Lancashire",
    "LRN" => "Larne",
    "LDS" => "Leeds",
    "LCE" => "Leicester",
    "LEC" => "Leicestershire",
    "LEW" => "Lewisham",
    "LMV" => "Limavady",
    "LIN" => "Lincolnshire",
    "LSB" => "Lisburn",
    "LIV" => "Liverpool",
    "LND" => "London, City of",
    "LUT" => "Luton",
    "MFT" => "Magherafelt",
    "MAN" => "Manchester",
    "MDW" => "Medway",
    "MTY" => "Merthyr Tydfil [Merthyr Tudful GB-MTU]",
    "MRT" => "Merton",
    "MDB" => "Middlesbrough",
    "MLN" => "Midlothian",
    "MIK" => "Milton Keynes",
    "MON" => "Monmouthshire [Sir Fynwy GB-FYN]",
    "MRY" => "Moray",
    "MYL" => "Moyle",
    "NTL" => "Neath Port Talbot [Castell-nedd Port Talbot GB-CTL]",
    "NET" => "Newcastle upon Tyne",
    "NWM" => "Newham",
    "NWP" => "Newport [Casnewydd GB-CNW]",
    "NYM" => "Newry and Mourne",
    "NTA" => "Newtownabbey",
    "NFK" => "Norfolk",
    "NAY" => "North Ayrshire",
    "NDN" => "North Down",
    "NEL" => "North East Lincolnshire",
    "NLK" => "North Lanarkshire",
    "NLN" => "North Lincolnshire",
    "NSM" => "North Somerset",
    "NTY" => "North Tyneside",
    "NYK" => "North Yorkshire",
    "NTH" => "Northamptonshire",
    "NIR" => "Northern Ireland",
    "NBL" => "Northumberland",
    "NGM" => "Nottingham",
    "NTT" => "Nottinghamshire",
    "OLD" => "Oldham",
    "OMH" => "Omagh",
    "ORK" => "Orkney Islands",
    "OXF" => "Oxfordshire",
    "PEM" => "Pembrokeshire [Sir Benfro GB-BNF]",
    "PKN" => "Perth and Kinross",
    "PTE" => "Peterborough",
    "PLY" => "Plymouth",
    "POL" => "Poole",
    "POR" => "Portsmouth",
    "POW" => "Powys",
    "RDG" => "Reading",
    "RDB" => "Redbridge",
    "RCC" => "Redcar and Cleveland",
    "RFW" => "Renfrewshire",
    "RCT" => "Rhondda, Cynon, Taff [Rhondda, Cynon,Taf]",
    "RIC" => "Richmond upon Thames",
    "RCH" => "Rochdale",
    "ROT" => "Rotherham",
    "RUT" => "Rutland",
    "SLF" => "Salford",
    "SAW" => "Sandwell",
    "SCT" => "Scotland",
    "SCB" => "Scottish Borders, The",
    "SFT" => "Sefton",
    "SHF" => "Sheffield",
    "ZET" => "Shetland Islands",
    "SHR" => "Shropshire",
    "SLG" => "Slough",
    "SOL" => "Solihull",
    "SOM" => "Somerset",
    "SAY" => "South Ayrshire",
    "SGC" => "South Gloucestershire",
    "SLK" => "South Lanarkshire",
    "STY" => "South Tyneside",
    "STH" => "Southampton",
    "SOS" => "Southend-on-Sea",
    "SWK" => "Southwark",
    "SHN" => "St. Helens",
    "STS" => "Staffordshire",
    "STG" => "Stirling",
    "SKP" => "Stockport",
    "STT" => "Stockton-on-Tees",
    "STE" => "Stoke-on-Trent",
    "STB" => "Strabane",
    "SFK" => "Suffolk",
    "SND" => "Sunderland",
    "SRY" => "Surrey",
    "STN" => "Sutton",
    "SWA" => "Swansea [Abertawe GB-ATA]",
    "SWD" => "Swindon",
    "TAM" => "Tameside",
    "TFW" => "Telford and Wrekin",
    "THR" => "Thurrock",
    "TOB" => "Torbay",
    "TOF" => "Torfaen [Tor-faen]",
    "TWH" => "Tower Hamlets",
    "TRF" => "Trafford",
    "VGL" => "Vale of Glamorgan, The [Bro Morgannwg GB-BMG]",
    "WKF" => "Wakefield",
    "WLS" => "Wales",
    "WLL" => "Walsall",
    "WFT" => "Waltham Forest",
    "WND" => "Wandsworth",
    "WRT" => "Warrington",
    "WAR" => "Warwickshire",
    "WBK" => "West Berkshire",
    "WDU" => "West Dunbartonshire",
    "WLN" => "West Lothian",
    "WSX" => "West Sussex",
    "WSM" => "Westminster",
    "WGN" => "Wigan",
    "WIL" => "Wiltshire",
    "WNM" => "Windsor and Maidenhead",
    "WRL" => "Wirral",
    "WOK" => "Wokingham",
    "WLV" => "Wolverhampton",
    "WOR" => "Worcestershire",
    "WRX" => "Wrexham [Wrecsam GB-WRC]",
    "YOR" => "York"
)),
'US' => array( 'name' => 'United States', 'states' => array(
    'AL' => 'Alabama',
    'AK' => 'Alaska',
    'AS' => 'American Samoa',
    'AZ' => 'Arizona',
    'AR' => 'Arkansas',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DE' => 'Delaware', 'DC' => 'District of Columbia', 'FL' => 'Florida',
    'GA' => 'Georgia', 'DC' => 'District of Columbia',
    'FM' => 'Federated States of Micronesia',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'GU' => 'Guam',
    'HI' => 'Hawaii',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'IA' => 'Iowa',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'ME' => 'Maine',
    'MH' => 'Marshall Islands',
    'MD' => 'Maryland',
    'MA' => 'Massachusetts',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MS' => 'Mississippi',
    'MO' => 'Missouri',
    'MT' => 'Montana',
    'NE' => 'Nebraska',
    'NV' => 'Nevada',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NY' => 'New York',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'PR' => 'Puerto Rico',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VT' => 'Vermont',
    'VI' => 'Virgin Islands',
    'VA' => 'Virginia',
    'WA' => 'Washington',
    'WV' => 'West Virginia',
    'WI' => 'Wisconsin',
    'WY' => 'Wyoming',
    'MN' => 'Minnesota',
    'MP' => 'Northern Mariana Islands'
)),

'VE' => array( 'name' => 'Venezuela', 'states' => array(
    "Z" => "Amazonas",
    "B" => "Anzoátegui",
    "C" => "Apure",
    "D" => "Aragua",
    "E" => "Barinas",
    "F" => "Bolívar",
    "G" => "Carabobo",
    "H" => "Cojedes",
    "Y" => "Delta Amacuro",
    "W" => "Dependencias Federales",
    "A" => "Distrito Federal",
    "I" => "Falcón",
    "J" => "Guárico",
    "K" => "Lara",
    "L" => "Mérida",
    "M" => "Miranda",
    "N" => "Monagas",
    "O" => "Nueva Esparta",
    "P" => "Portuguesa",
    "R" => "Sucre",
    "S" => "Táchira",
    "T" => "Trujillo",
    "X" => "Vargas",
    "U" => "Yaracuy",
    "V" => "Zulia"
)),
'VN' => array( 'name' => 'Viet Nam', 'states' => array(
    "44" => "An Giang",
    "43" => "Ba Ria-Vung Tau",
    "53" => "Bac Can",
    "54" => "Bac Giang",
    "55" => "Bac Lieu",
    "56" => "Bac Ninh",
    "50" => "Ben Tre",
    "31" => "Binh Dinh",
    "57" => "Binh Duong",
    "58" => "Binh Phuoc",
    "40" => "Binh Thuan",
    "59" => "Ca Mau",
    "CT" => "Can Tho",
    "04" => "Cao Bang",
    "DN" => "Da Nang",
    "33" => "Dac Lac",
    "72" => "Dak Nong",
    "71" => "Dien Bien",
    "39" => "Dong Nai",
    "45" => "Dong Thap",
    "30" => "Gia Lai",
    "03" => "Ha Giang",
    "63" => "Ha Nam",
    "HN" => "Ha Noi",
    "15" => "Ha Tay",
    "23" => "Ha Tinh",
    "61" => "Hai Duong",
    "HP" => "Hai Phong",
    "73" => "Hau Giang",
    "SG" => "Ho Chi Minh [Sai Gon]",
    "14" => "Hoa Binh",
    "66" => "Hung Yen",
    "34" => "Khanh Hoa",
    "47" => "Kien Giang",
    "28" => "Kon Tum",
    "01" => "Lai Chau",
    "35" => "Lam Dong",
    "09" => "Lang Son",
    "02" => "Lao Cai",
    "41" => "Long An",
    "67" => "Nam Dinh",
    "22" => "Nghe An",
    "18" => "Ninh Binh",
    "36" => "Ninh Thuan",
    "68" => "Phu Tho",
    "32" => "Phu Yen",
    "24" => "Quang Binh",
    "27" => "Quang Nam",
    "29" => "Quang Ngai",
    "13" => "Quang Ninh",
    "25" => "Quang Tri",
    "52" => "Soc Trang",
    "05" => "Son La",
    "37" => "Tay Ninh",
    "20" => "Thai Binh",
    "69" => "Thai Nguyen",
    "21" => "Thanh Hoa",
    "26" => "Thua Thien-Hue",
    "46" => "Tien Giang",
    "51" => "Tra Vinh",
    "07" => "Tuyen Quang",
    "49" => "Vinh Long",
    "70" => "Vinh Phuc",
    "06" => "Yen Bai"
)),

);

public static function getCountryLists() {
    $countryLists = [];

    foreach (self::$countries as $key => $country ) {
        $countryLists[$key] = self::$countries[$key]['name'];
    }

    return $countryLists;
}

public static function getCountryName($code) { 
    return self::$countries[$code]['name'];
}

public static function getStateLists($country_code = 'US') {
    $stateLists = [];

    $countries = self::$countries;

    if( ! array_key_exists($country_code, $countries) ) {
        $stateLists['null'] = "Selected countries can't be found!";
        return $stateLists;
    }

    if( count(self::$countries[$country_code]['states']) < 1 ) {
        $stateLists['null'] = "Select a country first!";
        return $stateLists;
    }

    $states = $countries[$country_code]['states'];

    return $states;

}

public static function getStateName($country_code, $state) {
  if( !$country_code )
    $stateName = "Select a country first!";
else if( !$state )
    $stateName = "Select a state first!";
else{
 $countries = self::$countries;
 if( ! array_key_exists($country_code, $countries) ) 
    $stateName = "Selected countries can't be found!";

else if(array_key_exists($state, $countries[$country_code]['states']))
    $stateName = $countries[$country_code]['states'][$state];

else
    $stateName = "";

			/*else if( count(self::$countries[$country_code]['states']) < 1 ) 
				$stateName = "Select a country first!";
	
			else
            $stateName = $countries[$country_code]['states'][$state];*/
        }

        return $stateName;

    }
}


?>
