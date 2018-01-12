<?php
/**
 * QRCode plugin for Craft CMS
 *
 * QRCode Variable
 *
 * @author    Kurious Agency
 * @copyright Copyright (c) 2018 Kurious Agency
 * @link      https://kurious.agency
 * @package   QRCode
 * @since     1.0.0
 */

namespace Craft;

class QRCodeVariable
{
    /**
     */
    public function getQRCode($data, $props=[])
    {
        $qrCode = craft()->qRCode->getQRCode($data, $props);
        
        return $qrCode->writeDataUri();
    }
}