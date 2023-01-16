<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    block_smartest
 * @copyright  2022 Smartest Learning AG
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* Ref https://docs.moodle.org/dev/Blocks */

namespace block_smartest;

require_once(__DIR__.'/../../../config.php');
/**
 * A class for JSON Web Token manipulations
 */
class smartest_moodle_jwt {
    /**
     * Build a JSON Web Token in PHP
     * @param string $jsonidtoken json
     * @return string $jwt token
     */
    public static function generate_token($jsonidtoken):string {

        $smartest = new \block_smartest\smartest_constants;
        $smartest->init();

        // Create token header as a JSON string.
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string.
        $payload = $jsonidtoken;

        // Encode Header to Base64Url String.
        $base64urlheader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String.
        $base64urlpayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash with.
        $signature = hash_hmac('sha256', $base64urlheader . "." . $base64urlpayload, $smartest->smartestsecret, true);

        // Encode Signature to Base64Url String.
        $base64urlsignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT.
        $jwt = $base64urlheader . "." . $base64urlpayload . "." . $base64urlsignature;

        return $jwt;
    }
    /**
     * Posts jwt to Smartest for sso and/or class replication
     * Receives a url for sso when everything ok or an error
     * @param string $moodlejwttoken jwt
     * @return string $response json result
     */
    public static function get_smartest_access($moodlejwttoken):string {

        $smartest = new \block_smartest\smartest_constants;
        $smartest->init();

        $curl = new \curl();
        $curl->setopt(array(
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_ENCODING' => '',
            'CURLOPT_TIMEOUT' => 0,
            'CURLOPT_FOLLOWLOCATION' => true,
            'CURLOPT_HTTP_VERSION' => CURL_HTTP_VERSION_1_1,
            'CURLOPT_HTTPHEADER' => array('Content-Type: application/json')
            ));
        $response = $curl->post($smartest->smartestexternalhref, '{"token":"' . $moodlejwttoken . '"}');
        return $response;
    }
    /**
     * Posts jwt to Smartest for grades
     * Receives a json when everything ok or and error
     * @param string $moodlejwttoken jwt
     * @return string $response json
     */
    public static function get_smartest_grades($moodlejwttoken):string {

        $smartest = new \block_smartest\smartest_constants;
        $smartest->init();

        $curl = new \curl();
        $curl->setopt(array(
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_ENCODING' => '',
            'CURLOPT_TIMEOUT' => 0,
            'CURLOPT_FOLLOWLOCATION' => true,
            'CURLOPT_HTTP_VERSION' => CURL_HTTP_VERSION_1_1,
            'CURLOPT_HTTPHEADER' => array('Content-Type: application/json')
            ));
        $response = $curl->post($smartest->smartestgradesapi, '{"token":"' . $moodlejwttoken . '"}');
        return $response;
    }
    /**
     * Verify if a token is properly signed by Smartest
     * @param string $moodlejwttoken jwt
     * @return boolean true or false
     */
    public static function verify_smartest_signature($moodlejwttoken):bool {
        $smartest = new \block_smartest\smartest_constants;
        $smartest->init();

        $encodedheader = explode('.', $moodlejwttoken)[0];
        $encodedpayload = explode('.', $moodlejwttoken)[1];
        $encodedsignature = explode('.', $moodlejwttoken)[2];
        $challengesignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(hash_hmac('sha256', $encodedheader . "." . $encodedpayload, $smartest->smartestsecret, true)));
        return $encodedsignature == $challengesignature ? true : false;
    }
    /**
     * Get the payload from a signed Smartest jwt
     * @param string $moodlejwttoken jwt
     * @return string $response json
     */
    public static function get_smartest_payload($moodlejwttoken):string {
        $encodedpayload = explode('.', $moodlejwttoken)[1];
        $decodedpayload = base64_decode(str_replace(['-', '_'], ['+', '/'], $encodedpayload));
        return $decodedpayload;
    }
}
