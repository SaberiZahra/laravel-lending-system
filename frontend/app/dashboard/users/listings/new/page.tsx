"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { itemsAPI, listingsAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

type Item = {
  id: number;
  title: string;
  description?: string;
};

export default function NewListingPage() {
  const router = useRouter();
  const [items, setItems] = useState<Item[]>([]);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState("");

  const today = new Date().toISOString().split("T")[0];

  const [formData, setFormData] = useState({
    item_id: "",
    title: "",
    description: "",
    daily_fee: "",
    deposit_amount: "",
    available_from: today,
    available_until: "",
    status: "active",
  });

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchItems = async () => {
      try {
        setLoading(true);
        const data = await itemsAPI.getAll();
        setItems(data || []);
      } catch (err: any) {
        setError("خطا در دریافت کالاها. دوباره تلاش کنید.");
      } finally {
        setLoading(false);
      }
    };

    fetchItems();
  }, [router]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError("");

    if (!formData.item_id || !formData.title || !formData.daily_fee || !formData.deposit_amount || !formData.available_from || !formData.available_until) {
      setError("لطفاً تمام فیلدهای ستاره‌دار را پر کنید.");
      return;
    }

    try {
      setSubmitting(true);
      await listingsAPI.create({
        item_id: parseInt(formData.item_id),
        title: formData.title.trim(),
        description: formData.description.trim(),
        daily_fee: parseFloat(formData.daily_fee),
        deposit_amount: parseFloat(formData.deposit_amount),
        available_from: formData.available_from,
        available_until: formData.available_until,
        status: formData.status,
      });
      router.push("/dashboard/users/listings");
    } catch (err: any) {
      setError(err.response?.data?.message || "ایجاد آگهی با خطا مواجه شد.");
    } finally {
      setSubmitting(false);
    }
  };

  if (loading) {
    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50">
          <div className="text-center">
            <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 mx-auto"></div>
            <p className="mt-6 text-xl text-gray-700">در حال بارگذاری کالاها...</p>
          </div>
        </div>
    );
  }

  return (
      <div className="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        {/* هدر صفحه */}
        <div className="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 mb-10 text-white shadow-xl">
          <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div>
              <h1 className="text-4xl font-bold mb-2">ایجاد آگهی جدید</h1>
              <p className="text-blue-100 text-lg">کالای خود را برای امانت دادن معرفی کنید</p>
            </div>
            <Link
                href="/dashboard/users/listings"
                className="px-6 py-3 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition text-lg font-medium text-center"
            >
              ← بازگشت به آگهی‌ها
            </Link>
          </div>
        </div>

        {/* فرم اصلی */}
        <form onSubmit={handleSubmit} className="bg-white rounded-3xl shadow-2xl p-8 sm:p-10 space-y-8">
          {/* پیام خطا */}
          {error && (
              <div className="bg-red-50 border-2 border-red-300 text-red-800 px-6 py-4 rounded-2xl font-medium text-center">
                ⚠️ {error}
              </div>
          )}

          {/* انتخاب کالا + بنر کالای جدید */}
          <div className="space-y-6">
            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                انتخاب کالا <span className="text-red-500">*</span>
              </label>
              <select
                  value={formData.item_id}
                  onChange={(e) => setFormData({ ...formData, item_id: e.target.value })}
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                  required
              >
                <option value="">یک کالا انتخاب کنید...</option>
                {items.map((item) => (
                    <option key={item.id} value={item.id}>
                      {item.title}
                    </option>
                ))}
              </select>
            </div>

            {/* بنر کالای جدید */}
            <div className="bg-gradient-to-r from-amber-100 to-orange-100 border-2 border-amber-300 rounded-2xl p-6 text-center shadow-md">
              <p className="text-amber-900 font-bold text-lg mb-3">
                کالای مورد نظرت رو در لیست نمی‌بینی؟
              </p>
              <Link
                  href="/dashboard/users/items/new"
                  className="inline-block px-8 py-4 bg-amber-500 text-white font-bold rounded-2xl hover:bg-amber-600 transition shadow-lg transform hover:scale-105"
              >
                ➕ همین الان یک کالای جدید ثبت کن
              </Link>
            </div>
          </div>

          {/* عنوان و توضیحات */}
          <div className="grid md:grid-cols-1 gap-6">
            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                عنوان آگهی <span className="text-red-500">*</span>
              </label>
              <input
                  type="text"
                  value={formData.title}
                  onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                  placeholder="مثال: اجاره دریل برقی بوش - عالی برای کارهای خانگی"
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                  required
              />
            </div>

            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                توضیحات آگهی (اختیاری)
              </label>
              <textarea
                  value={formData.description}
                  onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                  rows={5}
                  placeholder="جزئیات بیشتر، شرایط استفاده، لوازم همراه، نحوه تحویل و..."
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 resize-none"
              />
            </div>
          </div>

          {/* قیمت‌ها */}
          <div className="grid md:grid-cols-2 gap-6">
            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                هزینه روزانه (تومان) <span className="text-red-500">*</span>
              </label>
              <input
                  type="number"
                  value={formData.daily_fee}
                  onChange={(e) => setFormData({ ...formData, daily_fee: e.target.value })}
                  min="0"
                  step="1000"
                  placeholder="مثال: 50000"
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                  required
              />
            </div>

            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                مبلغ ضمانت (تومان) <span className="text-red-500">*</span>
              </label>
              <input
                  type="number"
                  value={formData.deposit_amount}
                  onChange={(e) => setFormData({ ...formData, deposit_amount: e.target.value })}
                  min="0"
                  step="10000"
                  placeholder="مثال: 500000"
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                  required
              />
            </div>
          </div>

          {/* تاریخ‌ها */}
          <div className="grid md:grid-cols-2 gap-6">
            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                در دسترس از <span className="text-red-500">*</span>
              </label>
              <input
                  type="date"
                  value={formData.available_from}
                  onChange={(e) => setFormData({ ...formData, available_from: e.target.value })}
                  min={today}
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                  required
              />
            </div>

            <div>
              <label className="block text-lg font-bold text-gray-800 mb-3">
                در دسترس تا <span className="text-red-500">*</span>
              </label>
              <input
                  type="date"
                  value={formData.available_until}
                  onChange={(e) => setFormData({ ...formData, available_until: e.target.value })}
                  min={formData.available_from || today}
                  className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                  required
              />
            </div>
          </div>

          {/* وضعیت */}
          <div>
            <label className="block text-lg font-bold text-gray-800 mb-3">
              وضعیت آگهی
            </label>
            <select
                value={formData.status}
                onChange={(e) => setFormData({ ...formData, status: e.target.value })}
                className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
              <option value="active">فعال (قابل مشاهده)</option>
              <option value="paused">متوقف (موقتاً مخفی)</option>
              <option value="expired">منقضی</option>
            </select>
          </div>

          {/* دکمه‌ها */}
          <div className="flex flex-col sm:flex-row gap-4 pt-6 border-t-2 border-gray-200">
            <button
                type="submit"
                disabled={submitting}
                className="flex-1 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-xl font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition shadow-lg disabled:opacity-70 disabled:cursor-not-allowed transform hover:scale-105"
            >
              {submitting ? "در حال ایجاد آگهی..." : "انتشار آگهی"}
            </button>

            <Link
                href="/dashboard/users/listings"
                className="px-8 py-5 border-4 border-gray-300 text-gray-700 text-xl font-bold rounded-2xl hover:bg-gray-100 transition text-center"
            >
              انصراف
            </Link>
          </div>
        </form>
      </div>
  );
}