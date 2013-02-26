<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
    /**
     * @var string the default layout for the views. Defaults to
     * '//layouts/column2', meaning using two-column layout. See
     * 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters.
     */
    public function filters()
    {
        return array(
            // Perform access control for CRUD operations.
            'accessControl',
            // We only allow deletion via POST request.
            'postOnly + delete',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules.
     */
    public function accessRules()
    {
        return array(
            // Allow all users to perform 'index' and 'view' actions.
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            // Allow authenticated to perform 'create' and 'update' actions.
            array('allow',
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            // Allow admin user to perform 'admin' and 'delete' actions.
            array('allow',
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            // Deny all users.
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // General CRUD actions.
            'view' => 'application.components.actions.ViewAction',
            'create' => 'application.components.actions.CreateAction',
            'update' => 'application.components.actions.UpdateAction',
            'delete' => 'application.components.actions.DeleteAction',
            'index' => 'application.components.actions.IndexAction',
            'admin' => 'application.components.actions.AdminAction',
        );
    }
}
