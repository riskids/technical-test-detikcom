<?php
include_once './src/utils/autoload.php';
include_once './src/utils/helpers.php';

class TicketController
{
    public function __construct()
    {
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $dbname = env('DB_NAME');

        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

    public function create($event_id = null, $total_ticket = null)
    {
        $status = 'available';
        
        if (isset($event_id) && isset($total_ticket)) {
            $this->db->beginTransaction();

            try {
                $query = 'INSERT INTO ticket (ticket_code, event_id, status) VALUES ';
                $values = array();

                for ($i = 0; $i < $total_ticket; $i++) {
                    $ticket_code = generateTicketCode($event_id);
                    $values[] = "('$ticket_code', $event_id, '$status')";
                }

                $query .= implode(',', $values);
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $this->db->commit();

                $rowCount = $stmt->rowCount();
                if ($rowCount !== 0) {
                    return 'Insert data success!. ' . $rowCount . ' ticket created';
                } else {
                    return 'Insert data failed!';
                }
            } catch (PDOException $e) {
                $this->db->rollback();
                return 'Error: ' . $e->getMessage();
            }
        } else {
            return "Params missing!";
        }
    }


    public function getById($param)
    {
        if (isset($param['event_id']) && isset($param['ticket_code'])) {
            $query = $this->db->prepare(
                "SELECT ticket_code, `status`
                FROM ticket where event_id=? and ticket_code=?"
            );

            $query->bindParam(1, $param['event_id']);
            $query->bindParam(2, $param['ticket_code']);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');

            return json_encode(array(
                'data' => $data ? $data : null,
                'message' => null
            ));
        } else {
            http_response_code(400);
            return json_encode(array(
                'data' => false,
                'message' => 'query param event_id & ticket_code is required!'
            ));
        }
    }

    public function update($param)
    {
        $event_id = $param['event_id'];
        $ticket_code = $param['ticket_code'];
        $status = $param['status'];

        if (isset($event_id) && isset($ticket_code) && isset($status)) {
            if (!($status == "available" || $status == "claimed")) {
                http_response_code(400);
                return json_encode(array(
                    'data' => null,
                    'message' => "status only available or claimed"
                ));
            }

            $this->db->beginTransaction();
            try {
                $query = $this->db->prepare("UPDATE ticket set `status`= '$status' where `event_id` = '$event_id' AND `ticket_code` = '$ticket_code'");
                $query->execute();
                $this->db->commit();

                $rowCount = $query->rowCount();
                if ($rowCount !== 0) {
                    $query = $this->db->prepare(
                        "SELECT ticket_code, `status`, updated_at
                        FROM ticket where event_id=? and ticket_code=?"
                    );
        
                    $query->bindParam(1, $event_id);
                    $query->bindParam(2, $ticket_code);
                    $query->execute();
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    header('Content-Type: application/json');
        
                    return json_encode(array(
                        'data' => $data ? $data : null,
                        'message' => null
                    ));
                } else {
                    http_response_code(400);
                    return json_encode(array(
                        'data' => null,
                        'message' => "Insert data failed!"
                    ));
                }
            } catch (PDOException $e) {
                $this->db->rollback();
                return 'Error: ' . $e->getMessage();
            }
        } else {
            http_response_code(400);
            return json_encode(array(
                'data' => false,
                'message' => 'query param event_id, status & ticket_code is required!'
            ));
        }
    }
}
