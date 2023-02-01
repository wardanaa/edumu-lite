<?php


use App\Models\Content;
use App\Models\ContentCategory;

class ContentSeeder extends \Illuminate\Database\Seeder {
    use DisableForeignKeys, TruncateTable;

    public function run() {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'content_category',
            'content',
            'content_comment',
            'content_rate',
        ]);

        ContentCategory::create([
            'name' => 'CONTOH KATEGORI',
            'description' => 'Mung Data dummy bro',
            'type' => ContentCategory::TYPE_E_BOOK,
        ]);

        Content::create([
            'customer_id' => 1,
            'type' => Content::TYPE_CONTENT,
            'name' => 'What is Lorem Ipsum? 1',
            'alias' => 'what-is-lorem-ipsum-1',
            'url' => 'https://file-examples.com/wp-content/uploads/2017/02/file-sample_500kB.doc',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ]);

        Content::create([
            'customer_id' => 2,
            'type' => Content::TYPE_CONTENT,
            'name' => 'What is Lorem Ipsum? 2',
            'alias' => 'what-is-lorem-ipsum-2',
            'url' => 'https://file-examples.com/wp-content/uploads/2017/02/file-sample_500kB.doc',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ]);

        Content::create([
            'type' => Content::TYPE_E_BOOK,
            'content_category_id' => 1,
            'name' => 'Example Book 1',
            'author' => 'bombom',
            'alias' => 'example-book',
            'url' => 'https://file-examples.com/wp-content/uploads/2017/02/file-sample_500kB.doc',
        ]);

        Content::create([
            'type' => Content::TYPE_NEWS,
            'name' => 'Berita Terkini',
            'alias' => 'berita-terkini',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'image' => 'gate_002.jpg',
        ]);

        Content::create([
            'type' => Content::TYPE_NEWS,
            'name' => 'Berita Terkini 2',
            'alias' => 'berita-terkini-2',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'image' => 'krasivyi_korabl_-1024x768.jpg',
        ]);

        $this->enableForeignKeys();
    }
}