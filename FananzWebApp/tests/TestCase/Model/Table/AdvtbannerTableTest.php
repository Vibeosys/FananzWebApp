<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdvtbannerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdvtbannerTable Test Case
 */
class AdvtbannerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdvtbannerTable
     */
    public $Advtbanner;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.advtbanner'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Advtbanner') ? [] : ['className' => 'App\Model\Table\AdvtbannerTable'];
        $this->Advtbanner = TableRegistry::get('Advtbanner', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Advtbanner);

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
