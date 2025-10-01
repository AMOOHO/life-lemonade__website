<?php


class FormRepository {
  private static $instance = null;
  private $forms = [];

  // The constructor is private to prevent external instantiation
  private function __construct() {
  }

  // Clone method is private to prevent cloning of the instance (not allowed in singleton pattern)
  private function __clone() {
  }

  // Method used to get the Singleton instance of the class
  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new FormRepository();
    }
    return self::$instance;
  }

  // Rest of the methods remain the same
  public function createFormInstance($name, $args) {
    $formLoader = get_template_directory() . '/inc/HazzelForms/autoload.php';
    if (file_exists($formLoader)) {
      require_once($formLoader);

      $form = new HazzelForms\HazzelForm($args);
      $this->addForm($name, $form);
      return $form;
    }

    throw new Exception("HazzelForms Loader not found");
  }

  public function addForm($formName, $form) {
    $this->forms[$formName] = $form;
  }

  public function getForm($formName) {
    if (array_key_exists($formName, $this->forms)) {
      return $this->forms[$formName];
    }

    return null;
  }

  public function getAllForms() {
    return $this->forms;
  }
}
