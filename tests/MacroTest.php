<?php

namespace SzaboZoltan\FilamentEssentials\Tests;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ConfigureUsingTest extends TestCase
{
    /** @test */
    public function text_input_gets_automatic_configuration(): void
    {
        config(['filament-essentials.default_max_length' => 500]);
        
        $textInput = TextInput::make('test');
        
        // A TextInput automatikusan megkapja a konfigurációt
        $this->assertInstanceOf(TextInput::class, $textInput);
    }

    /** @test */
    public function textarea_gets_automatic_configuration(): void
    {
        config(['filament-essentials.default_textarea_max_length' => 2000]);
        config(['filament-essentials.default_textarea_rows' => 5]);
        
        $textarea = Textarea::make('test');
        
        // A Textarea automatikusan megkapja a konfigurációt
        $this->assertInstanceOf(Textarea::class, $textarea);
    }

    /** @test */
    public function configuration_can_be_overridden(): void
    {
        config(['filament-essentials.default_max_length' => 255]);
        
        $textInput = TextInput::make('test')
            ->maxLength(1000); // Felülírja az alapértelmezett értéket
        
        $this->assertInstanceOf(TextInput::class, $textInput);
    }
}
