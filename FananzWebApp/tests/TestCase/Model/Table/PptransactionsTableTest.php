<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PptransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PptransactionsTable Test Case
 */
class PptransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PptransactionsTable
     */
    public $Pptransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pptransactions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pptransactions') ? [] : ['className' => 'App\Model\Table\PptransactionsTable'];
        $this->Pptransactions = TableRegistry::get('Pptransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pptransactions);

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
