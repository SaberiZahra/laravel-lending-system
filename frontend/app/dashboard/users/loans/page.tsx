"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { loansAPI, authAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";
import { Loan } from "@/lib/api";  // تایپ Loan از api.ts ایمپورت کن

export default function LoansPage() {
  const router = useRouter();
  const [allLoans, setAllLoans] = useState<Loan[]>([]);
  const [loading, setLoading] = useState(true);
  const [user, setUser] = useState<any>(null);
  const [activeTab, setActiveTab] = useState<"my-requests" | "incoming">("my-requests");

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const userData = await authAPI.me();
        const loansData = await loansAPI.getMyLoans();

        setUser(userData);
        setAllLoans(loansData || []);
      } catch (err: any) {
        alert("خطا در بارگذاری درخواست‌ها: " + (err.message || ""));
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  // ... بقیه کد (handleApprove, handleReject, renderLoans, etc) دقیقاً مثل کد فعلی‌ات

  const isAdmin = user?.role === 1;
  const currentUserId = user?.id;

  const myRequests = allLoans.filter((loan) => loan.borrower?.id === currentUserId);
  const incomingRequests = allLoans.filter((loan) => loan.listing?.item?.owner_id === currentUserId);

  // ... توابع formatDate, getImageUrl, getOwnerName, statusConfig, getStatus

  // renderLoans همون کد قبلی

  return (
      <div className="min-h-screen bg-gray-50">
        {/* هدر */}
        <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-6xl my-10 text-white shadow-2xl">
          <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div>
              <h1 className="text-4xl font-bold mb-3">درخواست‌های امانت</h1>
              <p className="text-xl text-blue-100">مدیریت درخواست‌های ارسال و دریافت کالا</p>
            </div>
            <Link href="/dashboard" className="px-8 py-4 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center">
              ← بازگشت به داشبورد
            </Link>
          </div>
        </div>

        <div dir="rtl" className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
          {/* تب‌ها فقط برای کاربر عادی */}
          <div className="flex gap-8 mb-10 border-b border-gray-200 overflow-x-auto">
            <button onClick={() => setActiveTab("my-requests")} className={`pb-4 px-2 text-lg font-semibold border-b-4 transition whitespace-nowrap ${activeTab === "my-requests" ? "border-indigo-600 text-indigo-600" : "border-transparent text-gray-600"}`}>
              درخواست‌های من ({myRequests.length})
            </button>
            <button onClick={() => setActiveTab("incoming")} className={`pb-4 px-2 text-lg font-semibold border-b-4 transition whitespace-nowrap ${activeTab === "incoming" ? "border-indigo-600 text-indigo-600" : "border-transparent text-gray-600"}`}>
              درخواست‌های دریافتی ({incomingRequests.length})
            </button>
          </div>

          <div className="grid gap-8">
            {activeTab === "my-requests" && renderLoans(myRequests, "درخواست‌های من برای امانت")}
            {activeTab === "incoming" && renderLoans(incomingRequests, "درخواست‌ها برای کالاهای من")}
          </div>
        </div>
      </div>
  );
}