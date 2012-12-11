<?php

class UploadBehavior extends CActiveRecordBehavior
{
    public $attributes = array();

    /**
     * Saves upload file with model attributes and removes old one.
     */
    public function beforeSave()
    {
        foreach ($this->attributes as $attr) {
            if ($this->owner->$attr instanceof CUploadedFile) {
                // Save new upload.
                $upload = $this->owner->$attr;
                $filename = uniqid() . '.' . $upload->getExtensionName();
                $this->owner->$attr = $filename;
                $upload->saveAs($this->getUploadPath($attr));

                // Remove old upload.
                if (!$this->owner->isNewRecord) {
                    $currentClass = get_class($this->owner);
                    $current = $currentClass::findByPk($this->owner->id);
                    if ($current !== null) {
                        $current->deleteUpload($attr);
                    }
                }
            }
        }
    }

    /**
     * Remove all uploads from all attributes.
     */
    public function afterDelete()
    {
        foreach ($this->attributes as $attr) {
            $this->deleteUpload($attr);
        }
    }

    /**
     * Creates full path for upload file.
     * @param string $attribute the name of upload model attribute.
     * @return string unix path.
     */
    public function getUploadPath($attribute)
    {
        return Yii::getPathOfAlias('webroot')
            . '/uploads/'
            . strtolower(get_class($this->owner)) . '/'
            . $attribute . '/'
            . $this->owner->$attribute;
    }

    /**
     * Creates relative URL for upload file.
     * @param string $attribute the name of upload model attribute.
     * @return string full URL.
     */
    public function getUploadUrl($attribute)
    {
        return Yii::app()->createUrl('uploads/'
            . strtolower(get_class($this->owner)) . '/'
            . $attribute . '/'
            . $this->owner->$attribute
        );
    }

    /**
     * Finds and deletes uploaded file by its attribute.
     * @param string $attribute the name of upload model attribute.
     */
    public function deleteUpload($attribute)
    {
        // Don't delete with empty attribute field.
        // Don't delete placeholder image.
        if (!empty($this->owner->$attribute) && $this->owner->$attribute != 'placeholder.jpg') {
            // Remove file.
            unlink($this->getUploadPath($attribute));

            // Empty attribute.
            $this->owner->$attribute = '';
        }
    }
}
