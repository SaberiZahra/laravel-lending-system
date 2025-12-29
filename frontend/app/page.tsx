import React from "react";

const NotFound404: React.FC = () => {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 px-4">
      <div className="max-w-xl w-full bg-white rounded-3xl shadow-xl p-8 text-center space-y-6">
        {/* Title */}
        <h1 className="text-3xl font-bold text-slate-800">
          به یک تجربه متفاوت خوش آمدید
        </h1>

        {/* Description */}
        <p className="text-slate-600 leading-relaxed">
          اینجا جایی است که می‌توانید بدون خرید، از وسایل دیگران استفاده کنید،
          آگهی ثبت کنید، با افراد گفتگو کنید و یک تجربه امن و هوشمند از اجاره داشته باشید.
        </p>

        {/* Highlights */}
        <ul className="text-slate-600 space-y-2 text-sm">
          <li>• اجاره آسان و سریع وسایل</li>
          <li>• اعتمادسازی با امتیاز کاربران</li>
          <li>• پیام‌رسان داخلی و مدیریت درخواست‌ها</li>
        </ul>

        {/* CTA */}
        <div className="pt-4">
          <a
            href="/mainPage"
            className="inline-block px-8 py-3 rounded-2xl bg-slate-900 text-white text-lg font-medium hover:bg-slate-800 transition"
          >
            ورود به سایت
          </a>
        </div>

        {/* Secondary */}
        <p className="text-xs text-slate-400">
          فقط چند کلیک تا شروع
        </p>
      </div>
    </div>
  );
};

export default NotFound404;
