<?
namespace App\Controller;

use App\Entity\Comment;
use App\Factory\PDOFactory;
use App\Manager\CommentManager;
use App\Route\Route;

class CommentController extends AbstractController
{
    #[Route('/api/posts/{post_id}/comments', name: 'index', methods: ['GET'])]
    public function index(string $post_id)
    {
        $commentManager = new CommentManager(new PDOFactory());

        try {
            $comments = $commentManager->index($post_id);
        } catch (\PDOException $e) {
            return http_response_code(500);
        }
        
        echo json_encode($comments);
        
        return http_response_code(200);
    }

    #[Route('/api/posts/{post_id}/comments', name: 'create', methods: ['POST'])]
    public function create(string $post_id)
    {
        $_POST["post_id"] = $post_id;

        $comment = new Comment($_POST);

        $commentManager = new CommentManager(new PDOFactory());

        try {
            $commentManager->create($comment);
        } catch (\PDOException $e) {
            return http_response_code(500);
        }

        return http_response_code(201);
    }

    #[Route('/api/comments/{comment_id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $comment_id)
    {
        $commentManager = new CommentManager(new PDOFactory());

        try {
            $commentManager->delete($comment_id);
        } catch (\PDOException $e) {
            return http_response_code(500);
        }

        return http_response_code(204);
    }

}