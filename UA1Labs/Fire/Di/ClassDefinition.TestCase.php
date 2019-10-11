<?php

/**
 *    __  _____   ___   __          __
 *   / / / /   | <  /  / /   ____ _/ /_  _____
 *  / / / / /| | / /  / /   / __ `/ __ `/ ___/
 * / /_/ / ___ |/ /  / /___/ /_/ / /_/ (__  )
 * `____/_/  |_/_/  /_____/`__,_/_.___/____/
 *
 * @package FireDI
 * @author UA1 Labs Developers https://ua1.us
 * @copyright Copyright (c) UA1 Labs
 */

namespace Test\UA1Labs\Fire\Di;

use Fire\Test\TestCase;
use UA1Labs\Fire\Di\ClassDefinition;
use ReflectionClass;

class ClassDefinitionTestCase extends TestCase
{
    /**
     * The FireDi ClassDefinition Class
     *
     * @var ClassDefinition
     */
    private $_classDefinition;

    public function beforeEach()
    {
        $this->_classDefinition = new ClassDefinition('Test\UA1Labs\Fire\Di\MyTestClass');
    }

    public function afterEach()
    {
        unset($this->_classDefinition);
    }

    public function testConstructor()
    {
        $this->should('Not throw an exception when the class is constructed');
        $this->assert(true);

        $this->should('Have set a serviceId of "Test\UA1Labs\Fire\Di\MyTestClass".');
        $this->assert($this->_classDefinition->serviceId === 'Test\UA1Labs\Fire\Di\MyTestClass');

        $this->should('Have set a classDef as a ReflectionClass object.');
        $this->assert($this->_classDefinition->classDef instanceof ReflectionClass);

        $this->should('Have set a dependency of "Test\UA1Labs\Fire\Di\MyDependentClass"');
        $this->assert(
            isset($this->_classDefinition->dependencies[0])
            && $this->_classDefinition->dependencies[0] === 'Test\UA1Labs\Fire\Di\MyDependentClass'
        );
    }

}

/**
 * Test classes need for tests.
 */
class MyTestClass
{
    public function __construct(MyDependentClass $stdClass)
    {}
}

class MyDependentClass
{}