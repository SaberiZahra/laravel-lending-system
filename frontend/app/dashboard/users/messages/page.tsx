"use client";

import { useEffect, useState } from "react";
import {
  getConversations,
  getMessages,
  sendMessage,
} from "@/lib/api";

interface Conversation {
  id: number;
  other_user: {
    name: string;
  };
}

interface Message {
  id: number;
  body: string;
  sender_id: number;
  created_at: string;
}

export default function MessagesPage() {
  const [conversations, setConversations] = useState<Conversation[]>([]);
  const [activeConversation, setActiveConversation] =
    useState<Conversation | null>(null);
  const [messages, setMessages] = useState<Message[]>([]);
  const [newMessage, setNewMessage] = useState("");

  useEffect(() => {
    loadConversations();
  }, []);

  async function loadConversations() {
    const data = await getConversations();
    setConversations(data);
  }

  async function openConversation(conv: Conversation) {
    setActiveConversation(conv);
    const msgs = await getMessages(conv.id);
    setMessages(msgs);
  }

  async function handleSend() {
    if (!newMessage.trim() || !activeConversation) return;

    await sendMessage({
      conversation_id: activeConversation.id,
      body: newMessage,
    });

    setNewMessage("");
    openConversation(activeConversation); // refresh
  }

  return (
    <div className="grid grid-cols-12 gap-6 h-[70vh]">
      {/* Conversations */}
      <aside className="col-span-4 bg-white rounded-2xl shadow p-4 space-y-2 overflow-y-auto">
        <h2 className="font-semibold mb-3">گفتگوها</h2>

        {conversations.map((c) => (
          <button
            key={c.id}
            onClick={() => openConversation(c)}
            className={`w-full text-right px-3 py-2 rounded-lg hover:bg-slate-100 ${
              activeConversation?.id === c.id
                ? "bg-slate-100"
                : ""
            }`}
          >
            {c.other_user.name}
          </button>
        ))}
      </aside>

      {/* Messages */}
      <section className="col-span-8 bg-white rounded-2xl shadow flex flex-col">
        {!activeConversation ? (
          <div className="flex items-center justify-center h-full text-slate-500">
            یک گفتگو را انتخاب کنید
          </div>
        ) : (
          <>
            {/* Messages list */}
            <div className="flex-1 p-4 space-y-3 overflow-y-auto">
              {messages.map((m) => (
                <div
                  key={m.id}
                  className="bg-slate-100 rounded-lg p-2 text-sm"
                >
                  {m.body}
                </div>
              ))}
            </div>

            {/* Input */}
            <div className="border-t p-3 flex gap-2">
              <input
                value={newMessage}
                onChange={(e) => setNewMessage(e.target.value)}
                className="flex-1 border rounded-lg px-3 py-2 text-sm"
                placeholder="پیام خود را بنویسید..."
              />
              <button
                onClick={handleSend}
                className="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700"
              >
                ارسال
              </button>
            </div>
          </>
        )}
      </section>
    </div>
  );
}
