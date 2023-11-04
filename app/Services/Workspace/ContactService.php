<?php

namespace App\Services\Workspace;

use App\Enums\DefaultStatus;
use App\Models\Workspace\Contact;
use App\Models\Workspace\ContactIndividual;
use App\Models\Workspace\ContactLegalEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactService
{
    public function __construct(
        protected Contact $contact,
        protected ContactIndividual $individual,
        protected ContactLegalEntity $legalEntity
    ) {
        $this->contact = $contact;
        $this->individual = $individual;
        $this->legalEntity = $legalEntity;
    }

    public function tableSearchByPhone(Builder $query, string $search): Builder
    {
        // $query->whereRaw('JSON_SEARCH(phones, "one", ?) IS NOT NULL', [$search]);

        return $query;
    }

    public function getUserContactOptionsBySearch(?string $search): array
    {
        return $this->individual->whereHas('contact', function (Builder $query): Builder {
            return $query->doesntHave('user');
        })
            ->where(function (Builder $query) use ($search): Builder {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->limit(50)
            ->get()
            ->mapWithKeys(function ($item): array {
                return [$item->contact->id => $item->name];
            })
            ->toArray();
    }

    public function getContactOptionLabel(?string $value): string
    {
        return $this->contact->find($value)?->contactable->name;
    }

    public function getContactInfos(?int $contactId): array
    {
        $result = [
            'name'  => '',
            'email' => '',
        ];

        if ($contactId) {
            $contact = $this->contact->findOrFail($contactId);

            $result = [
                'name'  => $contact->contactable->name,
                'email' => $contact->contactable->email,
            ];
        }

        return $result;
    }
}
