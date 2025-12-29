"use client";

import { useState } from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";

export default function ProfileLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const [open, setOpen] = useState(false);
  const pathname = usePathname();

  const MenuItem = ({ label, href }: { label: string; href: string }) => {
    const active = pathname === href;

    return (
      <Link
        href={href}
        className={`block w-full text-right px-4 py-2 rounded-lg transition
          ${
            active
              ? "bg-slate-900 text-white"
              : "hover:bg-slate-100 text-slate-700"
          }`}
      >
        {label}
      </Link>
    );
  };

  return (
    <div className="relative min-h-screen bg-slate-50">
      {/* Hover zone */}
      <div
        onMouseEnter={() => setOpen(true)}
        onMouseLeave={() => setOpen(false)}
        className="fixed top-0 right-0 h-full w-8 z-40"
      />

      {/* Sidebar */}
      <aside
        onMouseEnter={() => setOpen(true)}
        onMouseLeave={() => setOpen(false)}
        className={`fixed top-0 right-0 h-full w-64 bg-white shadow-xl
        transition-transform duration-300 z-50
        ${open ? "translate-x-0" : "translate-x-full"}`}
      >
        <nav className="p-6 space-y-4">
          <MenuItem label="پروفایل" href="/dashboard/users/profile" />
          <MenuItem label="آگهی‌های من" href="/dashboard/users/listings" />
          <MenuItem label="درخواست‌ها" href="/dashboard/users/loans" />
          <MenuItem label="پیام‌ها" href="/dashboard/users/messages" />
          <MenuItem label="آگهی ها" href="/listings" />
          <MenuItem label="تنظیمات" href="/settings" />
        </nav>
      </aside>

      {/* Content */}
      <main className="p-6">{children}</main>
    </div>
  );
}
