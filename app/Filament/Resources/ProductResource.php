<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Catalog';
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $modelLabel = 'Product';
    protected static ?string $pluralModelLabel = 'Products';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Product Information')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Product Name')
                    ->placeholder('e.g. Green Pepper')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                        $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->hidden(),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->placeholder('Select category'),

                Forms\Components\TextInput::make('size')
                    ->label('Size / Unit')
                    ->placeholder('e.g. 1kg, Per Dozen, Live Animal')
                    ->required()
                    ->maxLength(255),
            ])->columns(2),

            Forms\Components\Section::make('Description')->schema([
                Forms\Components\TextInput::make('short_description')
                    ->label('Short Description')
                    ->placeholder('A short, 1-sentence description...')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]),

            // -------- MULTIPLE IMAGES (Up to 5) --------
            Forms\Components\Section::make('Product Images (Up to 5)')->schema([
                Forms\Components\Repeater::make('images')
                    ->relationship()
                    ->schema([
                        Forms\Components\FileUpload::make('url')
                            ->label('Image')
                            ->image()
                            ->directory('products')
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->hidden(), 
                    ])
                    ->maxItems(5)
                    ->itemLabel(fn (array $state): ?string => $state['url'] ? 'Uploaded Image' : null)
                    ->collapsible()
                    ->cloneable()
                    ->grid(3),
            ]),

            Forms\Components\Section::make('Status')->schema([
                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->helperText('Product will be visible on the website.')
                    ->default(true)
                    ->inline(false),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Show the first image from the gallery
                Tables\Columns\ImageColumn::make('images.0.url')
                    ->label('')
                    ->square()
                    ->size(40)
                    ->defaultImageUrl(url('/images/logo.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('size')
                    ->label('Size')
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('name', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}