<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiseaseCategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiseaseCategoriesTable Test Case
 */
class DiseaseCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DiseaseCategoriesTable
     */
    protected $DiseaseCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DiseaseCategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DiseaseCategories') ? [] : ['className' => DiseaseCategoriesTable::class];
        $this->DiseaseCategories = $this->getTableLocator()->get('DiseaseCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DiseaseCategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
