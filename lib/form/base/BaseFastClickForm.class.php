<?php

/**
 * FastClick form base class.
 *
 * @method FastClick getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseFastClickForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'time'            => new sfWidgetFormInputText(),
      'ua_id'           => new sfWidgetFormInputText(),
      'a_hash'          => new sfWidgetFormInputText(),
      'ad_id'           => new sfWidgetFormInputText(),
      'user_id'         => new sfWidgetFormInputText(),
      'advert_id'       => new sfWidgetFormInputText(),
      'ip'              => new sfWidgetFormInputText(),
      'subnet'          => new sfWidgetFormInputText(),
      'ref'             => new sfWidgetFormInputText(),
      'last_click_time' => new sfWidgetFormInputText(),
      'no_cookie'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'time'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'ua_id'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'a_hash'          => new sfValidatorString(array('max_length' => 8)),
      'ad_id'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'user_id'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'advert_id'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'ip'              => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'subnet'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'ref'             => new sfValidatorString(array('max_length' => 100)),
      'last_click_time' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'no_cookie'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('fast_click[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FastClick';
  }


}
