<?php

/**
 * UserActivate form base class.
 *
 * @method UserActivate getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserActivateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormInputText(),
      'code'       => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'code'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getCode()), 'empty_value' => $this->getObject()->getCode(), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'UserActivate', 'column' => array('user_id')))
    );

    $this->widgetSchema->setNameFormat('user_activate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserActivate';
  }


}
