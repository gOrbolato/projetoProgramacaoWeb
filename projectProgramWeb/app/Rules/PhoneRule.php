<?php

namespace App\Rules;

use App\Libraries\Bankly\Bankly;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class PhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make(['value' => $value], [
            'value' => 'string',
        ]);

        $erros = $validator->errors()->count();
        if ($erros)
            $fail("The phone field is invalid.");

        $value = str_replace([' ', '(', ')', '-', '+55'], '', $value);
        if (!$this->validaCelularBR($value)) {
            $fail("The phone field is invalid.");
        }
    }

    private function validaCelularBR($celular)
    {
        // Verifica se o número de celular tem 11 ou 12 dígitos
        if (strlen($celular) != 11 && strlen($celular) != 10) {
            return false;
        }
        // Verifica se o primeiro dígito é um número de DDD válido
        $ddd          = substr($celular, 0, 2);
        $ddds_validos = [
            '11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24', '27', '28', '31', '32', '33', '34', '35', '37',
            '38', '41', '42', '43', '44', '45', '46', '47', '48', '49', '51', '53', '54', '55', '61', '62', '63', '64', '65', '66',
            '67', '68', '69', '71', '73', '74', '75', '77', '79', '81', '82', '83', '84', '85', '86', '87', '88', '89', '91', '92',
            '93', '94', '95', '96', '97', '98', '99'
        ];
        if (!in_array($ddd, $ddds_validos)) {
            return false;
        }
        // Verifica se os dígitos restantes são números de telefone válidos
        for ($i = 2; $i < strlen($celular); $i++) {
            if (!is_numeric($celular[$i])) {
                return false;
            }
        }
        // O número de celular é válido
        return true;
    }
}
