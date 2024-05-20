<?php


namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class QueryController extends Controller
{
    public function queries()
    {
        $categories = Categories::all();
        $categories = DB::table('categories')->get();
        dump($categories);


        $categories = Categories::with('posts')->find(1);
        echo "ID категории: {$categories->category_id}, Название: {$categories->category_name}\n";
        foreach ($categories->posts as $post) {
            echo "ID поста: {$post->post_id}, Заголовок: {$post->post_title}, Содержание поста: {$post->post_content}\n <br><br>";
        }


        $comments = Comments::where('post_id',1)->get();
        $posts = Posts::where('post_id', 1)->chunk(2, function ($posts) use ($comments) {
            foreach ($posts as $post) {
                // Вывод информации о посте
                echo "ID поста: {$post->post_id}, Заголовок: {$post->post_title}, Содержание: {$post->post_content}\n <br> ";

                foreach ($comments as $comment) {
                    echo "ID комментария: {$comment->comment_id}, Содержание комментария: {$comment->comment_content}\n <br>";
                }
            }

        });

        $category = new Categories();
        $category->category_name = "Новая категория";
        $category->save();

        $post = Posts::find(1);
        $post->post_title = "Новый Тайтл для первого поста";
        $post->post_content = "Новый контент для первого поста";
        $post->save();

        Comments::destroy(1);

    }

    public function allcomments(){

        $categories = Categories::with('comments')->get();

        foreach ($categories as $category) {
            if ($category->comments->isNotEmpty()) {
                echo "Categories: {$category->category_id}.<br>";

                foreach ($category->comments as $comment) {
                    echo "Comments: {$comment->comment_content}.<br>";
                }
            }
        }


    }

    public function transaction(){
        $post = Posts::inRandomOrder()->first();
        DB::beginTransaction();
        try {
            $postId = random_int(1, 2000);

            // Создать новый комментарий
            $comment = new Comments();
            $comment->comment_content = 'Новый комментарий';
            $comment->post_id = $postId;
            $comment->save();

            // Получить информацию о посте
            $post = Posts::find($postId);

            // Если пост найден, формируем сообщение
            $message = ($post) ? "Comment addet to post -> '{$post->post_title}'" : "SUCCESS";


                // Обновить поле updated_at для поста
            Posts::where('post_id', $postId)->update(['updated_at' => now()]);

            // Получить ID категории связанной с постом
            $categoryId = optional($post)->category_id;

            // Обновить поле updated_at для категории
            Categories::where('category_id', $categoryId)->update(['updated_at' => now()]);

            // Если все операции успешно выполнены, фиксируем изменения
            DB::commit();

            // Возвращаем ответ с сообщением
            return response()->json(['message' => $message], 200);
        } catch (\Exception $e) {
            // В случае ошибки откатываем транзакцию
            DB::rollBack();

            // Возвращаем сообщение об ошибке
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}
