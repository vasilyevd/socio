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
            $upload = CUploadedFile::getInstance($this->owner, $attr);

            if (!empty($upload)) {
                // Remove old upload.
                if (!empty($this->owner->$attr)) {
                    $this->deleteUpload($attr);
                }

                // Save new upload.
                $this->owner->$attr = uniqid() . '.'
                    . $upload->getExtensionName();
                $upload->saveAs($this->getUploadPath($attr));
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
