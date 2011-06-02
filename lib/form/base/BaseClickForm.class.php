<?php

/**
 * Click form base class.
 *
 * @method Click getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseClickForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'time'          => new sfWidgetFormInputText(),
      'processed'     => new sfWidgetFormInputText(),
      'user_id'       => new sfWidgetFormInputText(),
      'advert_id'     => new sfWidgetFormInputText(),
      'clicker_email' => new sfWidgetFormInputText(),
      'ua_id'         => new sfWidgetFormInputText(),
      'ad_id'         => new sfWidgetFormInputText(),
      'aid'           => new sfWidgetFormInputText(),
      'ip'            => new sfWidgetFormInputText(),
      'subnet'        => new sfWidgetFormInputText(),
      'ref'           => new sfWidgetFormInputText(),
      'no_cookie'     => new sfWidgetFormInputText(),
      'cost'          => new sfWidgetFormInputText(),
      'status'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'time'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'processed'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'user_id'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'advert_id'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'clicker_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ua_id'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'ad_id'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'aid'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'ip'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'subnet'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'ref'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'no_cookie'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'cost'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'status'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('click[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Click';
  }


}
