<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    // rewrite some functions for can set ViewPath fron config file
    private $_viewPath;

    /**
   * @var string the default layout for the controller view. Defaults to '//layouts/column1',
   * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
   */
  public $layout='//layouts/column1';

    //=====================================
    // Declarate for ALL TYPE OF SITE MENU's

  /** @var array context menu items. This property will be assigned to {@link CMenu::items}.  */
  public $menu=array();

    /** @var array containe the submenu items of main menu - по сути это разделы сайтов Доступность, Организации... */
    public $_subMenu = array();
    public $_subsubMenu = array();

    /** @var array */
  public $menu_org;

    /**
    * @var array items that showed like submenu of ITEMS (object, org, user)*/
    public $menu_item_sub = array();

    /** @var array items like main meno of ITEM (obj, org, user, ets.) */
    public $menu_item;

    // @todo : remove property $menu_org - because its analog of $menu_operations
    /**
     * @var array items of ITEM operations
     * can be showed in different parts of page
     */
    public $menu_operations;

    //=====================================

    /** @var string variable for add description of page */
    public $pageDescription=NULL;

    /** @var mixed string or array of keywords of page  */
    public $pageKeywords=NULL;

    /** @var string the name of main-section of SOCIO
     * like: Organizations, Accesibilyty, Help, Media, Users ets.
     */
    public $sectionMain=NULL;

    /** @var string the name of sub-main-section of main-section SOCIO
     * Accessibility:
     * */
    public $sectionMainSub=NULL;

    /** @var array of escaleted variables for its access in higher layouts */
    public $escalation = array();

    /** @var string set Class of content container in main layout when is need */
    public $contentClass = '';

    /** @var string - contains name of model that is main model in controller  */
    public $work_model_name=NULL;

	/**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    /**
     * Finds the model object for this controller by it's primary key.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded.
     * @return the model object.
     */
    public function loadModel($id)
    {
        // Set default model name as controller ID.
        $name = ucfirst($this->getId());

        return $this->loadModelByName($id, $name);
    }

    /**
     * Finds the model object by it's primary key and model name.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded.
     * @param string $name the name of model to load.
     * @return the model object.
     */
    public function loadModelByName($id, $name)
    {
        $model = CActiveRecord::model($name)->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Запрашиваемая страница не существует.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    public function performAjaxValidation($model)
    {
        $formName = $this->getId() . '-form';

        if (isset($_POST['ajax']) && $_POST['ajax'] === $formName) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Transforms organization model to views layout.
     * @param mixed $organization the Organization ID or Organization model.
     */
    public function escalateOrganization($organization)
    {
        if ($organization instanceof Organization) {
            $this->escalation['organization'] = $organization;
        } else {
            $this->escalation['organization'] = $this->loadModelByName($organization, 'Organization');
        }

        // TODO: remove fallback on 'menu_org'.
        $this->menu_org = $this->escalation['organization'];
    }

    public function newModel()
    {
        $model= new $this->work_model_name();
        if($model===null)
            throw new CHttpException(404,'Something wrong (x0001)');
        return $model;
    }

    public function setViewPath($path)
    {
        // если параметр содержит в себе слеши (или наоборот точки) то возвращаем либо путь как есть (либо обрабатываем алиас)
        $this->_viewPath = Yii::getPathOfAlias($path);
    }

    public function getViewPath()
    {
        if(!$this->_viewPath){
            if(($module=$this->getModule())===null)
                $module=Yii::app();
            $this->_viewPath = $module->getViewPath().DIRECTORY_SEPARATOR.$this->getId();
        }
        return $this->_viewPath;
    }
}
