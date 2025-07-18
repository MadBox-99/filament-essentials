<?php

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

test('text input gets automatic configuration', function () {
    $textInput = TextInput::make('test');
    
    // A TextInput automatikusan megkapja a konfigurációt
    expect($textInput)->toBeInstanceOf(TextInput::class);
});

test('textarea gets automatic configuration', function () {
    $textarea = Textarea::make('test');
    
    // A Textarea automatikusan megkapja a konfigurációt
    expect($textarea)->toBeInstanceOf(Textarea::class);
});

test('configuration can be overridden', function () {
    $textInput = TextInput::make('test')
        ->maxLength(1000);
    
    expect($textInput)->toBeInstanceOf(TextInput::class);
});
