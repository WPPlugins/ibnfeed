<?php
// ibnfeed_output.php
// from v0.2 of ibnfeed, this area is split out from the main plugin
// keeping user customisation separate, making it easier to take updates in the future.

$session_start_date_ft = $dt_start->format('d/m/Y');
$session_start_time_ft = $dt_start->format('H:i');
$session_end_date_ft = $dt_end->format('d/m/Y');
$session_end_time_ft = $dt_end->format('H:i');

// the following variables are available for use:
// $session_type - string
// $session_type_description - string
// $session_location - string
// $session_start - string
// $session_start_timezone - string
// $session_start_date_ft - string
// $session_start_time_ft - string
// $session_end - string 
// $session_end_timezone - string
// $sesion_end_date_ft - string
// $session_end_time_ft - string
// $session_end_sameday - string
// $session_max_places - string
// $session_availability - int
// $session_id - string

  
$htmlToAdd .= "<a href='$booking_url$session_id'>$session_description $session_start_date_ft</a><br/>\n";

?>