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
        // return Post::select('id', 'title', 'description')->get();
        dd($this->posts);
        return $this->posts;
    }

    public function headings(): array
    {
        return ["Id","Title","Description"];
    }
}
