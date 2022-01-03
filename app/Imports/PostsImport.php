<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Auth;

class PostsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $postObj = [
            'title' => $row['title'],
            'description' => $row['description'],
            'created_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id
        ];
        if (Arr::exists($row, 'status')) {
            $postObj = array_merge($postObj, ['status'=> $row['status']]);
        } 
        return new Post($postObj);           
    }

    /**
     * Get the validation rules that apply to the import.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
        ];
    }
}
