<?php

// Példa arra, hogyan működik a Filament Essentials csomag

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

// KORÁBBAN: Sok boilerplate kód minden komponensnél
$traditionalForm = [
    TextInput::make('name')
        ->translatable()
        ->required()
        ->maxLength(255),
    
    Textarea::make('description')
        ->translatable()
        ->required()
        ->maxLength(1000)
        ->rows(3),
    
    Select::make('category_id')
        ->relationship('category', 'name')
        ->translatable()
        ->searchable()
        ->required(),
    
    DatePicker::make('published_at')
        ->format('Y-m-d')
        ->displayFormat('Y. m. d.'),
    
    Toggle::make('is_active')
        ->onColor('success')
        ->offColor('gray'),
    
    FileUpload::make('image')
        ->maxSize(2048)
        ->acceptedFileTypes(['image/*'])
        ->downloadable()
        ->previewable(),
];

// MOST: Filament Essentials automatikusan beállít mindent!
$essentialsForm = [
    TextInput::make('name'),
    // ↑ Automatikusan translateLabel(), max 255 karakter
    
    Textarea::make('description'),
    // ↑ Automatikusan translateLabel(), max 1000 karakter, 3 sor
    
    Select::make('category_id')
        ->relationship('category', 'name'),
    // ↑ Automatikusan translateLabel(), searchable
    
    DatePicker::make('published_at'),
    // ↑ Automatikusan Y. m. d. formátum
    
    Toggle::make('is_active'),
    // ↑ Automatikusan zöld/szürke színek
    
    FileUpload::make('image'),
    // ↑ Automatikusan 2MB limit, képek, letölthető és előnézet
];

// Ha specifikus beállítást szeretnél, egyszerűen felülírod:
$customForm = [
    TextInput::make('special_name')
        ->maxLength(500), // Felülírja az alapértelmezett 255-öt
    
    Textarea::make('long_description')
        ->maxLength(5000) // Felülírja az alapértelmezett 1000-et
        ->rows(10),       // Felülírja az alapértelmezett 3-at
];

// A translateLabel() automatikusan be van kapcsolva és biztonságos!
// Ez lefordítja a mezők címkéit a Laravel lang fájlok alapján.
// Például: TextInput::make('name') → automatikusan "Név" címke
