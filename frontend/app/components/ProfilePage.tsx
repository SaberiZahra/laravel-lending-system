"use client";

import { useState } from "react";
import {
  UserIcon,
  EnvelopeIcon,
  PhoneIcon,
  StarIcon
} from "@heroicons/react/24/outline";
import {
  EyeIcon,
  EyeSlashIcon
} from "@heroicons/react/24/solid";

/* =====================================================
   PROFILE PAGE
   route: /profile
===================================================== */

export function ProfilePage() {
  const [open, setOpen] = useState(false);

  return (
    <div className="relative min-h-screen bg-slate-50">
      {/* Hover Area */}
      <div
        onMouseEnter={() => setOpen(true)}
        onMouseLeave={() => setOpen(false)}
        className="fixed top-0 right-0 h-full w-8 z-40"
      />

      {/* Side Menu */}
      <aside
        onMouseEnter={() => setOpen(true)}
        onMouseLeave={() => setOpen(false)}
        className={`fixed top-0 right-0 h-full w-64 bg-white shadow-xl transition-transform duration-300 z-50 ${
          open ? "translate-x-0" : "translate-x-full"
        }`}
      >
        <nav className="p-6 space-y-4">
          <MenuItem label="پروفایل" href="/profile"/>
          <MenuItem label="آگهی‌های من" href="/listings" />
          <MenuItem label="درخواست‌ها" href="/loans" />
          <MenuItem label="پیام‌ها" href="/messages"/>
          <MenuItem label="تنظیمات" href="/settings"/>
        </nav>
      </aside>

      {/* Content */}
      <div className="p-6 space-y-8">
        <div className="bg-white rounded-2xl shadow p-6 flex items-center gap-6">
          <div className="h-24 w-24 rounded-full bg-slate-200" />
          <div>
            <h1 className="text-2xl font-bold">علی محمدی</h1>
            <p className="text-slate-500">@ali_mohammadi</p>
            <div className="flex items-center gap-1 text-amber-500 mt-2">
              <StarIcon className="h-5 w-5" />
              <span className="font-medium">4.6</span>
            </div>
          </div>
        </div>

        <div className="grid md:grid-cols-2 gap-4">
          <InfoCard icon={EnvelopeIcon} label="ایمیل" value="ali@email.com" />
          <InfoCard icon={PhoneIcon} label="شماره تماس" value="09120000000" />
        </div>

        <section>
          <h2 className="text-xl font-semibold mb-4 text-right">آگهی‌های من</h2>
          <div className="grid md:grid-cols-3 gap-4">
            <ListingCard />
            <ListingCard />
            <ListingCard />
          </div>
        </section>
      </div>
    </div>
  );
}

import Link from "next/link";
import { usePathname } from "next/navigation";


function MenuItem({ label, href }: { label: string; href: string }) {
const pathname = usePathname();
const active = pathname === href;


return (
<Link
href={href}
className={`block w-full text-right px-4 py-2 rounded-lg transition
${active
? "bg-slate-900 text-white"
: "hover:bg-slate-100 text-slate-700"}`}
>
{label}
</Link>
);
}

function InfoCard({ icon: Icon, label, value }: any) {
  return (
    <div className="bg-white rounded-xl shadow p-4 flex items-center gap-3">
      <Icon className="h-5 w-5 text-slate-500" />
      <div>
        <p className="text-sm text-slate-500">{label}</p>
        <p className="font-medium">{value}</p>
      </div>
    </div>
  );
}

/* =====================================================
   LISTINGS PAGE
   route: /listings
===================================================== */

export function ListingsPage() {
  return (
    <div className="min-h-screen bg-slate-100 p-6">
      <h1 className="text-2xl font-bold mb-6">آگهی‌ها</h1>

      <div className="grid md:grid-cols-4 gap-6">
        {/* Filters */}
        <aside className="bg-white rounded-2xl shadow p-4 space-y-4">
          <h2 className="font-semibold">فیلترها</h2>
          <select className="w-full border rounded-lg p-2">
            <option>دسته‌بندی</option>
          </select>
          <select className="w-full border rounded-lg p-2">
            <option>وضعیت آگهی</option>
          </select>
        </aside>
        
        {/* Listings */}
        <main className="md:col-span-3 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <PublicListingCard />
          <PublicListingCard />
          <PublicListingCard />
        </main>
      </div>
    </div>
  );
}

function ListingCard() {
  return (
    <div className="bg-white rounded-xl shadow p-4 space-y-2">
      <div className="h-32 bg-slate-200 rounded-lg" />
      <h3 className="font-semibold">دوربین DSLR</h3>
      <p className="text-sm text-slate-500">روزانه: 150,000 تومان</p>
      <span className="inline-block text-xs bg-green-100 text-green-700 px-2 py-1 rounded">فعال</span>
    </div>
  );
}

function PublicListingCard() {
  return (
    <div className="bg-white rounded-xl shadow p-4 space-y-3">
      <div className="h-40 bg-slate-200 rounded-lg" />
      <h3 className="font-semibold">اجاره پلی‌استیشن 5</h3>
      <p className="text-sm text-slate-500">دسته‌بندی: کنسول بازی</p>
      <div className="flex justify-between items-center">
        <span className="font-bold">200,000 / روز</span>
        <span className="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">در دسترس</span>
      </div>
    </div>
  );
}
