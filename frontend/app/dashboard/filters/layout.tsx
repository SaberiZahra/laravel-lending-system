"use client";

import { useEffect, useState } from "react";
import Link from "next/link";
import { ChevronRightIcon } from "@heroicons/react/24/outline";

type Listing = {
  id: number;
  title: string;
  dailyFee: number;
  category: string;
  owner: string;
  status: "available" | "unavailable";
};

export default function ListingsPage() {
  const [sidebarOpen, setSidebarOpen] = useState(false);
  const [listingOpen, setListingOpen] = useState(false);

  const [category, setCategory] = useState("all");
  const [status, setStatus] = useState("all");
  const [maxPrice, setMaxPrice] = useState("");

  const [listings, setListings] = useState<Listing[]>([]);
  const [loading, setLoading] = useState(true);

  /* ===== FETCH LISTINGS FROM API ===== */
  useEffect(() => {
    const fetchListings = async () => {
      try {
        const token = localStorage.getItem("token"); // Sanctum token

        const res = await fetch("http://localhost:8000/api/listings", {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
          },
        });

        const data = await res.json();

        // Map API response to UI structure
        const mapped: Listing[] = data.map((item: any) => ({
          id: item.id,
          title: item.title,
          dailyFee: item.daily_fee,
          category: item.category,
          owner: item.user?.name ?? "نامشخص",
          status: item.status,
        }));

        setListings(mapped);
      } catch (error) {
        console.error("خطا در دریافت آگهی‌ها:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchListings();
  }, []);

  /* ===== FILTER LOGIC ===== */
  const filteredListings = listings.filter((l) => {
    const categoryMatch =
      category === "all" || l.category === category;

    const statusMatch =
      status === "all" || l.status === status;

    const priceMatch =
      !maxPrice || l.dailyFee <= Number(maxPrice);

    return categoryMatch && statusMatch && priceMatch;
  });

  const MenuItem = ({ label, href }: { label: string; href: string }) => (
    <Link
      href={href}
      className="block w-full text-right px-4 py-2 rounded-lg hover:bg-blue-100 text-blue-900 transition"
    >
      {label}
    </Link>
  );

  /* ===== UI (UNCHANGED) ===== */
  return (
    <div className="min-h-screen bg-blue-50 relative">
      {/* Trigger bar */}
      <div
        onClick={() => setSidebarOpen(!sidebarOpen)}
        className="fixed top-1/2 right-0 z-50 h-32 w-6 bg-gradient-to-b from-blue-700 to-blue-800 rounded-l-full cursor-pointer flex items-center justify-center shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all"
      >
        <ChevronRightIcon
          className={`w-5 h-5 text-white transform transition-transform duration-300 ${
            sidebarOpen ? "rotate-180" : ""
          }`}
        />
      </div>

      {/* Sidebar */}
      <aside
        className={`fixed top-0 right-0 h-full w-64 bg-white shadow-xl transition-transform duration-300 z-40 ${
          sidebarOpen ? "translate-x-0" : "translate-x-full"
        }`}
      >
        <nav className="p-6 space-y-2">
          <MenuItem label="پروفایل" href="/dashboard/users/profile" />

          <div>
            <button
              onClick={() => setListingOpen(!listingOpen)}
              className="w-full text-right px-4 py-2 rounded-lg hover:bg-blue-100 text-blue-900 flex justify-between"
            >
              آگهی‌های من
              <span className={listingOpen ? "rotate-90" : ""}>▶️</span>
            </button>

            {listingOpen && (
              <div className="mt-1 pl-4 space-y-1">
                <MenuItem label="آگهی‌های فعال" href="/dashboard/users/listings/active" />
                <MenuItem label="آگهی‌های منقضی" href="/dashboard/users/listings/expired" />
              </div>
            )}
          </div>

          <MenuItem label="درخواست‌ها" href="/dashboard/users/loans" />
          <MenuItem label="پیام‌ها" href="/dashboard/users/messages" />
          <MenuItem label="خانه" href="/listings" />
          <MenuItem label="تنظیمات" href="/settings" />
        </nav>
      </aside>

      {/* Main content */}
      <main className="flex-1 p-6 max-w-5xl mx-auto space-y-6">
        <h1 className="text-3xl font-bold text-blue-800">آگهی‌ها</h1>

        {loading ? (
          <p className="text-center text-gray-500">در حال بارگذاری...</p>
        ) : (
          <div className="flex flex-col gap-4">
            {filteredListings.map((listing) => (
              <div
                key={listing.id}
                className="flex flex-col md:flex-row bg-white rounded-2xl shadow-md"
              >
                <div className="w-full md:w-48 h-40 bg-gray-200" />

                <div className="flex-1 p-5 flex justify-between items-center">
                  <div>
                    <h3 className="font-semibold">{listing.title}</h3>
                    <p className="text-sm">دسته‌بندی: {listing.category}</p>
                    <p className="text-sm">مالک: {listing.owner}</p>
                  </div>

                  <div className="text-left">
                    <p className="font-bold text-blue-700">
                      {listing.dailyFee.toLocaleString()} تومان / روز
                    </p>
                    <span className="text-xs">
                      {listing.status === "available" ? "در دسترس" : "ناموجود"}
                    </span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </main>
    </div>
  );
}
