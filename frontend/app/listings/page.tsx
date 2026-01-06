"use client";

import { useEffect, useState } from "react";
import Link from "next/link";
import { useSearchParams } from "next/navigation";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { listingsAPI, categoriesAPI } from "@/lib/api";
import { ChevronDownIcon, EyeIcon } from "@heroicons/react/24/outline";

type Listing = {
  id: number;
  title: string;
  daily_fee: number;
  status: string;
  view_count?: number;
  item: {
    id: number;
    title: string;
    images_json?: string | null;
    category?: {
      id: number;
      title: string;
    };
  };
};

type Category = {
  id: number;
  title: string;
};

type SortOption = "newest" | "most_viewed" | "cheapest" | "most_expensive";

export default function ListingsPage() {
  const [listings, setListings] = useState<Listing[]>([]);
  const [categories, setCategories] = useState<Category[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string>("");
  const searchParams = useSearchParams();

  const [searchQuery, setSearchQuery] = useState("");
  const [selectedCategory, setSelectedCategory] = useState<number | null>(null);
  const [sortBy, setSortBy] = useState<SortOption>("newest");
  const [showSortMenu, setShowSortMenu] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const [listingsData, categoriesData] = await Promise.all([
          listingsAPI.getPublic(),
          categoriesAPI.getAll(),
        ]);
        setListings(listingsData || []);
        setCategories(categoriesData || []);

        const search = searchParams.get("search") || "";
        const category = searchParams.get("category");
        const sort = searchParams.get("sort") as SortOption | null;

        setSearchQuery(search);
        if (category) setSelectedCategory(Number(category));
        if (sort && ["newest", "most_viewed", "cheapest", "most_expensive"].includes(sort)) {
          setSortBy(sort);
        }
      } catch (err: any) {
        setError("خطا در بارگذاری آگهی‌ها");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [searchParams]);

  const filteredAndSortedListings = listings
      .filter((listing) => {
        const matchesSearch =
            listing.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
            listing.item.title.toLowerCase().includes(searchQuery.toLowerCase());
        const matchesCategory =
            selectedCategory === null || listing.item.category?.id === selectedCategory;
        return matchesSearch && matchesCategory;
      })
      .sort((a, b) => {
        switch (sortBy) {
          case "newest":
            return (b.id || 0) - (a.id || 0);
          case "most_viewed":
            return (b.view_count || 0) - (a.view_count || 0);
          case "cheapest":
            return a.daily_fee - b.daily_fee;
          case "most_expensive":
            return b.daily_fee - a.daily_fee;
          default:
            return 0;
        }
      });

  const sortLabels: Record<SortOption, string> = {
    newest: "جدیدترین",
    most_viewed: "پربازدیدترین",
    cheapest: "ارزان‌ترین",
    most_expensive: "گران‌ترین",
  };

  if (loading) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-8 text-xl text-gray-700">در حال بارگذاری آگهی‌ها...</p>
          </div>
        </div>
    );
  }

  return (
      <div className="min-h-screen bg-gray-50">
        <Header />

        <div dir="rtl" className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          {/* عنوان و مرتب‌سازی */}
          <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">
            <h1 className="text-4xl font-bold text-gray-900">همه آگهی‌ها</h1>

            <div className="relative">
              <button
                  onClick={() => setShowSortMenu(!showSortMenu)}
                  className="flex items-center gap-3 px-6 py-4 bg-white rounded-2xl shadow-md hover:shadow-lg transition font-medium text-gray-800"
              >
                <span>مرتب‌سازی: {sortLabels[sortBy]}</span>
                <ChevronDownIcon className={`w-5 h-5 transition ${showSortMenu ? "rotate-180" : ""}`} />
              </button>

              {showSortMenu && (
                  <div className="absolute top-full mt-3 w-full bg-white rounded-2xl shadow-xl border overflow-hidden z-10">
                    {(["newest", "most_viewed", "cheapest", "most_expensive"] as SortOption[]).map((option) => (
                        <button
                            key={option}
                            onClick={() => {
                              setSortBy(option);
                              setShowSortMenu(false);
                            }}
                            className={`w-full px-6 py-4 text-right hover:bg-indigo-50 transition ${
                                sortBy === option ? "bg-indigo-100 text-indigo-700 font-bold" : "text-gray-700"
                            }`}
                        >
                          {sortLabels[option]}
                        </button>
                    ))}
                  </div>
              )}
            </div>
          </div>

          {/* فیلتر دسته‌بندی */}
          <div className="flex flex-wrap gap-3 justify-end mb-10">
            <button
                onClick={() => setSelectedCategory(null)}
                className={`px-6 py-3 rounded-2xl font-medium transition shadow-sm ${
                    selectedCategory === null
                        ? "bg-indigo-600 text-white"
                        : "bg-white text-gray-700 border hover:bg-gray-50"
                }`}
            >
              همه دسته‌ها
            </button>
            {categories.map((cat) => (
                <button
                    key={cat.id}
                    onClick={() => setSelectedCategory(cat.id)}
                    className={`px-6 py-3 rounded-2xl font-medium transition shadow-sm ${
                        selectedCategory === cat.id
                            ? "bg-indigo-600 text-white"
                            : "bg-white text-gray-700 border hover:bg-gray-50"
                    }`}
                >
                  {cat.title}
                </button>
            ))}
          </div>

          {/* گرید آگهی‌ها */}
          {filteredAndSortedListings.length === 0 ? (
              <div className="text-center py-20">
                <p className="text-2xl text-gray-600">آگهی‌ای با این شرایط یافت نشد</p>
                <p className="text-gray-500 mt-4">فیلترها را تغییر دهید یا بعداً دوباره امتحان کنید</p>
              </div>
          ) : (
              <div className="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                {filteredAndSortedListings.map((listing) => {
                  const images = listing.item.images_json
                      ? typeof listing.item.images_json === "string"
                          ? JSON.parse(listing.item.images_json)
                          : listing.item.images_json || []
                      : [];
                  const imageUrl = images.length > 0 ? images[0] : "https://via.placeholder.com/400x300/E5E7EB/6B7280?text=بدون+تصویر";

                  const isAvailable = listing.status === "active";

                  return (
                      <Link
                          key={listing.id}
                          href={`/listings/${listing.id}`}
                          className="group block bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3"
                      >
                        <div className="aspect-video overflow-hidden">
                          <img
                              src={imageUrl}
                              alt={listing.title}
                              className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                          />
                        </div>

                        <div className="p-6 space-y-5">
                          <h3 className="text-2xl font-bold text-gray-900 line-clamp-2 leading-tight">
                            {listing.title}
                          </h3>

                          <p className="text-base text-gray-600">
                            {listing.item.category?.title || "دسته‌بندی نامشخص"}
                          </p>

                          <div className="space-y-4">
                            <div className="flex items-baseline gap-2">
                        <span className="text-2xl font-bold text-indigo-600">
                          {listing.daily_fee.toLocaleString()}
                        </span>
                              <span className="text-base text-gray-600">تومان در روز</span>
                            </div>

                            <div className="flex flex-wrap items-center justify-between gap-4 text-sm">
                              {/*{listing.view_count !== undefined && (*/}
                              {/*    <div className="flex items-center gap-2 text-gray-600">*/}
                              {/*      <EyeIcon className="w-5 h-5" />*/}
                              {/*      <span>{listing.view_count.toLocaleString()} بازدید</span>*/}
                              {/*    </div>*/}
                              {/*)}*/}

                              <div className="flex items-center gap-2">
                                <span className={`w-3 h-3 rounded-full ${isAvailable ? "bg-green-500 animate-pulse" : "bg-gray-400"}`} />
                                <span className={`font-medium ${isAvailable ? "text-green-700" : "text-gray-600"}`}>
                            {isAvailable ? "در دسترس" : "ناموجود"}
                          </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </Link>
                  );
                })}
              </div>
          )}
        </div>

        <Footer />
      </div>
  );
}