"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { listingsAPI, authAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

type Listing = {
  id: number;
  title: string;
  description?: string;
  daily_fee: number;
  deposit_amount?: number;
  status: string;
  item?: {
    id: number;
    title: string;
    images_json?: string | null;
  } | null;
};

export default function MyListingsPage() {
  const router = useRouter();
  const [listings, setListings] = useState<Listing[]>([]);
  const [loading, setLoading] = useState(true);
  const [user, setUser] = useState<any>(null);

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const [listingsData, userData] = await Promise.all([
          listingsAPI.getAll(),
          authAPI.me().catch(() => null),
        ]);
        setListings(listingsData || []);
        setUser(userData);
      } catch (err) {
        alert("خطا در بارگذاری آگهی‌ها");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  const isAdmin = user?.role === 1;

  const handleDelete = async (id: number) => {
    if (!confirm("مطمئنی می‌خوای این آگهی رو حذف کنی؟")) return;
    try {
      await listingsAPI.delete(id);
      setListings((prev) => prev.filter((l) => l.id !== id));
    } catch (err) {
      alert("حذف انجام نشد");
    }
  };

  if (loading) {
    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50">
          <div className="text-center">
            <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-6 text-xl text-gray-700">در حال بارگذاری آگهی‌ها...</p>
          </div>
        </div>
    );
  }

  return (
      <div dir="rtl" className="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        {/* هدر یکسان */}
        <div className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-8 mb-12 text-white shadow-2xl">
          <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div>
              <h1 className="text-4xl font-bold mb-2">
                {isAdmin ? "مدیریت همه آگهی‌ها" : "آگهی‌های من"}
              </h1>
              <p className="text-blue-100 text-lg">
                {isAdmin ? "تمام آگهی‌های ثبت شده در سایت" : "آگهی‌های امانت شما"}
              </p>
            </div>

            {!isAdmin && (
                <div className="flex gap-4">
                  <Link
                      href="/dashboard"
                      className="px-6 py-3 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium"
                  >
                    ← بازگشت به داشبورد
                  </Link>
                  <Link
                      href="/dashboard/users/listings/new"
                      className="px-6 py-3 bg-white text-indigo-700 font-bold rounded-2xl hover:bg-gray-100 transition shadow-lg"
                  >
                    + ایجاد آگهی جدید
                  </Link>
                </div>
            )}
          </div>
        </div>

        {/* لیست آگهی‌ها */}
        {listings.length === 0 ? (
            <div className="bg-white rounded-3xl shadow-2xl p-16 text-center">
              <div className="text-gray-400 mb-6">
                <svg className="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <p className="text-xl text-gray-600 mb-6">
                {isAdmin ? "هیچ آگهی‌ای ثبت نشده." : "شما هنوز آگهی‌ای ندارید."}
              </p>
              {!isAdmin && (
                  <Link
                      href="/dashboard/users/listings/new"
                      className="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:shadow-xl transition transform hover:scale-105"
                  >
                    اولین آگهی رو بسازید!
                  </Link>
              )}
            </div>
        ) : (
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
              {listings.map((listing) => (
                  <ListingCard key={listing.id} listing={listing} onDelete={handleDelete} />
              ))}
            </div>
        )}
      </div>
  );
}

function ListingCard({ listing, onDelete }: { listing: Listing; onDelete: (id: number) => void }) {
  const item = listing.item;
  const itemTitle = item?.title || "کالا نامشخص";
  let imageUrl = "https://via.placeholder.com/400x300/E5E7EB/6B7280?text=بدون+تصویر";
  if (item?.images_json) {
    try {
      const images = typeof item.images_json === "string" ? JSON.parse(item.images_json) : item.images_json || [];
      if (images.length > 0) imageUrl = images[0];
    } catch (e) {}
  }

  return (
      <div className="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
        <div className="relative h-56 overflow-hidden">
          <img src={imageUrl} alt={listing.title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition" />
        </div>

        <div className="p-6 space-y-4">
          <div>
            <h3 className="font-bold text-lg text-gray-900 line-clamp-2">{listing.title}</h3>
            <p className="text-sm text-gray-600 mt-1">کالا: {itemTitle}</p>
          </div>

          <p className="text-2xl font-bold text-indigo-600">
            {listing.daily_fee.toLocaleString()} <span className="text-sm font-normal text-gray-600">تومان/روز</span>
          </p>

          <span className={`inline-block px-4 py-2 rounded-full text-sm font-medium ${listing.status === "active" ? "bg-green-100 text-green-700" : "bg-gray-100 text-gray-600"}`}>
          {listing.status === "active" ? "✅ فعال" : "⏸ متوقف"}
        </span>

          <div className="grid grid-cols-3 gap-2 pt-4 border-t border-gray-100">
            <Link href={`/listings/${listing.id}`} className="text-center py-2 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 text-sm font-medium">
              👁مشاهده
            </Link>
            <Link href={`/dashboard/users/listings/edit/${listing.id}`} className="text-center py-2 bg-amber-50 text-amber-700 rounded-xl hover:bg-amber-100 text-sm font-medium">
              ✏️ویرایش
            </Link>
            <button onClick={() => onDelete(listing.id)} className="text-center py-2 bg-red-50 text-red-700 rounded-xl hover:bg-red-100 text-sm font-medium">
              🗑 حذف
            </button>
          </div>
        </div>
      </div>
  );
}