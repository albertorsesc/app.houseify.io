<?php

namespace Tests\Unit\Http\Requests\Businesses;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\BusinessTestCase;
use App\Models\Businesses\Business;

class BusinessRequestTest extends BusinessTestCase
{
    private string $routePrefix = 'api.businesses.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function name_is_required()
    {
        $validatedField = 'name';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function name_must_be_unique()
    {
        $validatedField = 'name';
        $brokenRule = 'my-great-business';
        $this->create(Business::class, ['name' => $brokenRule]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->makeBusiness([$validatedField => $brokenRule])
        )->assertJsonValidationErrors($validatedField);

        // * Can't Update Business name
        /*$existingAd = $this->create(Business::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);*/
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function name_must_not_exceed_150_characters()
    {
        $validatedField = 'name';
        $brokenRule = Str::random(151);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function owner_id_must_be_equal_to_authenticated_user_id()
    {
        $notOwner = $this->create(User::class);
        $validatedField = 'owner_id';
        $brokenRule = $notOwner->id;

        $response = $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Business::class, [
                $validatedField => $brokenRule
            ])->toArray()
        );

        $this->assertTrue($response->getOriginalContent()->owner_id === auth()->id());
        $this->assertTrue(Business::first()->owner()->is(auth()->user()));
        $this->assertFalse(Business::first()->owner_id === $notOwner->id);

        $existingBusiness = $this->create(Business::class, ['owner_id' => auth()->id()]);
        $this->putJson(
            route($this->routePrefix . 'update', $existingBusiness),
            $this->make(Business::class, [
                $validatedField => $brokenRule
            ])->toArray()
        );

        $this->assertTrue($existingBusiness->owner_id === auth()->id());
        $this->assertTrue($existingBusiness->owner()->is(auth()->user()));
        $this->assertFalse($existingBusiness->owner_id === $notOwner->id);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_have_a_valid_format()
    {
        $validatedField = 'email';
        $brokenRule = 'not-an-email';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Business::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_not_exceed_150_characters()
    {
        $validatedField = 'email';
        $brokenRule = Str::random(141) . '@email.com';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Business::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function phone_must_not_exceed_150_characters()
    {
        $validatedField = 'phone';
        $brokenRule = Str::random(51);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Business::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function site_must_have_a_valid_format()
    {
        $validatedField = 'site';
        $brokenRule = 'not-a-site';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Business::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function site_must_not_exceed_255_characters()
    {
        $validatedField = 'site';
        $brokenRule = 'https//' . Str::random(249);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingAd = $this->create(Business::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingAd),
            $this->make(Business::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
