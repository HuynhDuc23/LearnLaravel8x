<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UpperCase implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Kiểm tra độ dài mật khẩu phải lớn hơn 8
        if (strlen($value) <= 8) {
            $fail('The :attribute phải dài hơn 8 ký tự.');
            return;
        }

        // Kiểm tra mật khẩu phải có cả chữ cái và số
        if (!preg_match('/[A-Za-z]/', $value) || !preg_match('/[0-9]/', $value)) {
            $fail('The :attribute phải chứa cả và số.');
        }
    }
}
