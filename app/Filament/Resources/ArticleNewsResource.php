<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleNewsResource\Pages;
use App\Models\ArticleNews;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;

class ArticleNewsResource extends Resource
{
    protected static ?string $model = ArticleNews::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->required()
                ->image(),

                Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Select::make('author_id')
                ->relationship('author', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Select::make('is_featured')
                ->options([
                    'featured' => 'Featured',
                    'not_featured' => 'Not Featured',
                ])
                ->required(),

                RichEditor::make('content')
                ->required()
                ->columnSpanFull()
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),

                TextColumn::make('is_featured')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'featured' => 'success',
                    'not_featured' => 'danger',
                }),

                TextColumn::make('category.name'),

                ImageColumn::make('thumbnail'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListArticleNews::route('/'),
            'create' => Pages\CreateArticleNews::route('/create'),
            'edit' => Pages\EditArticleNews::route('/{record}/edit'),
        ];
    }
}
