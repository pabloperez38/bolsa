<?php

namespace Tests\Feature;

use App\Models\Trabajo;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TrabajoFechaCierreTest extends TestCase
{
    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_la_oferta_sigue_vigente_hasta_el_final_de_su_fecha_de_cierre(): void
    {
        Carbon::setTestNow(Carbon::parse(
            '2026-10-17 23:00:00',
            'America/Argentina/Buenos_Aires'
        ));

        $trabajo = new Trabajo(['fecha_cierre' => '2026-10-17']);

        $this->assertSame('date', $trabajo->getCasts()['fecha_cierre']);
        $this->assertTrue($trabajo->fechaCierreVigente());
        $this->assertSame(
            '2026-10-17 23:59:59',
            $trabajo->fechaCierreVencimiento()->format('Y-m-d H:i:s')
        );
        $this->assertSame(1, $trabajo->diasRestantes());

        Carbon::setTestNow(Carbon::parse(
            '2026-10-18 00:00:00',
            'America/Argentina/Buenos_Aires'
        ));

        $this->assertFalse($trabajo->fechaCierreVigente());
        $this->assertSame(0, $trabajo->diasRestantes());
    }
}
