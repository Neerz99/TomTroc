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
    public function index($convId = null)
    {
        $this->ensureLogged();
        $uid = (int)$_SESSION['user_id'];

        $convModel = new ConversationModel();
        $conversations = $convModel->conversationByUser($uid);

        $selectedConv = null;
        $messages = [];
        $convTitle = 'Mes conversations';

        if ($convId !== null) {
            $selectedConv = $convModel->conversationData((int)$convId);
            if ($selectedConv && ($selectedConv['user1Id'] === $uid || $selectedConv['user2Id'] === $uid)
            ) {
                // Conversation title -> username of the other user
                $otherId    = ($selectedConv['user1Id'] === $uid)
                    ? $selectedConv['user2Id']
                    : $selectedConv['user1Id'];
                $convTitle  = (new UserModel())->find($otherId)['username'];

                // Load messages
                $messages = (new MessageModel())
                    ->findByConversation((int)$convId);
            } else {
                http_response_code(404);
                echo "<h1>Erreur 404</h1><p>Conversation introuvable.</p>";
                exit;
            }
        }

        $this->render('conversation/index', [
            'title'         => $convTitle,
            'conversations' => $conversations,
            // These are the messages of the selected conversation
            'selectedId'    => $convId,
            'messages'      => $messages,
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
            'title' => ''
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
        Utils::redirect('conversation', 'index', [$convId]);
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
        Utils::redirect('conversation', 'index', [$convId]);
    }
}
