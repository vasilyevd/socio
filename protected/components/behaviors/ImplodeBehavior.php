<?php

class ImplodeBehavior extends CActiveRecordBehavior
{
    public $attributes = array();

    /**
     * Transforms string attributes to array.
     */
    public function afterFind()
    {
        foreach ($this->attributes as $attr) {
            if (empty($this->owner->$attr)) {
                $this->owner->$attr = array();
            } else {
                $this->owner->$attr = explode(',', $this->owner->$attr);
            }
        }
    }

    /**
     * Transforms array attributes to string.
     */
    public function beforeSave()
    {
        foreach ($this->attributes as $attr) {
            if (empty($this->owner->$attr)) {
                $this->owner->$attr = '';
            } else {
                $this->owner->$attr = implode(',', $this->owner->$attr);
            }
        }
    }
}
