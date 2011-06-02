<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'role'        => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'password'    => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'visit_at'    => new sfWidgetFormDateTime(),
      'ip_register' => new sfWidgetFormInputText(),
      'ip_last'     => new sfWidgetFormInputText(),
      'last_action' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 100)),
      'role'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'status'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'email'       => new sfValidatorString(array('max_length' => 100)),
      'password'    => new sfValidatorString(array('max_length' => 100)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'visit_at'    => new sfValidatorDateTime(),
      'ip_register' => new sfValidatorInteger(array('min' => -9.22337203685E+18, 'max' => 9.22337203685E+18, 'required' => false)),
      'ip_last'     => new sfValidatorInteger(array('min' => -9.22337203685E+18, 'max' => 9.22337203685E+18, 'required' => false)),
      'last_action' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
