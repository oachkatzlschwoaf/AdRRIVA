<?php

/**
 * StatActivityDaily form base class.
 *
 * @method StatActivityDaily getObject() Returns the current form's model object
 *
 * @package    adrriva
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatActivityDailyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'date'                      => new sfWidgetFormInputText(),
      'shares'                    => new sfWidgetFormInputText(),
      'clicks'                    => new sfWidgetFormInputText(),
      'clicks_shares'             => new sfWidgetFormInputText(),
      'avg_share_agents'          => new sfWidgetFormInputText(),
      'avg_share_active_agents'   => new sfWidgetFormInputText(),
      'avg_clicks_agents'         => new sfWidgetFormInputText(),
      'avg_clicks_active_agents'  => new sfWidgetFormInputText(),
      'advertise_catalog'         => new sfWidgetFormInputText(),
      'active_advertise'          => new sfWidgetFormInputText(),
      'active_unactive_advertise' => new sfWidgetFormInputText(),
      'advertise_shares'          => new sfWidgetFormInputText(),
      'advertise_clicks'          => new sfWidgetFormInputText(),
      'active_advertise_shares'   => new sfWidgetFormInputText(),
      'active_advertise_clicks'   => new sfWidgetFormInputText(),
      'advertise_adverts'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'date'                      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'shares'                    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'clicks'                    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'clicks_shares'             => new sfValidatorNumber(),
      'avg_share_agents'          => new sfValidatorNumber(),
      'avg_share_active_agents'   => new sfValidatorNumber(),
      'avg_clicks_agents'         => new sfValidatorNumber(),
      'avg_clicks_active_agents'  => new sfValidatorNumber(),
      'advertise_catalog'         => new sfValidatorNumber(),
      'active_advertise'          => new sfValidatorNumber(),
      'active_unactive_advertise' => new sfValidatorNumber(),
      'advertise_shares'          => new sfValidatorNumber(),
      'advertise_clicks'          => new sfValidatorNumber(),
      'active_advertise_shares'   => new sfValidatorNumber(),
      'active_advertise_clicks'   => new sfValidatorNumber(),
      'advertise_adverts'         => new sfValidatorNumber(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StatActivityDaily', 'column' => array('date')))
    );

    $this->widgetSchema->setNameFormat('stat_activity_daily[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatActivityDaily';
  }


}
