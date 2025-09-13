<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Actor extends Model
{
    protected $fillable = [
        'email',
        'description',
        'first_name',
        'last_name',
        'address',
        'height',
        'weight',
        'gender',
        'age'
    ];

    public static function validationRules()
    {
        return [
            'email' => 'required|email|unique:actors,email',
            'description' => 'required|string|min:10',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|integer|min:1|max:150'
        ];
    }
}
