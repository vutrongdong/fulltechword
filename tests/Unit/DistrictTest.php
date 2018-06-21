<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\Districts\District;
use App\Repositories\Districts\DistrictRepository;

class DistrictTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_can_listing_district_by_city_id()
    {
        factory(District::class, 2)->create([
            "city_id" => 1
        ]);

        factory(District::class, 4)->create([
            "city_id" => 2
        ]);

        $districtRepository = \App::make(DistrictRepository::class);
        $_districts_1 = $districtRepository->getByCity(1);
        $_districts_2 = $districtRepository->getByCity(2);

        $this->assertInstanceOf(Collection::class, $_districts_1);
        $this->assertInstanceOf(Collection::class, $_districts_2);
        $this->assertEquals($_districts_1->count(), 2);
        $this->assertEquals($_districts_2->count(), 4);
    }
}
