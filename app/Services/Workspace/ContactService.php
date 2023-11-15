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

    public function getTableAvatar(Contact $contact): string
    {
        $avatar = $contact->contactable->getFirstMedia('avatar');
        if ($avatar) {
            return '<div style="width: 45px; height: 45px; background-image: url('. $avatar->getUrl('thumb') .');
                background-size: cover; background-position: center center" class="rounded-full"></div>';

            // return '<div style="min-width: 45px;">
            //             <img src="' . CreateThumb($avatar->getUrl(), 45, 45) . '" class="rounded-full">
            //         </div>';
        }

        return '';
    }

    public function tableSearchByPhone(Builder $query, string $search): Builder
    {
        // $query->whereRaw('JSON_SEARCH(phones, "one", ?) IS NOT NULL', [$search]);

        return $query;
    }

    public function getInsiderContactOptionsBySearch(?string $search): array
    {
        return $this->contact
            ->whereHas('contactable', function (Builder $query) use ($search): Builder {
                return $query->when(
                    $query->getModel()->getTable() === 'contact_individuals',
                    function ($query) use ($search): Builder {
                        return $query->where('cpf', 'like', "%{$search}%")
                            ->orWhereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), '/', '') LIKE ?", ["%{$search}%"]);
                    }
                )
                    ->when(
                        $query->getModel()->getTable() === 'contact_legal_entities',
                        function ($query) use ($search): Builder {
                            return $query->where('cnpj', 'like', "%{$search}%")
                                ->orWhereRaw("REPLACE(REPLACE(REPLACE(cnpj, '.', ''), '-', ''), '/', '') LIKE ?", ["%{$search}%"]);
                        }
                    )
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->doesntHave('insider')
            ->limit(50)
            ->get()
            ->mapWithKeys(function ($item): array {
                $cpfCnpj = $item->contactable->cpf ?? $item->contactable->cnpj;
                $contactableName = !empty($cpfCnpj) ? $item->contactable->name . ' - ' . $cpfCnpj : $item->contactable->name;
                return [$item->id => $contactableName];
            })
            ->toArray();
    }

    public function getUserContactOptionsBySearch(?string $search): array
    {
        return $this->individual->whereHas('contact', function (Builder $query): Builder {
            return $query->doesntHave('user');
        })
            ->where(function (Builder $query) use ($search): Builder {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', "%{$search}%");
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
