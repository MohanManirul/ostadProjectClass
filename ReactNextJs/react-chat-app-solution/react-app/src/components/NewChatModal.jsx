import { useState } from 'react';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import api from '../api/axios';
import toast from 'react-hot-toast';
import { useAuth } from '../context/AuthContext';

export default function NewChatModal({ onClose }) {
  const [name, setName] = useState('');
  const [participants, setParticipants] = useState('');
  const [type, setType] = useState('individual');
  const queryClient = useQueryClient();
  const { user } = useAuth();

  const createChat = useMutation({
    mutationFn: async (data) => {
      const response = await api.post('/chats', {
        ...data,
        createdBy: user.id
      });
      return response.data;
    },
    onSuccess: () => {
      queryClient.invalidateQueries(['chats']);
      toast.success('Chat created successfully');
      onClose();
    },
    onError: (error) => {
      const message = error.response?.data?.error || error.message;
      toast.error(message);
    }
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!participants.trim()) {
      toast.error('Please enter at least one participant');
      return;
    }
    
    createChat.mutate({
      name: name.trim() || 'New Chat',
      participants: [...new Set([user.id, ...participants.split(',').map(p => p.trim())])],
      type
    });
  };

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div className="bg-white rounded-lg p-6 w-96 max-w-[90vw]">
        <h2 className="text-xl font-semibold mb-4">Create New Chat</h2>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-700">
              Chat Name (optional)
            </label>
            <input
              type="text"
              value={name}
              onChange={(e) => setName(e.target.value)}
              className="mt-1 block w-full rounded-md border p-2"
              placeholder="Enter chat name"
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700">
              Participants (comma-separated usernames)
            </label>
            <input
              type="text"
              value={participants}
              onChange={(e) => setParticipants(e.target.value)}
              className="mt-1 block w-full rounded-md border p-2"
              placeholder="e.g., john, jane, alex"
              required
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700">
              Type
            </label>
            <select
              value={type}
              onChange={(e) => setType(e.target.value)}
              className="mt-1 block w-full rounded-md border p-2"
            >
              <option value="individual">Individual</option>
              <option value="group">Group</option>
            </select>
          </div>
          <div className="flex justify-end space-x-2 pt-4">
            <button
              type="button"
              onClick={onClose}
              className="px-4 py-2 text-gray-600 hover:text-gray-800"
            >
              Cancel
            </button>
            <button
              type="submit"
              className="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50"
              disabled={createChat.isPending}
            >
              {createChat.isPending ? 'Creating...' : 'Create'}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}