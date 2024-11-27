<?php
if(!defined('_CODE')) {
    die('Access denied...');
} 

function query($sql, $data=[], $check=false) {
    global $conn;
    $result = false;
    
    try {
        $statement = $conn -> prepare($sql);

        if(!empty($data)) {
            $result = $statement -> execute($data);
        } else {
            $result = $statement -> execute();
        }
    } catch(Exception $exp) {
        echo $exp -> getMessage() . '<br>';
        echo 'File: ' . $exp -> getFile() . '<br>';
        echo 'Line: ' . $exp -> getLine();
        die();
    }

    if($check) {
        return $statement;
    }

    return $result;
}

// Hàm thêm
function insert($table, $data) {
    $key = array_keys($data);
    $truong = implode(', ', $key);
    $valuetb = ':' . implode(',:', $key);

    $sql = 'INSERT INTO ' . $table . '(' . $truong . ') VALUES(' . $valuetb .')';

    $ketQua = query($sql, $data);
    return $ketQua;
}

// Hàm cập nhật
function update($table, $data, $condition='') {
    $update = '';
    foreach($data as $key => $value) {
        $update .= $key .'= :' . $key . ',';
    }
    $update = trim($update, ',');

    if(!empty($condition)) {
        $sql = 'UPDATE ' . $table . ' SET ' . $update . ' WHERE ' . $condition;
    } else {
        $sql = 'UPDATE ' . $table . ' SET ' . $update ;
    }

    $ketQua = query($sql, $data);
    return $ketQua;
}

// Hàm xóa
function delete($table, $condition='') {
    if(empty($condition)) {
        $sql = 'DELETE FROM ' . $table;
    } else {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
    }

    $ketQua = query($sql);
    return $ketQua;
}

// Lấy nhiều dòng dữ liệu
function getRaw($sql) {
    $result = query($sql, '', true);
    if(is_object($result)) {
        $dataFetch = $result -> fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

// Lấy 1 dòng dữ liệu
function oneRaw($sql) {
    $result = query($sql, '', true);
    if(is_object($result)) {
        $dataFetch = $result -> fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

// Đếm số dòng dữ liệu
function getRows($sql) {
    $result = query($sql, '', true);
    if(!empty($result)) {
        return $result -> rowCount();
    }
}