"use client";

import { useEffect, useState } from "react";
import { useRouter, useParams } from "next/navigation";
import Link from "next/link";
import { itemsAPI, categoriesAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";

type Category = { id: number; title: string };

export default function EditItemPage() {
    const router = useRouter();
    const { id } = useParams(); // آیدی از URL

    const [categories, setCategories] = useState<Category[]>([]);
    const [title, setTitle] = useState("");
    const [categoryId, setCategoryId] = useState<number | undefined>(undefined);
    const [condition, setCondition] = useState("like_new");
    const [description, setDescription] = useState("");
    const [images, setImages] = useState("");
    const [loading, setLoading] = useState(true);
    const [submitting, setSubmitting] = useState(false);
    const [error, setError] = useState("");

    useEffect(() => {
        if (!isAuthenticated()) {
            router.push("/login");
            return;
        }

        const fetchData = async () => {
            if (!id) return;

            try {
                setLoading(true);
                const [catsData, itemData] = await Promise.all([
                    categoriesAPI.getAll(),
                    itemsAPI.getById(Number(id)),
                ]);

                setCategories(catsData || []);

                if (itemData) {
                    setTitle(itemData.title || "");
                    setCategoryId(itemData.category_id || undefined);
                    setCondition(itemData.item_condition || "like_new");
                    setDescription(itemData.description || "");

                    if (itemData.images_json) {
                        try {
                            const imagesArray = typeof itemData.images_json === "string"
                                ? JSON.parse(itemData.images_json)
                                : itemData.images_json || [];
                            setImages(imagesArray.join(", "));
                        } catch (e) {
                            setImages("");
                        }
                    }
                } else {
                    setError("کالا یافت نشد.");
                }
            } catch (err: any) {
                setError("خطا در بارگذاری اطلاعات کالا.");
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [id, router]);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        if (!categoryId) {
            setError("دسته‌بندی را انتخاب کنید");
            return;
        }

        setError("");
        setSubmitting(true);

        try {
            const payload: any = {
                title: title.trim(),
                category_id: categoryId,
                item_condition: condition,
            };
            if (description.trim()) payload.description = description.trim();

            if (images.trim()) {
                const list = images.split(",").map((s) => s.trim()).filter(Boolean);
                payload.images_json = JSON.stringify(list);
            } else {
                payload.images_json = JSON.stringify([]);
            }

            await itemsAPI.update(Number(id), payload);
            router.push("/dashboard/users/items");
        } catch (err: any) {
            setError(err.response?.data?.message || "ویرایش کالا انجام نشد.");
        } finally {
            setSubmitting(false);
        }
    };

    // لودینگ
    if (loading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-gray-50">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 mx-auto"></div>
                    <p className="mt-6 text-xl text-gray-700">در حال بارگذاری کالا...</p>
                </div>
            </div>
        );
    }

    // خطا یا کالا یافت نشد
    if (error) {
        return (
            <div className="max-w-4xl mx-auto py-20 px-6 text-center">
                <p className="text-2xl text-red-600 mb-8">{error}</p>
                <Link href="/dashboard/users/items" className="text-blue-600 text-lg hover:underline">
                    ← بازگشت به لیست کالاها
                </Link>
            </div>
        );
    }

    return (
        <div className="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            {/* هدر زیبا */}
            <div className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-8 mb-10 text-white shadow-2xl">
                <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <div>
                        <h1 className="text-4xl font-bold mb-2">ویرایش کالا</h1>
                        <p className="text-blue-100 text-lg">شماره کالا: {id}</p>
                    </div>
                    <Link
                        href="/dashboard/users/items"
                        className="px-6 py-3 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
                    >
                        ← بازگشت به لیست کالاها
                    </Link>
                </div>
            </div>

            {/* فرم ویرایش */}
            <form onSubmit={handleSubmit} className="bg-white rounded-3xl shadow-2xl p-8 sm:p-12 space-y-8">
                {error && (
                    <div className="bg-red-50 border-2 border-red-300 text-red-800 px-6 py-4 rounded-2xl font-medium text-center">
                        ⚠️ {error}
                    </div>
                )}

                <div>
                    <label className="block text-lg font-bold text-gray-800 mb-3">
                        عنوان کالا <span className="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        value={title}
                        onChange={(e) => setTitle(e.target.value)}
                        required
                        className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                        placeholder="مثال: لپ‌تاپ Dell حرفه‌ای"
                    />
                </div>

                <div className="grid md:grid-cols-2 gap-8">
                    <div>
                        <label className="block text-lg font-bold text-gray-800 mb-3">
                            دسته‌بندی <span className="text-red-500">*</span>
                        </label>
                        <select
                            value={categoryId ?? ""}
                            onChange={(e) => setCategoryId(e.target.value ? Number(e.target.value) : undefined)}
                            required
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                        >
                            <option value="">انتخاب کنید...</option>
                            {categories.map((cat) => (
                                <option key={cat.id} value={cat.id}>
                                    {cat.title}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label className="block text-lg font-bold text-gray-800 mb-3">
                            وضعیت کالا
                        </label>
                        <select
                            value={condition}
                            onChange={(e) => setCondition(e.target.value)}
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                        >
                            <option value="new">نو</option>
                            <option value="like_new">در حد نو</option>
                            <option value="used">کارکرده</option>
                            <option value="old">قدیمی</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label className="block text-lg font-bold text-gray-800 mb-3">
                        توضیحات (اختیاری)
                    </label>
                    <textarea
                        value={description}
                        onChange={(e) => setDescription(e.target.value)}
                        rows={6}
                        className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 resize-none transition"
                        placeholder="لوازم جانبی، شرایط استفاده، دلیل فروش و..."
                    />
                </div>

                <div>
                    <label className="block text-lg font-bold text-gray-800 mb-3">
                        لینک تصاویر (با ویرگول جدا کنید)
                    </label>
                    <textarea
                        value={images}
                        onChange={(e) => setImages(e.target.value)}
                        rows={4}
                        className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition font-mono"
                        placeholder="https://example.com/img1.jpg , https://example.com/img2.jpg"
                    />
                    <p className="text-sm text-gray-500 mt-3">
                        برای حذف همه تصاویر، این فیلد را خالی بگذارید.
                    </p>
                </div>

                <div className="flex flex-col sm:flex-row gap-6 pt-8 border-t-2 border-gray-200">
                    <button
                        type="submit"
                        disabled={submitting}
                        className="flex-1 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-xl font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition shadow-xl disabled:opacity-70 disabled:cursor-not-allowed transform hover:scale-105"
                    >
                        {submitting ? "در حال ذخیره تغییرات..." : "ذخیره تغییرات"}
                    </button>

                    <Link
                        href="/dashboard/users/items"
                        className="px-8 py-5 border-4 border-gray-300 text-gray-700 text-xl font-bold rounded-2xl hover:bg-gray-100 transition text-center"
                    >
                        انصراف
                    </Link>
                </div>
            </form>
        </div>
    );
}