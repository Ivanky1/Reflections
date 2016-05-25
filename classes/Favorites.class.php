<?php
class Favorites{
  private $plugins = [];
	
  function __construct(){
      $directory = dirname(__FILE__);
      $iterator = new DirectoryIterator($directory);
      foreach($iterator as $dir) {
          if ($dir->isDir() && preg_match('/[^\.]/', $dir->getFilename())) {
              foreach(new DirectoryIterator($directory.'/'.$dir->getFilename()) as $fileObj) {
                  if ($fileObj->isFile()) {
                      require_once $dir->getFilename().'/'.$fileObj->getFilename();
                      $this->plugins[] = new ReflectionClass(str_replace('.class.php', '', $fileObj->getFilename()));
                  }
              }
          }
      }
      $this->findPlugins();
  }
	
  private function findPlugins() {
    foreach($this->plugins as $k => $plugin) {
        if (!$plugin->implementsInterface('IPlugin')) {
            unset($this->plugins[$k]);
        }
     }

  }
	
  function getFavorites($methodName) {
      $list = [];
      foreach($this->plugins as $plugin) {
          $result = '';
          if ($plugin->hasMethod($methodName)) {
              $rm = $plugin->getMethod($methodName);
              if ($rm->isStatic()) {
                  $result = $rm->invoke(null);
              } else {
                  $instance = $plugin->newInstance();
                  $result = $rm->invoke($instance);
              }
              if ($result)
              $list[] = $result;
          }
      }
      return $list;
  }
}






