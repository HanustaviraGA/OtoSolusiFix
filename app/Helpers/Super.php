<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\DataTables;

function select_table($queryOrModel){

    if ($queryOrModel instanceof Model) {
        $query = $queryOrModel->newQuery();
    } elseif ($queryOrModel instanceof Builder) {
        $query = $queryOrModel;
    } elseif ($queryOrModel instanceof Collection) {
        if ($queryOrModel->isEmpty()) {
            return DataTables::of($queryOrModel)->make(true);
        }
        $query = $queryOrModel->toQuery();
    } else {
        throw new \InvalidArgumentException('Invalid query or model provided.');
    }

    $table = $query->getModel()->getTable();
    $columns = Schema::getColumnListing($table);

    return DataTables::of($query)
    ->addColumn('no', function ($data) {
        static $count = 1; // Initialize a static counter variable
        $primaryKeyValue = base64_encode(json_encode($data->getKey())); // Assuming the primary key column is named "id"
        return '<td><span>' . $count++ . '.</span><input type="checkbox" name="checkbox" data-record="' . $primaryKeyValue . '" style="display: none;"></td>';
    })
    ->addColumn('action', function ($data) {
        // Add custom action column logic here
    })
    ->rawColumns(['no', 'action']) // Include the new 'no' column in rawColumns
    ->make(true);
}

function loadPage($page, $data = []){
    $view = view($page, $data)->render(); // Render the view as a string
    $base64 = base64_encode($view); // Encode the view as base64
    return response()->json(['base64' => $base64]);
}

function dateformat($tgl){
    if ($tgl != null && $tgl != "" && $tgl != "0000-00-00") {
        $spliting = explode("-", $tgl);
        $bha = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $tanggal = $spliting[2];
        $tahun = $spliting[0];
        $ba = $spliting[1];
        $bh = "";
        foreach ($bha as $key => $value) {
            if ($ba == $key || $ba == "0" . $key) {
                $bh = $value;
            }
        }
        return $tanggal . " " . $bh . " " . $tahun;
    }
}

function monthformat($bulan){
    switch ($bulan) {
        case 1:
            $text = 'Januari';
            break;
        case 2:
            $text = 'Februari';
            break;
        case 3:
            $text = 'Maret';
            break;
        case 4:
            $text = 'April';
            break;
        case 5:
            $text = 'Mei';
            break;
        case 6:
            $text = 'Juni';
            break;
        case 7:
            $text = 'Juli';
            break;
        case 8:
            $text = 'Agustus';
            break;
        case 9:
            $text = 'September';
            break;
        case 10:
            $text = 'Oktober';
            break;
        case 11:
            $text = 'November';
            break;
        case 12:
            $text = 'Desember';
            break;
        default:
            break;
    }
    return $text;
}

function generateCode($prefix = NULL) {
    if($prefix == NULL){
        $prefix = 'RFL';
    }
    $date = date('ymd');
    $suffix = generateSuffix();
    return $prefix . '.' . $date . '.' . $suffix;
}

function generateSuffix() {
    $suffix = '';
    $length = 5; // Desired length of the suffix (5 characters)

    while (strlen($suffix) < $length) {
        $randType = rand(0, 2); // Randomly choose 0 for letter, 1 for number, 2 for alphanumeric

        if ($randType === 0) {
            $suffix .= chr(rand(65, 90)); // Random letter from A to Z
        } elseif ($randType === 1) {
            $suffix .= rand(0, 9); // Random number from 0 to 9
        } else {
            $suffix .= chr(rand(65, 90)) . rand(0, 9); // Random alphanumeric combination
        }
    }

    // Trim or pad the suffix to ensure it has exactly 5 characters
    $suffix = substr($suffix, 0, $length);

    return $suffix;
}