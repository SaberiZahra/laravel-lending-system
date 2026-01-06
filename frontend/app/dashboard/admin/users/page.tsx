"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { adminAPI, authAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

type User = {
  id: number;
  full_name: string;
  username: string;
  email: string;
  phone?: string;
  role: number;
  status: string;
  trust_score?: number;
  items_count?: number;
  loans_count?: number;
  created_at: string;
};

export default function AdminUsersPage() {
  const router = useRouter();

  const [users, setUsers] = useState<User[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [currentUser, setCurrentUser] = useState<any>(null);

  // نگه‌داری مقدار امتیاز در حال ویرایش
  const [editingScores, setEditingScores] = useState<Record<number, number>>({});
  const [savingUserId, setSavingUserId] = useState<number | null>(null);

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const [usersData, userData] = await Promise.all([
          adminAPI.getUsers(),
          authAPI.me().catch(() => null),
        ]);

        setUsers(usersData?.data || usersData || []);
        setCurrentUser(userData);

        if (userData?.role !== 1) {
          router.push("/dashboard");
        }
      } catch (err: any) {
        setError(err.response?.data?.message || "خطا در دریافت لیست کاربران");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  const handleScoreChange = (userId: number, value: string) => {
    let num = Number(value);
    if (isNaN(num)) num = 0;
    if (num < 0) num = 0;
    if (num > 10) num = 10;

    setEditingScores((prev) => ({
      ...prev,
      [userId]: num,
    }));
  };

  const saveTrustScore = async (userId: number) => {
    const score = editingScores[userId];
    if (score === undefined) return;

    try {
      setSavingUserId(userId);
      await adminAPI.updateUserTrustScore(userId, score);

      setUsers((prev) =>
          prev.map((u) =>
              u.id === userId ? { ...u, trust_score: score } : u
          )
      );
    } catch (err: any) {
      alert(err.response?.data?.message || "خطا در ذخیره امتیاز");
    } finally {
      setSavingUserId(null);
    }
  };

  if (loading) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-6 text-lg text-gray-700">در حال بارگذاری کاربران...</p>
          </div>
        </div>
    );
  }

  if (currentUser?.role !== 1) return null;

  return (
      <div className="min-h-screen bg-gray-50">
        <div className="max-w-7xl mx-auto py-12 px-4">

          {/* هدر */}
          <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mb-12 text-white shadow-2xl">
            <div className="flex justify-between items-center">
              <div>
                <h1 className="text-4xl font-bold mb-2">مدیریت کاربران</h1>
                <p className="text-blue-100">ویرایش امتیاز اعتماد کاربران</p>
              </div>
              <Link
                  href="/dashboard"
                  className="px-6 py-3 bg-white/20 rounded-xl hover:bg-white/30 transition"
              >
                ← بازگشت
              </Link>
            </div>
          </div>

          {error && (
              <div className="bg-red-100 text-red-700 px-6 py-4 rounded-xl mb-6">
                {error}
              </div>
          )}

          {/* جدول */}
          <div dir="rtl" className="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead className="bg-gray-100">
                <tr>
                  <th className="px-6 py-4 text-right">نام</th>
                  <th className="px-6 py-4 text-right">نام کاربری</th>
                  <th className="px-6 py-4 text-right">ایمیل</th>
                  <th className="px-6 py-4 text-center">نقش</th>
                  <th className="px-6 py-4 text-center">وضعیت</th>
                  <th className="px-6 py-4 text-center">امتیاز اعتماد</th>
                  <th className="px-6 py-4 text-center">عملیات</th>
                </tr>
                </thead>
                <tbody className="divide-y">
                {users.map((u) => {
                  const value =
                      editingScores[u.id] ?? u.trust_score ?? 0;

                  return (
                      <tr key={u.id} className="hover:bg-gray-50">
                        <td className="px-6 py-4">{u.full_name || "-"}</td>
                        <td className="px-6 py-4">@{u.username}</td>
                        <td className="px-6 py-4">{u.email}</td>

                        <td className="px-6 py-4 text-center">
                          {u.role === 1 ? "👑 مدیر" : "کاربر"}
                        </td>

                        <td className="px-6 py-4 text-center">
                          {u.status === "active" ? "✅ فعال" : "🔴 غیرفعال"}
                        </td>

                        {/* ویرایش امتیاز */}
                        <td className="px-6 py-4 text-center">
                          <input
                              type="number"
                              min={0}
                              max={10}
                              step={0.1}
                              value={value}
                              onChange={(e) =>
                                  handleScoreChange(u.id, e.target.value)
                              }
                              className="w-20 text-center border rounded-lg px-2 py-1"
                          />
                          <span className="ml-1 text-sm">/ 10</span>
                        </td>

                        <td className="px-6 py-4 text-center">
                          <button
                              onClick={() => saveTrustScore(u.id)}
                              disabled={savingUserId === u.id}
                              className="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50"
                          >
                            {savingUserId === u.id ? "در حال ذخیره..." : "ذخیره"}
                          </button>
                        </td>
                      </tr>
                  );
                })}
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
  );
}
