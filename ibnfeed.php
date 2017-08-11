<?php
/*
Plugin Name: itsbooked.net feed reader
Description: Plugin that allows you to embed XML feed of sessions published from itsbooked.net
Version: 0.3
Author: Alex North
Author URI: http://itsbooked.net/
*/

function ibn_feeds($content) {

	$inputTag = preg_match_all('/\[ibnfeed (.+)\]/', $content, $tags);
	
	foreach ($tags[1] as $tagNum => $tag) {
		$rawArgs = explode(',', $tag);
		
		// Parse the arguments
		foreach($rawArgs as $input) {
			preg_match_all('/^(ibn_site|camp_type|location|button_definition)=(.+)$/i', $input, $matches);
			$key = $matches[1][0];
			$value = $matches[2][0];
			$$key = $value;	
		}
	  $url = "http://secure.itsbooked.net/"; 
	  $booking_url = "https://secure.itsbooked.net/";
	  $booking_url_end = "/bookings/index.php?action=booksession&amp;session_id=";    
		if ($ibn_site) {
		    $url = $url . $ibn_site . "/news/sessionfeed.php";
		    $booking_url = $booking_url . $ibn_site . $booking_url_end;
        if (isset($camp_type)){
	        $url = $url . "?feed=".$camp_type;
	      }
	      if (isset($location)){
	      	if (isset($camp_type)){
	      	  $url = $url . "&location=".$location;	
	      	} else {
	      	  $url = $url . "?location=".$location;
	      	} 
	      }
	      
	      $ch = curl_init();
	      curl_setopt($ch, CURLOPT_URL, $url);
	      curl_setopt($ch, CURLOPT_HEADER, false);
	      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	      $xml = curl_exec($ch);
	      curl_close($ch);
	      
	      $feed = ibn_produce_XML_object_tree($xml);
	
			// now we can create some formatted output
				$htmlToAdd = '';
				foreach ($feed->session as $session){
				  $session_type = (string)$session->session_type;
				  $session_type_description = (string)$session->session_type_description;
				  $session_description = (string)$session->session_description;
				  $session_location = (string)$session->session_location;
				  $session_start = (string)$session->start;
				  $session_start_timezone = (string)$session->start->attributes()->timezone;
				  $session_end = (string)$session->end;
				  $session_end_sameday = (string)$session->end->attributes()->sameday;
				  $session_end_timezone = (string)$session->end->attributes()->timezone;  
				  $session_max_places = (string)$session->max_places;
				  $session_availability = (int)$session->availability;
				  $session_id = (string)$session->session_id;
				  $dt_start = date_create_from_format('Y-m-d H:i:s', $session_start);
				  $dt_end = date_create_from_format('Y-m-d H:i:s', $session_end);
  
				  include("ibnfeed_output.php");
				
				}
			  // end formatted output				
			$content = preg_replace('/' . preg_quote($tags[0][$tagNum], '/') . '/', $htmlToAdd, $content);
		  }		
	}
	return $content;
}

function ibn_produce_XML_object_tree($raw_XML) {
    libxml_use_internal_errors(true);
    try {
        $xmlTree = new SimpleXMLElement($raw_XML);
    } catch (Exception $e) {
        // Something went wrong.
        $error_message = 'SimpleXMLElement threw an exception.';
        foreach(libxml_get_errors() as $error_line) {
            $error_message .= "\t" . $error_line->message;
        }
        trigger_error($error_message);
        return false;
    }
    return $xmlTree;
}

add_filter('the_content', 'ibn_feeds');
?>