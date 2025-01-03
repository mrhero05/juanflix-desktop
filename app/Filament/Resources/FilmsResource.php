<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Films;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FilmsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FilmsResource\RelationManagers;

class FilmsResource extends Resource
{
    protected static ?string $model = Films::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                DatePicker::make('released_at')->required(),
                RichEditor::make('description')->columnSpan(2)->required(),
                TextInput::make('src')->required(),
                TextInput::make('trailer_src')->required(),
                FileUpload::make('poster')->required()
                ->disk('public')
                ->directory('images/films')
                ->image()->
                minSize(16)
                ->maxSize(2048),
                FileUpload::make('thumbnail')->required()
                ->disk('public')
                ->directory('images/films')
                ->image()->
                minSize(16)
                ->maxSize(2048),
                TextInput::make('rating')->required(),
                TextInput::make('duration')->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        // test
        return $table
            ->columns([
                TextColumn::make('title'),
                ImageColumn::make('poster'),
                ImageColumn::make('thumbnail')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilms::route('/create'),
            'edit' => Pages\EditFilms::route('/{record}/edit'),
        ];
    }
}
