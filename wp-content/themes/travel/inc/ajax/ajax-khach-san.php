<?php
add_action("wp_ajax_add_type_room", "add_type_room");
add_action("wp_ajax_nopriv_add_type_room", "add_type_room");

function add_type_room() {
    $data_id = $_POST['data_id'];
    $room_name_ks = $_POST['room_name_ks'];
    $date_price_ks = $_POST['date_price_ks'];
    $price_ks = $_POST['price_ks'];

    $emergency_contact = array('room_name' => $EMERGENCY_CONTACT_FULL_NAME,
        'date' => $EMERGENCY_CONTACT_RELATIONSHIP,
        'price' => $EMERGENCY_CONTACT_CONTACT_PHONE

    );
    update_field('typeroom', $emergency_contact, $theId);

    //wp_send_json_success('');
    die();
}
