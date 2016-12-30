<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PortfolioPhotosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PortfolioPhotosTable Test Case
 */
class PortfolioPhotosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PortfolioPhotosTable
     */
    public $PortfolioPhotos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.portfolio_photos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PortfolioPhotos') ? [] : ['className' => 'App\Model\Table\PortfolioPhotosTable'];
        $this->PortfolioPhotos = TableRegistry::get('PortfolioPhotos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PortfolioPhotos);

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
