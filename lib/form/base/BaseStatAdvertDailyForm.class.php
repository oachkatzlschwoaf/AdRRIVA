<?php

/**
 * StatAdvertDaily form base class.
 *
 * @method StatAdvertDaily getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatAdvertDailyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'date'      => new sfWidgetFormDate(),
      'clicks'    => new sfWidgetFormInputText(),
      'points'    => new sfWidgetFormInputText(),
      'advert_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'ad_id'     => new sfWidgetFormPropelChoice(array('model' => 'Advertise', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date'      => new sfValidatorDate(),
      'clicks'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'points'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'advert_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'ad_id'     => new sfValidatorPropelChoice(array('model' => 'Advertise', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StatAdvertDaily', 'column' => array('date', 'advert_id', 'ad_id')))
    );

    $this->widgetSchema->setNameFormat('stat_advert_daily[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatAdvertDaily';
  }


}
