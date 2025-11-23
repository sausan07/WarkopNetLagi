<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleOvalLeftEllipsis;
    
    protected static ?string $navigationLabel = 'Posts/Replies';
    
    protected static ?string $modelLabel = 'Post/Reply';
    
    protected static ?string $pluralModelLabel = 'Posts/Replies';
    
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('user_id')
                    ->label('Author')
                    ->relationship('user', 'username')
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\Select::make('thread_id')
                    ->label('Thread')
                    ->relationship('thread', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\Textarea::make('content')
                    ->label('Content')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                    
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('thread.title')
                    ->label('Thread')
                    ->searchable()
                    ->limit(40)
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->limit(60)
                    ->searchable()
                    ->wrap(),
                    
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
                    
                Tables\Columns\TextColumn::make('likes_count')
                    ->label('Likes')
                    ->counts('likes')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Posted At')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                    
                Tables\Filters\SelectFilter::make('thread')
                    ->relationship('thread', 'title')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'username')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    
                    BulkAction::make('activate')
                        ->label('Set as Active')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each->update(['status' => 'active']);
                        }),
                        
                    BulkAction::make('deactivate')
                        ->label('Set as Inactive')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each->update(['status' => 'inactive']);
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ManagePosts::route('/'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
