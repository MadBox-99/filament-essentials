<?php

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Tables\Columns\TextColumn;

it('translates field labels by default', function () {
    expect(TextInput::make('first_name')->getLabel())->toBe('Keresztnév')
        ->and(Repeater::make('first_name')->getLabel())->toBe('Keresztnév');
});

it('translates infolist entry labels by default', function () {
    expect(TextEntry::make('first_name')->getLabel())->toBe('Keresztnév');
});

it('translates table column labels by default', function () {
    expect(TextColumn::make('first_name')->getLabel())->toBe('Keresztnév');
});

it('translates wizard step labels by default', function () {
    expect(Step::make('Details')->getLabel())->toBe('Részletek');
});

it('keeps untranslated labels as filament renders them', function () {
    expect(TextInput::make('last_name')->getLabel())->toBe('Last name');
});

it('lets a component opt out of translation', function () {
    expect(TextInput::make('first_name')->translateLabel(false)->getLabel())->toBe('First name');
});

it('does not translate labels when disabled', function () {
    config(['filament-essentials.translate_labels' => false]);

    expect(TextInput::make('first_name')->getLabel())->toBe('First name')
        ->and(TextEntry::make('first_name')->getLabel())->toBe('First name')
        ->and(TextColumn::make('first_name')->getLabel())->toBe('First name');
});
