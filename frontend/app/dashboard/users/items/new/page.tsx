"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import { itemsAPI, categoriesAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";

type Category = { id: number; title: string };

export default function NewItemPage() {
  const router = useRouter();
  const [categories, setCategories] = useState<Category[]>([]);
  const [title, setTitle] = useState("");
  const [categoryId, setCategoryId] = useState<number | undefined>(undefined);
  const [condition, setCondition] = useState("like_new");
  const [description, setDescription] = useState("");
  const [images, setImages] = useState("");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }
    const fetchCats = async () => {
      try {
        const data = await categoriesAPI.getAll();
        setCategories(data || []);
      } catch (err: any) {
        setError("خطا در دریافت دسته‌بندی‌ها");
      }
    };
    fetchCats();
  }, [router]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!title.trim()) {
      setError("عنوان کالا را وارد کنید");
      return;
    }
    if (!categoryId) {
      setError("دسته‌بندی را انتخاب کنید");
      return;
    }
    setError("");
    setLoading(true);
    try {
      const payload: any = {
        title: title.trim(),
        category_id: categoryId,
        item_condition: condition,
      };
      if (description.trim()) payload.description = description.trim();
      if (images.trim()) {
        const list = images
            .split(",")
            .map((s) => s.trim())
            .filter(Boolean);
        payload.images_json = JSON.stringify(list);
      }

      await itemsAPI.create(payload);
      router.push("/dashboard/users/items");
    } catch (err: any) {
      setError(err.response?.data?.message || "ثبت کالا انجام نشد. دوباره تلاش کنید.");
    } finally {
      setLoading(false);
    }
  };

  return (
      <div className="min-h-screen bg-gray-50">
        {/* هدر زیبا */}
        <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-5xl my-12 text-white shadow-2xl">
          <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div>
              <h1 className="text-4xl font-bold mb-3">افزودن کالای جدید</h1>
              <p className="text-xl text-blue-100">کالای خود را برای امانت دادن ثبت کنید</p>
            </div>
            <Link
                href="/dashboard/users/items"
                className="px-8 py-4 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
            >
              ← بازگشت به لیست کالاها
            </Link>
          </div>
        </div>

        {/* فرم — راست‌چین */}
        <div dir="rtl" className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
          <form
              onSubmit={handleSubmit}
              className="bg-white rounded-3xl shadow-2xl p-10 border space-y-8"
          >
            {/* عنوان کالا */}
            <div>
              <label className="block text-lg font-semibold text-gray-700 mb-3">
                عنوان کالا <span className="text-red-500">*</span>
              </label>
              <input
                  type="text"
                  value={title}
                  onChange={(e) => setTitle(e.target.value)}
                  required
                  placeholder="مثلاً: دریل برقی بوش مدل GSB 16 RE"
                  className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
              />
            </div>

            {/* دسته‌بندی و وضعیت */}
            <div className="grid md:grid-cols-2 gap-8">
              <div>
                <label className="block text-lg font-semibold text-gray-700 mb-3">
                  دسته‌بندی <span className="text-red-500">*</span>
                </label>
                <select
                    value={categoryId ?? ""}
                    onChange={(e) => setCategoryId(e.target.value ? Number(e.target.value) : undefined)}
                    required
                    className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                >
                  <option value="">انتخاب دسته‌بندی</option>
                  {categories.map((cat) => (
                      <option key={cat.id} value={cat.id}>
                        {cat.title}
                      </option>
                  ))}
                </select>
              </div>

              <div>
                <label className="block text-lg font-semibold text-gray-700 mb-3">
                  وضعیت کالا
                </label>
                <select
                    value={condition}
                    onChange={(e) => setCondition(e.target.value)}
                    className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                >
                  <option value="new">نو و آکبند</option>
                  <option value="like_new">در حد نو</option>
                  <option value="used">کارکرده (سالم)</option>
                  <option value="old">قدیمی اما قابل استفاده</option>
                </select>
              </div>
            </div>

            {/* توضیحات */}
            <div>
              <label className="block text-lg font-semibold text-gray-700 mb-3">
                توضیحات کالا (اختیاری)
              </label>
              <textarea
                  value={description}
                  onChange={(e) => setDescription(e.target.value)}
                  rows={5}
                  placeholder="جزئیات، لوازم جانبی، شرایط استفاده، نقص‌ها (اگر وجود دارد) و..."
                  className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 resize-none transition"
              />
            </div>

            {/* لینک تصاویر */}
            <div>
              <label className="block text-lg font-semibold text-gray-700 mb-3">
                لینک تصاویر (اختیاری — با ویرگول جدا کنید)
              </label>
              <textarea
                  value={images}
                  onChange={(e) => setImages(e.target.value)}
                  rows={3}
                  placeholder="https://example.com/image1.jpg , https://example.com/image2.jpg"
                  className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 resize-none transition font-mono"
              />
              <p className="text-sm text-gray-500 mt-3">
                لینک مستقیم تصاویر (از imgur، تلگرام یا هر جای دیگر). اگر خالی بماند، کالا بدون تصویر ثبت می‌شود.
              </p>
            </div>

            {/* پیام خطا */}
            {error && (
                <div className="bg-red-50 border-2 border-red-300 text-red-800 px-8 py-5 rounded-2xl text-center font-medium text-lg">
                  ⚠️ {error}
                </div>
            )}

            {/* دکمه ثبت */}
            <div className="pt-6">
              <button
                  type="submit"
                  disabled={loading}
                  className="w-full py-5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-xl font-bold rounded-2xl hover:from-indigo-700 hover:to-blue-700 transition shadow-xl disabled:opacity-60 disabled:cursor-not-allowed transform hover:scale-105"
              >
                {loading ? "در حال ثبت کالا..." : "ثبت کالا و ادامه"}
              </button>
            </div>
          </form>
        </div>
      </div>
  );
}