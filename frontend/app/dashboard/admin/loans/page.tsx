"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { loansAPI, authAPI, adminAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";
import { Loan } from "@/lib/api";

export default function AdminLoansPage() {
    const router = useRouter();
    const [allLoans, setAllLoans] = useState<Loan[]>([]);
    const [loading, setLoading] = useState(true);
    const [user, setUser] = useState<any>(null);
    const [activeTab, setActiveTab] = useState<"my-requests" | "incoming" | "all-history">("all-history");

    useEffect(() => {
        if (!isAuthenticated()) {
            router.push("/login");
            return;
        }

        const fetchData = async () => {
            try {
                setLoading(true);
                const userData = await authAPI.me();

                if (userData?.role !== 1) {
                    router.push("/dashboard");
                    return;
                }

                const loansData = await adminAPI.getAllLoans();

                setUser(userData);
                setAllLoans(loansData || []);
                setActiveTab("all-history");
            } catch (err: any) {
                alert("خطا در بارگذاری درخواست‌ها: " + (err.message || ""));
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [router]);

    const handleApprove = async (loanId: number) => {
        if (!confirm("آیا از تأیید این درخواست مطمئن هستید؟")) return;

        try {
            await loansAPI.approve(loanId);
            setAllLoans((prev) =>
                prev.map((loan) =>
                    loan.id === loanId ? { ...loan, status: "approved" } : loan
                )
            );
        } catch (err: any) {
            alert("تأیید درخواست انجام نشد.");
        }
    };

    const handleReject = async (loanId: number) => {
        if (!confirm("آیا از رد این درخواست مطمئن هستید؟")) return;

        try {
            await loansAPI.reject(loanId);
            setAllLoans((prev) =>
                prev.map((loan) =>
                    loan.id === loanId ? { ...loan, status: "rejected" } : loan
                )
            );
        } catch (err: any) {
            alert("رد درخواست انجام نشد.");
        }
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-gray-50 flex items-center justify-center">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
                    <p className="mt-8 text-xl text-gray-700">در حال بارگذاری درخواست‌ها...</p>
                </div>
            </div>
        );
    }

    const currentUserId = user?.id;

    const myRequests = allLoans.filter((loan) => loan.borrower?.id === currentUserId);
    const incomingRequests = allLoans.filter(
        (loan) => loan.listing?.item?.owner_id === currentUserId
    );

    const formatDate = (date: string) => new Date(date).toLocaleDateString("fa-IR");

    const getImageUrl = (images_json?: string | null) => {
        if (!images_json) return "https://via.placeholder.com/300x200/E5E7EB/6B7280?text=بدون+تصویر";
        try {
            const images = typeof images_json === "string" ? JSON.parse(images_json) : images_json || [];
            return images.length > 0 && images[0] ? images[0] : "https://via.placeholder.com/300x200/E5E7EB/6B7280?text=بدون+تصویر";
        } catch {
            return "https://via.placeholder.com/300x200/E5E7EB/6B7280?text=بدون+تصویر";
        }
    };

    const getOwnerName = (loan: Loan) => {
        if (!loan.listing?.item?.owner) return "نامشخص";
        return loan.listing.item.owner.full_name || loan.listing.item.owner.username || "نامشخص";
    };

    const statusConfig = {
        requested: { label: "در انتظار", color: "bg-amber-100 text-amber-700", icon: "⏳" },
        approved: { label: "تأیید شده", color: "bg-blue-100 text-blue-700", icon: "✅" },
        borrowed: { label: "امانت داده شده", color: "bg-green-100 text-green-700", icon: "📦" },
        returned: { label: "بازگردانده شده", color: "bg-gray-100 text-gray-700", icon: "↩️" },
        rejected: { label: "رد شده", color: "bg-red-100 text-red-700", icon: "❌" },
        cancelled: { label: "لغو شده", color: "bg-purple-100 text-purple-700", icon: "🚫" },
    };

    const getStatus = (status: string) =>
        statusConfig[status as keyof typeof statusConfig] || statusConfig.requested;

    // تابع renderLoans که گم شده بود! ← این بخش اضافه شد
    const renderLoans = (loansList: Loan[], title: string) => {
        if (loansList.length === 0) {
            return (
                <div className="bg-white rounded-3xl shadow-xl p-16 text-center">
                    <p className="text-xl text-gray-600">هیچ درخواستی وجود ندارد</p>
                </div>
            );
        }

        return (
            <div className="space-y-8">
                <h3 className="text-2xl font-bold text-gray-900">{title}</h3>
                {loansList.map((loan) => {
                    if (!loan.listing || !loan.listing.item) return null;

                    const status = getStatus(loan.status);

                    return (
                        <div
                            key={loan.id}
                            className="bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border"
                        >
                            <div className="flex flex-col md:flex-row gap-6">
                                <div className="md:w-40 flex-shrink-0">
                                    <div className="h-40 rounded-2xl overflow-hidden shadow">
                                        <img
                                            src={getImageUrl(loan.listing.item.images_json)}
                                            alt={loan.listing.title}
                                            className="w-full h-full object-cover"
                                        />
                                    </div>
                                </div>

                                <div className="flex-1 space-y-4">
                                    <div className="flex items-start justify-between">
                                        <div>
                                            <h4 className="text-xl font-bold text-gray-900 mb-1">{loan.listing.title}</h4>
                                            <p className="text-base text-gray-600">
                                                کالا: <span className="font-medium">{loan.listing.item.title}</span>
                                            </p>
                                            <p className="text-sm text-gray-500 mt-1">
                                                صاحب کالا: <span className="font-medium">{getOwnerName(loan)}</span>
                                            </p>
                                        </div>

                                        <span className={`px-5 py-2 rounded-full text-base font-medium ${status.color}`}>
                      {status.icon} {status.label}
                    </span>
                                    </div>

                                    <div className="flex flex-wrap gap-6 text-sm bg-gray-50 p-4 rounded-2xl">
                                        <div className="flex items-center gap-2">
                                            <span className="text-gray-600 font-medium">بازه امانت:</span>
                                            <span className="font-semibold">
                        {formatDate(loan.start_date)} تا {formatDate(loan.end_date)}
                      </span>
                                        </div>
                                        <div className="flex items-center gap-2">
                                            <span className="text-gray-600 font-medium">تاریخ درخواست:</span>
                                            <span className="font-semibold">{formatDate(loan.request_date)}</span>
                                        </div>
                                        {loan.borrower && (
                                            <div className="flex items-center gap-2">
                                                <span className="text-gray-600 font-medium">امانت‌گیرنده:</span>
                                                <span className="font-semibold">
                          {loan.borrower.full_name} (@{loan.borrower.username})
                        </span>
                                            </div>
                                        )}
                                    </div>

                                    {/* دکمه‌های تأیید/رد فقط وقتی وضعیت requested باشه */}
                                    {loan.status === "requested" && (
                                        <div className="flex gap-4 pt-4 border-t border-gray-200">
                                            <button
                                                onClick={() => handleApprove(loan.id)}
                                                className="flex-1 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-2xl hover:from-green-600 hover:to-emerald-700 transition shadow"
                                            >
                                                ✅ تأیید درخواست
                                            </button>
                                            <button
                                                onClick={() => handleReject(loan.id)}
                                                className="flex-1 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white font-bold rounded-2xl hover:from-red-600 hover:to-rose-700 transition shadow"
                                            >
                                                ❌ رد درخواست
                                            </button>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    );
                })}
            </div>
        );
    };

    return (
        <div className="min-h-screen bg-gray-50">
            {/* هدر ادمین */}
            <div dir="rtl" className="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-6xl my-10 text-white shadow-2xl">
                <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <div>
                        <h1 className="text-4xl font-bold mb-3">مدیریت درخواست‌های امانت (ادمین)</h1>
                        <p className="text-xl text-purple-100">مشاهده و مدیریت تمام درخواست‌های سیستم</p>
                    </div>
                    <Link
                        href="/dashboard"
                        className="px-8 py-4 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
                    >
                        ← بازگشت به داشبورد
                    </Link>
                </div>
            </div>

            <div dir="rtl" className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
                {/* تب‌ها */}
                <div className="flex gap-8 mb-10 border-b border-gray-200 overflow-x-auto">
                    <button
                        onClick={() => setActiveTab("my-requests")}
                        className={`pb-4 px-2 text-lg font-semibold border-b-4 transition whitespace-nowrap ${
                            activeTab === "my-requests" ? "border-indigo-600 text-indigo-600" : "border-transparent text-gray-600"
                        }`}
                    >
                        درخواست‌های من ({myRequests.length})
                    </button>
                    <button
                        onClick={() => setActiveTab("incoming")}
                        className={`pb-4 px-2 text-lg font-semibold border-b-4 transition whitespace-nowrap ${
                            activeTab === "incoming" ? "border-indigo-600 text-indigo-600" : "border-transparent text-gray-600"
                        }`}
                    >
                        درخواست‌های دریافتی ({incomingRequests.length})
                    </button>
                    <button
                        onClick={() => setActiveTab("all-history")}
                        className={`pb-4 px-2 text-lg font-semibold border-b-4 transition whitespace-nowrap ${
                            activeTab === "all-history" ? "border-indigo-600 text-indigo-600" : "border-transparent text-gray-600"
                        }`}
                    >
                        تاریخچه تمام درخواست‌ها ({allLoans.length})
                    </button>
                </div>

                {/* نمایش لیست */}
                <div className="grid gap-8">
                    {activeTab === "my-requests" && renderLoans(myRequests, "درخواست‌های من")}
                    {activeTab === "incoming" && renderLoans(incomingRequests, "درخواست‌های دریافتی از من")}
                    {activeTab === "all-history" && renderLoans(allLoans, "تمام درخواست‌های سیستم")}
                </div>
            </div>
        </div>
    );
}