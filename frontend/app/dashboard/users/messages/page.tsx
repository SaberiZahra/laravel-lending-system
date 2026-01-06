"use client";

import { useState, useEffect, useRef } from "react";
import { useRouter } from "next/navigation";
import { messagesAPI, authAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

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

export default function MessagesPage() {
  const router = useRouter();
  const [messages, setMessages] = useState<Message[]>([]);
  const [loading, setLoading] = useState(true);
  const [sending, setSending] = useState(false);
  const [user, setUser] = useState<any>(null);
  const [messageText, setMessageText] = useState("");
  const messagesEndRef = useRef<HTMLDivElement>(null);

  // اسکرول خودکار به پایین
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
        const [userData, adminConversation] = await Promise.all([
          authAPI.me(),
          messagesAPI.getOrCreateAdminConversation(), // باید در بک‌اند این API وجود داشته باشه
        ]);

        setUser(userData);

        // دریافت پیام‌های چت با ادمین
        if (adminConversation && adminConversation.id) {
          const msgs = await messagesAPI.getMessages(adminConversation.id);
          setMessages(msgs || []);
        }
      } catch (err: any) {
        console.error("خطا در بارگذاری چت:", err);
        alert("خطا در بارگذاری چت با پشتیبانی");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  const handleSend = async () => {
    if (!messageText.trim() || sending) return;

    try {
      setSending(true);
      const conversation = await messagesAPI.getOrCreateAdminConversation();

      await messagesAPI.send({
        conversation_id: conversation.id,
        message: messageText.trim(),
      });

      // دریافت پیام‌های به‌روز شده
      const updatedMessages = await messagesAPI.getMessages(conversation.id);
      setMessages(updatedMessages || []);
      setMessageText("");
    } catch (err: any) {
      alert("خطا در ارسال پیام");
    } finally {
      setSending(false);
    }
  };

  const formatTime = (dateString: string) => {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now.getTime() - date.getTime();

    if (diff < 60000) return "الان";
    if (diff < 3600000) return `${Math.floor(diff / 60000)} دقیقه پیش`;
    if (diff < 86400000) return `${Math.floor(diff / 3600000)} ساعت پیش`;
    return date.toLocaleDateString("fa-IR");
  };

  if (loading) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-8 text-xl text-gray-700">در حال اتصال به پشتیبانی...</p>
          </div>
        </div>
    );
  }

  return (
      <div className="min-h-screen bg-gray-50">
        {/* هدر */}
        <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-8 mx-4 sm:mx-8 lg:mx-auto lg:max-w-6xl my-10 text-white shadow-2xl">
          <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
              <h1 className="text-4xl font-bold mb-3">چت با پشتیبانی</h1>
              <p className="text-xl text-blue-100">هر سوالی دارید بپرسید، ما در خدمت شما هستیم</p>
            </div>
            <Link
                href="/dashboard"
                className="px-8 py-4 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
            >
              ← بازگشت به داشبورد
            </Link>
          </div>
        </div>

        {/* چت اصلی */}
        <div dir="rtl" className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
          <div className="bg-white rounded-3xl shadow-2xl overflow-hidden border">
            {/* هدر چت */}
            <div className="bg-gradient-to-r from-indigo-500 to-blue-500 p-6 text-white">
              <div className="flex items-center gap-4">
                <div className="w-12 h-12 rounded-full bg-white/30 backdrop-blur flex items-center justify-center text-2xl font-bold">
                  👑
                </div>
                <div>
                  <h2 className="text-xl font-bold">پشتیبانی سایت</h2>
                  <p className="text-sm opacity-90">معمولاً در کمتر از ۱ ساعت پاسخ می‌دهیم</p>
                </div>
              </div>
            </div>

            {/* لیست پیام‌ها */}
            <div className="h-96 md:h-[28rem] overflow-y-auto p-6 space-y-6 bg-gray-50">
              {messages.length === 0 ? (
                  <div className="text-center py-16">
                    <p className="text-lg text-gray-500">هنوز پیامی ارسال نشده</p>
                    <p className="text-sm text-gray-400 mt-3">اولین پیام را شما شروع کنید!</p>
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
                              className={`max-w-xs md:max-w-md px-5 py-3 rounded-3xl shadow-md ${
                                  isOwn
                                      ? "bg-gradient-to-r from-indigo-500 to-blue-500 text-white"
                                      : "bg-white border border-gray-200 text-gray-800"
                              }`}
                          >
                            <p className="text-base leading-relaxed">{msg.message_text}</p>
                            <p className={`text-xs mt-2 ${isOwn ? "text-blue-100" : "text-gray-400"}`}>
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
            <div className="p-6 bg-white border-t">
              <div className="flex gap-4">
                <input
                    type="text"
                    value={messageText}
                    onChange={(e) => setMessageText(e.target.value)}
                    onKeyDown={(e) => e.key === "Enter" && !e.shiftKey && handleSend()}
                    placeholder="پیام خود را بنویسید..."
                    disabled={sending}
                    className="flex-1 border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                />
                <button
                    onClick={handleSend}
                    disabled={sending || !messageText.trim()}
                    className="px-8 py-4 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed shadow-lg"
                >
                  {sending ? "در حال ارسال..." : "ارسال"}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  );
}