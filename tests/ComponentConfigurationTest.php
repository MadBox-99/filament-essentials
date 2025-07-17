<?php

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use FilamentEssentials\Facades\FilamentEssentials;

test('select gets automatic configuration', function () {
    $select = Select::make('category');
    
    expect($select)->toBeInstanceOf(Select::class);
});

test('datepicker gets automatic configuration', function () {
    $datepicker = DatePicker::make('date');
    
    expect($datepicker)->toBeInstanceOf(DatePicker::class);
});

test('toggle gets automatic configuration', function () {
    $toggle = Toggle::make('active');
    
    expect($toggle)->toBeInstanceOf(Toggle::class);
});

test('file upload gets automatic configuration', function () {
    $fileUpload = FileUpload::make('image');
    
    expect($fileUpload)->toBeInstanceOf(FileUpload::class);
});

test('facade provides configuration access', function () {
    $config = FilamentEssentials::getDefaultConfig();
    
    expect($config)->toBeArray()
        ->and($config)->toHaveKey('default_translatable')
        ->and($config)->toHaveKey('default_text_maxlength');
});

test('facade can check translatable setting', function () {
    $isTranslatable = FilamentEssentials::isTranslatableByDefault();
    
    expect($isTranslatable)->toBeBool();
});
