"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { profileAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

type User = {
  id: number;
  full_name: string;
  username: string;
  email: string;
  phone?: string;
  address?: string;
  profile_image?: string | null;
  trust_score?: number;
  status: string;
  created_at: string;
};

export default function ProfilePage() {
  const router = useRouter();
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [editing, setEditing] = useState(false);
  const [saving, setSaving] = useState(false);
  const [editData, setEditData] = useState({
    full_name: "",
    email: "",
    phone: "",
    address: "",
    profile_image: "",
  });

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const userData = await profileAPI.get();

        setUser(userData);
        setEditData({
          full_name: userData.full_name || "",
          email: userData.email || "",
          phone: userData.phone || "",
          address: userData.address || "",
          profile_image: userData.profile_image || "",
        });
      } catch (err: any) {
        setError("خطا در بارگذاری پروفایل");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  const handleSave = async () => {
    try {
      setSaving(true);

      let profileImage = editData.profile_image.trim();

      // اگر کاربر فیلد تصویر رو خالی گذاشت → آواتار پیش‌فرض زیبا
      if (!profileImage) {
        profileImage = `https://ui-avatars.com/api/?name=${encodeURIComponent(editData.full_name || "کاربر")}&background=6366f1&color=fff&size=256&bold=true`;
      }

      const payload: any = {
        full_name: editData.full_name.trim() || null,
        email: editData.email.trim(),
        phone: editData.phone.trim() || null,
        address: editData.address.trim() || null,
        profile_image: profileImage,
      };

      const updatedUser = await profileAPI.update(payload);
      setUser(updatedUser);
      setEditing(false);
      alert("پروفایل با موفقیت به‌روزرسانی شد!");
    } catch (err: any) {
      setError(err.response?.data?.message || "خطا در ذخیره تغییرات");
    } finally {
      setSaving(false);
    }
  };

  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString("fa-IR");
  };

  if (loading) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-8 text-xl text-gray-700">در حال بارگذاری پروفایل...</p>
          </div>
        </div>
    );
  }

  if (error || !user) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center bg-white rounded-3xl shadow-2xl p-12">
            <p className="text-2xl text-red-600 mb-6">{error || "خطا در بارگذاری پروفایل"}</p>
            <Link href="/dashboard" className="text-indigo-600 text-lg hover:underline">
              ← بازگشت به داشبورد
            </Link>
          </div>
        </div>
    );
  }

  return (
      <div className="min-h-screen bg-gray-50">
        {/* هدر پروفایل — فونت کوچیک‌تر + دکمه بازگشت */}
        <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-5xl my-12 text-white shadow-2xl">
          <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div className="flex items-center gap-6">
              {user.profile_image ? (
                  <img
                      src={user.profile_image}
                      alt="پروفایل"
                      className="w-28 h-28 rounded-full object-cover border-4 border-white shadow-xl"
                  />
              ) : (
                  <div className="w-28 h-28 rounded-full bg-white/30 backdrop-blur flex items-center justify-center text-4xl font-bold shadow-xl">
                    {user.full_name.charAt(0).toUpperCase()}
                  </div>
              )}

              <div>
                <h1 className="text-3xl font-bold mb-2">{user.full_name}</h1>
                <p className="text-xl text-blue-100 mb-4">@{user.username}</p>

                <div className="flex flex-wrap items-center gap-3 text-sm">
                  {user.trust_score !== undefined && (
                      <span className="bg-yellow-300 text-yellow-900 px-4 py-1.5 rounded-full font-medium">
                    ⭐ امتیاز اعتماد: {user.trust_score.toFixed(1)}
                  </span>
                  )}
                  <span className={`px-4 py-1.5 rounded-full font-medium ${user.status === "active" ? "bg-green-400" : "bg-gray-400"} text-white`}>
                  {user.status === "active" ? "فعال" : "غیرفعال"}
                </span>
                </div>
              </div>
            </div>

            {/* دکمه‌های بازگشت و ویرایش */}
            <div className="flex flex-col sm:flex-row gap-4">
              <Link
                  href="/dashboard"
                  className="px-6 py-3 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
              >
                ← بازگشت به داشبورد
              </Link>

              {!editing ? (
                  <button
                      onClick={() => setEditing(true)}
                      className="px-6 py-3 bg-white text-indigo-700 font-semibold rounded-2xl hover:bg-gray-100 transition"
                  >
                    ویرایش پروفایل
                  </button>
              ) : (
                  <div className="flex gap-3">
                    <button
                        onClick={handleSave}
                        disabled={saving}
                        className="px-6 py-3 bg-green-600 text-white font-semibold rounded-2xl hover:bg-green-700 transition disabled:opacity-60"
                    >
                      {saving ? "در حال ذخیره..." : "ذخیره"}
                    </button>
                    <button
                        onClick={() => {
                          setEditing(false);
                          setEditData({
                            full_name: user.full_name || "",
                            email: user.email || "",
                            phone: user.phone || "",
                            address: user.address || "",
                            profile_image: user.profile_image || "",
                          });
                        }}
                        className="px-6 py-3 bg-gray-600 text-white font-semibold rounded-2xl hover:bg-gray-700 transition"
                    >
                      انصراف
                    </button>
                  </div>
              )}
            </div>
          </div>
        </div>

        {/* محتوای اصلی — راست‌چین */}
        <div dir="rtl" className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
          {error && (
              <div className="bg-red-50 border-2 border-red-300 text-red-800 px-8 py-5 rounded-2xl mb-10 text-center font-medium text-lg">
                ⚠️ {error}
              </div>
          )}

          {/* اطلاعات کاربر */}
          <div className="bg-white rounded-3xl shadow-2xl p-10 border">
            <h2 className="text-3xl font-bold text-gray-900 mb-8">اطلاعات حساب</h2>

            {editing ? (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div>
                    <label className="block text-lg font-semibold text-gray-700 mb-3">نام کامل</label>
                    <input
                        type="text"
                        value={editData.full_name}
                        onChange={(e) => setEditData({ ...editData, full_name: e.target.value })}
                        className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                        placeholder="نام و نام خانوادگی"
                    />
                  </div>

                  <div>
                    <label className="block text-lg font-semibold text-gray-700 mb-3">ایمیل</label>
                    <input
                        type="email"
                        value={editData.email}
                        onChange={(e) => setEditData({ ...editData, email: e.target.value })}
                        className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                    />
                  </div>

                  <div>
                    <label className="block text-lg font-semibold text-gray-700 mb-3">شماره تماس</label>
                    <input
                        type="tel"
                        value={editData.phone}
                        onChange={(e) => setEditData({ ...editData, phone: e.target.value })}
                        className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition"
                        placeholder="09123456789"
                    />
                  </div>

                  <div>
                    <label className="block text-lg font-semibold text-gray-700 mb-3">آدرس</label>
                    <textarea
                        value={editData.address}
                        onChange={(e) => setEditData({ ...editData, address: e.target.value })}
                        rows={4}
                        className="w-full border-2 border-gray-300 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 resize-none transition"
                        placeholder="آدرس کامل پستی"
                    />
                  </div>

                  <div className="md:col-span-2">
                    <label className="block text-base font-medium text-gray-700 mb-2">
                      تصویر پروفایل (اختیاری — خالی کردن = آواتار پیش‌فرض)
                    </label>
                    <input
                        type="url"
                        value={editData.profile_image}
                        onChange={(e) => setEditData({ ...editData, profile_image: e.target.value })}
                        className="w-full border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition"
                        placeholder="https://example.com/photo.jpg"
                    />
                    <p className="text-xs text-gray-500 mt-2">
                      لینک مستقیم به تصویر. اگر خالی بگذارید، آواتار پیش‌فرض بر اساس نام شما ساخته می‌شود.
                    </p>
                  </div>
                </div>
            ) : (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <InfoCard label="ایمیل" value={user.email} icon="✉️" />
                  <InfoCard label="شماره تماس" value={user.phone || "وارد نشده"} icon="📞" />
                  <InfoCard label="آدرس" value={user.address || "وارد نشده"} icon="📍" />
                  <InfoCard label="تاریخ عضویت" value={formatDate(user.created_at)} icon="📅" />
                </div>
            )}
          </div>
        </div>
      </div>
  );
}

// کارت اطلاعات — شیک و مینیمال
function InfoCard({ label, value, icon }: { label: string; value: string; icon: string }) {
  return (
      <div className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 shadow hover:shadow-lg transition-all duration-300 border">
        <div className="flex items-center gap-5">
          <div className="text-4xl">{icon}</div>
          <div>
            <p className="text-lg text-gray-600 font-medium">{label}</p>
            <p className="text-xl font-bold text-gray-900 mt-2">{value}</p>
          </div>
        </div>
      </div>
  );
}