<?php


/**
 * Description of TestClass
 *
 * @author sleek
 */
class TestClass {
    public $name = '';
    
    public function setName($name) {
        $try = "test";
        if (empty($name)) {
            printf("empty string passed.");
        } else {
            $this->name = "finch";
            printf("name: %s<br/>", $name);
        }
        
        return $name;
    }
    
    public function testName() {
        $param = $this->setName($name);
        print_r($param);
    }
    
}
