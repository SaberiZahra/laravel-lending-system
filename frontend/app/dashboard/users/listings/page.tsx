"use client";

import { useState } from "react";

type Listing = {
  id: number;
  title: string;
  dailyFee: number;
  status: "active" | "inactive";
};

export default function MyListingsPage() {
  const [listings, setListings] = useState<Listing[]>([
    { id: 1, title: "دوربین DSLR Canon", dailyFee: 150000, status: "active" },
    { id: 2, title: "پلی‌استیشن 5", dailyFee: 200000, status: "inactive" },
  ]);

  const [showForm, setShowForm] = useState(false);
  const [title, setTitle] = useState("");
  const [dailyFee, setDailyFee] = useState("");

  function addListing() {
    if (!title || !dailyFee) return;

    setListings((prev) => [
      ...prev,
      {
        id: Date.now(),
        title,
        dailyFee: Number(dailyFee),
        status: "active",
      },
    ]);

    setTitle("");
    setDailyFee("");
    setShowForm(false);
  }

  function deleteListing(id: number) {
    setListings((prev) => prev.filter((l) => l.id !== id));
  }

  return (
    <div className="space-y-8">
      {/* Header */}
      <header className="flex justify-between items-center">
        <h1 className="text-2xl font-bold">آگهی‌های من</h1>

        <button
          onClick={() => setShowForm(true)}
          className="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800"
        >
          + افزودن آگهی
        </button>
      </header>

      {/* Add Listing Form */}
      {showForm && (
        <div className="bg-white rounded-2xl shadow p-6 space-y-4">
          <h2 className="font-semibold text-lg">آگهی جدید</h2>

          <input
            value={title}
            onChange={(e) => setTitle(e.target.value)}
            placeholder="عنوان آگهی"
            className="w-full border rounded-xl px-4 py-2"
          />

          <input
            value={dailyFee}
            onChange={(e) => setDailyFee(e.target.value)}
            placeholder="قیمت روزانه (تومان)"
            type="number"
            className="w-full border rounded-xl px-4 py-2"
          />

          <div className="flex gap-2">
            <button
              onClick={addListing}
              className="px-4 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700"
            >
              ثبت آگهی
            </button>

            <button
              onClick={() => setShowForm(false)}
              className="px-4 py-2 rounded-xl bg-slate-200"
            >
              انصراف
            </button>
          </div>
        </div>
      )}

      {/* Listings */}
      <section className="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {listings.map((listing) => (
          <div
            key={listing.id}
            className="bg-white rounded-2xl shadow p-4 space-y-3"
          >
            <div className="h-32 bg-slate-200 rounded-lg" />

            <h3 className="font-semibold">{listing.title}</h3>

            <p className="text-sm text-slate-500">
              {listing.dailyFee.toLocaleString()} تومان / روز
            </p>

            <div className="flex justify-between items-center">
              <span
                className={`text-xs px-2 py-1 rounded-full ${
                  listing.status === "active"
                    ? "bg-green-100 text-green-700"
                    : "bg-slate-200 text-slate-600"
                }`}
              >
                {listing.status === "active" ? "فعال" : "رزرو شده"}
              </span>

              <button
                onClick={() => deleteListing(listing.id)}
                className="text-sm text-red-600 hover:underline"
              >
                حذف
              </button>
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
