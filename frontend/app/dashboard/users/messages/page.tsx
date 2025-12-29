export default function MessagesPage() {
  return (
    <div className="h-[calc(100vh-3rem)] bg-white rounded-2xl shadow overflow-hidden flex">
      {/* Conversations List */}
      <aside className="w-80 border-l border-slate-200 overflow-y-auto">
        <ConversationItem
          name="محمد رضایی"
          lastMessage="سلام، برای اجاره دوربین پیام دادم"
          time="10:32"
          unread
        />
        <ConversationItem
          name="علی احمدی"
          lastMessage="باشه، فردا تحویل میدم"
          time="دیروز"
        />
        <ConversationItem
          name="سارا کریمی"
          lastMessage="ممنون از پاسخ‌گویی"
          time="2 روز پیش"
        />
      </aside>

      {/* Chat Area */}
      <section className="flex-1 flex flex-col">
        {/* Header */}
        <header className="border-b border-slate-200 p-4">
          <h2 className="font-semibold">محمد رضایی</h2>
          <p className="text-xs text-slate-500">
            آنلاین
          </p>
        </header>

        {/* Messages */}
        <div className="flex-1 overflow-y-auto p-4 space-y-4 bg-slate-50">
          <MessageBubble
            text="سلام، دوربین هنوز موجوده؟"
            isOwn={false}
            time="10:20"
          />
          <MessageBubble
            text="بله، در دسترسه"
            isOwn
            time="10:22"
          />
          <MessageBubble
            text="عالیه، برای آخر هفته می‌خوام"
            isOwn={false}
            time="10:23"
          />
        </div>

        {/* Input */}
        <footer className="border-t border-slate-200 p-4">
          <div className="flex gap-2">
            <input
              placeholder="پیام خود را بنویسید..."
              className="flex-1 border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-400"
            />
            <button className="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800">
              ارسال
            </button>
          </div>
        </footer>
      </section>
    </div>
  );
}

/* ================================
   Components
================================ */

function ConversationItem({
  name,
  lastMessage,
  time,
  unread = false,
}: {
  name: string;
  lastMessage: string;
  time: string;
  unread?: boolean;
}) {
  return (
    <div
      className={`p-4 cursor-pointer border-b border-slate-100 hover:bg-slate-50
      ${unread ? "bg-slate-100" : ""}`}
    >
      <div className="flex justify-between items-center">
        <p className="font-medium">{name}</p>
        <span className="text-xs text-slate-400">{time}</span>
      </div>
      <p className="text-sm text-slate-500 truncate mt-1">
        {lastMessage}
      </p>
    </div>
  );
}

function MessageBubble({
  text,
  isOwn,
  time,
}: {
  text: string;
  isOwn: boolean;
  time: string;
}) {
  return (
    <div
      className={`max-w-xs md:max-w-md px-4 py-2 rounded-2xl text-sm
      ${isOwn
        ? "ml-auto bg-slate-900 text-white"
        : "mr-auto bg-white border"}`}
    >
      <p>{text}</p>
      <span
        className={`block mt-1 text-xs
        ${isOwn ? "text-slate-300" : "text-slate-400"}`}
      >
        {time}
      </span>
    </div>
  );
}
