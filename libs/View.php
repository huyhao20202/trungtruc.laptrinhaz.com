<?php

class View
{
    public $_moduleName;
    public $_templatePath;
    public $_fileView;

    public function __construct($module)
    {
        $this->_moduleName = $module;
    }

    public function render($fileInclude, $full = true)
    {
        $filePath = MODULE_PATH . DS . $this->_moduleName . DS . "views" . DS . $fileInclude . '.php';
        if (file_exists($filePath)) {
            if ($full == true) {
                $this->_fileView = $fileInclude;
                include_once $this->_templatePath;
            } else {
                include_once $filePath;
            }
        }
    }

    // Thiết lập đường dẫn đến template
    public function setTemplatePath($path)
    {
        $this->_templatePath = $path;
    }

    public function createTitle($file)
    {
        if ($file != null) {
            echo "<title>$file</title>";
        } else {
            echo "<title>" . TITLE . "</title>";
        }

    }

    //Created link CSS - JS
    public function createLink($path, $files, $type)
    {
        $xhtml = '';
        if (!empty($files)) {
            foreach ($files as $file) {
                $file = TEMPLATE_URL . DS . $path . DS . $file;
                if ($type == 'css')
                    $xhtml .= "<link rel='stylesheet' href='$file'>";
                else
                    $xhtml .= "<script src='$file'></script>";
            }
        }
        return $xhtml;
    }

    //Created link META
    public function createMeta($files, $type)
    {
        $xhtml = '';
        if (!empty($files)) {
            foreach ($files as $file) {
                $arrContent = explode('|', $file);
                if ($type == 'name')
                    $xhtml .= '<meta name="' . $arrContent[0] . '" content="' . $arrContent[1] . '">';
                else
                    $xhtml .= '<meta http-equiv="' . $arrContent[0] . '" content="' . $arrContent[1] . '"/>';
            }
        }
        return $xhtml;

    }
}


?>
