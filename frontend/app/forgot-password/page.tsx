"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import Header from "@/components/Header";
import { authAPI } from "@/lib/api";
import { EyeIcon, EyeSlashIcon } from "@heroicons/react/24/outline";

export default function ForgotPasswordPage() {
  const router = useRouter();
  const [email, setEmail] = useState("");
  const [code, setCode] = useState("");
  const [newPassword, setNewPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState(""); // ← اضافه شد
  const [showPassword, setShowPassword] = useState(false);
  const [step, setStep] = useState<"email" | "code" | "password">("email");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [message, setMessage] = useState("");

  // مرحله ۱: ارسال کد
  const handleSendCode = async (e: React.FormEvent) => {
    e.preventDefault();
    setError("");
    setMessage("");
    setLoading(true);

    try {
      await authAPI.forgotPassword({ email: email.trim() });

      setMessage("کد بازیابی با موفقیت به ایمیل شما ارسال شد. لطفاً اینباکس یا اسپم را چک کنید.");
      setStep("code");
    } catch (err: any) {
      if (!err.response || err.response.status >= 500 || err.message.includes("Network")) {
        setError("مشکل در ارتباط با سرور. لطفاً دوباره تلاش کنید.");
      } else {
        setMessage("کد بازیابی با موفقیت به ایمیل شما ارسال شد.");
        setStep("code");
      }
    } finally {
      setLoading(false);
    }
  };

  // مرحله ۲: تأیید کد
  const handleVerifyCode = async (e: React.FormEvent) => {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      await authAPI.verifyResetCode({ email: email.trim(), code: code.trim() });

      setStep("password");
      setMessage("");
    } catch (err: any) {
      setError("کد وارد شده نامعتبر یا منقضی شده است.");
    } finally {
      setLoading(false);
    }
  };

  // مرحله ۳: تغییر رمز عبور
  const handleResetPassword = async (e: React.FormEvent) => {
    e.preventDefault();
    setError("");
    setMessage("");
    setLoading(true);

    // چک محلی: رمز و تأیید برابر باشند
    if (newPassword !== confirmPassword) {
      setError("رمز عبور و تأیید آن برابر نیستند.");
      setLoading(false);
      return;
    }

    try {
      await authAPI.resetPassword({
        email: email.trim(),
        code: code.trim(),
        password: newPassword,
        password_confirmation: confirmPassword, // ← فرستاده می‌شه
      });

      setMessage("رمز عبور با موفقیت تغییر یافت! در حال انتقال به صفحه ورود...");
      setTimeout(() => router.push("/login"), 2000);
    } catch (err: any) {
      setError("خطا در تغییر رمز عبور. لطفاً دوباره تلاش کنید.");
    } finally {
      setLoading(false);
    }
  };

  return (
      <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50">
        <Header />
        <div className="flex items-center justify-center min-h-[calc(100vh-80px)] px-6 py-12">
          <div className="w-full max-w-md">
            <div className="bg-white rounded-3xl shadow-2xl p-8 lg:p-10">
              <h1 className="text-4xl font-bold text-right text-gray-900 mb-8">
                بازیابی رمز عبور
              </h1>

              {/* مرحله ایمیل */}
              {step === "email" && (
                  <form onSubmit={handleSendCode} className="space-y-6">
                    <div>
                      <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                        ایمیل حساب کاربری
                      </label>
                      <input
                          type="email"
                          value={email}
                          onChange={(e) => setEmail(e.target.value)}
                          required
                          className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                          placeholder="example@domain.com"
                      />
                    </div>

                    {message && (
                        <div className="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-right text-sm">
                          {message}
                        </div>
                    )}

                    {error && (
                        <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-right text-sm">
                          {error}
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={loading}
                        className="w-full py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                      {loading ? "در حال ارسال..." : "ارسال کد بازیابی"}
                    </button>
                  </form>
              )}

              {/* مرحله کد */}
              {step === "code" && (
                  <form onSubmit={handleVerifyCode} className="space-y-6">
                    <div>
                      <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                        کد ۶ رقمی دریافت شده
                      </label>
                      <input
                          type="text"
                          value={code}
                          onChange={(e) => setCode(e.target.value.replace(/\D/g, "").slice(0, 6))}
                          required
                          maxLength={6}
                          className="w-full px-4 py-3 rounded-xl border border-gray-300 text-center text-lg tracking-widest font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                          placeholder="------"
                      />
                      <p className="text-xs text-gray-500 text-right mt-2">
                        کد را از ایمیل دریافتی کپی کنید. اگر نرسید، پوشه اسپم را چک کنید.
                      </p>
                    </div>

                    {error && (
                        <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-right text-sm">
                          {error}
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={loading}
                        className="w-full py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 disabled:opacity-60"
                    >
                      {loading ? "در حال بررسی..." : "تأیید کد"}
                    </button>

                    <button
                        type="button"
                        onClick={() => {
                          setStep("email");
                          setCode("");
                          setError("");
                        }}
                        className="w-full mt-4 text-blue-600 hover:text-blue-800 text-sm"
                    >
                      ارسال مجدد کد
                    </button>
                  </form>
              )}

              {/* مرحله رمز جدید — با تأیید رمز */}
              {step === "password" && (
                  <form onSubmit={handleResetPassword} className="space-y-6">
                    <div>
                      <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                        رمز عبور جدید
                      </label>
                      <div className="relative">
                        <input
                            type={showPassword ? "text" : "password"}
                            value={newPassword}
                            onChange={(e) => setNewPassword(e.target.value)}
                            required
                            minLength={6}
                            className="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="حداقل ۶ کاراکتر"
                        />
                        <button
                            type="button"
                            onClick={() => setShowPassword(!showPassword)}
                            className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                        >
                          {showPassword ? <EyeSlashIcon className="w-5 h-5" /> : <EyeIcon className="w-5 h-5" />}
                        </button>
                      </div>
                    </div>

                    <div>
                      <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                        تأیید رمز عبور جدید
                      </label>
                      <div className="relative">
                        <input
                            type={showPassword ? "text" : "password"}
                            value={confirmPassword}
                            onChange={(e) => setConfirmPassword(e.target.value)}
                            required
                            className="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="رمز را دوباره وارد کنید"
                        />
                        <button
                            type="button"
                            onClick={() => setShowPassword(!showPassword)}
                            className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                        >
                          {showPassword ? <EyeSlashIcon className="w-5 h-5" /> : <EyeIcon className="w-5 h-5" />}
                        </button>
                      </div>
                    </div>

                    {/* چک محلی برای برابر بودن رمزها */}
                    {newPassword && confirmPassword && newPassword !== confirmPassword && (
                        <div className="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-xl text-right text-sm">
                          رمز عبور و تأیید آن برابر نیستند.
                        </div>
                    )}

                    {message && (
                        <div className="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-right text-sm">
                          {message}
                        </div>
                    )}

                    {error && (
                        <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-right text-sm">
                          {error}
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={loading || newPassword !== confirmPassword || newPassword.length < 6}
                        className="w-full py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                      {loading ? "در حال تغییر..." : "تغییر رمز عبور"}
                    </button>
                  </form>
              )}

              <p className="mt-8 text-center text-gray-600">
                <Link href="/login" className="text-blue-600 font-bold hover:text-blue-800 hover:underline transition">
                  بازگشت به صفحه ورود
                </Link>
              </p>
            </div>
          </div>
        </div>
      </div>
  );
}