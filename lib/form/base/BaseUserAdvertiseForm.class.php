<?php

/**
 * UserAdvertise form base class.
 *
 * @method UserAdvertise getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserAdvertiseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'advert_id'    => new sfWidgetFormInputText(),
      'advertise_id' => new sfWidgetFormPropelChoice(array('model' => 'Advertise', 'add_empty' => false)),
      'last_action'  => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
      'url'          => new sfWidgetFormInputText(),
      'secret'       => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'advert_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'advertise_id' => new sfValidatorPropelChoice(array('model' => 'Advertise', 'column' => 'id')),
      'last_action'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'status'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'url'          => new sfValidatorString(array('max_length' => 300)),
      'secret'       => new sfValidatorString(array('max_length' => 50)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'UserAdvertise', 'column' => array('user_id', 'advertise_id')))
    );

    $this->widgetSchema->setNameFormat('user_advertise[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserAdvertise';
  }


}
