"use client";

import { useState } from "react";

type Listing = {
  id: number;
  title: string;
  dailyFee: number;
  category: string;
  owner: string;
  status: "available" | "unavailable";
};

export default function ListingsPage() {
  const [menuOpen, setMenuOpen] = useState(false);

  const listings: Listing[] = [
    {
      id: 1,
      title: "دوربین DSLR Canon",
      dailyFee: 150000,
      category: "دوربین",
      owner: "علی محمدی",
      status: "available",
    },
    {
      id: 2,
      title: "پلی‌استیشن 5",
      dailyFee: 200000,
      category: "کنسول بازی",
      owner: "محمد رضایی",
      status: "unavailable",
    },
  ];

  return (
    <div className="bg-white">
      {/* Header */}
      <header className="border-b">
        <div className="container mx-auto px-6 py-4 flex justify-between items-center">
          <h1 className="text-2xl font-semibold">آگهی‌ها</h1>

          <button
            onClick={() => setMenuOpen(!menuOpen)}
            className="sm:hidden text-xl"
          >
            ☰
          </button>
        </div>

        {/* Filters (Mobile) */}
        {menuOpen && (
          <div className="border-t sm:hidden px-6 py-4 space-y-3">
            <select className="w-full border rounded-lg px-3 py-2">
              <option>همه دسته‌بندی‌ها</option>
            </select>
            <select className="w-full border rounded-lg px-3 py-2">
              <option>همه وضعیت‌ها</option>
            </select>
          </div>
        )}
      </header>

      {/* Main */}
      <main className="my-8">
        <div className="container mx-auto px-6 flex gap-6">
          {/* Filters (Desktop) */}
          <aside className="hidden sm:block w-64 space-y-4">
            <h2 className="font-semibold">فیلترها</h2>

            <select className="w-full border rounded-lg px-3 py-2">
              <option>همه دسته‌بندی‌ها</option>
            </select>

            <select className="w-full border rounded-lg px-3 py-2">
              <option>همه وضعیت‌ها</option>
            </select>
          </aside>

          {/* Listings Grid */}
          <section className="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 flex-1">
            {listings.map((listing) => (
              <div
                key={listing.id}
                className="rounded-2xl shadow overflow-hidden bg-white"
              >
                <div className="h-48 bg-slate-200" />

                <div className="p-5 space-y-1">
                  <h3 className="font-semibold">{listing.title}</h3>

                  <p className="text-sm text-slate-500">
                    دسته‌بندی: {listing.category}
                  </p>

                  <p className="text-sm text-slate-500">
                    مالک: {listing.owner}
                  </p>

                  <div className="flex justify-between items-center mt-3">
                    <span className="font-bold">
                      {listing.dailyFee.toLocaleString()} تومان / روز
                    </span>

                    <span
                      className={`text-xs px-2 py-1 rounded-full ${
                        listing.status === "available"
                          ? "bg-green-100 text-green-700"
                          : "bg-slate-200 text-slate-600"
                      }`}
                    >
                      {listing.status === "available"
                        ? "در دسترس"
                        : "ناموجود"}
                    </span>
                  </div>

                  <button className="mt-3 w-full rounded-xl bg-slate-900 text-white py-2 hover:bg-slate-800">
                    مشاهده جزئیات
                  </button>
                </div>
              </div>
            ))}
          </section>
        </div>
      </main>
    </div>
  );
}
