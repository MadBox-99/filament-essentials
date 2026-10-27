<?php

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

it('leaves components untouched by default', function () {
    expect(TextInput::make('name')->getMaxLength())->toBeNull()
        ->and(Select::make('category')->isSearchable())->toBeFalse()
        ->and(FileUpload::make('image')->getAcceptedFileTypes())->toBeNull();
});

describe('when enabled', function () {
    beforeEach(fn () => config(['filament-essentials.component_defaults' => true]));

    it('applies the configured defaults', function () {
        $fileUpload = FileUpload::make('image');

        expect(TextInput::make('name')->getMaxLength())->toBe(255)
            ->and(Textarea::make('description')->getMaxLength())->toBe(1000)
            ->and(Textarea::make('description')->getRows())->toBe(3)
            ->and(Select::make('category')->isSearchable())->toBeTrue()
            ->and(DatePicker::make('date')->getDisplayFormat())->toBe('Y. m. d.')
            ->and(Toggle::make('active')->getOnColor())->toBe('success')
            ->and(CheckboxList::make('options')->isSearchable())->toBeTrue()
            ->and($fileUpload->getMaxSize())->toBe(2048)
            ->and($fileUpload->getAcceptedFileTypes())->toBe(['application/pdf', 'image/*']);
    });

    it('lets the component override a default', function () {
        expect(TextInput::make('name')->maxLength(500)->getMaxLength())->toBe(500);
    });
});
