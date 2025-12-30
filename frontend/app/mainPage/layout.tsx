import Link from 'next/link';
import Image from 'next/image';
import { MagnifyingGlassIcon } from '@heroicons/react/24/outline';
import { getPublicListings } from '@/app/lib/api'; // مسیر درست api.ts خودت
import { ArrowRightIcon } from '@heroicons/react/24/outline';

// نوع داده‌های listing (برای TypeScript بهتره)
type Listing = {
  id: number;
  title: string;
  description: string | null;
  daily_fee: number;
  deposit_amount: number;
  item: {
    title: string;
    images_json: string | null; // JSON string like '["url1","url2"]'
    category: {
      title: string;
    } | null;
    owner: {
      full_name: string;
    };
  };
};

export default async function HomePage() {
  let listings: Listing[] = [];
  let error: string | null = null;

  try {
    const data = await getPublicListings();
    // اگر pagination داری: listings = data.data
    // اگر نه: listings = data
    listings = Array.isArray(data) ? data : data.data || [];
  } catch (err: any) {
    error = err.message || 'خطا در دریافت آگهی‌ها. لطفاً بعداً دوباره تلاش کنید.';
    console.error('Error fetching listings:', err);
  }

  return (
      <div className="min-h-screen bg-gray-50">
        {/* Hero Section - بالای صفحه */}
        <section className="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20 px-6">
          <div className="max-w-6xl mx-auto text-center">
            <h1 className="text-4xl md:text-6xl font-bold mb-6">
              اجاره کنید، قرض بدهید، صرفه‌جویی کنید!
            </h1>
            <p className="text-xl md:text-2xl mb-10">
              هزاران وسیله با قیمت مناسب در دسترس شماست
            </p>
            <div className="max-w-2xl mx-auto">
              <div className="relative">
                <input
                    type="text"
                    placeholder="چیزی که نیاز داری رو جستجو کن..."
                    className="w-full px-6 py-4 pr-14 rounded-full text-gray-900 text-lg focus:outline-none focus:ring-4 focus:ring-white/30"
                />
                <MagnifyingGlassIcon className="absolute left-6 top-1/2 -translate-y-1/2 w-8 h-8 text-gray-500" />
              </div>
            </div>
          </div>
        </section>

        {/* Listings Section */}
        <section className="max-w-7xl mx-auto px-6 py-12">
          <h2 className="text-3xl font-bold text-gray-800 mb-8 text-center">
            آگهی‌های جدید
          </h2>

          {error && (
              <div className="text-center py-12">
                <p className="text-red-600 text-xl">{error}</p>
                <button
                    onClick={() => window.location.reload()}
                    className="mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                >
                  تلاش دوباره
                </button>
              </div>
          )}

          {!error && listings.length === 0 && (
              <div className="text-center py-20">
                <p className="text-gray-600 text-xl">هنوز آگهی‌ای ثبت نشده است.</p>
                <p className="text-gray-500 mt-4">اولین نفر باشید که چیزی برای اجاره می‌ذاره!</p>
              </div>
          )}

          {!error && listings.length > 0 && (
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                {listings.map((listing) => {
                  // اولین عکس رو از images_json بگیر
                  let firstImage = '/placeholder.jpg'; // عکس پیش‌فرض
                  if (listing.item.images_json) {
                    try {
                      const images = JSON.parse(listing.item.images_json);
                      if (Array.isArray(images) && images.length > 0) {
                        firstImage = images[0];
                      }
                    } catch (e) {
                      console.error('Invalid images_json', e);
                    }
                  }

                  return (
                      <Link
                          href={`/listing/${listing.id}`}
                          key={listing.id}
                          className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl hover:scale-105 transition-all duration-300"
                      >
                        <div className="relative h-64 bg-gray-200">
                          <Image
                              src={firstImage}
                              alt={listing.title}
                              fill
                              className="object-cover"
                              unoptimized // اگر عکس‌ها از دامنه خارجی هستن
                          />
                          <div className="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                            {listing.item.category?.title || 'دسته‌بندی نشده'}
                          </div>
                        </div>

                        <div className="p-6">
                          <h3 className="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            {listing.title}
                          </h3>
                          <p className="text-gray-600 text-sm mb-4 line-clamp-3">
                            {listing.description || 'بدون توضیحات'}
                          </p>

                          <div className="flex justify-between items-center mb-4">
                            <div>
                              <p className="text-2xl font-bold text-blue-600">
                                {listing.daily_fee.toLocaleString('fa-IR')} تومان
                              </p>
                              <p className="text-sm text-gray-500">در روز</p>
                            </div>
                            <div className="text-right">
                              <p className="text-sm text-gray-600">ودیعه:</p>
                              <p className="font-semibold">
                                {listing.deposit_amount.toLocaleString('fa-IR')} تومان
                              </p>
                            </div>
                          </div>

                          <div className="flex items-center justify-between text-sm text-gray-500">
                            <span>ارائه‌دهنده: {listing.item.owner.full_name}</span>
                            <span className="bg-green-100 text-green-800 px-3 py-1 rounded-full">
                        موجود
                      </span>
                          </div>
                        </div>
                      </Link>
                  );
                })}
              </div>
          )}
        </section>

        {/* CTA Section */}
        <section className="bg-blue-600 text-white py-16 text-center">
          <div className="max-w-4xl mx-auto px-6">
            <h2 className="text-3xl md:text-4xl font-bold mb-6">
              وسیله‌ای دارید که استفاده نمی‌کنید؟
            </h2>
            <p className="text-xl mb-10">
              آن را اجاره دهید و درآمد کسب کنید!
            </p>
            <Link
                href="/login"
                className="inline-flex items-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-bold hover:bg-gray-100 transition"
            >
              همین حالا شروع کنید
              <ArrowRightIcon className="w-6 h-6" />
            </Link>
          </div>
        </section>
      </div>
  );
}