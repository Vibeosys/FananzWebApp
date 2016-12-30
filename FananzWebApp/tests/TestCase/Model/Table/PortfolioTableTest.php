<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PortfolioTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PortfolioTable Test Case
 */
class PortfolioTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PortfolioTable
     */
    public $Portfolio;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.portfolio'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Portfolio') ? [] : ['className' => 'App\Model\Table\PortfolioTable'];
        $this->Portfolio = TableRegistry::get('Portfolio', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Portfolio);

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
