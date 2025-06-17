<?php

namespace Tests\Unit;

use App\Rules\BarrioValido;
use PHPUnit\Framework\TestCase;

class BarrioValidoRuleTest extends TestCase
{
    /** @test */
    public function acepta_barrios_estrictamente_validos(): void
    {
        $rule = new BarrioValido();

        $this->assertTrue($rule->passes('barrio', 'Villa Guadalupe'));
        $this->assertTrue($rule->passes('barrio', 'Pablo VI'));
    }

    /** @test */
    public function rechaza_barrios_inexistentes(): void
    {
        $rule = new BarrioValido();

        $this->assertFalse($rule->passes('barrio', 'Barrio Inventado'));
        $this->assertFalse($rule->passes('barrio', 'Castillaa'));
    }

    /** @test */
    public function mensaje_de_error_es_correcto(): void
    {
        $rule = new BarrioValido();

        $this->assertEquals(
            'El barrio seleccionado no es válido.',
            $rule->message()
        );
    }
}
