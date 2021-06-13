<?php


namespace App\Http\Requests\Lessons;

use App\Rules\LessonTimeAvailabilityRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'class_id' => [
                'required',
                'integer'],
            'teacher_id' => [
                'required',
                'integer'],
            'weekday' => [
                'required',
                'integer',
                'min:1',
                'max:7'],
            'start_time' => [
                'required',
                new LessonTimeAvailabilityRule(),
                'date_format:H:i'],
            'end_time' => [
                'required',
                'after:start_time',
                'date_format:H:i'],
        ];
    }
}
