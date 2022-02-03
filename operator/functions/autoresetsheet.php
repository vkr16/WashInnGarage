<?php
function autoreset($spreadsheetId, $sheetname)
{
    global $service;
    $response = $service->spreadsheets_values->get($spreadsheetId, $sheetname . "!C1");
    echo '<pre>', var_export($response, true), '</pre>', "\n";

    $monthOnSheet =  $response['values']['0']['0'];
    if ($monthOnSheet != date("F")) {
        $requestBody = new Google_Service_Sheets_ClearValuesRequest();
        $response = $service->spreadsheets_values->clear($spreadsheetId, $sheetname . "!A3:P500", $requestBody);
    }
}
