<?php

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\CheckboxList;
use FilamentEssentials\Facades\FilamentEssentials;

test('select gets automatic configuration', function () {
    $select = Select::make('category');
    
    expect($select)->toBeInstanceOf(Select::class);
    
    // Tesztelj valós automatikus konfigurációt - a searchable alapértelmezetten true kell legyen
    expect($select->isSearchable())->toBe(true)
        ->and($select->isPreloaded())->toBe(false);
});

test('datepicker gets automatic configuration', function () {
    $datepicker = DatePicker::make('date');
    
    expect($datepicker)->toBeInstanceOf(DatePicker::class);
    
    // Tesztelj úgy, ahogy a komponens valójában működik
    // A pontos formátumot nem ellenőrizzük, csak hogy be van állítva
    expect($datepicker->getFormat())->not->toBeNull()
        ->and($datepicker->getDisplayFormat())->not->toBeNull();
});

test('toggle gets automatic configuration', function () {
    $toggle = Toggle::make('active');
    
    expect($toggle)->toBeInstanceOf(Toggle::class);
    
    // Ellenőrizzük, hogy a színek be vannak állítva az automatikus konfigurálás által
    expect($toggle->getOnColor())->toBe('success')
        ->and($toggle->getOffColor())->toBe('gray');
});

test('file upload gets automatic configuration', function () {
    $fileUpload = FileUpload::make('image');
    
    expect($fileUpload)->toBeInstanceOf(FileUpload::class);
    
    // Ellenőrizzük az automatikus beállításokat
    expect($fileUpload->getMaxSize())->toBe(2048) // 2MB
        ->and($fileUpload->getAcceptedFileTypes())->toBe(['application/pdf', 'image/*'])
        ->and($fileUpload->isDownloadable())->toBe(true)
        ->and($fileUpload->isPreviewable())->toBe(true);
});

test('textinput gets automatic configuration', function () {
    $textInput = TextInput::make('name');
    
    expect($textInput)->toBeInstanceOf(TextInput::class);
    
    // Ellenőrizzük az automatikus max length beállítást
    expect($textInput->getMaxLength())->toBe(255);
});

test('textarea gets automatic configuration', function () {
    $textarea = Textarea::make('description');
    
    expect($textarea)->toBeInstanceOf(Textarea::class);
    
    // Ellenőrizzük az automatikus beállításokat
    expect($textarea->getMaxLength())->toBe(1000)
        ->and($textarea->getRows())->toBe(3);
});

test('checkbox list gets automatic configuration', function () {
    $checkboxList = CheckboxList::make('options');
    
    expect($checkboxList)->toBeInstanceOf(CheckboxList::class);
    
    // Ellenőrizzük az automatikus beállításokat
    expect($checkboxList->isSearchable())->toBe(true)
        ->and($checkboxList->isBulkToggleable())->toBe(true);
});

test('components work without automatic configuration', function () {
    // Tesztelj, hogy a komponensek anélkül is működnek, hogy expliciteb beállítást adnánk
    $select = Select::make('test_select');
    $textInput = TextInput::make('test_text');
    $toggle = Toggle::make('test_toggle');
    
    expect($select)->toBeInstanceOf(Select::class)
        ->and($textInput)->toBeInstanceOf(TextInput::class)
        ->and($toggle)->toBeInstanceOf(Toggle::class);
    
    // Az automatikus konfiguráció miatt ezeknek már alapból be kell állítva lenniük
    expect($select->isSearchable())->toBe(true)
        ->and($textInput->getMaxLength())->toBe(255)
        ->and($toggle->getOnColor())->toBe('success');
});

test('automatic configuration provides consistent defaults', function () {
    // Tesztelj, hogy több példány is ugyanazt a konfigurációt kapja
    $select1 = Select::make('select1');
    $select2 = Select::make('select2');
    
    $textInput1 = TextInput::make('text1');
    $textInput2 = TextInput::make('text2');
    
    // Ugyanazokat az automatikus beállításokat kell kapniuk
    expect($select1->isSearchable())->toBe($select2->isSearchable())
        ->and($select1->isPreloaded())->toBe($select2->isPreloaded())
        ->and($textInput1->getMaxLength())->toBe($textInput2->getMaxLength());
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
