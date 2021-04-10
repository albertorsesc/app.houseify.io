<?php

namespace Tests\Feature\Api\Properties\Actions;

use App\Models\Properties\Concerns\BusinessType;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyType;
use Tests\PropertyTestCase;
use App\Models\Properties\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchPropertiesTest extends PropertyTestCase
{
    use RefreshDatabase;

    private string $route = 'api.properties.search';

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_search_a_property_by_title_or_comments()
    {
        $this->signIn();

        $property = $this->create(Property::class, [
            'title' => 'Departamento en el campo',
            'comments' => 'Lujoso departamento'
        ]);
        $this->create(Property::class);

        $response = $this->postJson(route($this->route), [
            'title_or_comments' => 'campo'
        ]);
        $this->assertCount(1, $response->getOriginalContent());

        $response = $this->postJson(route($this->route), [
            'title_or_comments' => 'lujoso'
        ]);

        $this->assertCount(1, $response->getOriginalContent());
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_search_a_property_by_price_range()
    {
        $this->signIn();

        $property = $this->create(Property::class, [
            'price' => 4000
        ]);
        $this->create(Property::class, ['price' => 1000]);
        $this->create(Property::class, ['price' => 6000]);

        $response = $this->postJson(route($this->route), [
            'from_price' => 2000,
        ]);

        $this->assertCount(2, $response->getOriginalContent());

        $response = $this->postJson(route($this->route), [
            'to_price' => 5000,
        ]);

        $this->assertCount(2, $response->getOriginalContent());

        $response = $this->postJson(route($this->route), [
            'from_price' => 5000,
        ]);

        $this->assertCount(1, $response->getOriginalContent());

        $response = $this->postJson(route($this->route), [
            'to_price' => 5000,
        ]);

        $this->assertCount(2, $response->getOriginalContent());
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_search_a_property_by_business_type()
    {
        $this->signIn();

        $property = $this->create(Property::class, [
            'business_type' => BusinessType::TYPES['rent']
        ]);
        $this->create(Property::class, [
            'business_type' => BusinessType::TYPES['sale']
        ]);

        $response = $this->postJson(route($this->route), [
            'business_types' => [BusinessType::TYPES['rent']]
        ]);

        $this->assertCount(1, $response->getOriginalContent());
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_search_a_property_by_property_category()
    {
        $this->signIn();

        $property = $this->create(Property::class, [
            'property_category_id' => PropertyCategory::where('name', 'house')->first()->id,
        ]);
        $this->create(Property::class, [
            'property_category_id' => PropertyCategory::where('name', 'office')->first()->id,
        ]);

        $response = $this->postJson(route($this->route), [
            'property_category' => 'Casa'
        ]);

        $this->assertCount(1, $response->getOriginalContent());
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function authenticated_user_can_search_a_property_by_property_type()
    {
        $this->signIn();

        $propertyType = PropertyType::where('display_name', 'Residencial')->first();
        $propertyCategory = PropertyCategory::where('property_type_id', $propertyType->id)->first();

        $property = $this->create(Property::class, [
            'property_category_id' => $propertyCategory->id,
        ]);
        $this->create(Property::class, [
            'property_category_id' => PropertyCategory::where('name', 'office')->first()->id,
        ]);

        $response = $this->postJson(route($this->route), [
            'property_type' => 'Residencial'
        ]);

        $this->assertCount(1, $response->getOriginalContent());
    }
}
