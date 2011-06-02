<?php

/**
 * Advertise form base class.
 *
 * @method Advertise getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAdvertiseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'type'        => new sfWidgetFormInputText(),
      'owner_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'AdvertiseCatalog', 'add_empty' => false)),
      'status'      => new sfWidgetFormInputText(),
      'subject'     => new sfWidgetFormInputText(),
      'text'        => new sfWidgetFormInputText(),
      'image'       => new sfWidgetFormInputText(),
      'html'        => new sfWidgetFormTextarea(),
      'url'         => new sfWidgetFormInputText(),
      'cost'        => new sfWidgetFormInputText(),
      'agents'      => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'type'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'owner_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'AdvertiseCatalog', 'column' => 'id')),
      'status'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'subject'     => new sfValidatorString(array('max_length' => 100)),
      'text'        => new sfValidatorString(array('max_length' => 300)),
      'image'       => new sfValidatorString(array('max_length' => 300)),
      'html'        => new sfValidatorString(),
      'url'         => new sfValidatorString(array('max_length' => 300)),
      'cost'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'agents'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('advertise[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Advertise';
  }


}
