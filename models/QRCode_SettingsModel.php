<?php
/**
 * QRCode plugin for Craft CMS
 *
 * QRCode Settings Model
 *
 * @author    Kurious Agency
 * @copyright Copyright (c) 2018 Kurious Agency
 * @link      https://kurious.agency
 * @package   QRCode
 * @since     1.0.0
 */

namespace Craft;

class QRCode_SettingsModel extends BaseModel
{
    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'data' => array(AttributeType::String, 'column' => ColumnType::Text),
        ));
    }

}