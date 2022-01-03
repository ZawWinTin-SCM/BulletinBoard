<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Contracts\Services\Post\PostServiceInterface;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PostsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * post service interface
     */
    private $postServiceInterface;

    /**
     * Class Constructor
     * 
     * @param PostServiceInterface
     * @return
     */
    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->postServiceInterface->getPostListForExport();
    }

    /**
     * @return posts table column 
     */
    public function headings(): array
    {
        return [
            "id", "title", "description", "status", 
            "created_user_id", "updated_user_id", 
            "created_at", "updated_at"
        ];
    }
}
