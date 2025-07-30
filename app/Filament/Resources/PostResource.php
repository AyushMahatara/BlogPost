<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use App\Mail\PostApproved;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use Filament\Tables\Actions\ActionGroup;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-s-megaphone';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->hasRole('super_admin')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\MarkdownEditor::make('content')->required()->columnSpanFull(),
                Forms\Components\Select::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Forms\Components\Toggle::make('is_approved')->label('Approved')->columnSpanFull()->visible(fn($record) => auth()->user()->hasRole('super_admin')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable()->wrap(),
                Tables\Columns\TextColumn::make('content')->limit(15),
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('tags.name')->badge()->wrap(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->icon(fn($state) => $state ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle')
                    ->color(fn($state) => $state ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('user.name')->label('Author'),

            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([

                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('approve')
                        ->label('Approve')
                        ->icon('heroicon-s-check-circle')
                        ->action(function (Post $record) {
                            // Check if the post is already approved
                            if ($record->is_approved) {
                                // If the post is already approved, show a notification and stop the email from being sent
                                Notification::make()
                                    ->title('This post is already approved.')
                                    ->warning()
                                    ->send();

                                return; // Prevent further actions, including sending the email
                            }

                            // Update the post's approval status
                            $record->update(['is_approved' => true]);

                            // Send an email to the user informing them that the post is approved
                            Mail::to($record->user->email)->send(new PostApproved($record));

                            // Show success notification
                            Notification::make()
                                ->title('Post approved and email sent!')
                                ->success()
                                ->send();
                        })
                        ->color('success')
                        ->visible(fn($record) => auth()->user()->hasRole('super_admin')),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
