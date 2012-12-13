<?php

class UploadBehavior extends CActiveRecordBehavior
{
    public $attributes = array();
    public $uploadOffset;

    /**
     * Set uploads to attributes.
     */
    public function beforeValidate()
    {
        foreach ($this->attributes as $attr) {
            // Apply offset to upload.
            if (isset($this->uploadOffset)) {
                $upload = CUploadedFile::getInstance($this->owner, "[$this->uploadOffset]$attr");
            } else {
                $upload = CUploadedFile::getInstance($this->owner, $attr);
            }

            if (!empty($upload)) {
                $this->owner->$attr = $upload;
            }
        }
    }

    /**
     * Saves upload files with model attributes.
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
            }
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
}
