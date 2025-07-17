<?php

// Example of how the Filament Essentials package works

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

// BEFORE: Lots of boilerplate code for every component
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

// NOW: Filament Essentials automatically configures everything!
$essentialsForm = [
    TextInput::make('name'),
    // ↑ Automatically maxLength(255) (optionally translateLabel)
    
    Textarea::make('description'),
    // ↑ Automatically maxLength(1000), rows(3) (optionally translateLabel)
    
    Select::make('category_id')
        ->relationship('category', 'name'),
    // ↑ Automatically searchable(true), preload(false) (optionally translateLabel)
    
    DatePicker::make('published_at'),
    // ↑ Automatically Y-m-d format (optionally translateLabel)
    
    Toggle::make('is_active'),
    // ↑ Automatically onColor('success'), offColor('gray') (optionally translateLabel)
    
    FileUpload::make('image'),
    // ↑ Automatically maxSize(2048) KB, images, downloadable and previewable
];

// If you want specific settings, simply override them:
$customForm = [
    TextInput::make('special_name')
        ->maxLength(500)  // Overrides the default 255
        ->required(),     // Add if needed
    
    Textarea::make('long_description')
        ->rows(10)        // Overrides the default 3
        ->cols(80)        // Overrides the default 50
        ->required(),     // Add if needed
];

// If you enable the translateLabel() function in config:
// config/filament-essentials.php: 'default_translatable' => true
// Then it automatically translates field labels based on Laravel lang files.
// Example: TextInput::make('name') → automatically "Name" label
