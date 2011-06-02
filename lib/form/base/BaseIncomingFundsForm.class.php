<?php

/**
 * IncomingFunds form base class.
 *
 * @method IncomingFunds getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseIncomingFundsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'time'        => new sfWidgetFormDateTime(),
      'to_account'  => new sfWidgetFormInputText(),
      'amount'      => new sfWidgetFormInputText(),
      'money'       => new sfWidgetFormInputText(),
      'profit'      => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormInputText(),
      'service_id'  => new sfWidgetFormInputText(),
      'mr_tid'      => new sfWidgetFormInputText(),
      'mr_uid'      => new sfWidgetFormInputText(),
      'sig'         => new sfWidgetFormInputText(),
      'sms_price'   => new sfWidgetFormInputText(),
      'other_price' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'time'        => new sfValidatorDateTime(),
      'to_account'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'amount'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'money'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'profit'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'status'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'service_id'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'mr_tid'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'mr_uid'      => new sfValidatorString(array('max_length' => 30)),
      'sig'         => new sfValidatorString(array('max_length' => 30)),
      'sms_price'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'other_price' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('incoming_funds[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IncomingFunds';
  }


}
