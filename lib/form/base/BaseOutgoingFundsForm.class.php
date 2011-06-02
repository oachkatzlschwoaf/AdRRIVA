<?php

/**
 * OutgoingFunds form base class.
 *
 * @method OutgoingFunds getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseOutgoingFundsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'time'        => new sfWidgetFormDateTime(),
      'approved_at' => new sfWidgetFormDateTime(),
      'account_id'  => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'amount'      => new sfWidgetFormInputText(),
      'money'       => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      'currency'    => new sfWidgetFormInputText(),
      'emoney_id'   => new sfWidgetFormInputText(),
      'comment'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'time'        => new sfValidatorDateTime(),
      'approved_at' => new sfValidatorDateTime(array('required' => false)),
      'account_id'  => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'amount'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'money'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'status'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'currency'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'emoney_id'   => new sfValidatorString(array('max_length' => 300)),
      'comment'     => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('outgoing_funds[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OutgoingFunds';
  }


}
