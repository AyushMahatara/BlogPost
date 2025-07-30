<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        if (auth()->user()->hasRole('super_admin')) {
            return [
                Stat::make('Total Post', Post::count())->url(PostResource::getUrl('index')),
                Stat::make('Total Approved Post', Post::where('is_approved', true)->count())->url(PostResource::getUrl('index')),
                Stat::make('Total Categories', \App\Models\Category::count())->url(\App\Filament\Resources\CategoryResource::getUrl('index')),
                Stat::make('Total Tags', \App\Models\Tag::count())->url(\App\Filament\Resources\TagResource::getUrl('index')),
                Stat::make('Total Users', \App\Models\User::count())->url(\App\Filament\Resources\UserResource::getUrl('index')),
            ];
        } else {
            return [
                Stat::make('Total Post', Post::where('user_id', auth()->id())->count())->url(PostResource::getUrl('index')),
                Stat::make('Total Approved Post', Post::where('is_approved', true)->count())->url(PostResource::getUrl('index')),
            ];
        }
    }
}
