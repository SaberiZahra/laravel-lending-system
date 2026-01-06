"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import Header from "@/components/Header";
import { authAPI } from "@/lib/api";
import { EyeIcon, EyeSlashIcon } from "@heroicons/react/24/outline";

const SignupPage: React.FC = () => {
  const router = useRouter();
  const [fullname, setFullname] = useState<string>("");
  const [username, setUsername] = useState<string>("");
  const [email, setEmail] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [phone, setPhone] = useState<string>("");
  const [address, setAddress] = useState<string>("");
  const [showPassword, setShowPassword] = useState<boolean>(false);
  const [error, setError] = useState<string>("");
  const [loading, setLoading] = useState<boolean>(false);

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      const response = await authAPI.register({
        full_name: fullname.trim(),
        username: username.trim(),
        email: email.trim(),
        password,
        phone: phone.trim() || undefined,
        address: address.trim() || undefined,
      });

      if (response.access_token) {
        router.push("/dashboard");
      }
    } catch (err: any) {
      const errorMessage =
          err.response?.data?.message ||
          err.response?.data?.errors ||
          "خطا در ثبت نام. لطفاً دوباره تلاش کنید.";
      setError(
          typeof errorMessage === "string"
              ? errorMessage
              : JSON.stringify(errorMessage)
      );
    } finally {
      setLoading(false);
    }
  };

  return (
      <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50">
        <Header />
        <div className="min-h-screen grid lg:grid-cols-2">
          {/* فرم ثبت نام - سمت راست در RTL */}
          <div className="flex items-center justify-center px-6 py-12 lg:py-0">
            {/* باکس سفید عریض‌تر شد */}
            <div className="w-full max-w-3xl"> {/* از max-w-md به max-w-3xl تغییر کرد → عریض‌تر و زیبا */}
              <div className="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                <h1 className="text-4xl font-bold text-right text-gray-900 mb-10">
                  ایجاد حساب جدید
                </h1>

                <form onSubmit={handleSubmit} className="space-y-8">
                  {/* گرید دو ستونه برای فیلدها */}
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {/* ستون اول */}
                    <div className="space-y-6">
                      {/* نام و نام خانوادگی */}
                      <div>
                        <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                          نام و نام خانوادگی <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            value={fullname}
                            onChange={(e) => setFullname(e.target.value)}
                            required
                            className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   transition-all duration-200"
                            placeholder="علی احمدی"
                        />
                      </div>

                      {/* نام کاربری */}
                      <div>
                        <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                          نام کاربری <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            value={username}
                            onChange={(e) => setUsername(e.target.value)}
                            required
                            className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   transition-all duration-200"
                            placeholder="ali_ahmadi"
                        />
                      </div>

                      {/* ایمیل */}
                      <div>
                        <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                          ایمیل <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                            className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   transition-all duration-200"
                            placeholder="ali@example.com"
                        />
                      </div>
                    </div>

                    {/* ستون دوم */}
                    <div className="space-y-6">
                      {/* شماره تماس */}
                      <div>
                        <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                          شماره تماس
                        </label>
                        <input
                            type="tel"
                            value={phone}
                            onChange={(e) => setPhone(e.target.value)}
                            className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   transition-all duration-200"
                            placeholder="09123456789"
                        />
                      </div>

                      {/* رمز عبور با آیکون چشم */}
                      <div>
                        <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                          رمز عبور <span className="text-red-500">*</span>
                        </label>
                        <div className="relative">
                          <input
                              type={showPassword ? "text" : "password"}
                              value={password}
                              onChange={(e) => setPassword(e.target.value)}
                              required
                              minLength={6}
                              className="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 text-right
                                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                     transition-all duration-200"
                              placeholder="حداقل ۶ کاراکتر"
                          />
                          <button
                              type="button"
                              onClick={() => setShowPassword(!showPassword)}
                              className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                          >
                            {showPassword ? (
                                <EyeSlashIcon className="w-5 h-5" />
                            ) : (
                                <EyeIcon className="w-5 h-5" />
                            )}
                          </button>
                        </div>
                      </div>

                      {/* آدرس - تمام عرض (span دو ستون در موبایل) */}
                      <div className="md:col-span-2">
                        <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                          آدرس
                        </label>
                        <textarea
                            value={address}
                            onChange={(e) => setAddress(e.target.value)}
                            rows={3}
                            className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   transition-all duration-200 resize-none"
                            placeholder="تهران، خیابان آزادی، پلاک ۱۲۳..."
                        />
                      </div>
                    </div>
                  </div>

                  {/* پیام خطا */}
                  {error && (
                      <div className="md:col-span-2 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl text-right text-sm">
                        {error}
                      </div>
                  )}

                  {/* دکمه ثبت نام - تمام عرض */}
                  <div className="md:col-span-2">
                    <button
                        type="submit"
                        disabled={loading}
                        className="w-full py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg
                               hover:from-blue-700 hover:to-indigo-700
                               shadow-lg hover:shadow-xl transform hover:-translate-y-1
                               transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none"
                    >
                      {loading ? "در حال ثبت نام..." : "ثبت نام"}
                    </button>
                  </div>
                </form>

                {/* لینک ورود */}
                <p className="mt-10 text-center text-gray-600">
                  قبلاً حساب دارید؟{" "}
                  <Link
                      href="/login"
                      className="text-blue-600 font-bold hover:text-blue-800 hover:underline transition"
                  >
                    وارد شوید
                  </Link>
                </p>
              </div>
            </div>
          </div>

          {/* تصویر سمت چپ - بدون هیچ تغییری */}
          <div
              className="hidden lg:block bg-gradient-to-br from-blue-600 to-indigo-600 bg-no-repeat bg-center bg-cover"
              style={{
                // backgroundImage: "url('/Wavy_Gen-01_Single-07.jpg')",
                backgroundImage: "url('/Hand holding phone with screen lock flat vector illustration.jpg')",
                // backgroundImage: "url('https://img.freepik.com/free-vector/sign-page-abstract-concept-illustration_335657-2242.jpg?semt=ais_hybrid&w=740&q=80')",
              }}
          />
        </div>
      </div>
  );
};

export default SignupPage;