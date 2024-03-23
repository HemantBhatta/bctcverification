<?php
require __DIR__ . '/vendor/autoload.php';

//Reading data from spreadsheet.

$client = new \Google_Client();

$client->setApplicationName('Google Sheets and PHP');

$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

$client->setAccessType('offline');

$client->setAuthConfig(__DIR__ . '/credentials.json');

$service = new Google_Service_Sheets($client);



$spreadsheetId = "1HSG1SbJPgPlqV2apL7J5853hLSEMIOzcjxVBbGZU8Jg"; 

$headers = array('Date', 'Mesh', 'Brish', 'Mithun', 'Karkat', 'Singha','Kanya','Tulaa' , 'Brishchik', 'Dhanu', 'Makar', 'Kumbha', 'Min');
update_rashifal_daily();

function update_rashifal_daily(){
    global $service ;
    global $spreadsheetId ;
    global $headers ;
    $response = $service->spreadsheets_values->get($spreadsheetId,"Sheet1");

    $values = $response->getValues();
    
    $currentDate = date('n/d/Y');
    
    if($values){
        $rashifal_values = array_slice($values,1);
    }
    
    $sorted_rashifals = array();

    if($rashifal_values){

        foreach($rashifal_values as $rashi_key=>$rashi_value){
        
            $single_rashifal = array();
        
            if($rashi_value[0] != $currentDate){
                continue;
            }
        
            foreach($headers as $key =>$hd){
                if(empty($rashi_value[$key])){
                    continue;
                }
                $single_rashifal[$hd] =  $rashi_value[$key];
            }
        
            $sorted_rashifals[$rashi_key] = $single_rashifal;
        
            
        
        }
        
        foreach($headers as $head_key=>$head_value){
            
            if($head_key == 0){
                continue;
            }
        
            $rashi_data = get_page_by_path(strtolower($head_value));
        
            if(!empty($rashi_data)){
                $rashi_id = $rashi_data ->ID;
            
                $updated_page = array(
                    'ID'           => $rashi_id,
                    'post_content' => array_values($sorted_rashifals)[0][$head_value],
                );
            
                $updated_post_value = wp_update_post( $updated_page );
            
                if(empty($updated_post_value || is_wp_error($updated_post_value))){
                    update_rashifal_daily();
                }
            }
            
        
        }
    }
    
    
}



 







