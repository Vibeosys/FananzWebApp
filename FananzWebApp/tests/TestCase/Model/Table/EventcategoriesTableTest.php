<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventcategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventcategoriesTable Test Case
 */
class EventcategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventcategoriesTable
     */
    public $Eventcategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.eventcategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Eventcategories') ? [] : ['className' => 'App\Model\Table\EventcategoriesTable'];
        $this->Eventcategories = TableRegistry::get('Eventcategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Eventcategories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
