<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_code {

    public function __construct() {
        require_once APPPATH . 'libraries/phpqrcode/qrlib.php';
    }

    public function generate($params) {
        // Set output header as image/png
        header('Content-Type: image/png');

        // Generate QR code
        QRcode::png($params['data'], false, $params['level'], $params['size'], 2);
    }
}
