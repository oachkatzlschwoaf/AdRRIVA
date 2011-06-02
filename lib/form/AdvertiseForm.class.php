<?php

class AdvertiseForm extends BaseAdvertiseForm {

    public function configure() {
        unset($this['owner_id']);
        unset($this['type']);
        unset($this['html']);
        unset($this['status']);
        unset($this['agents']);
        unset($this['created_at']);
        unset($this['updated_at']);

        $this->widgetSchema['id']       = new sfWidgetFormInputHidden();
        $this->widgetSchema['image']    = new sfWidgetFormInputFile();
        $this->validatorSchema['image'] = new sfValidatorFile(array('required' => false));

        $this->widgetSchema['text'] = new sfWidgetFormTextarea();

    }

}
