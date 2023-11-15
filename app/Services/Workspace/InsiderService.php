<?php

namespace App\Services\Workspace;

use App\Enums\UserStatus;
use App\Models\User;
use App\Models\Workspace\ContactIndividual;
use App\Models\Workspace\Insider;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class InsiderService
{
    public function __construct(protected Insider $insider)
    {
        $this->insider = $insider;
    }

    public function forceScopeActiveStatus(): Builder
    {
        // statuses 1 - active
        return $this->insider->byStatuses(statuses: [1,]);
    }

    public function tableSearchByCpf(Builder $query, string $search): Builder
    {
        // return $query->whereHas('contact', function (Builder $query) use ($search): Builder {
        //     $contactableType = array_search(ContactIndividual::class, Relation::morphMap(), true);
        //     return $query->where('contactable_type', $contactableType)
        //         ->whereHas('contactable', function (Builder $query) use ($search): Builder {
        //             return $query->where('cpf', 'like', "%{$search}%");
        //         });
        // });

        return $query;
    }

    public function tableSearchByPhone(Builder $query, string $search): Builder
    {
        // $query->whereRaw('JSON_SEARCH(phones, "one", ?) IS NOT NULL', [$search]);

        return $query;
    }

    public function tableSearchByStatus(Builder $query, string $search): Builder
    {
        $statuses = UserStatus::asSelectArray();

        $matchingStatuses = [];
        foreach ($statuses as $index => $status) {
            if (stripos($status, $search) !== false) {
                $matchingStatuses[] = $index;
            }
        }

        if ($matchingStatuses) {
            return $query->whereIn('status', $matchingStatuses);
        }

        return $query;
    }

    public function tableSortByStatus(Builder $query, string $direction): Builder
    {
        $statuses = UserStatus::asSelectArray();

        $caseParts = [];
        $bindings = [];

        foreach ($statuses as $key => $status) {
            $caseParts[] = "WHEN ? THEN ?";
            $bindings[] = $key;
            $bindings[] = $status;
        }

        $orderByCase = "CASE status " . implode(' ', $caseParts) . " END";

        return $query->orderByRaw("$orderByCase $direction", $bindings);
    }

    /**
     * $action can be:
     * Filament\Tables\Actions\DeleteAction;
     * Filament\Actions\DeleteAction;
     */
    // public function preventUserDeleteWithRelations($action, User $user): void
    // {
    //     if ($user->count() > 0) {
    //         Notification::make()
    //             ->title('Este usuário possui ... relacionados.')
    //             ->warning()
    //             ->body('Para excluir, você deve primeiro desvincular todos os ... deste usuário.')
    //             ->send();

    //         // $action->cancel();
    //         $action->halt();
    //     }
    // }
}
