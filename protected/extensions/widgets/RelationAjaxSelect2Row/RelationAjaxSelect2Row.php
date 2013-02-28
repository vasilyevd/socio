<?php

/**
 * Wrapper for 'select2' widget. Useful for general ajax calls.
 */
class RelationAjaxSelect2Row extends CWidget
{
    public $model;
    public $attribute;
    public $relationAttributeText;
    public $form;
    public $url;
    protected $_selectText;

    public function init()
    {
        // Parameters check.
        if (!$this->model instanceof CActiveRecord) {
            throw new RuntimeException('Parameter "model" must be instance of "CActiveRecord".');
        }
        if (!$this->form instanceof CActiveForm) {
            throw new RuntimeException('Parameter "form" must be instance of "CActiveForm".');
        }

        // Prepare model relation for 'select2' widget and find select text.
        if (is_object($this->model->{$this->attribute})) {
            // Get text from widget model relation attribute.
            $this->_selectText = $this->model->{$this->attribute}->{$this->relationAttributeText};
            // Transform model relation attribute to integer (ID). Needed for
            // 'select2' to work.
            $this->model->{$this->attribute} = $this->model->{$this->attribute}->id;
        } else {
            $this->_selectText = '';
        }
    }

    public function run()
    {
        $this->render('main', array(
            'model' => $this->model,
            'attribute' => $this->attribute,
            'form' => $this->form,
            'url' => $this->url,
            'selectText' => $this->_selectText,
        ));
    }
}
