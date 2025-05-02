<?php

class ConversationController extends Controller
{
    private function ensureLogged()
    {
        if (empty($_SESSION['user_id'])) {
            Utils::redirect('user', 'login');
        }
    }

    /**
     * List all conversations of the logged user
     */
    public function index()
    {
        $this->ensureLogged();
        $uid = (int)$_SESSION['user_id'];
        $model = new ConversationModel();
        $convs = $model->conversationByUser($uid);

        $this->render('conversation/index', [
            'title' => 'Mes conversations',
            'conversations' => $convs
        ]);
    }

    /**
     * Display a conversation and its messages
     */
    public function view($convId)
    {
        $this->ensureLogged();
        $uid = (int)$_SESSION['user_id'];
        $convModel = new ConversationModel();
        $conv = $convModel->conversationData((int)$convId);
        if (!$conv || ($conv['user1Id'] != $uid && $conv['user2Id'] != $uid)) {
            http_response_code(404);
            echo "Conversation introuvable";
            exit;
        }

        $messageModel = new MessageModel();
        $messages = $messageModel->findByConversation((int)$convId);

        $this->render('conversation/view', [
            'title' => 'Conversation avec '
                . ($conv['user1Id'] == $uid
                    ? (new UserModel())->find($conv['user2Id'])['username']
                    : (new UserModel())->find($conv['user1Id'])['username']),
            'messages' => $messages,
            'conversationId' => $convId
        ]);
    }

    /**
     * Send a message in a conversation
     */
    public function send($convId)
    {
        $this->ensureLogged();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uid = (int)$_SESSION['user_id'];
            $content = Utils::sanitize($_POST['content'] ?? '');
            // Déterminer le destinataire
            $conv = (new ConversationModel())->conversationData((int)$convId);
            $other = ($conv['user1Id'] == $uid)
                ? $conv['user2Id']
                : $conv['user1Id'];

            (new MessageModel())->sendMessage($convId, $uid, $other, $content);
        }
        Utils::redirect('conversation', 'view', [$convId]);
    }

    /**
     * Start a conversation with another user
     */
    public function start($otherUserId)
    {
        $this->ensureLogged();
        $uid = (int)$_SESSION['user_id'];
        $convId = (new ConversationModel())
            ->startConversation($uid, (int)$otherUserId);
        Utils::redirect('conversation', 'view', [$convId]);
    }
}
