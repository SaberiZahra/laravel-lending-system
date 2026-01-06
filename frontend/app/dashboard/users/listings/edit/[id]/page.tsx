"use client";

import { useEffect, useState } from "react";
import { useRouter, useParams } from "next/navigation";
import Link from "next/link";
import { listingsAPI, itemsAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";

type Item = { id: number; title: string };

export default function EditListingPage() {
    const router = useRouter();
    const { id } = useParams(); // آیدی آگهی از URL

    const [items, setItems] = useState<Item[]>([]);
    const [formData, setFormData] = useState({
        item_id: "",
        title: "",
        description: "",
        daily_fee: "",
        deposit_amount: "",
        available_from: "",
        available_until: "",
        status: "active",
    });

    const [loading, setLoading] = useState(true);
    const [submitting, setSubmitting] = useState(false);
    const [error, setError] = useState("");

    const today = new Date().toISOString().split("T")[0];

    useEffect(() => {
        if (!isAuthenticated()) {
            router.push("/login");
            return;
        }

        const fetchData = async () => {
            if (!id) return;

            try {
                setLoading(true);
                const [itemsData, listingData] = await Promise.all([
                    itemsAPI.getAll(),
                    listingsAPI.getById(Number(id)),
                ]);

                setItems(itemsData || []);

                if (listingData) {
                    setFormData({
                        item_id: listingData.item_id?.toString() || "",
                        title: listingData.title || "",
                        description: listingData.description || "",
                        daily_fee: listingData.daily_fee?.toString() || "",
                        deposit_amount: listingData.deposit_amount?.toString() || "",
                        available_from: listingData.available_from || today,
                        available_until: listingData.available_until || "",
                        status: listingData.status || "active",
                    });
                } else {
                    setError("آگهی یافت نشد.");
                }
            } catch (err: any) {
                setError("خطا در بارگذاری اطلاعات آگهی.");
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [id, router]);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setError("");

        if (!formData.item_id || !formData.title || !formData.daily_fee || !formData.deposit_amount || !formData.available_from || !formData.available_until) {
            setError("لطفاً تمام فیلدهای الزامی را پر کنید.");
            return;
        }

        try {
            setSubmitting(true);
            await listingsAPI.update(Number(id), {
                item_id: parseInt(formData.item_id),
                title: formData.title.trim(),
                description: formData.description.trim() || null,
                daily_fee: parseFloat(formData.daily_fee),
                deposit_amount: parseFloat(formData.deposit_amount),
                available_from: formData.available_from,
                available_until: formData.available_until,
                status: formData.status,
            });

            router.push("/dashboard/users/listings");
            alert("آگهی با موفقیت ویرایش شد!");
        } catch (err: any) {
            setError(err.response?.data?.message || "ویرایش آگهی انجام نشد.");
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
                    <p className="mt-6 text-xl text-gray-700">در حال بارگذاری آگهی...</p>
                </div>
            </div>
        );
    }

    // خطا
    if (error && !loading) {
        return (
            <div className="max-w-4xl mx-auto py-20 px-6 text-center">
                <p className="text-2xl text-red-600 mb-8">{error}</p>
                <Link href="/dashboard/users/listings" className="text-blue-600 text-lg hover:underline">
                    ← بازگشت به لیست آگهی‌ها
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
                        <h1 className="text-4xl font-bold mb-2">ویرایش آگهی</h1>
                        <p className="text-blue-100 text-lg">شماره آگهی: {id}</p>
                    </div>
                    <Link
                        href="/dashboard/users/listings"
                        className="px-6 py-3 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
                    >
                        ← بازگشت به آگهی‌ها
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

                {/* انتخاب کالا + بنر کالای جدید */}
                <div className="space-y-6">
                    <div>
                        <label className="block text-lg font-bold text-gray-800 mb-3">
                            انتخاب کالا <span className="text-red-500">*</span>
                        </label>
                        <select
                            value={formData.item_id}
                            onChange={(e) => setFormData({ ...formData, item_id: e.target.value })}
                            required
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
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

                <div>
                    <label className="block text-lg font-bold text-gray-800 mb-3">
                        عنوان آگهی <span className="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        value={formData.title}
                        onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                        required
                        placeholder="مثال: اجاره لپ‌تاپ Dell - مناسب کار و بازی"
                        className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                    />
                </div>

                <div>
                    <label className="block text-lg font-bold text-gray-800 mb-3">
                        توضیحات آگهی (اختیاری)
                    </label>
                    <textarea
                        value={formData.description}
                        onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                        rows={6}
                        placeholder="جزئیات بیشتر، شرایط استفاده، نحوه تحویل و..."
                        className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 resize-none transition"
                    />
                </div>

                <div className="grid md:grid-cols-2 gap-8">
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
                            required
                            placeholder="مثال: 50000"
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
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
                            required
                            placeholder="مثال: 500000"
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                        />
                    </div>
                </div>

                <div className="grid md:grid-cols-2 gap-8">
                    <div>
                        <label className="block text-lg font-bold text-gray-800 mb-3">
                            در دسترس از <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            value={formData.available_from}
                            onChange={(e) => setFormData({ ...formData, available_from: e.target.value })}
                            min={today}
                            required
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
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
                            required
                            className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                        />
                    </div>
                </div>

                <div>
                    <label className="block text-lg font-bold text-gray-800 mb-3">
                        وضعیت آگهی
                    </label>
                    <select
                        value={formData.status}
                        onChange={(e) => setFormData({ ...formData, status: e.target.value })}
                        className="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition"
                    >
                        <option value="active">فعال (قابل مشاهده)</option>
                        <option value="paused">متوقف (مخفی موقت)</option>
                        <option value="expired">منقضی</option>
                    </select>
                </div>

                <div className="flex flex-col sm:flex-row gap-6 pt-8 border-t-2 border-gray-200">
                    <button
                        type="submit"
                        disabled={submitting}
                        className="flex-1 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-xl font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition shadow-xl disabled:opacity-70 transform hover:scale-105"
                    >
                        {submitting ? "در حال ذخیره تغییرات..." : "ذخیره تغییرات"}
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