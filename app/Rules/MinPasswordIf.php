<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class MinPasswordIf implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($params, $numberMin, $field)
    {
        $this->params = $params;
        $this->numberMin = $numberMin;
        $this->field = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (isset($this->params['alter-password']) || !isset($this->params['id'])) {
            return strlen($this->params['password']) >= $this->numberMin ? true : false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O campo {$this->field} deve ter no mínimo 8 caracteres.";
    }
}
