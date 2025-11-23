<?php

namespace App\Providers;
use App\Models\Categories;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Services\MessageService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share categories across all views
        // View::composer('*', function ($view) {
        //     $view->with('categories', Categories::all());
        // });

        // Share conversations with all views for authenticated users
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $messageService = app(MessageService::class);
                $conversations = $messageService->getUserConversations(Auth::id());
                
                // Calculate total unread count directly from conversations
                $totalUnreadCount = $conversations->sum(function ($conversation) {
                    return $conversation['unread_count'] ?? 0;
                });
                
                $view->with('conversations', $conversations);
                $view->with('totalUnreadCount', $totalUnreadCount);
            } else {
                $view->with('conversations', collect());
                $view->with('totalUnreadCount', 0);
            }
        });
    }
}
