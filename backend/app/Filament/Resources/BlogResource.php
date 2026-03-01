<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Bài viết / Blog';
    protected static ?string $modelLabel = 'Bài viết';
    protected static ?string $pluralModelLabel = 'Bài viết';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Nội dung bài viết')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Tiêu đề')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->label('Đường dẫn (slug)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->label('Danh mục')
                    ->options([
                        'Cẩm nang' => 'Cẩm nang',
                        'Tin hàng không' => 'Tin hàng không',
                        'Mẹo du lịch' => 'Mẹo du lịch',
                        'Khuyến mãi' => 'Khuyến mãi',
                        'Sự kiện' => 'Sự kiện',
                        'Cẩm nang điểm đến' => 'Cẩm nang điểm đến',
                    ])
                    ->required()
                    ->default('Cẩm nang'),
                Forms\Components\Textarea::make('excerpt')
                    ->label('Tóm tắt')
                    ->rows(3)
                    ->maxLength(500),
                Forms\Components\RichEditor::make('content')
                    ->label('Nội dung chi tiết')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Thông tin bổ sung')->schema([
                Forms\Components\TextInput::make('image_url')
                    ->label('URL hình ảnh')
                    ->url()
                    ->maxLength(500),
                Forms\Components\TextInput::make('author')
                    ->label('Tác giả')
                    ->default('Gia Bảo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('read_time')
                    ->label('Thời gian đọc (phút)')
                    ->numeric()
                    ->default(5),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Ngày đăng'),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Tin nổi bật'),
                Forms\Components\Toggle::make('is_published')
                    ->label('Đã xuất bản')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category')
                    ->label('Danh mục')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Cẩm nang' => 'success',
                        'Tin hàng không' => 'info',
                        'Mẹo du lịch' => 'warning',
                        'Khuyến mãi' => 'danger',
                        'Sự kiện' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('author')
                    ->label('Tác giả'),
                Tables\Columns\TextColumn::make('read_time')
                    ->label('Đọc')
                    ->suffix(' phút')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Xuất bản')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Ngày đăng')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Danh mục')
                    ->options([
                        'Cẩm nang' => 'Cẩm nang',
                        'Tin hàng không' => 'Tin hàng không',
                        'Mẹo du lịch' => 'Mẹo du lịch',
                        'Khuyến mãi' => 'Khuyến mãi',
                        'Sự kiện' => 'Sự kiện',
                    ]),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Trạng thái'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Nổi bật'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
