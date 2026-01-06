"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { authAPI, listingsAPI, loansAPI, itemsAPI, adminAPI } from "@/lib/api"; // ← adminAPI اضافه شد
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";
import Footer from "@/components/Footer";

type Loan = {
    id: number;
    status: string;
    request_date: string;
    start_date: string | null;
    end_date: string | null;
    listing: {
        id: number;
        title: string;
        item: { id: number; title: string };
    };
    borrower?: { id: number; full_name: string; username: string };
};

export default function DashboardPage() {
    const router = useRouter();
    const [loading, setLoading] = useState(true);
    const [user, setUser] = useState<any>(null);
    const [loans, setLoans] = useState<Loan[]>([]);
    const [adminPendingLoans, setAdminPendingLoans] = useState<Loan[]>([]); // ← تغییر نام و منبع
    const [items, setItems] = useState<any[]>([]);
    const [listings, setListings] = useState<any[]>([]);
    const isAdmin = user?.role === 1;

    useEffect(() => {
        if (!isAuthenticated()) {
            router.push("/login");
            return;
        }

        const fetchData = async () => {
            try {
                setLoading(true);
                const userData = await authAPI.me();

                // درخواست‌های کاربر عادی
                const myLoansData = await loansAPI.getMyLoans().catch(() => []);

                // فقط اگر ادمین بود، درخواست‌های در انتظار رو بگیر
                let pendingLoans: Loan[] = [];
                if (userData?.role === 1) {
                    try {
                        const allLoans = await adminAPI.getAllLoans();
                        pendingLoans = allLoans.filter((l: Loan) => l.status === "requested");
                    } catch (err) {
                        console.error("خطا در دریافت درخواست‌های ادمین:", err);
                        pendingLoans = [];
                    }
                }

                const [myItems, listingsData] = await Promise.all([
                    itemsAPI.getAll().catch(() => []),
                    listingsAPI.getAll().catch(() => []),
                ]);

                setUser(userData);
                setLoans(myLoansData || []);
                setAdminPendingLoans(pendingLoans);
                setItems(myItems || []);
                setListings(listingsData || []);
            } catch (err) {
                console.error("Error fetching dashboard data:", err);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [router]);

    if (loading) {
        return (
            <div className="min-h-screen bg-gray-50 flex items-center justify-center">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
                    <p className="mt-6 text-lg text-gray-700">در حال بارگذاری...</p>
                </div>
            </div>
        );
    }

    // داده‌های کاربر عادی
    const myId = user?.id;
    const myLoanRequests = loans.filter((loan) => loan.borrower?.id === myId);
    const incomingRequests = loans.filter(
        (loan) =>
            loan.listing?.item?.owner?.id === myId && loan.borrower?.id !== myId
    );

    const formatDate = (value: string | null) =>
        value ? new Date(value).toLocaleDateString("fa-IR") : "-";

    return (
        <div className="min-h-screen bg-gray-50">
            {/* هدر */}
            <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-6xl my-10 text-white shadow-2xl">
                <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <div>
                        <h1 className="text-4xl font-bold mb-3">خوش آمدید!</h1>
                        <p className="text-2xl text-blue-100">
                            {user?.full_name || user?.username || "کاربر گرامی"}
                            {isAdmin && (
                                <span className="mr-4 bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full text-base font-bold">
                                    👑 مدیر سیستم
                                </span>
                            )}
                        </p>
                    </div>
                    <div className="text-left lg:text-right">
                        <p className="text-lg text-blue-100">داشبورد شخصی شما</p>
                    </div>
                </div>
            </div>

            {/* محتوای اصلی — راست‌چین */}
            <div dir="rtl" className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
                {/* دسترسی سریع */}
                <div className="mb-20">
                    <h2 className="text-3xl font-bold text-gray-900 mb-12 text-center">دسترسی سریع</h2>

                    {/* ردیف اول — همیشه ۳ کارت اصلی */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 justify-items-center">
                        <QuickActionCard
                            title="کالاهای من"
                            description="مدیریت کالاهای ثبت شده"
                            icon="🛍️"
                            link="/dashboard/users/items"
                            color="from-blue-500 to-cyan-500"
                        />
                        <QuickActionCard
                            title={isAdmin ? "همه آگهی‌ها" : "آگهی‌های من"}
                            description="مدیریت آگهی‌های امانت"
                            icon="📋"
                            link="/dashboard/users/listings"
                            color="from-indigo-500 to-purple-500"
                        />
                        <QuickActionCard
                            title="درخواست‌های امانت"
                            description="مشاهده و مدیریت درخواست‌ها"
                            icon="📨"
                            link={isAdmin ? "/dashboard/admin/loans" : "/dashboard/users/loans"} // ← اینجا تغییر مهم!
                            color="from-green-500 to-emerald-500"
                        />
                    </div>

                    {/* ردیف دوم — متفاوت برای کاربر و ادمین */}
                    <div className={`grid grid-cols-1 ${isAdmin ? "md:grid-cols-4" : "md:grid-cols-3"} gap-8 justify-items-center`}>
                        {!isAdmin && (
                            <>
                                <QuickActionCard
                                    title="پروفایل من"
                                    description="تنظیمات و اطلاعات شخصی"
                                    icon="👤"
                                    link="/dashboard/users/profile"
                                    color="from-purple-500 to-pink-500"
                                />
                                <QuickActionCard
                                    title="چت با پشتیبانی"
                                    description="ارسال پیام به ادمین"
                                    icon="💬"
                                    link="/dashboard/users/messages"
                                    color="from-pink-500 to-rose-500"
                                />
                                <div className="hidden md:block w-full" />
                            </>
                        )}

                        {isAdmin && (
                            <>
                                <QuickActionCard
                                    title="پروفایل من"
                                    description="تنظیمات و اطلاعات شخصی"
                                    icon="👤"
                                    link="/dashboard/users/profile"
                                    color="from-purple-500 to-pink-500"
                                />
                                <QuickActionCard
                                    title="دسته‌بندی‌ها"
                                    description="مدیریت دسته‌بندی کالاها"
                                    icon="📁"
                                    link="/dashboard/admin/categories"
                                    color="from-teal-500 to-cyan-500"
                                />
                                <QuickActionCard
                                    title="کاربران"
                                    description="مدیریت کاربران سایت"
                                    icon="👥"
                                    link="/dashboard/admin/users"
                                    color="from-orange-500 to-red-500"
                                />
                                <QuickActionCard
                                    title="چت‌ها"
                                    description="مدیریت پیام‌های کاربران"
                                    icon="✉️"
                                    link="/dashboard/admin/messages"
                                    color="from-amber-500 to-orange-500"
                                />
                            </>
                        )}
                    </div>
                </div>

                {/* پیش‌نمایش‌ها */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">
                    <SimplePreview
                        title="کالاهای من"
                        items={items.slice(0, 3)}
                        empty="کالایی ثبت نشده"
                        link="/dashboard/users/items"
                    >
                        {(it) => (
                            <>
                                <p className="font-medium text-lg">{it.title}</p>
                                <p className="text-sm text-gray-500 mt-1">
                                    {it.category?.title || "بدون دسته"} • {it.item_condition || "نامشخص"}
                                </p>
                            </>
                        )}
                    </SimplePreview>

                    <SimplePreview
                        title={isAdmin ? "آگهی‌های اخیر" : "آگهی‌های من"}
                        items={listings.slice(0, 3)}
                        empty="آگهی‌ای ثبت نشده"
                        link="/dashboard/users/listings"
                    >
                        {(l) => (
                            <>
                                <p className="font-medium text-lg">{l.title}</p>
                                <p className="text-sm text-gray-500 mt-1">
                                    {l.daily_fee?.toLocaleString()} تومان/روز • {l.status === "active" ? "فعال" : "متوقف"}
                                </p>
                            </>
                        )}
                    </SimplePreview>
                </div>

                {!isAdmin && (
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">
                        <SimplePreview
                            title="درخواست‌های من"
                            items={myLoanRequests.slice(0, 3)}
                            empty="درخواستی ثبت نشده"
                            link="/dashboard/users/loans"
                        >
                            {(l) => (
                                <>
                                    <p className="font-medium text-lg">{l.listing?.title}</p>
                                    <p className="text-sm text-gray-500 mt-1">وضعیت: {l.status}</p>
                                </>
                            )}
                        </SimplePreview>

                        <SimplePreview
                            title="درخواست‌ها برای کالاهای من"
                            items={incomingRequests.slice(0, 3)}
                            empty="درخواستی وجود ندارد"
                            link="/dashboard/users/loans"
                        >
                            {(l) => (
                                <>
                                    <p className="font-medium text-lg">{l.listing?.title}</p>
                                    <p className="text-sm text-gray-500 mt-1">
                                        از: {l.borrower?.full_name || l.borrower?.username || "کاربر"}
                                    </p>
                                </>
                            )}
                        </SimplePreview>
                    </div>
                )}

                {/* بخش ادمین: فقط درخواست‌های در انتظار */}
                {isAdmin && (
                    <div className="mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 mb-10 text-center">مدیریت سیستم</h2>
                        <SimplePreview
                            title="درخواست‌های در انتظار تأیید"
                            items={adminPendingLoans.slice(0, 3)}
                            empty="درخواست در انتظاری نیست"
                            link="/dashboard/admin/loans" // ← لینک درست به صفحه ادمین
                        >
                            {(l) => (
                                <>
                                    <p className="font-medium text-lg">{l.listing?.title}</p>
                                    <p className="text-sm text-gray-500 mt-1">
                                        توسط {l.borrower?.full_name || l.borrower?.username || "کاربر"}
                                    </p>
                                </>
                            )}
                        </SimplePreview>
                    </div>
                )}
            </div>

            <Footer />
        </div>
    );
}

// QuickActionCard و SimplePreview دقیقاً مثل قبل
function QuickActionCard({ title, description, icon, link, color }: { title: string; description: string; icon: string; link: string; color: string; }) {
    return (
        <Link href={link} className="group block w-full max-w-sm bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 p-10 text-center border border-gray-100 transform hover:-translate-y-2">
            <div className={`w-24 h-24 mx-auto mb-6 rounded-3xl bg-gradient-to-br ${color} flex items-center justify-center text-5xl text-white shadow-xl`}>
                {icon}
            </div>
            <h3 className="text-2xl font-bold text-gray-900 mb-3">{title}</h3>
            <p className="text-base text-gray-600 leading-relaxed mb-6">{description}</p>
            <p className="text-indigo-600 font-semibold group-hover:text-indigo-700 transition text-lg">
                وارد شوید →
            </p>
        </Link>
    );
}

function SimplePreview({ title, items, empty, link, children }: { title: string; items: any[]; empty: string; link: string; children: (item: any) => JSX.Element; }) {
    return (
        <div className="bg-white rounded-3xl shadow-2xl p-10 border">
            <div className="flex items-center justify-between mb-8">
                <h2 className="text-2xl font-bold text-gray-900">{title}</h2>
                <Link href={link} className="text-indigo-600 hover:underline font-medium text-lg">
                    مشاهده همه →
                </Link>
            </div>

            {items.length === 0 ? (
                <div className="text-center py-16">
                    <p className="text-xl text-gray-500">{empty}</p>
                </div>
            ) : (
                <div className="space-y-6">
                    {items.map((item) => (
                        <div key={item.id} className="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 hover:from-gray-100 hover:to-gray-200 transition shadow">
                            {children(item)}
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}