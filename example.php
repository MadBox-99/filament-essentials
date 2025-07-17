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
        ->translateLabel()
        ->required()
        ->maxLength(255),
    
    Textarea::make('description')
        ->translateLabel()
        ->required()
        ->rows(3)
        ->cols(50),
    
    Select::make('category_id')
        ->relationship('category', 'name')
        ->translateLabel()
        ->searchable()
        ->required(),
    
    DatePicker::make('published_at')
        ->format('Y-m-d')
        ->displayFormat('Y. m. d.')
        ->required(),
    
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
    // ↑ Automatikusan max 255 karakter (opcionálisan translateLabel)
    
    Textarea::make('description'),
    // ↑ Automatikusan 3 sor, 50 oszlop (opcionálisan translateLabel)
    
    Select::make('category_id')
        ->relationship('category', 'name'),
    // ↑ Automatikusan searchable (opcionálisan translateLabel)
    
    DatePicker::make('published_at'),
    // ↑ Automatikusan Y. m. d. formátum (opcionálisan translateLabel)
    
    Toggle::make('is_active'),
    // ↑ Automatikusan zöld/szürke színek (opcionálisan translateLabel)
    
    FileUpload::make('image'),
    // ↑ Automatikusan 2MB limit, képek, letölthető és előnézet
];

// Ha specifikus beállítást szeretnél, egyszerűen felülírod:
$customForm = [
    TextInput::make('special_name')
        ->maxLength(500)  // Felülírja az alapértelmezett 255-öt
        ->required(),     // Hozzáadod ha szükséges
    
    Textarea::make('long_description')
        ->rows(10)        // Felülírja az alapértelmezett 3-at
        ->cols(80)        // Felülírja az alapértelmezett 50-et
        ->required(),     // Hozzáadod ha szükséges
];

// Ha bekapcsolod a translateLabel() funkciót a konfigban:
// config/filament-essentials.php: 'default_translatable' => true
// Akkor automatikusan lefordítja a mezők címkéit a Laravel lang fájlok alapján.
// Például: TextInput::make('name') → automatikusan "Név" címke
