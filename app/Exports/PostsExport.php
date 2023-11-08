<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $posts;
    public function __construct($posts)
    {
        $this->posts = $posts;
    }
    public function collection()
    {
        $filteredPosts = $this->posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'show_on_list' => $post->show_on_list == 1 ? 'Active' : 'Inactive',
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at
            ];
        });


        return $filteredPosts;
    }

    public function headings(): array
    {
        return ["Id","Title","Description","Show on List", "Created At", "Updated At"];
    }
}
