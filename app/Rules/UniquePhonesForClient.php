<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniquePhonesForClient implements Rule
{
    protected $clientId;

    public function __construct($clientId = null)
    {
        $this->clientId = $clientId;
    }

    public function passes($attribute, $value)
    {
        $query = DB::table('clients')->whereJsonContains('phone', $value);
        if ($this->clientId) {
            $query->where('id', '!=', $this->clientId);
        }
        return !$query->exists();
    }

    public function message()
    {
        return __('validation.unique_phone_for_client');
    }
}
