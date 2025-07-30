<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use App\Mail\PostApproved;
use Illuminate\Support\Facades\Mail;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // email is also send to the superamdin if the post is edited to approve if created the email is not sent
        if ($data['is_approved'] && $data['is_approved'] == true || $data['is_approved'] == '1') {
            Mail::to(auth()->user()->email)->send(new PostApproved($this->record));
        }

        return $data;
    }
}
