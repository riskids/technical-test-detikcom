<?php
include_once './src/controllers/TicketController.php';
$lib = new TicketController();

$event_id = $argv[1] ?? null;
$total_ticket = $argv[2] ?? null;

$result = $lib->create($event_id, $total_ticket);
print_r($result);
