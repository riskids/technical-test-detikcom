<?php

function generateTicketCode($event_id) {
    $prefix = "DTK" . str_pad($event_id, 2, '0', STR_PAD_LEFT);
    $random_string = strtoupper(substr(bin2hex(random_bytes(7)), 0, 7));
    return $prefix . $random_string;
}