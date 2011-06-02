<?php

/**
 * Transaction form base class.
 *
 * @method Transaction getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'created_at' => new sfWidgetFormDateTime(),
      'points'     => new sfWidgetFormInputText(),
      'amount'     => new sfWidgetFormInputText(),
      'fee'        => new sfWidgetFormInputText(),
      'from'       => new sfWidgetFormInputText(),
      'to'         => new sfWidgetFormInputText(),
      'from_user'  => new sfWidgetFormInputText(),
      'to_user'    => new sfWidgetFormInputText(),
      'invoice_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'points'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'amount'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'fee'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'from'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'to'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'from_user'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'to_user'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'invoice_id' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }


}
