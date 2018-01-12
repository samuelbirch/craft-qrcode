<?php
/**
 * QRCode plugin for Craft CMS
 *
 * QRCode Service
 *
 * @author    Kurious Agency
 * @copyright Copyright (c) 2018 Kurious Agency
 * @link      https://kurious.agency
 * @package   QRCode
 * @since     1.0.0
 */

namespace Craft;

use Endroid\QrCode\QrCode;

class QRCodeService extends BaseApplicationComponent
{
    /**
     */
    public function getQRCode($data, $props=[])
    {
        $qrCode = new QrCode(json_encode($data));
        
        if(in_array('size', $props)){
            $qrCode->setSize($props['size']);
        }

        //header('Content-Type: '.$qrCode->getContentType());
        return $qrCode;
    }

}