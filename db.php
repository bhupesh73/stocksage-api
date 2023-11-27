<?php

$myPDO = new PDO('sqlite:company_data1.db');
$response = array();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $myPDO->query("SELECT * FROM company_data");

    if ($result) {
        header("Content-Type: application/json");

        
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $i => $row) {
            $response[$i]['Symbol'] = $row['Symbol'];
            $response[$i]['AsOn'] = $row['AsOn'];
            $response[$i]['CompanyPrice'] = $row['CompanyPrice'];
            $response[$i]['CompanyRatio'] = $row['CompanyRatio'];
            $response[$i]['CompanyPercent'] = $row['CompanyPercent'];
            $response[$i]['Open'] = $row['Open'];
            $response[$i]['High'] = $row['High'];
            $response[$i]['Low'] = $row['Low'];
            $response[$i]['Volume'] = $row['Volume'];
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['error' => 'Failed to retrieve data'], JSON_PRETTY_PRINT);
    }
} else {
    
    http_response_code(405); 
    echo json_encode(['error' => 'Method not allowed'], JSON_PRETTY_PRINT);
}
