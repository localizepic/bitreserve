<?php
/**
 * 
 * Bitreserve PHP SDK for Bitreserve API v0
 * 
 * https://developer.bitreserve.org/api/v0/
 * 
 */
 
class BitreserveApi {
    
    // vars
    var $bitreserveUrl;  
    var $requestUrl;
    
    
    function BitreserveApi() {
        
        // do nothing      
    }
    
    
    function setVarUrl($url) {
        $this->bitreserveUrl = $url;
    }  
    

    /**
     * Append necessary parameter for the url request
     */
    private function makeUrl($appendUrl) {
        
        return $this->bitreserveUrl . $appendUrl;
    }
    
    
    /**
     * Authentication
     */
    function Auth() {
         
        // TODO: Not Implemented on server yet        
    }
    
      
    /**
     * Get All Tickers
     */
    function getAllTickers() {
        
        $this->requestUrl = $this->makeUrl('ticker');
        
        return $this->getData();
    }
    
    
    /**
     * Get Tickers for Currency
     */
    function getTickersForCurrency($currency) {
        
        $this->requestUrl = $this->makeUrl('ticker/' . $currency);
        
        return $this->getData();
    }
    
    
    /**
     * List Cards
     */
    function listCards($header_token = array()) {
        
        $this->requestUrl = $this->makeUrl('me/cards');
        
        return $this->getData($header_token);
    }
    
    
    /**
     * Get Card Details
     */
    function getCardDetails($header_token = array(), $cardId = '') {
        
        $this->requestUrl = $this->makeUrl('me/cards/' . $cardId);
        
        return $this->getData($header_token);
    }
    
    
    /**
     * Get data for a given Url and Post params
     */
    private function getData($headers = array(), $post_data = array()) {
        
        $apiURL = $this->requestUrl;
        
        $default_headers = array();
        
        $default_headers[] = 'Content-type: application/x-www-form-urlencoded';
        $default_headers[] = 'User-Agent: bitreserve-php-sdk/v0.1';
        
        $all_headers = array_merge($default_headers, $headers);
        
        
        // CURL setup
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiURL );
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $all_headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, count($post_data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);        
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // just for test don't check cert
        
        $apiResponse = curl_exec($ch);
         
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        
        curl_close($ch);

        return $apiResponse;
          
    }
    
    
}


?>
