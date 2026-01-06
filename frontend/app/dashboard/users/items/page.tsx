"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import { itemsAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Footer from "@/components/Footer";

type Item = {
  id: number;
  title: string;
  description?: string;
  item_condition?: string;
  category?: { id: number; title: string };
  images_json?: string;
};

export default function ItemsPage() {
  const router = useRouter();
  const [items, setItems] = useState<Item[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const data = await itemsAPI.getAll();
        setItems(data || []);
      } catch (err) {
        alert("خطا در دریافت کالاها");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  const handleDelete = async (id: number) => {
    if (!confirm("مطمئنی می‌خوای این کالا رو حذف کنی؟")) return;
    try {
      await itemsAPI.delete(id);
      setItems((prev) => prev.filter((i) => i.id !== id));
    } catch (err) {
      alert("حذف انجام نشد");
    }
  };

  if (loading) {
    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50">
          <div className="text-center">
            <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-6 text-xl text-gray-700">در حال بارگذاری کالاها...</p>
          </div>
        </div>
    );
  }

  return (
      <div dir="rtl" className="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        {/* هدر یکسان با آگهی‌ها */}
        <div className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-8 mb-12 text-white shadow-2xl">
          <div  className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div>
              <h1 className="text-4xl font-bold mb-2">کالاهای من</h1>
              <p className="text-blue-100 text-lg">مدیریت کالاهایی که برای امانت دارید</p>
            </div>

            <div className="flex gap-4">
              <Link
                  href="/dashboard"
                  className="px-6 py-3 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium"
              >
                ← بازگشت به داشبورد
              </Link>
              <Link
                  href="/dashboard/users/listings/new"
                  className="px-6 py-3 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition shadow-lg"
              >
                + ایجاد آگهی جدید
              </Link>
              <Link
                  href="/dashboard/users/items/new"
                  className="px-6 py-3 bg-white text-indigo-700 font-bold rounded-2xl hover:bg-gray-100 transition shadow-lg"
              >
                + افزودن کالای جدید
              </Link>
            </div>
          </div>
        </div>

        {/* لیست کالاها */}
        {items.length === 0 ? (
            <div className="bg-white rounded-3xl shadow-2xl p-16 text-center">
              <div className="text-gray-400 mb-6">
                <svg className="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
              </div>
              <p className="text-xl text-gray-600 mb-6">هنوز کالایی ثبت نکرده‌اید.</p>
              <Link
                  href="/dashboard/users/items/new"
                  className="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:shadow-xl transition transform hover:scale-105"
              >
                اولین کالا رو همین الان اضافه کنید!
              </Link>
            </div>
        ) : (
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
              {items.map((item) => (
                  <ItemCard key={item.id} item={item} onDelete={handleDelete} />
              ))}
            </div>
        )}
      </div>
  );
}

function ItemCard({ item, onDelete }: { item: Item; onDelete: (id: number) => void }) {
  let imageUrl = "https://via.placeholder.com/400x300/E5E7EB/6B7280?text=بدون+تصویر";
  if (item.images_json) {
    try {
      const images = typeof item.images_json === "string" ? JSON.parse(item.images_json) : item.images_json || [];
      if (images.length > 0) imageUrl = images[0];
    } catch (e) {}
  }

  return (
      <div className="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
        <div className="relative h-56 overflow-hidden">
          <img src={imageUrl} alt={item.title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition" />
        </div>

        <div className="p-6 space-y-4">
          <div>
            <h3 className="font-bold text-lg text-gray-900 line-clamp-2">{item.title}</h3>
            <p className="text-sm text-gray-600 mt-1 line-clamp-2">{item.description || "بدون توضیح"}</p>
          </div>

          <div className="flex justify-between text-sm">
            <span className="text-gray-500">{item.category?.title || "دسته‌بندی نشده"}</span>
            <span className="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
            {item.item_condition || "نامشخص"}
          </span>
          </div>

          <div className="grid grid-cols-3 gap-2 pt-4 border-t border-gray-100">
            <Link href={`/dashboard/users/items/edit/${item.id}`} className="text-center py-2 bg-amber-50 text-amber-700 rounded-xl hover:bg-amber-100 text-sm font-medium">
              ✏️ویرایش
            </Link>
            <button onClick={() => onDelete(item.id)} className="text-center py-2 bg-red-50 text-red-700 rounded-xl hover:bg-red-100 text-sm font-medium">
              🗑 حذف
            </button>
            <Link href={`/dashboard/users/listings/new?item=${item.id}`} className="text-center py-2 bg-green-50 text-green-700 rounded-xl hover:bg-green-100 text-sm font-medium">
              + آگهی
            </Link>
          </div>
        </div>
      </div>

  );
}