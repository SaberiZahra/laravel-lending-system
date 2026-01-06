"use client";

import { useState, useEffect, useRef } from "react";
import { useRouter } from "next/navigation";
import { messagesAPI, authAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

type Conversation = {
  id: number;
  participants: Array<{
    id: number;
    full_name: string;
    username: string;
    profile_image?: string | null;
  }>;
  messages: Array<{
    id: number;
    message_text: string;
    created_at: string;
    sender_id: number;
    is_read?: boolean;
  }>;
};

type Message = {
  id: number;
  message_text: string;
  sender_id: number;
  created_at: string;
  sender?: {
    id: number;
    full_name: string;
    username: string;
  };
};

export default function AdminMessagesPage() {
  const router = useRouter();
  const [conversations, setConversations] = useState<Conversation[]>([]);
  const [messages, setMessages] = useState<Message[]>([]);
  const [activeConversation, setActiveConversation] = useState<Conversation | null>(null);
  const [messageText, setMessageText] = useState("");
  const [loading, setLoading] = useState(true);
  const [user, setUser] = useState<any>(null);
  const messagesEndRef = useRef<HTMLDivElement>(null);

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const [conversationsData, userData] = await Promise.all([
          messagesAPI.getConversations(),
          authAPI.me(),
        ]);

        if (userData?.role !== 1) {
          router.push("/dashboard");
          return;
        }

        setUser(userData);

        // فقط مکالماتی که پیام دارن + مرتب‌سازی بر اساس آخرین پیام
        const activeConvs = (conversationsData || [])
            .filter((conv: Conversation) => conv.messages && conv.messages.length > 0)
            .sort((a: Conversation, b: Conversation) => {
              const timeA = new Date(a.messages[0]?.created_at || 0).getTime();
              const timeB = new Date(b.messages[0]?.created_at || 0).getTime();
              return timeB - timeA; // جدیدترین بالا
            });

        setConversations(activeConvs);
      } catch (err) {
        console.error("Error loading conversations:", err);
        alert("خطا در بارگذاری مکالمات");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  useEffect(() => {
    if (activeConversation) {
      const fetchMessages = async () => {
        try {
          const msgs = await messagesAPI.getMessages(activeConversation.id);
          setMessages(msgs || []);
        } catch (err) {
          console.error("Error loading messages:", err);
        }
      };
      fetchMessages();
    }
  }, [activeConversation]);

  const handleSend = async () => {
    if (!messageText.trim() || !activeConversation) return;

    try {
      await messagesAPI.send({
        conversation_id: activeConversation.id,
        message: messageText.trim(),
      });

      const updatedMsgs = await messagesAPI.getMessages(activeConversation.id);
      setMessages(updatedMsgs || []);
      setMessageText("");
    } catch (err) {
      alert("خطا در ارسال پیام");
    }
  };

  const formatTime = (dateString: string) => {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now.getTime() - date.getTime();
    const minutes = Math.floor(diff / 60000);

    if (minutes < 1) return "الان";
    if (minutes < 60) return `${minutes} دقیقه پیش`;
    if (minutes < 1440) return `${Math.floor(minutes / 60)} ساعت پیش`;
    return date.toLocaleDateString("fa-IR");
  };

  // محاسبه پیام‌های خوانده‌نشده (پیام‌های کاربر که ادمین نخوانده)
  const getUnreadCount = (conv: Conversation) => {
    if (!user) return 0;
    return conv.messages.filter(m => m.sender_id !== user.id && !m.is_read).length;
  };

  const getOtherParticipant = (conv: Conversation) => {
    return conv.participants.find(p => p.id !== user?.id);
  };

  if (loading) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-8 text-xl text-gray-700">در حال بارگذاری مکالمات...</p>
          </div>
        </div>
    );
  }

  return (
      <div className="min-h-screen bg-gray-50">
        {/* هدر زیبا */}
        <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-6xl my-10 text-white shadow-2xl">
          <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div>
              <h1 className="text-4xl font-bold mb-3">مدیریت پیام‌ها</h1>
              <p className="text-xl text-blue-100">پاسخ به پیام‌های کاربران</p>
            </div>
            <Link
                href="/dashboard"
                className="px-8 py-4 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
            >
              ← بازگشت به داشبورد
            </Link>
          </div>
        </div>

        {/* محتوای اصلی — راست‌چین */}
        <div dir="rtl" className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
          <div className="bg-white rounded-3xl shadow-2xl overflow-hidden border">
            <div className="flex h-[600px] md:h-[700px]">
              {/* لیست مکالمات */}
              <aside className="w-96 border-l border-gray-200 overflow-y-auto bg-gray-50">
                {conversations.length === 0 ? (
                    <div className="p-10 text-center text-gray-500">
                      <p className="text-xl">هیچ پیامی دریافت نشده</p>
                      <p className="text-sm mt-3">وقتی کاربری پیام بدهد، اینجا نمایش داده می‌شود</p>
                    </div>
                ) : (
                    <div className="divide-y divide-gray-200">
                      {conversations.map((conv) => {
                        const other = getOtherParticipant(conv);
                        const lastMsg = conv.messages[0];
                        const unread = getUnreadCount(conv);

                        return (
                            <button
                                key={conv.id}
                                onClick={() => setActiveConversation(conv)}
                                className={`w-full p-5 text-right hover:bg-indigo-50 transition relative ${
                                    activeConversation?.id === conv.id ? "bg-indigo-100 border-r-4 border-indigo-600" : ""
                                }`}
                            >
                              <div className="flex items-center gap-4">
                                <div className="relative">
                                  <div className="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-400 to-blue-400 flex items-center justify-center text-2xl font-bold text-white shadow-lg">
                                    {other?.full_name.charAt(0).toUpperCase() || "?"}
                                  </div>
                                  {unread > 0 && (
                                      <span className="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow">
                                {unread > 9 ? "9+" : unread}
                              </span>
                                  )}
                                </div>

                                <div className="flex-1">
                                  <div className="flex justify-between items-start mb-1">
                                    <p className="font-bold text-gray-900 text-lg">
                                      {other?.full_name || "کاربر ناشناس"}
                                    </p>
                                    <span className="text-xs text-gray-400">
                                {formatTime(lastMsg.created_at)}
                              </span>
                                  </div>
                                  <p className="text-sm text-gray-600 truncate">
                                    {lastMsg.sender_id === user?.id ? "شما: " : ""}{lastMsg.message_text}
                                  </p>
                                  <p className="text-xs text-gray-400 mt-1">@{other?.username}</p>
                                </div>
                              </div>
                            </button>
                        );
                      })}
                    </div>
                )}
              </aside>

              {/* منطقه چت */}
              {activeConversation ? (
                  <section className="flex-1 flex flex-col">
                    {/* هدر چت */}
                    <header className="bg-gradient-to-r from-indigo-500 to-blue-500 p-6 text-white shadow-md">
                      <div className="flex items-center gap-5">
                        <div className="w-16 h-16 rounded-full bg-white/30 backdrop-blur flex items-center justify-center text-3xl font-bold shadow-xl">
                          {getOtherParticipant(activeConversation)?.full_name.charAt(0).toUpperCase() || "?"}
                        </div>
                        <div>
                          <h2 className="text-2xl font-bold">
                            {getOtherParticipant(activeConversation)?.full_name}
                          </h2>
                          <p className="text-sm opacity-90">
                            آخرین پیام: {formatTime(activeConversation.messages[0]?.created_at || new Date().toISOString())}
                          </p>
                        </div>
                      </div>
                    </header>

                    {/* پیام‌ها */}
                    <div className="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50">
                      {messages.length === 0 ? (
                          <div className="text-center py-20 text-gray-500">
                            <p className="text-xl">مکالمه خالی است</p>
                          </div>
                      ) : (
                          messages.map((msg) => {
                            const isOwn = msg.sender_id === user?.id;
                            return (
                                <div
                                    key={msg.id}
                                    className={`flex ${isOwn ? "justify-end" : "justify-start"}`}
                                >
                                  <div
                                      className={`max-w-lg px-6 py-4 rounded-3xl shadow-lg ${
                                          isOwn
                                              ? "bg-gradient-to-r from-indigo-500 to-blue-500 text-white"
                                              : "bg-white border border-gray-200 text-gray-800"
                                      }`}
                                  >
                                    {!isOwn && msg.sender && (
                                        <p className="text-xs font-bold mb-2 text-indigo-600">
                                          {msg.sender.full_name}
                                        </p>
                                    )}
                                    <p className="text-base leading-relaxed">{msg.message_text}</p>
                                    <p className={`text-xs mt-3 ${isOwn ? "text-blue-100" : "text-gray-400"}`}>
                                      {formatTime(msg.created_at)}
                                    </p>
                                  </div>
                                </div>
                            );
                          })
                      )}
                      <div ref={messagesEndRef} />
                    </div>

                    {/* ورودی پیام */}
                    <footer className="p-6 bg-white border-t">
                      <div className="flex gap-4">
                        <input
                            type="text"
                            value={messageText}
                            onChange={(e) => setMessageText(e.target.value)}
                            onKeyDown={(e) => e.key === "Enter" && !e.shiftKey && handleSend()}
                            placeholder="پاسخ خود را بنویسید..."
                            className="flex-1 border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                        />
                        <button
                            onClick={handleSend}
                            disabled={!messageText.trim()}
                            className="px-10 py-4 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-blue-700 transition disabled:opacity-50 shadow-lg"
                        >
                          ارسال
                        </button>
                      </div>
                    </footer>
                  </section>
              ) : (
                  <section className="flex-1 flex items-center justify-center bg-gray-50">
                    <div className="text-center text-gray-500">
                      <p className="text-2xl mb-4">یک کاربر را انتخاب کنید</p>
                      <p className="text-lg">برای مشاهده و پاسخ به پیام‌ها</p>
                    </div>
                  </section>
              )}
            </div>
          </div>
        </div>
      </div>
  );
}