<?php
require 'db.php'; 

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $task_id = $data['task_id'] ?? null;
    $comment = $data['comment'] ?? null;

    if ($task_id && $comment) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM tasks WHERE id = ?");
        $stmt->bindParam(1, $task_id, PDO::PARAM_INT);
        $stmt->execute();
        $task_exists = $stmt->fetchColumn();

        if ($task_exists) {
            $stmt = $pdo->prepare("INSERT INTO comments (task_id, comment) VALUES (?, ?)");
            $stmt->bindParam(1, $task_id, PDO::PARAM_INT);
            $stmt->bindParam(2, $comment, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'id' => $pdo->lastInsertId()]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create comment.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Task not found.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
} elseif ($method === 'GET') {
    $task_id = $_GET['task_id'] ?? null;

    if ($task_id) {
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE task_id = ? ORDER BY id ASC");
        $stmt->bindParam(1, $task_id, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($comments) {
            echo json_encode($comments);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No comments found.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Task ID is required.']);
    }
} elseif ($method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $comment = $data['comment'] ?? null;

    if ($id && $comment) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $comment_exists = $stmt->fetchColumn();

        if ($comment_exists) {
            $stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
            $stmt->bindParam(1, $comment, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update comment.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Comment not found.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
} elseif ($method === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $comment_exists = $stmt->fetchColumn();

        if ($comment_exists) {
            $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete comment.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Comment not found.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}