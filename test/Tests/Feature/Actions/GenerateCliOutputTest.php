<?php

namespace Tests\Feature\Actions;

use FumeApp\ModelTyper\Actions\GenerateCliOutput;
use FumeApp\ModelTyper\Actions\GetMappings;
use FumeApp\ModelTyper\Actions\GetModels;
use Tests\Feature\TestCase;

class GenerateCliOutputTest extends TestCase
{
    /** @test */
    public function test_action_can_be_resolved_by_application()
    {
        $this->assertInstanceOf(GenerateCliOutput::class, resolve(GenerateCliOutput::class));
    }

    /** @test */
    public function test_action_can_be_executed()
    {
        $action = app(GenerateCliOutput::class);
        $result = $action(app(GetModels::class)(), app(GetMappings::class)());

        $this->assertIsString($result);
    }
}
