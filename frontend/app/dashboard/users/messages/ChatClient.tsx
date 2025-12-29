"use client";

import { useState } from "react";
import { Conversation, Message } from "./types";

export default function ChatClient({
  conversations,
  initialMessages,
}: {
  conversations: Conversation[];
  initialMessages: Message[];
}) {
  const [activeConversation, setActiveConversation] =
    useState<Conversation | null>(conversations[0] || null);

  const [messages, setMessages] = useState<Message[]>(initialMessages);
  const [text, setText] = useState("");

  function sendMessage() {
    if (!text.trim() || !activeConversation) return;

    const newMessage: Message = {
      id: Date.now(),
      conversationId: activeConversation.id,
      senderId: 1,
      text,
      createdAt: "الان",
      isOwn: true,
    };

    setMessages((prev) => [...prev, newMessage]);
    setText("");
  }

  return (
    <div className="flex h-[calc(100vh-3rem)] bg-white rounded-2xl shadow overflow-hidden">
      {/* Conversations */}
      <aside className="w-80 border-l overflow-y-auto">
        {conversations.map((c) => (
          <button
            key={c.id}
            onClick={() => setActiveConversation(c)}
            className={`w-full text-right p-4 border-b hover:bg-slate-50
              ${
                activeConversation?.id === c.id
                  ? "bg-slate-100"
                  : ""
              }`}
          >
            <div className="flex justify-between">
              <span className="font-medium">{c.otherUserName}</span>
              <span className="text-xs text-slate-400">
                {c.updatedAt}
              </span>
            </div>

            <p className="text-sm text-slate-500 truncate">
              {c.lastMessage}
            </p>

            {c.unreadCount > 0 && (
              <span className="inline-block mt-1 text-xs bg-red-600 text-white px-2 py-0.5 rounded-full">
                {c.unreadCount}
              </span>
            )}
          </button>
        ))}
      </aside>

      {/* Chat */}
      <section className="flex-1 flex flex-col">
        {/* Header */}
        <header className="p-4 border-b font-semibold">
          {activeConversation?.otherUserName}
        </header>

        {/* Messages */}
        <div className="flex-1 p-4 space-y-3 overflow-y-auto bg-slate-50">
          {messages
            .filter(
              (m) =>
                m.conversationId === activeConversation?.id
            )
            .map((m) => (
              <div
                key={m.id}
                className={`max-w-md px-4 py-2 rounded-2xl text-sm
                ${
                  m.isOwn
                    ? "ml-auto bg-slate-900 text-white"
                    : "mr-auto bg-white border"
                }`}
              >
                <p>{m.text}</p>
                <span className="block mt-1 text-xs opacity-70">
                  {m.createdAt}
                </span>
              </div>
            ))}
        </div>

        {/* Input */}
        <footer className="p-4 border-t flex gap-2">
          <input
            value={text}
            onChange={(e) => setText(e.target.value)}
            placeholder="پیام خود را بنویسید..."
            className="flex-1 border rounded-xl px-4 py-2"
          />
          <button
            onClick={sendMessage}
            className="px-5 rounded-xl bg-slate-900 text-white"
          >
            ارسال
          </button>
        </footer>
      </section>
    </div>
  );
}
