<?php
class Controller
{
    // View Object
    protected $_view;

    // Model Object
    protected $_model;

    // Params (GET - POST)
    protected $_arrParam;

    //Template
    protected $_templateObj;

    public function __construct($params)
    {
        $this->setParams($params);
        $this->setModel($this->_arrParam['module'],$this->_arrParam['controller']);
        $this->setTemplate($this);
        $this->setView($this->_arrParam['module']);
        $this->_view->arrParam  = $this->_arrParam;
    }

    //set Model
    public function setModel($module,$controller)
    {
        $modelName = ucfirst($controller) . 'Model';
        $fileModel = MODULE_PATH . DS . $module . DS . 'models' . DS . $modelName . '.php';
        if (file_exists($fileModel)) {
            include_once $fileModel;
            $this->_model = new $modelName();
        }
    }

    //set View
    public function setView($module)
    {
        $this->_view = new View($module);
    }

    //get View
    public function getView()
    {
        return $this->_view;
    }

    //set Template
    public function setTemplate()
    {
        $this->_templateObj =  new Template($this);
    }

    //set Params
    public function setParams($params)
    {
        $this->_arrParam = $params;
    }

}
