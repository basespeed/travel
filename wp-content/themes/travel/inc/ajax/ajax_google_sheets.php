<?php
add_action("wp_ajax_removeSessionAddGoogleSheet", "removeSessionAddGoogleSheet");
add_action("wp_ajax_nopriv_removeSessionAddGoogleSheet", "removeSessionAddGoogleSheet");

function removeSessionAddGoogleSheet() {
    unset($_SESSION['add_google_sheets']);
    unset($_SESSION['edit_google_sheets']);
    unset($_SESSION['cut_google_sheets']);
    unset($_SESSION['number_cup_booking']);
    unset($_SESSION['ses_add_booking']);
    unset($_SESSION['cup_mkb']);
    die();
}