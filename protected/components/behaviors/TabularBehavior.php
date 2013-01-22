<?php

class TabularBehavior extends CActiveRecordBehavior
{
    public $relations = array();
    private $_models = array();
    private $_settings;

    /**
     * Calls tabular method for all relations and saves relation models.
     */
    public function beforeValidate()
    {
        // Find relations settings.
        if (!isset($this->_settings)) {
            $this->_settings = $this->owner->relations();
        }

        foreach ($this->relations as $rel => $options) {
            $method = $rel . 'Tabular';
            $this->_models[$rel] = $this->owner->$method();
        }
    }

    /**
     * Saves all 'MANY_MANY' and 'HAS_MANY' relations with relation link
     * attribute as null (to find ID).
     * Sets relation attributes to saved models arrays.
     * EActiveRecordRelationBehavior will update relations on master save.
     */
    public function beforeSave()
    {
        foreach ($this->relations as $rel => $options) {
            if ($this->_settings[$rel][0] === CActiveRecord::MANY_MANY ||
                $this->_settings[$rel][0] === CActiveRecord::HAS_MANY
            ) {
                foreach ($this->_models[$rel] as $m) {
                    $m->save();
                }
                $this->owner->$rel = $this->_models[$rel];
            } elseif ($this->_settings[$rel][0] === CActiveRecord::BELONGS_TO) {
                $this->_models[$rel]->save();
                $this->owner->setAttribute($this->_settings[$rel][2], $this->_models[$rel]->id);
            }
        }
    }

    /**
     * Deletes homeless models for 'HAS_MANY' relations, based on 'delete'
     * option.
     * Saves master relation for 'BELONGS_TO', updates current model relation
     * link in progress.
     */
    public function afterSave()
    {
        foreach ($this->relations as $rel => $options) {
            if ($this->_settings[$rel][0] === CActiveRecord::HAS_MANY &&
                $options['delete'] === true
            ) {
                $deleteModels = call_user_func($this->_settings[$rel][1] . '::model')->findAllByAttributes(array($this->_settings[$rel][2] => null));
                foreach ($deleteModels as $m) {
                    $m->delete();
                }
            }
            // } elseif ($this->_settings[$rel][0] === CActiveRecord::BELONGS_TO &&
            //     $this->_models[$rel] !== null
            // ) {
            //     // Set masters 'MANY_MANY' relational array.
            //     $this->_models[$rel]->$options['masterRelation'] = array($this->owner);
            //     $this->_models[$rel]->save();
            // }
        }
    }
}
