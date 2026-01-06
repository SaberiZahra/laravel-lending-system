"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import Header from "@/components/Header";
import { authAPI } from "@/lib/api";
import { EyeIcon, EyeSlashIcon } from "@heroicons/react/24/outline";

const LoginPage: React.FC = () => {
  const router = useRouter();
  const [login, setLogin] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [remember, setRemember] = useState<boolean>(false);
  const [showPassword, setShowPassword] = useState<boolean>(false);
  const [error, setError] = useState<string>("");
  const [loading, setLoading] = useState<boolean>(false);

  // وقتی صفحه باز میشه، اگر قبلاً "مرا به خاطر بسپار" فعال بوده، نام کاربری رو پر کن
  useEffect(() => {
    const rememberedLogin = localStorage.getItem("remembered_login");
    const shouldRemember = localStorage.getItem("remember_me") === "true";

    if (shouldRemember && rememberedLogin) {
      setLogin(rememberedLogin);
      setRemember(true);
    }
  }, []);

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      const response = await authAPI.login({
        login: login.trim(),
        password,
      });

      if (response.access_token) {
        // اگر "مرا به خاطر بسپار" تیک خورده باشد، نام کاربری رو ذخیره کن
        if (remember) {
          localStorage.setItem("remember_me", "true");
          localStorage.setItem("remembered_login", login.trim());
        } else {
          localStorage.removeItem("remember_me");
          localStorage.removeItem("remembered_login");
        }

        router.push("/dashboard");
      }
    } catch (err: any) {
      setError(
          err.response?.data?.message || "خطا در ورود. لطفاً دوباره تلاش کنید."
      );
    } finally {
      setLoading(false);
    }
  };

  return (
      <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50">
        <Header />
        <div className="min-h-screen grid lg:grid-cols-2">
          {/* فرم لاگین - سمت راست در RTL */}
          <div className="flex items-center justify-center px-6 py-12 lg:py-0">
            <div className="w-full max-w-md">
              <div className="bg-white rounded-3xl shadow-2xl p-8 lg:p-10">
                <h1 className="text-4xl font-bold text-right text-gray-900 mb-8">
                  ورود به حساب
                </h1>

                <form onSubmit={handleSubmit} className="space-y-6">
                  {/* نام کاربری یا ایمیل */}
                  <div>
                    <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                      نام کاربری یا ایمیل
                    </label>
                    <input
                        type="text"
                        value={login}
                        onChange={(e) => setLogin(e.target.value)}
                        required
                        className="w-full px-4 py-3 rounded-xl border border-gray-300 text-right
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               transition-all duration-200"
                        placeholder="example@domain.com"
                    />
                  </div>

                  {/* رمز عبور با آیکون چشم */}
                  <div>
                    <label className="block text-sm font-medium text-gray-700 text-right mb-2">
                      رمز عبور
                    </label>
                    <div className="relative">
                      <input
                          type={showPassword ? "text" : "password"}
                          value={password}
                          onChange={(e) => setPassword(e.target.value)}
                          required
                          className="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 text-right
                                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                 transition-all duration-200"
                          placeholder="••••••••"
                      />
                      <button
                          type="button"
                          onClick={() => setShowPassword(!showPassword)}
                          className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                      >
                        {showPassword ? (
                            <EyeSlashIcon className="w-5 h-5"/>
                        ) : (
                            <EyeIcon className="w-5 h-5"/>
                        )}
                      </button>
                    </div>
                  </div>

                  {/* پیام خطا */}
                  {error && (
                      <div
                          className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-right text-sm">
                        {error}
                      </div>
                  )}

                  {/* فراموشی رمز و مرا به خاطر بسپار */}
                  <div className="flex items-center justify-between">
                    <Link
                        href="/forgot-password"
                        className="text-sm text-blue-600 hover:text-blue-800 hover:underline transition"
                    >
                      فراموشی رمز عبور؟
                    </Link>

                    <label className="flex items-center gap-3 cursor-pointer group">
                    <span className="text-sm text-gray-700 group-hover:text-gray-900 transition">
                      مرا به خاطر بسپار
                    </span>
                      <div className="relative">
                        <input
                            type="checkbox"
                            checked={remember}
                            onChange={(e) => setRemember(e.target.checked)}
                            className="sr-only"
                        />
                        <div
                            className={`w-11 h-6 rounded-full transition-all duration-300 ${
                                remember ? "bg-blue-600" : "bg-gray-300"
                            }`}
                        >
                          <div
                              className={`w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 ${
                                  remember ? "translate-x-5" : "translate-x-0.5"
                              } mt-0.5`}
                          />
                        </div>
                      </div>
                    </label>
                  </div>

                  {/* دکمه ورود */}
                  <button
                      type="submit"
                      disabled={loading}
                      className="w-full py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg
                             hover:from-blue-700 hover:to-indigo-700
                             shadow-lg hover:shadow-xl transform hover:-translate-y-1
                             transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none"
                  >
                    {loading ? "در حال ورود..." : "ورود به حساب"}
                  </button>
                </form>

                {/* ثبت نام */}
                <p className="mt-8 text-center text-gray-600">
                  حساب کاربری ندارید؟{" "}
                  <Link
                      href="/signUp"
                      className="text-blue-600 font-bold hover:text-blue-800 hover:underline transition"
                  >
                    ثبت نام کنید
                  </Link>
                </p>
              </div>
            </div>
          </div>

          {/* تصویر سمت چپ - بدون هیچ تغییری */}
          <div
              className="hidden lg:block bg-gradient-to-br from-blue-600 to-indigo-600 bg-no-repeat bg-center bg-cover"
              style={{
                backgroundImage: "url('/Wavy_Gen-01_Single-07.jpg')",
                // backgroundImage: "url('/Hand holding phone with screen lock flat vector illustration.jpg')",
                // backgroundImage: "url('https://img.freepik.com/free-vector/access-control-system-abstract-concept_335657-3180.jpg?semt=ais_hybrid&w=740&q=80')",
              }}
          />
        </div>
      </div>
  );
};

export default LoginPage;