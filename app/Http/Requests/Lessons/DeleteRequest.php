<?php


namespace App\Http\Requests\Lessons;

use App\Rules\LessonTimeAvailabilityRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lessons,id',
        ];
    }
}
