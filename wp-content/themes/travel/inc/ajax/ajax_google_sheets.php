<?php
add_action("wp_ajax_removeSessionAddGoogleSheet", "removeSessionAddGoogleSheet");
add_action("wp_ajax_nopriv_removeSessionAddGoogleSheet", "removeSessionAddGoogleSheet");

function removeSessionAddGoogleSheet() {
    unset($_SESSION['add_google_sheets']);
    die();
}