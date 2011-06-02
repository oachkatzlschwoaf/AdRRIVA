<?php

/**
 * AdvertiseCatalog form base class.
 *
 * @method AdvertiseCatalog getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAdvertiseCatalogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'parent_id' => new sfWidgetFormInputText(),
      'name'      => new sfWidgetFormInputText(),
      'min_cost'  => new sfWidgetFormInputText(),
      'order_id'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'parent_id' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 100)),
      'min_cost'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'order_id'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('advertise_catalog[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdvertiseCatalog';
  }


}
