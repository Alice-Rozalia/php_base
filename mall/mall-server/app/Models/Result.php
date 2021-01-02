<?php

namespace App\Models;

class Result {

    public static function ok() {
        $result = array(
            'success' => true,
            'message' => '请求成功！',
            'code' => 200,
            'data' => []
        );
        return $result;
    }

    public static function ok2($message) {
        $result = array(
            'success' => true,
            'message' => $message,
            'code' => 200,
            'data' => []
        );
        return $result;
    }

    public static function ok3($message, $data) {
        $result = array(
            'success' => true,
            'message' => $message,
            'code' => 200,
            'data' => $data
        );
        return $result;
    }

    public static function ok4($data) {
        $result = array(
            'success' => true,
            'message' => '请求成功！',
            'code' => 200,
            'data' => $data
        );
        return $result;
    }

    public static function error() {
        $result = array(
            'success' => false,
            'message' => '请求失败！',
            'code' => 400,
            'data' => []
        );
        return $result;
    }

    public static function error2($message) {
        $result = array(
            'success' => false,
            'message' => $message,
            'code' => 400,
            'data' => []
        );
        return $result;
    }
}