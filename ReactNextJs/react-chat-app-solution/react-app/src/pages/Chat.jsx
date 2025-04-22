import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import ChatList from '../components/ChatList';
import ChatMessages from '../components/ChatMessages';
import NewChatModal from '../components/NewChatModal';
import { Plus, LogOut } from 'lucide-react';

export default function Chat() {
  const [selectedChat, setSelectedChat] = useState(null);
  const [showNewChatModal, setShowNewChatModal] = useState(false);
  const { logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate('/');
  };

  return (
    <div className="h-screen flex flex-col">
      <div className="bg-white border-b p-4 flex justify-between items-center">
        <h1 className="text-xl font-bold">Chat App</h1>
        <div className="flex items-center space-x-4">
          <button
            onClick={() => setShowNewChatModal(true)}
            className="flex items-center space-x-2 bg-blue-500 text-white rounded-lg px-4 py-2"
          >
            <Plus className="w-5 h-5" />
            <span>New Chat</span>
          </button>
          <button
            onClick={handleLogout}
            className="flex items-center space-x-2 text-gray-600 hover:text-gray-800"
          >
            <LogOut className="w-5 h-5" />
            <span>Logout</span>
          </button>
        </div>
      </div>
      <div className="flex-1 grid grid-cols-3 gap-4 p-4">
        <div className="col-span-1">
          <ChatList
            onSelectChat={setSelectedChat}
            selectedChatId={selectedChat?.id}
          />
        </div>
        <div className="col-span-2 bg-white rounded-lg shadow">
          <ChatMessages chatId={selectedChat?.id} />
        </div>
      </div>
      {showNewChatModal && (
        <NewChatModal onClose={() => setShowNewChatModal(false)} />
      )}
    </div>
  );
}