<?php
/**
 * QRCode plugin for Craft CMS
 *
 * QRCode FieldType
 *
 * @author    Kurious Agency
 * @copyright Copyright (c) 2018 Kurious Agency
 * @link      https://kurious.agency
 * @package   QRCode
 * @since     1.0.0
 */

namespace Craft;

class QRCodeFieldType extends BaseFieldType implements IPreviewableFieldType
{
    /**
     * @return mixed
     */
    public function getName()
    {
        return Craft::t('QRCode');
    }

    /**
     * @return mixed
     */
    public function defineContentAttribute()
    {
        return AttributeType::Mixed;
    }

    /**
     * @param string $name
     * @param mixed  $value
     * @return string
     */
    public function getInputHtml($name, $value)
    {
        //if (!$value)
        //    $value = new QRCodeModel();

        $id = craft()->templates->formatInputId($name);
        $namespacedId = craft()->templates->namespaceInputId($id);

/* -- Include our Javascript & CSS */

        craft()->templates->includeCssResource('qrcode/css/fields/QRCodeFieldType.css');
        craft()->templates->includeJsResource('qrcode/js/fields/QRCodeFieldType.js');

/* -- Variables to pass down to our field.js */

        $jsonVars = array(
            'id' => $id,
            'name' => $name,
            'namespace' => $namespacedId,
            'prefix' => craft()->templates->namespaceInputId(""),
            );

        $jsonVars = json_encode($jsonVars);
        craft()->templates->includeJs("$('#{$namespacedId}-field').QRCodeFieldType(" . $jsonVars . ");");

/* -- Variables to pass down to our rendered template */

        $variables = array(
            'id' => $id,
            'name' => $name,
            'namespaceId' => $namespacedId,
            'value' => $value
            );

        return craft()->templates->render('qrcode/fields/QRCodeFieldType.twig', $variables);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function prepValueFromPost($value)
    {
        $template = craft()->templates->renderString($this->getSettings()->data, [lcfirst($this->element->classHandle) => $this->element]);

        $value = craft()->qRCode->getQRCode($template)->writeDataUri();
        //Craft::dd($value);
        
        return $value;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function prepValue($value)
    {
       /* if(!$value){
            $value = new QRCodeModel();
        }*/
//Craft::dd($value);
        return $value;
    }


    public function getSettingsHtml()
    {
        return craft()->templates->render('qrcode/fields/settings', array(
            'settings' => $this->getSettings(),
        ));
    }

    protected function getSettingsModel()
    {
        return new QRCode_SettingsModel();
    }

    public function getTableAttributeHtml($value)
    {
        return $value ? '<img src="'.$value.'" style="width:50px;" />' : '';
    }
}