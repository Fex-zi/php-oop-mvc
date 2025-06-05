<?php 
declare(strict_types=1);

namespace models\find;
use models\db\Connect;

class Find extends Connect {
   
    public function findById($id) {
        $sql = 'SELECT * FROM pages WHERE id = :id';
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $data = $stmt->fetch();
        
        return $data;
    }

 
    public function getAllPages() {
        $sql = 'SELECT * FROM pages';
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function insertPage($title, $content) {
        $sql = 'INSERT INTO pages (title, content) VALUES (:title, :content)';
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'title' => $title,
            'content' => $content
        ]);
    }

     public function delete($id) {
        $sql = 'DELETE FROM pages WHERE id = :id';
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
        
    }

    public function findby($username){

        $sql =  'SELECT * FROM users where username = :username';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username'=>$username]);

        return $stmt->fetch();



    }
}

/*
declare(strict_types=1);

use models\find\Find;
use models\admin\AdminUser;

// Create an instance of the Find model
$finder = new Find();

// Get action from request
$action = $_GET['action'] ?? 'list';

switch($action) {
    case 'show':
        $id = $_GET['id'] ?? 1;
        $data = $finder->findById($id);
        echo '<h2>Page Details</h2>';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        break;
        
    case 'list':
    default:
        $pages = $finder->getAllPages();
        echo '<h2>All Pages</h2>';
        echo '<pre>';
        print_r($pages);
        echo '</pre>';
        break;
        
    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $result = $finder->delete($id);
            echo '<h2>Delete Result</h2>';
            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } else {
            echo '<p>No ID provided for deletion.</p>';
        }
        break;
}


// //Example usage (uncomment to test):
// $finder = (new Find())->findById(1);

// echo '<pre>';
// print_r($finder);

// $get = (new Find())->getAllPages();
// echo '<pre>';
// print_r($get);

// // $put = (new Find())->insertPage('Hey', 'why');
// // echo '<pre>';
// // print_r($put);

// $delete = (new Find())->delete(6);
// echo '<pre>';
// print_r($delete);
*/